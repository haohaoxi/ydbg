<?php

namespace backend\modules\vehicle\controllers;

use backend\controllers\CommonController;
use backend\functions\functions;
use backend\modules\vehicle\models\Vehicle;
use Yii;
use backend\modules\vehicle\models\VehicleApply;
use backend\modules\vehicle\models\VehicleapplySearch;
use backend\modules\gongchu\models\Gongchu;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\message\models\Message;

/**
 * VehicleApplyController implements the CRUD actions for VehicleApply model.
 */
class VehicleapplyController extends CommonController
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
        $searchModel = new VehicleapplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
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
    public function actionCreate($id)
    {
        $deptAuditors=Gongchu::getDeptAuditors(196);//获取有车辆申请审核权限的部门人员信息 参数为：menuid
        $userId=Yii::$app->user->id;
        $deptUsers=Gongchu::getDeptNames();
        $model = new VehicleApply();
        $vehicle=new Vehicle();
        $vLicense=$vehicle->findOne($id)->v_license;
        $model->v_license=$vLicense;//车牌号
        if ($model->load(Yii::$app->request->post())) {
            $model->vehicleid=$id;//车辆id
            $model->apply_delete=0;
            $model->dept_delete=0;
            $model->branch_delete=0;
            $model->apply_ren=Yii::$app->user->id;
            $model->apply_time=date('Y-m-d H:i:s',time());
            if($model->dept_leader==$userId){
                $model->dept_leader=0;
                $model->dept_audit=1;//如果为用户本身为科室领导，则更新科室状态为审批同意，方便下级审核审核
                $jsr=$model->branch_leader;
                $type='branch';
            }elseif($model->branch_leader==$userId){
                $model->dept_leader=0;
                $model->dept_audit=1;//如果为用户本身为科室领导，则更新科室状态为审批同意，方便下级审核审核
                $jsr=$model->branch_leader;
                $type='branch';
            }else{
                $jsr=$model->dept_leader;
                $type='dept';
            }

            $model->audit_status=0;//发起申请，默认审核状态为未审核
            if($model->save(false)){
                Message::sendMsg('车辆申请',Yii::$app->user->identity->username.'发起了一个车辆申请',$jsr,['vehicle/audit/update','id'=>$model->id,'type'=>$type,'api_url' => "index.php/vehicle/view?id=".$model->id]);
                $vm=Vehicle::findOne($id);
                $vm->setAttributes(['count'=>0,'isreturn'=>0,'return_time'=>NULL]);
                if($vm->save(false)){
                    return $this->redirect(['index']);
                }else{
                    $vehicle->getErrors();
                    functions::alert('申请车辆失败');
                }
            }else{
                functions::alert('申请车辆失败');
            }
        } else {
            return $this->render('create', [
                'deptUsers'=>$deptUsers,
                'deptAuditors'=>$deptAuditors,
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
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing VehicleApply model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //更新删除状态
        $model=$this->findModel($id);
        $model->setAttribute('apply_delete',1);//逻辑删除
        $model->save(false);
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
