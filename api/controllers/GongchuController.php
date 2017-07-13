<?php
namespace api\controllers;

use backend\modules\gongchu\models\Gongchu;
use Yii;
use yii\rest\ActiveController;
use api\functionGlobal\FunctionRand;
use yii\db\mssql\PDO;
use backend\modules\message\models\Message;

/**
 * 公出管理 api
 */
class GongchuController extends ActiveController
{
    public $modelClass = 'backend\modules\gongchu\models\Gongchu';

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
        $id = (int)$id;
        FunctionRand::UserAuth((int)$userid,$user_key);
        $connection = \Yii::$app->db;
        $data = $connection->createCommand('SELECT * FROM {{%gongchu}} WHERE id = :id');
        $data->bindParam(':id', $id, PDO::PARAM_STR);
        $data = $data->queryOne();
        if(!empty($data)){
            $data['dept_name'] = Gongchu::getDeptNameById($data['dept']);
            $data['jbr_name'] = Gongchu::getUserNamesByIds($data['jb_ren']);
            $data['dept_leader_name'] = Gongchu::getUserNamesByIds($data['dept_leader']);
            $data['yuan_leader_name'] = Gongchu::getUserNamesByIds($data['yuan_leader']);
            $data['jcz_name'] = Gongchu::getUserNamesByIds($data['jcz']);
            FunctionRand::View(1, 'Success', $data);
        }else{
            FunctionRand::Error(2, '参数无效或缺失');
        }

    }
    //我发起的、我审批的list
    public function actionList($userid,$user_key,$type)
    {
        if (!is_numeric($type)) {
            FunctionRand::Error(2, '参数无效或缺失');
        }
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid, $user_key);
        $page = !isset($_GET['page']) ? 1 : (int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1) * $page_size;
        $modelClass = new $this->modelClass();
        $query = $modelClass->find();
        if ($type == 1) {//我发起的
            $query->where("jb_ren = :jb_ren and user_delete = 0",['jb_ren' => $userid]);
            $count = $query;
            $count = $count->count();
            $data = $query->select(['gongchu.id','user.name','gc_time','dept_audit','yuan_audit','jcz_audit'])
                ->join('LEFT JOIN', 'user', 'user.id = gongchu.jb_ren')
                ->orderBy('gc_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        } elseif ($type == 2) {//我审批的
            $query->where('(dept_leader=:dept_leader and dept_delete=:dept_delete)
                    or (yuan_leader=:dept_leader and yuan_delete=:dept_delete and dept_audit=:dept_audit)
                    or (jcz=:dept_leader and jcz_delete=:dept_delete and dept_audit=:dept_audit and yuan_audit=:dept_audit)',
                [':dept_leader'=>$userid,':dept_delete'=>0,':dept_audit'=>1,]);
            $count = $query;
            $count = $count->count();
            $data = $query->select(['gongchu.id','user.name','gc_time','dept_audit','yuan_audit','jcz_audit'])
                ->join('LEFT JOIN', 'user', 'user.id = gongchu.jb_ren')
                ->orderBy('gc_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        }
        FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
    }
    //公出申请
    public function actionAdd()
    {
        $modelClass = $this->modelClass;
        $model = new $modelClass();
        /*$_POST['Gongchu'] = [
            'userid' => 1,
            'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
            'dept' => 5,
            'gc_ren' => '1,2,8',
            'gongchurens' => '公出人1,公出人2,公出人3',
            'gc_count' => 3,
            'gc_time' => '2016-05-26',
            'end_time' => '2016-05-27',
            'gc_place' => '公出地点',
            'ygwc' => '因公外出',
            'jb_ren' => '1',
            'dept_leader' => 2,
            'dept_audit' => 0,
            'yuan_leader' => 8,
            'yuan_audit' => 0,
            'jcz' => 8,
            'yuan_audit' => 0
        ];
        $_POST['Gongchu'] = json_encode($_POST['Gongchu']);*/
        $post = json_decode($_POST['Gongchu'],1);
        $post = FunctionRand::PostFormat($post);
        $post['userid'] = (int)$post['userid'];
        FunctionRand::UserAuth($post['userid'],$post['user_key']);
        $model->apply_time = date('Y-m-d H:i:s',time());
        if($model->dept_leader==$post['userid']){
            $model->dept_leader=0;
            $model->dept_audit=1;//如果为用户本身为科室领导，则更新科室状态为审批同意，方便下级审核审核
            Message::sendMsgApi('公出申请',Gongchu::getUserNamesByIds($post['userid']).'发起了一个公出申请',$model->yuan_leader,['gongchu/audit/index','api_url' => "index.php/gongchu/view?id=".$model->id],$post['userid']);
        }elseif($model->yuan_leader==$post['userid']){
            $model->dept_leader=0;
            $model->dept_audit=1;//如果为用户本身为科室领导，则更新科室状态为审批同意，方便下级审核审核
            $model->yuan_leader=0;
            $model->yuan_audit=1;//如果为用户本身为院领导，则更新科室状态为审批同意，方便下级审核审核
            $model->jcz=$post['jcz'];
            $model->jcz_audit=$post['jcz_audit'];
            Message::sendMsgApi('公出申请',Gongchu::getUserNamesByIds($post['userid']).'发起了一个公出申请',$model->jcz,['gongchu/audit/index','api_url' => "index.php/gongchu/view?id=".$model->id],$post['userid']);
        }else{
            Message::sendMsgApi('公出申请',Gongchu::getUserNamesByIds($post['userid']).'发起了一个公出申请',$model->dept_leader,['gongchu/audit/index','api_url' => "index.php/gongchu/view?id=".$model->id],$post['userid']);
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
        $modelClass = $this->modelClass;
        $gongchu = new $modelClass();
        $model = $this->findModel($id);
        $mods = $this->findModel($id);
        $mods->dept=$gongchu::getDeptNameById($model->dept);
        $mods->gc_ren=$gongchu::getUserNamesByIds($model->gc_ren);
        $mods->jb_ren=$gongchu::getUserNamesByIds($model->jb_ren);
        $mods->dept_leader=$gongchu::getUserNamesByIds($model->dept_leader).'('.$gongchu::getStatusById($model->dept_audit).')';
        $mods->yuan_leader=$gongchu::getUserNamesByIds($model->yuan_leader).'('.$gongchu::getStatusById($model->yuan_audit).')';
        /*$_POST['format'] = [
            'yuan_audit' => 2,
            'yuan_reason' => '院领导返驳原因',
        ];
        $_POST['format'] = json_encode($_POST['format']);*/
        if(!isset($_POST['format'])){
            FunctionRand::Error(2, '无效的访问');
        }
        $post = json_decode($_POST['format'],1);
        $auditStatus=$post['yuan_audit'];
        $id = (int)$id;
        if($type=='dept'){
            if($auditStatus==1){
                $model->dept_audit=1;//部门审批同意
                Message::sendMsgApi('审批同意',Gongchu::getUserNamesByIds($post['userid']).'同意了一个公出申请',$model->yuan_leader,['gongchu/audit/index','api_url' => "index.php/gongchu/view?id=".$id],$post['userid']);
            }elseif($auditStatus==2){
                $model->dept_audit=2;//部门审批驳回
                $model->dept_reason=$post['yuan_reason'];
                $model->audit_status=2;//申请驳回，审核状态为驳回
                Message::sendMsgApi('审批驳回',Gongchu::getUserNamesByIds($post['userid']).'驳回了一个公出申请',$model->jb_ren,['gongchu/gongchu/index','api_url' => "index.php/gongchu/view?id=".$id],$post['userid']);

            }
            $model->dept_audit_time = date('Y-m-d H:i:s',time());
        }elseif($type=='yuan'){
            if($auditStatus==1){
                $model->yuan_audit=1;//院审批同意
                if(!empty($model->jcz)){
                    Message::sendMsgApi('审批同意',Gongchu::getUserNamesByIds($post['userid']).'同意了一个公出申请',$model->jcz,['gongchu/audit/index','api_url' => "index.php/gongchu/view?id=".$id],$post['userid']);
                }else{
                    $model->audit_status=1;//申请同意，审核状态为同意
                    Message::sendMsgApi('审批同意',Gongchu::getUserNamesByIds($post['userid']).'同意了一个公出申请',$model->jb_ren,['gongchu/gongchu/index','api_url' => "index.php/gongchu/view?id=".$id],$post['userid']);
                }
                Message::sendMsgApi('审批同意',Gongchu::getUserNamesByIds($post['userid']).'同意了一个公出申请',$model->jcz,['gongchu/audit/index','api_url' => "index.php/gongchu/view?id=".$id],$post['userid']);
            }elseif($auditStatus==2){
                $model->yuan_audit=2;//院审批驳回
                $model->yuan_reason=$post['yuan_reason'];
                $model->audit_status=2;//申请驳回，审核状态为驳回
                Message::sendMsgApi('审批驳回',Gongchu::getUserNamesByIds($post['userid']).'驳回了一个公出申请',$model->jb_ren,['gongchu/gongchu/index','api_url' => "index.php/gongchu/view?id=".$id],$post['userid']);
            }
            $model->yuan_audit_time = date('Y-m-d H:i:s',time());
        }else{
            if($auditStatus==1){
                $model->jcz_audit=1;//检查长审批同意
                $model->audit_status=1;//申请同意，审核状态为同意
                Message::sendMsgApi('审批同意',Gongchu::getUserNamesByIds($post['userid']).'同意了一个公出申请',$model->jb_ren,['gongchu/gongchu/index','api_url' => "index.php/gongchu/view?id=".$id],$post['userid']);
            }elseif($auditStatus==2){
                $model->jcz_audit=2;//检查长审批驳回
                $model->jcz_reason=$post['yuan_reason'];
                $model->audit_status=2;//申请驳回，审核状态为驳回
                Message::sendMsgApi('审批驳回',Gongchu::getUserNamesByIds($post['userid']).'驳回了一个公出申请',$model->jb_ren,['gongchu/gongchu/index','api_url' => "index.php/gongchu/view?id=".$id],$post['userid']);
            }
            $model->jcz_audit_time=date('Y-m-d H:i:s',time());
        }
        if($model->save(false)){
            FunctionRand::View(1, 'success');
        }else{
            FunctionRand::Error(2, 'false');
        }
    }
    //删除公出申请
    public function actionDel($id,$type,$userid,$user_key)
    {
        $id = (int)$id;
        FunctionRand::UserAuth((int)$userid,$user_key);
        if($type == 'dept'){
            $model = $this->findModel($id);
            $model->setAttribute('dept_delete',1);
            $model->save(false);
        }elseif('yuan'){
            $model=$this->findModel($id);
            $model->setAttribute('yuan_delete',1);
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