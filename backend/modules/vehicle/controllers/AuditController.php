<?php

namespace backend\modules\vehicle\controllers;

use backend\controllers\CommonController;
use Yii;
use backend\modules\vehicle\models\VehicleApply;
use backend\modules\vehicle\models\AuditSearch;
use backend\modules\vehicle\models\Vehicle;
use backend\modules\gongchu\models\Gongchu;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\functions\functions;
use backend\modules\message\models\Message;

/**
 * AuditController implements the CRUD actions for VehicleApply model.
 */
class AuditController extends CommonController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all VehicleApply models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuditSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $depts=Gongchu::getDepts();
        return $this->render('index', [
            'depts'=>$depts,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VehicleApply model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $vehicleid=$model->vehicleid;
        $mods=$this->findModel($id);
        $mods->dept=Gongchu::getDeptNameById($model->dept);
        $mods->use_time=substr($model->use_time,0,-3);
        $mods->v_user=Gongchu::getUserNamesByIds($model->v_user);
        $mods->apply_ren=Gongchu::getUserNamesByIds($model->apply_ren);
        $mods->v_license=Vehicle::findOne($vehicleid)->v_license;
        if($model->dept_audit==0){//审批中 状态 不加审批时间 驳回理由
            $mods->dept_leader=Gongchu::getUserNamesByIds($model->dept_leader).'('.Gongchu::getStatusById($model->dept_audit).')';
        }else{
            $mods->dept_leader=Gongchu::getUserNamesByIds($model->dept_leader).'('.Gongchu::getStatusById($model->dept_audit).') '.$model->dept_reason.' '.substr($model->dept_audit_time,0,-3);
        }
        if($model->dept_audit==2){//如果科室领导驳回，则院领导直接显示名字即可
            $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader);
        }else{
            if($model->branch_audit==0){//审批中 状态 不加审批时间 驳回理由
                $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader).'('.Gongchu::getStatusById($model->branch_audit).')';
            }else{
                $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader).'('.Gongchu::getStatusById($model->branch_audit).') '.$model->branch_reason.' '.substr($model->branch_audit_time,0,-3);
            }
        }
        if($model->dept_leader==0){
            $mods->dept_leader=0;
        }
        return $this->render('view', [
            'model' => $mods,
        ]);
    }

    /**
     * Creates a new VehicleApply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VehicleApply();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing VehicleApply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$type)
    {
        $model=$this->findModel($id);
        $vehicleid=$model->vehicleid;
        $mods=$this->findModel($id);
        $mods->dept=Gongchu::getDeptNameById($model->dept);
        $mods->v_user=Gongchu::getUserNamesByIds($model->v_user);
        $mods->apply_ren=Gongchu::getUserNamesByIds($model->apply_ren);
        $mods->v_license=Vehicle::findOne($vehicleid)->v_license;
        if($model->dept_audit==0){//审批中 状态 不加审批时间 驳回理由
            $mods->dept_leader=Gongchu::getUserNamesByIds($model->dept_leader).'('.Gongchu::getStatusById($model->dept_audit).')';
        }else{
            $mods->dept_leader=Gongchu::getUserNamesByIds($model->dept_leader).'('.Gongchu::getStatusById($model->dept_audit).') '.$model->dept_reason.' '.substr($model->dept_audit_time,0,-3);
        }
        if($model->dept_audit==2){//如果科室领导驳回，则院领导直接显示名字即可
            $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader);
        }else{
            if($model->branch_audit==0){//审批中 状态 不加审批时间 驳回理由
                $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader).'('.Gongchu::getStatusById($model->branch_audit).')';
            }else{
                $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader).'('.Gongchu::getStatusById($model->branch_audit).') '.$model->branch_reason.' '.substr($model->branch_audit_time,0,-3);
            }
        }
        if($model->dept_leader==0){
            $mods->dept_leader=0;
        }
        if($_POST){
            $auditStatus=$_POST['VehicleApply']['branch_audit'];
            if($type=='dept'){
                if($auditStatus==1){
                    $model->dept_audit=1;//部门审批同意
                    Message::sendMsg('审批同意',Yii::$app->user->identity->username.'同意了一个车辆申请',$model->branch_leader,['vehicle/audit/update','id'=>$model->id,'type'=>'branch','api_url' => "index.php/vehicle/view?id=".$model->id]);
                }elseif($auditStatus==2){
                    $model->dept_audit=2;//部门审批驳回，驳回更新车辆状态
                    $model->dept_reason=$_POST['VehicleApply']['branch_reason'];
                    $model->audit_status=2;//申请驳回，审核状态为驳回
                    Message::sendMsg('审批驳回',Yii::$app->user->identity->username.'驳回了一个车辆申请',$model->apply_ren,['vehicle/vehicleapply/view','id'=>$model->id,'api_url' => "index.php/vehicle/view?id=".$model->id]);
                    $vm=Vehicle::findOne($vehicleid);
                    $vm->setAttributes(['count'=>1,'isreturn'=>1,'return_time'=>NULL]);
                    $vm->save(false);
                }
                $model->dept_audit_time=date('Y-m-d H:i:s',time());
            }else{
                if($auditStatus==1){
                    $model->branch_audit=1;//分管审批同意
                    $model->audit_status=1;//申请同意，审核状态为同意
                    Message::sendMsg('审批同意',Yii::$app->user->identity->username.'同意了一个车辆申请',$model->apply_ren,['vehicle/vehicleapply/view','id'=>$model->id,'api_url' => "index.php/vehicle/view?id=".$model->id]);
                }elseif($auditStatus==2){
                    $model->branch_audit=2;//院审批驳回，更新车辆状态
                    $model->branch_reason=$_POST['VehicleApply']['branch_reason'];
                    $model->audit_status=2;//申请驳回，审核状态为驳回
                    Message::sendMsg('审批驳回',Yii::$app->user->identity->username.'驳回了一个车辆申请',$model->apply_ren,['vehicle/vehicleapply/view','id'=>$model->id,'api_url' => "index.php/vehicle/view?id=".$model->id]);
                    $vm=Vehicle::findOne($vehicleid);
                    $vm->setAttributes(['count'=>1,'isreturn'=>1,'return_time'=>NULL]);
                    $vm->save(false);
                }
                $model->branch_audit_time=date('Y-m-d H:i:s',time());
            }
            if($model->save(false)){
                return $this->redirect(['index']);
            }else{
                functions::alert('审核失败');
            }
        }else{
            return $this->render('update', [
                'model' => $mods,
            ]);
        }
    }

    /**
     * Deletes an existing VehicleApply model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$type)
    {
        if($type=='dept'){
            $model=$this->findModel($id);
            $model->setAttribute('dept_delete',1);
            $model->save(false);
        }else{
            $model=$this->findModel($id);
            $model->setAttribute('branch_delete',1);
            $model->save(false);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the VehicleApply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VehicleApply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VehicleApply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
