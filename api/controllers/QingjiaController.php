<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use api\functionGlobal\FunctionRand;
use backend\modules\gongchu\models\Gongchu;
use backend\modules\message\models\Message;

/**
 *  请假申请 api
 */
class QingjiaController extends ActiveController
{
    public $modelClass = 'backend\modules\qingjia\models\Qingjia';

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
    //请假申请详情
    public function actionView($id,$userid,$user_key)
    {
        FunctionRand::UserAuth((int)$userid,$user_key);
        $model=$this->findModel((int)$id);
        $data = $model->attributes;
        $data['dept_name'] = Gongchu::getDeptNameById($model->dept);
        $data['dept_leader_name'] = Gongchu::getUserNamesByIds($model->dept_leader);
        $data['branch_name'] = Gongchu::getUserNamesByIds($model->branch_leader);
        $data['zzc_name'] = Gongchu::getUserNamesByIds($model->zzc);
        $data['jcz_name'] = Gongchu::getUserNamesByIds($model->jcz);
        $data['position_name'] = Gongchu::getPositionName($model->position);
        if(!empty($data)){
            FunctionRand::View(1, 'Success', $data);
        }else{
            FunctionRand::Error(100, '参数无效或缺失');
        }
    }
    //我发起的、我审批的list
    public function actionList($userid,$user_key,$type)
    {
        $userid = (int)$userid;
        $type = (int)$type;
        FunctionRand::UserAuth($userid,$user_key);
        $page = !isset($_GET['page'])?1:(int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1)*$page_size;
        $modelClass = new $this->modelClass();
        $query = $modelClass->find();
        if($type == 1){//我发起的
            $query->where("qj_ren = :qj_ren and user_delete = 0",['qj_ren' => $userid]);
            $count = $query;
            $count = $count->count();
            $data = $query->select(['qingjia.id','user.name','qj_time','dept_audit','branch_audit','zzc_audit','jcz_audit'])
                ->join('LEFT JOIN', 'user', 'user.id = qingjia.qj_ren')
                ->orderBy('apply_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        }elseif($type == 2) {//我审批的
            $query->where('(dept_leader=:dept_leader and dept_delete=:dept_delete)
                    or (branch_leader=:dept_leader and branch_delete=:dept_delete and dept_audit=:dept_audit)
                    or (zzc=:dept_leader and zzc_delete=0 and dept_audit=:dept_audit and branch_audit=:dept_audit)
                    or (jcz=:dept_leader and jcz_delete=:dept_delete and dept_audit=:dept_audit and branch_audit=:dept_audit and zzc_audit=:dept_audit)',
                [':dept_leader'=>$userid,':dept_delete'=>0,':dept_audit'=>1,]);
            $count = $query;
            $count = $count->count();
            $data = $query->select(['qingjia.id','user.name','qj_time','dept_audit','branch_audit','zzc_audit','jcz_audit'])
                ->join('LEFT JOIN', 'user', 'user.id = qingjia.qj_ren')
                ->orderBy('apply_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();

        }
        FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
    }
    //发起请假申请
    public function actionAdd()
    {
        $modelClass = $this->modelClass;
        $model = new $modelClass();
        /*$_POST['format'] = [
            'userid' => 1,
            'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
            'qj_ren' => 1, //请假人
            'dept' => 27,//所属机构
            'position' => 1,//职务
            'qj_type' => 1,//请假类型
            'qj_time' => '2016-06-02 00:00:00',//请假开始时间
            'end_time' => '2016-06-03 00:00:00',//请假结束时间
            'qj_day' => 1,//请假时长
            'qj_reason' => '请假原因',
            'dept_leader' => 2, //科室领导
            'branch_leader' => 8,//分管领导
            'zzc' => 9,//政治处领导
            'jcz' => 1,//检查长
            'qingjiaren' => '请假人',
        ];
        $_POST['format'] = json_encode($_POST['format']);*/
        $post = json_decode($_POST['format'],true);
        $post = FunctionRand::PostFormat($post);
        $post['userid'] = (int)$post['userid'];
        FunctionRand::UserAuth($post['userid'],$post['user_key']);
        $model->attributes = $post;
        $model->dept =  $post['dept'];
        $model->position = $post['position'];
        $model->apply_time  = date('Y-m-d H:i:s',time());
        if($model->save()){
            if(isset($post['dept_leader']) && $post['dept_leader'] !=0 && !empty($post['dept_leader'])){
                $sen_ren = $post['dept_leader'];
            }elseif(isset($post['branch_leader']) && $post['branch_leader'] !=0 && !empty($post['branch_leader'])){
                $sen_ren = $post['branch_leader'];
            }elseif(isset($post['zzc']) && $post['zzc'] !=0 && !empty($post['zzc'])){
                $sen_ren = $post['zzc'];
            }else{
                $sen_ren = $post['jcz'];
            }
            Message::sendMsgApi('请假申请',gongchu::getUserNamesByIds($post['userid']).'发起了一个请假申请',$sen_ren,['qingjia/audit/index','api_url' => "index.php/qingjia/view?id=".$model->id],$post['userid']);
            FunctionRand::View(1, 'success');
        }else{
            FunctionRand::Error(2, $model->getFirstErrors());
        }
    }
    //申请审核
    public function actionShenpi($id,$type)
    {
        $id = (int)$id;
        $model = $this->findModel($id);
        $mods = $this->findModel($id);
        $mods->dept = Gongchu::getDeptNameById($model->dept);
        $mods->qj_ren = Gongchu::getUserNamesByIds($model->qj_ren);
        if($model->dept_audit == 0){//审核中状态 不加审批时间
            $mods->dept_leader = Gongchu::getUserNamesByIds($model->dept_leader).'('.Gongchu::getStatusById($model->dept_audit).')';
        }else{
            $mods->dept_leader = Gongchu::getUserNamesByIds($model->dept_leader).'('.Gongchu::getStatusById($model->dept_audit).')'.' '.substr($model->dept_audit_time,0,-3);
        }
        if($model->branch_audit==0){
            $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader).'('.Gongchu::getStatusById($model->branch_audit).')';
        }else{
            $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader).'('.Gongchu::getStatusById($model->branch_audit).')'.' '.substr($model->branch_audit_time,0,-3);
        }
        if($model->zzc_audit==0){
            $mods->zzc=Gongchu::getUserNamesByIds($model->zzc).'('.Gongchu::getStatusById($model->zzc_audit).')';
        }else{
            $mods->zzc=Gongchu::getUserNamesByIds($model->zzc).'('.Gongchu::getStatusById($model->zzc_audit).')'.' '.substr($model->zzc_audit_time,0,-3);
        }
        if($model->jcz_audit==0){
            $mods->jcz=Gongchu::getUserNamesByIds($model->jcz).'('.Gongchu::getStatusById($model->jcz_audit).')';
        }else{
            $mods->jcz=Gongchu::getUserNamesByIds($model->jcz).'('.Gongchu::getStatusById($model->jcz_audit).')'.' '.substr($model->jcz_audit_time,0,-3);
        }
        /*$_POST['format'] = [
            'userid' => 1,
            'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
            'yuan_audit' => 2,
            'yuan_reason' => '院领导返驳原因',
        ];
        $_POST['format'] = json_encode($_POST['format']);*/
        $post = json_decode($_POST['format'],1);
        $post = FunctionRand::PostFormat($post);
        $post['userid'] = (int)$post['userid'];
        FunctionRand::UserAuth($post['userid'],$post['user_key']);
        $auditStatus=$post['yuan_audit'];
        if($type=='dept'){
            if($auditStatus==1){
                $model->dept_audit=1;//部门审批同意
                Message::sendMsgApi('审批同意',Gongchu::getUserNamesByIds($post['userid']).'同意了一个请假申请',$model->branch_leader,['qingjia/audit/index','api_url' => "index.php/qingjia/view?id=".$id],$post['userid']);
            }elseif($auditStatus==2){
                $model->dept_audit=2;//部门审批驳回
                $model->dept_reason=$post['yuan_reason'];
                $model->audit_status=2;//申请驳回，审核状态为驳回
                Message::sendMsgApi('审批驳回',Gongchu::getUserNamesByIds($post['userid']).'驳回了一个请假申请',$model->qj_ren,['qingjia/qingjia/index','api_url' => "index.php/qingjia/view?id=".$id],$post['userid']);
            }
            $model->dept_audit_time=date('Y-m-d H:i:s',time());
        }elseif($type=='branch'){
            if($auditStatus==1){
                $model->branch_audit=1;//院审批同意
                Message::sendMsgApi('审批同意',Gongchu::getUserNamesByIds($post['userid']).'同意了一个请假申请',$model->zzc,['qingjia/audit/index','api_url' => "index.php/qingjia/view?id=".$id],$post['userid']);
            }elseif($auditStatus==2){
                $model->branch_audit=2;//院审批驳回
                $model->branch_reason=$post['yuan_reason'];
                $model->audit_status=2;//申请驳回，审核状态为驳回
                Message::sendMsgApi('审批驳回',Gongchu::getUserNamesByIds($post['userid']).'驳回了一个请假申请',$model->qj_ren,['qingjia/qingjia/index','api_url' => "index.php/qingjia/view?id=".$id],$post['userid']);
            }
            $model->branch_audit_time=date('Y-m-d H:i:s',time());
        }elseif($type=='zzc'){
            if($auditStatus==1){
                $model->zzc_audit=1;//院审批同意
                if(!empty($model->jcz)){
                    Message::sendMsgApi('审批同意',Gongchu::getUserNamesByIds($post['userid']).'同意了一个请假申请',$model->jcz,['qingjia/audit/index','api_url' => "index.php/qingjia/view?id=".$id],$post['userid']);
                }else{
                    Message::sendMsgApi('审批同意',Gongchu::getUserNamesByIds($post['userid']).'同意了一个请假申请',$model->qj_ren,['qingjia/qingjia/index','api_url' => "index.php/qingjia/view?id=".$id],$post['userid']);
                }
                }elseif($auditStatus==2){
                $model->zzc_audit=2;//院审批驳回
                $model->zzc_reason=$post['yuan_reason'];
                $model->audit_status=2;//申请驳回，审核状态为驳回
                Message::sendMsgApi('审批驳回',Gongchu::getUserNamesByIds($post['userid']).'驳回了一个请假申请',$model->jcz,['qingjia/qingjia/index','api_url' => "index.php/qingjia/view?id=".$id],$post['userid']);
            }
            $model->zzc_audit_time=date('Y-m-d H:i:s',time());
        }else{
            if($auditStatus==1){
                $model->jcz_audit=1;//检查长审批同意
                $model->audit_status=1;//申请同意，审核状态为同意
                Message::sendMsgApi('审批同意',Gongchu::getUserNamesByIds($post['userid']).'同意了一个请假申请',$model->qj_ren,['qingjia/qingjia/index','api_url' => "index.php/qingjia/view?id=".$id],$post['userid']);
            }elseif($auditStatus==2){
                $model->jcz_audit=2;//检查长审批驳回
                $model->jcz_reason=$post['yuan_reason'];
                $model->audit_status=2;//申请同意，审核状态为同意
                Message::sendMsgApi('审批驳回',Gongchu::getUserNamesByIds($post['userid']).'驳回了一个请假申请',$model->qj_ren,['qingjia/qingjia/index','api_url' => "index.php/qingjia/view?id=".$id],$post['userid']);
            }
            $model->jcz_audit_time=date('Y-m-d H:i:s',time());
        }
        if($model->save(false)){
            FunctionRand::View(1, 'success');
        }else{
            FunctionRand::Error(2, 'false');
        }
    }
    //删除申请
    public function actionDel($id,$userid,$user_key,$type)
    {
        FunctionRand::UserAuth((int)$userid,$user_key);
        $model = $this->findModel($id);
        if($type == 'dept'){
            $model->setAttribute('dept_delete',1);
        }elseif($type == 'branch'){
            $model->setAttribute('branch_delete',1);
        }elseif($type == 'zzc'){
            $model->setAttribute('zzc_delete',1);
        }elseif($type == 'jcz'){
            $model->setAttribute('jcz_delete',1);
        }else{
            $model->setAttribute('user_delete',1);
        }
        $model->save(false);
        FunctionRand::View(1, 'success');
    }
    //请假类型
    public function actionQjtype($userid,$user_key)
    {
        FunctionRand::UserAuth((int)$userid,$user_key);
        $model =  'backend\modules\qingjia\models\QingjiaType';
        $model = new $model();
        $data = $model::find()->asArray()->all();
        FunctionRand::View(1, 'success',$data);
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