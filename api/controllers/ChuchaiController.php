<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use api\functionGlobal\FunctionRand;
use backend\modules\gongchu\models\Gongchu;
use backend\modules\message\models\Message;

/**
 * 出差管理 api
 */
class ChuchaiController extends ActiveController
{
    public $modelClass = 'backend\modules\chuchai\models\Chuchai';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items'
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['contentNegotiator']['formats']['application/xml']);
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        // 注销系统自带的实现方法
        unset($actions['index'], $actions['update'], $actions['create'], $actions['delete'], $actions['view']);
        return $actions;
    }
    public function actionView($id,$userid,$user_key)
    {
        $userid = (int)$userid;
        $id = (int)$id;
        FunctionRand::UserAuth($userid,$user_key);
        $model=$this->findModel($id);
        $data = $model->attributes;
        $data['dept_name'] = Gongchu::getDeptNameById($model->dept);
        $data['dept_leader_name'] = Gongchu::getUserNamesByIds($model->dept_leader);
        $data['branch_name'] = Gongchu::getUserNamesByIds($model->branch_leader);
        $data['chief_name'] = Gongchu::getUserNamesByIds($model->chief);
        if(!empty($data)){
            FunctionRand::View(1, 'Success', $data);
        }else{
            FunctionRand::Error(2, '参数无效或缺失');
        }

    }
    //我发起的、我审批的list
    public function actionList($userid,$user_key,$type)
    {
        $userid = (int)$userid;
        $type = (int)$type;
        FunctionRand::UserAuth($userid, $user_key);
        $page = !isset($_GET['page']) ? 1 : (int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1) * $page_size;
        $modelClass = new $this->modelClass();
        $query = $modelClass->find();
        if ($type == 1) {//我发起的
            $query->where("apply_ren = :apply_ren and user_delete = 0",['apply_ren' => $userid]);
            $count = $query;
            $count = $count->count();
            $data = $query->select(['chuchai.id','user.name','apply_time','dept_audit','branch_audit','chief_audit'])
                ->join('LEFT JOIN', 'user', 'user.id = chuchai.apply_ren')
                ->orderBy('apply_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        } elseif ($type == 2) {//我审批的
            $query->where('(dept_leader=:dept_leader and dept_delete=:dept_delete)
                    or (branch_leader=:dept_leader and branch_delete=:dept_delete and dept_audit=:dept_audit)
                    or (chief=:dept_leader and chief_delete=:dept_delete and dept_audit=:dept_audit and branch_audit=:dept_audit)',
                [':dept_leader'=>$userid,':dept_delete'=>0,':dept_audit'=>1,]);
            $count = $query;
            $count = $count->count();
            $data = $query->select(['chuchai.id','user.name','apply_time','dept_audit','branch_audit','chief_audit'])
                ->join('LEFT JOIN', 'user', 'user.id = chuchai.apply_ren')
                ->orderBy('apply_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        }
        FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
    }
    public function actionAdd()
    {
        $modelClass = $this->modelClass;
        $model = new $modelClass();
        /*$_POST['format'] = [
            'userid' => 1,
            'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
            'dept' => 1,
            'cc_ren' => '1,2,3',
            'chuchairen' => '审批2,审批3,审批4',
            'cc_count' => 3,
            'apply_ren' => '1',
            'cc_date' => '2016-05-31',
            'end_date' => '2016-06-03',
            'cc_place' => '出差地点',
            'cc_transporation' => '交通工具',
            'cc_task' => '出差任务',
            'dept_leader' => '1',
            'branch_leader' => 2,
            'chief' => 3,
        ];
        $_POST['format'] = json_encode($_POST['format']);*/
        $post = json_decode($_POST['format'],true);
        FunctionRand::UserAuth($post['userid'],$post['user_key']);
        $model->attributes = FunctionRand::PostFormat($post);
        $model->apply_time = date('Y-m-d H:i:s',time());
        $model->dept_audit = 0;
        if($model->dept_leader==$post['userid']){
            $model->dept_leader=0;
            $model->dept_audit=1;//如果为用户本身为科室领导，则更新科室状态为审批同意，方便下级审核审核
            Message::sendMsgApi('出差申请',Gongchu::getUserNamesByIds($post['userid']).'发起了一个出差申请',$model->branch_leader,['chuchai/audit/index','api_url' => "index.php/chuchai/view?id=".$model->id],$post['userid']);
        }elseif($model->branch_leader==$post['userid']){
            $model->dept_leader=0;
            $model->dept_audit=1;//如果为用户本身为科室领导，则更新科室状态为审批同意，方便下级审核审核
            $model->branch_leader=0;
            $model->branch_audit=1;//如果为用户本身为院领导，则更新科室状态为审批同意，方便下级审核审核
            Message::sendMsgApi('出差申请',Gongchu::getUserNamesByIds($post['userid']).'发起了一个出差申请',$model->chief,['chuchai/audit/index','api_url' => "index.php/chuchai/view?id=".$model->id],$post['userid']);
        }else{
            Message::sendMsgApi('出差申请',Gongchu::getUserNamesByIds($post['userid']).'发起了一个出差申请',$model->dept_leader,['chuchai/audit/index','api_url' => "index.php/chuchai/view?id=".$model->id],$post['userid']);
        }
        if (! $model->save()) {
            FunctionRand::Error(2, $model->getFirstErrors());
        }else{
            FunctionRand::View(1, 'success');
        }
    }
    //申请审核
    public function actionShenpi($id,$type)
    {
        $id = (int)$id;
        $model = $this->findModel($id);
        $mods=$this->findModel($id);
        $mods->dept=Gongchu::getDeptNameById($model->dept);
        $mods->cc_ren=Gongchu::getUserNamesByIds($model->cc_ren);
        $mods->apply_ren=Gongchu::getUserNamesByIds($model->apply_ren);
        $mods->apply_time=substr($model->apply_time,0,-3);
        if($model->dept_audit==0){//审核中状态 不加审批时间
            $mods->dept_leader=Gongchu::getUserNamesByIds($model->dept_leader).'('.Gongchu::getStatusById($model->dept_audit).')';
        }else{
            $mods->dept_leader=Gongchu::getUserNamesByIds($model->dept_leader).'('.Gongchu::getStatusById($model->dept_audit).')'.' '.substr($model->dept_audit_time,0,-3);
        }
        if($model->branch_audit==0){
            $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader).'('.Gongchu::getStatusById($model->branch_audit).')';
        }else{
            $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader).'('.Gongchu::getStatusById($model->branch_audit).')'.' '.substr($model->branch_audit_time,0,-3);
        }
        if($model->chief_audit==0){
            $mods->chief=Gongchu::getUserNamesByIds($model->chief).'('.Gongchu::getStatusById($model->chief_audit).')';
        }else{
            $mods->chief=Gongchu::getUserNamesByIds($model->chief).'('.Gongchu::getStatusById($model->chief_audit).')'.' '.substr($model->chief_audit_time,0,-3);
        }
        /*$_POST['format'] = [
            'userid' => 1,
            'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
            'chief_audit' => 2,
            'chief_reason' => '院领导返驳原因',
        ];
        $_POST['format'] = json_encode($_POST['format']);*/
        if(!isset($_POST['format'])){
            FunctionRand::Error(2, '无效的访问');
        }
        $post = json_decode($_POST['format'],1);
        FunctionRand::UserAuth((int)$post['userid'],$post['user_key']);
        $auditStatus=$post['chief_audit'];
        if($type=='dept'){
            if($auditStatus==1){
                $model->dept_audit=1;//部门审批同意
                Message::sendMsgApi('审批同意',Gongchu::getUserNamesByIds($post['userid']).'同意了一个出差申请',$model->branch_leader,['chuchai/audit/index','api_url' => "index.php/chuchai/view?id=".$id],$post['userid']);
            }elseif($auditStatus==2){
                $model->dept_audit=2;//部门审批驳回
                $model->dept_reason=$post['chief_reason'];
                $model->audit_status=2;//申请驳回，审核状态为驳回
                Message::sendMsgApi('审批驳回',Gongchu::getUserNamesByIds($post['userid']).'驳回了一个出差申请',$model->apply_ren,['chuchai/chuchai/index','api_url' => "index.php/chuchai/view?id=".$id],$post['userid']);
            }
            $model->dept_audit_time=date('Y-m-d H:i:s',time());
        }elseif($type=='branch'){
            if($auditStatus==1){
                $model->branch_audit=1;//院审批同意
                Message::sendMsgApi('审批同意',Gongchu::getUserNamesByIds($post['userid']).'同意了一个出差申请',$model->chief,['chuchai/audit/index','api_url' => "index.php/chuchai/view?id=".$id],$post['userid']);
            }elseif($auditStatus==2){
                $model->branch_audit=2;//院审批驳回
                $model->branch_reason=$post['chief_reason'];
                $model->audit_status=2;//申请驳回，审核状态为驳回
                Message::sendMsgApi('审批驳回',Gongchu::getUserNamesByIds($post['userid']).'驳回了一个出差申请',$model->apply_ren,['chuchai/chuchai/index','api_url' => "index.php/chuchai/view?id=".$id],$post['userid']);
            }
            $model->branch_audit_time=date('Y-m-d H:i:s',time());
        }else{
            if($auditStatus==1){
                $model->chief_audit=1;//检查长审批同意
                $model->audit_status=1;//申请同意，审核状态为同意
                Message::sendMsgApi('审批同意',Gongchu::getUserNamesByIds($post['userid']).'同意了一个出差申请',$model->apply_ren,['chuchai/audit/index','api_url' => "index.php/chuchai/view?id=".$id],$post['userid']);
            }elseif($auditStatus==2){
                $model->chief_audit=2;//检查长审批驳回
                $model->chief_reason=$post['chief_reason'];
                $model->audit_status=2;//申请驳回，审核状态为驳回
                Message::sendMsgApi('审批驳回',Gongchu::getUserNamesByIds($post['userid']).'驳回了一个出差申请',$model->apply_ren,['chuchai/chuchai/index','api_url' => "index.php/chuchai/view?id=".$id],$post['userid']);
            }
            $model->chief_audit_time=date('Y-m-d H:i:s',time());
        }
        if($model->save(false)){
            FunctionRand::View(1, 'success');
        }else{
            FunctionRand::Error(2, 'false');
        }
    }
    //罗辑除删
    public function actionDel($id,$type,$userid,$user_key)
    {//各级审核记录删除 逻辑删除
        $id = (int)$id;
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        if($type=='dept'){
            $model=$this->findModel($id);
            $model->setAttribute('dept_delete',1);
            $model->save(false);
        }elseif($type== 'branch'){
            $model=$this->findModel($id);
            $model->setAttribute('branch_delete',1);
            $model->save(false);
        }elseif($type== 'chief'){
            $model=$this->findModel($id);
            $model->setAttribute('chief_delete',1);
            $model->save(false);
        }else{
            $model=$this->findModel($id);
            $model->setAttribute('user_delete',1);
            $model->save(false);
        }
        FunctionRand::View(1, 'success');
    }
    protected function findModel($id)
    {
        $modelClass = $this->modelClass;
        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            FunctionRand::View(0, NotFoundHttpException('The requested page does not exist.'));
        }
    }
}