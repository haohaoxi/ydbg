<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use api\functionGlobal\FunctionRand;
use backend\modules\gongchu\models\Gongchu;
use backend\modules\vehicle\models\Vehicle;
use backend\modules\message\models\Message;

/**
 *  车辆管理 api
 */
class VehicleController extends ActiveController
{
    public $modelClass = 'backend\modules\vehicle\models\Vehicle';

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
        FunctionRand::UserAuth((int)$userid,$user_key);
        $modelClass = 'backend\modules\vehicle\models\VehicleApply';
        $model = $modelClass::findOne((int)$id);
        $data = $model->attributes;
        $vehicleid = $model->vehicleid;
        $data['dept_name']=Gongchu::getDeptNameById($model->dept);
        $data['v_user_name']=Gongchu::getUserNamesByIds($model->v_user);
        $data['apply_ren_name']=Gongchu::getUserNamesByIds($model->apply_ren);
        $data['dept_leader_name']=Gongchu::getUserNamesByIds($model->dept_leader);
        $data['branch_leader_name']=Gongchu::getUserNamesByIds($model->branch_leader);
        $vehicle = Vehicle::findOne($vehicleid);
        $data['v_license']=$vehicle->v_license;
        $data['return_time'] = $vehicle->return_time;
        FunctionRand::View(1, 'Success',$data);
    }
    //申请审核
    public function actionShenpi($id,$type)
    {
        $id = (int)$id;
        $modelClass = 'backend\modules\vehicle\models\VehicleApply';
        $model = $modelClass::findOne($id);
        $vehicleid = $model->vehicleid;
        $mods = $modelClass::findOne($id);
        $mods->dept=Gongchu::getDeptNameById($model->dept);
        $mods->v_user=Gongchu::getUserNamesByIds($model->v_user);
        $mods->apply_ren=Gongchu::getUserNamesByIds($model->apply_ren);
        $mods->v_license=Vehicle::findOne($vehicleid)->v_license;
        /*$_POST['format'] = [
            'userid' => 1 ,
            'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
            'yuan_audit' => 2,
            'yuan_reason' => '院领导返驳原因',
        ];
        $_POST['format'] = json_encode($_POST['format']);*/
        $post = json_decode($_POST['format'],1);
        $post = FunctionRand::PostFormat($post);
        FunctionRand::UserAuth($post['userid'],$post['user_key']);
        if($post){
            $auditStatus=$post['yuan_audit'];
            if($type=='dept'){
                if($auditStatus==1){
                    $model->dept_audit=1;//部门审批同意
                    Message::sendMsgApi('审批同意',Gongchu::getUserNamesByIds($post['userid']).'同意了一个车辆申请',$model->branch_leader,['vehicle/audit/index','api_url' => "index.php/vehicle/view?id=".$model->id],$post['userid'],$post['userid']);
                }elseif($auditStatus==2){
                    $model->dept_audit=2;//部门审批驳回
                    $model->dept_reason=$post['yuan_reason'];
                    $model->audit_status=2;//申请驳回，审核状态为驳回
                    Message::sendMsgApi('审批驳回',Gongchu::getUserNamesByIds($post['userid']).'驳回了一个车辆申请',$model->apply_ren,['vehicle/vehicleapply/index','api_url' => "index.php/vehicle/view?id=".$model->id],$post['userid']);
                    $vm=Vehicle::findOne($mods->vehicleid);
                    $vm->setAttributes(['count'=>1,'isreturn'=>1,'return_time'=>NULL]);
                    $vm->save(false);
                }
                $model->dept_audit_time = date('Y-m-d H:i:s',time());
            }else{
                if($auditStatus==1){
                    $model->yuan_audit=1;//院审批同意
                    $model->audit_status=1;//申请同意，审核状态为同意
                    Message::sendMsgApi('审批同意',Gongchu::getUserNamesByIds($post['userid']).'同意了一个车辆申请',$model->apply_ren,['vehicle/vehicleapply/index','api_url' => "index.php/vehicle/view?id=".$model->id],$post['userid']);
                }elseif($auditStatus==2){
                    $model->yuan_audit=2;//院审批驳回
                    $model->yuan_reason=$post['yuan_reason'];
                    $model->audit_status=2;//申请驳回，审核状态为驳回
                    Message::sendMsgApi('审批驳回',Gongchu::getUserNamesByIds($post['userid']).'驳回了一个车辆申请',$model->apply_ren,['vehicle/vehicleapply/index','api_url' => "index.php/vehicle/view?id=".$model->id],$post['userid']);
                    $vm=Vehicle::findOne($mods->vehicleid);
                    $vm->setAttributes(['count'=>1,'isreturn'=>1,'return_time'=>NULL]);
                    $vm->save(false);
                }
                $model->branch_audit_time = date('Y-m-d H:i:s',time());
            }
            if($model->save(false)){
                FunctionRand::View(1, 'success');
            }else{
                FunctionRand::Error(2, 'false');
            }
        }else{
            FunctionRand::Error(2, 'false');
        }
    }
    //查看车辆
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
        if($type == 1){//仓库中的
            $count = $query->where(['count' => 1,'isdelete' => 0,'isreturn' => 1])->count();
            $data = $query->select(['vehicle.id','vehicle.v_license','vehicle.v_usage','vehicle.v_type','vehicle_type.name'])
                ->join('LEFT JOIN', 'vehicle_type', 'vehicle_type.id = vehicle.v_type')
                ->where(['count' => 1,'isdelete' => 0,'isreturn' => 1])
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        }elseif($type == 2){//使用中的
            $count = $query->where(['count' => 0,'isdelete' => 0,'isreturn' => 0])->count();
            $data = $query->select(['vehicle.id','vehicle.v_license','vehicle.v_usage','vehicle.v_type','vehicle_type.name','vehicle.isreturn'])
                ->join('LEFT JOIN', 'vehicle_type', 'vehicle_type.id = vehicle.v_type')
                ->where(['count' => 0,'isdelete' => 0,'isreturn' => 0])
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        }elseif($type == 3){//我发起的
            $modelClass = 'backend\modules\vehicle\models\VehicleApply';
            $query = $modelClass::find();
            $query->where("v_user = :v_user and apply_delete = 0",['v_user' => $userid]);
            $count = $query;
            $count = $count->count();
            $data = $query->select(['vehicle_apply.id','user.name','apply_time','dept_audit','branch_audit'])
                ->join('LEFT JOIN', '{{%user}}', 'user.id = vehicle_apply.v_user')
                ->orderBy('apply_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        }elseif($type == 4) {//我审批的
            $modelClass = 'backend\modules\vehicle\models\VehicleApply';
            $query = $modelClass::find();
            $query->where('(dept_leader=:dept_leader and dept_delete=:dept_delete)
                    or (branch_leader=:dept_leader and branch_delete=:dept_delete and dept_audit=:dept_audit)',
                [':dept_leader'=>$userid,':dept_delete'=>0,':dept_audit'=>1,]);
            $count = $query;
            $count = $count->count();
            $data = $query->select(['vehicle_apply.id','user.name','apply_time','dept_audit','branch_audit'])
                ->join('LEFT JOIN', '{{%user}}', 'user.id = vehicle_apply.v_user')
                ->orderBy('apply_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        }
        FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
    }
    //在库车辆申请
    public function actionShenqing()
    {
        $modelClass = 'backend\modules\vehicle\models\VehicleApply';
        $model = new $modelClass();
        /*$_POST['format'] = [
            'userid' => 1,
            'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
            'vehicleid' => 2,
            'v_license' => '车牌号',
            'dept' => 5, //科室
            'v_user' => 1,//用车人
            'driver' => '驾驶员',
            'use_time' => '2016-05-31 00:00:00',//用车时间
            'quxiang' => '去向',
            'reason' => '用车事由',
            'apply_ren' => 1,
            'dept_leader' => 2, //科室负责人
            'branch_leader' => 8,//分管领导
        ];
        $_POST['format'] = json_encode($_POST['format']);*/
        $post = json_decode($_POST['format'],true);
        $post = FunctionRand::PostFormat($post);
        $post['userid'] = (int)$post['userid'];
        FunctionRand::UserAuth($post['userid'],$post['user_key']);
        $model->attributes = $post;
        $model->apply_time = date('Y-m-d H:i:s',time());
        $model->apply_delete=0;
        $model->dept_delete=0;
        $model->branch_delete=0;
        if($model->dept_leader == $post['userid']){
            $model->dept_leader=0;
            $model->dept_audit=1;//如果为用户本身为科室领导，则更新科室状态为审批同意，方便下级审核审核
            Message::sendMsgApi('车辆申请',Gongchu::getUserNamesByIds($post['userid']).'发起了一个车辆申请',$model->branch_leader,['vehicle/audit/index','api_url' => "index.php/vehicle/view?id=".$model->id],$post['userid']);
        }elseif($model->branch_leader == $post['userid']){
            $model->dept_leader=0;
            $model->dept_audit=1;//如果为用户本身为科室领导，则更新科室状态为审批同意，方便下级审核审核
            Message::sendMsgApi('车辆申请',Gongchu::getUserNamesByIds($post['userid']).'发起了一个车辆申请',$model->branch_leader,['vehicle/audit/index','api_url' => "index.php/vehicle/view?id=".$model->id],$post['userid']);
        }else{
            Message::sendMsgApi('车辆申请',Gongchu::getUserNamesByIds($post['userid']).'发起了一个车辆申请',$model->dept_leader,['vehicle/audit/index','api_url' => "index.php/vehicle/view?id=".$model->id],$post['userid']);
        }
        if($model->save()){
            $vm=$vm=Vehicle::findOne($post['vehicleid']);
            $vm->setAttributes(['count'=>0,'isreturn'=>0,'return_time'=>NULL]);
            FunctionRand::View(1, 'success');
        }else{
            FunctionRand::Error(2, $model->getFirstErrors());
        }
    }
    //删除车辆申请
    public function actionDel($id,$type,$userid,$user_key)
    {
        $id = (int)$id;
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        $modelClass = 'backend\modules\vehicle\models\VehicleApply';
        $model = $modelClass::findOne($id);
        if($type = 'dept'){
            $model->setAttribute('dept_delete',1);
        }elseif($type = 'branch'){
            $model->setAttribute('branch_delete',1);
        }else{
            $model->setAttribute('apply_delete',1);
        }
        $model->save();
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