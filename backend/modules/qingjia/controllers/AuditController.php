<?php

namespace backend\modules\qingjia\controllers;

use backend\modules\position\models\Position;
use Yii;
use backend\modules\qingjia\models\Qingjia;
use backend\modules\qingjia\models\AuditSearch;
use backend\modules\qingjia\models\QingjiaType;
use backend\modules\gongchu\models\Gongchu;
use backend\functions\functions;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\message\models\Message;
use backend\controllers\CommonController;

/**
 * AuditController implements the CRUD actions for Qingjia model.
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
     * Lists all Qingjia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuditSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $depts=Gongchu::getDepts();
        return $this->render('index', [
            'depts'=> $depts,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Qingjia model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $mods=$this->findModel($id);
        $mods->dept=Gongchu::getDeptNameById($model->dept);
        $mods->qj_ren=Gongchu::getUserNamesByIds($model->qj_ren);
        $mods->qj_type=QingjiaType::getQingjiaTypeNameById($model->qj_type);
        $mods->position=Position::getZhiwu($model->position);
        $mods->apply_time=substr($model->apply_time,0,-3);
        $mods->qj_time=substr($model->qj_time,0,-3);
        $mods->end_time=substr($model->end_time,0,-3);

        if($model->dept_audit==0){//审批中 状态 不加审批时间 驳回理由
            $mods->dept_leader=Gongchu::getUserNamesByIds($model->dept_leader).'('.Gongchu::getStatusById($model->dept_audit).')';
        }else{
            $mods->dept_leader=Gongchu::getUserNamesByIds($model->dept_leader).'('.Gongchu::getStatusById($model->dept_audit).') '.$model->dept_reason.' '.substr($model->dept_audit_time,0,-3);
        }
        if($model->dept_audit==2){//如果科室领导驳回，则院领导直接显示名字即可
            $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader);
            $mods->zzc=Gongchu::getUserNamesByIds($model->zzc);
            if(!empty($model->jcz)){
                $mods->jcz=Gongchu::getUserNamesByIds($model->jcz);
            }
        }else{
            if($model->branch_audit==0){//审批中 状态 不加审批时间 驳回理由
                $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader).'('.Gongchu::getStatusById($model->branch_audit).')';
            }else{
                $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader).'('.Gongchu::getStatusById($model->branch_audit).') '.$model->branch_reason.' '.substr($model->branch_audit_time,0,-3);
            }
            if($model->zzc_audit==0){
                $mods->zzc=Gongchu::getUserNamesByIds($model->zzc).'('.Gongchu::getStatusById($model->zzc_audit).')';
            }else{
                $mods->zzc=Gongchu::getUserNamesByIds($model->zzc).'('.Gongchu::getStatusById($model->zzc_audit).') '.$model->zzc_reason.' '.substr($model->zzc_audit_time,0,-3);
            }
            if(!empty($model->jcz)){
                if($model->jcz_audit==0){
                    $mods->jcz=Gongchu::getUserNamesByIds($model->jcz).'('.Gongchu::getStatusById($model->jcz_audit).')';
                }else{
                    $mods->jcz=Gongchu::getUserNamesByIds($model->jcz).'('.Gongchu::getStatusById($model->jcz_audit).') '.$model->jcz_reason.' '.substr($model->jcz_audit_time,0,-3);
                }
            }
        }
        if($model->branch_audit==2){
            $mods->zzc=Gongchu::getUserNamesByIds($model->zzc);
            if(!empty($model->jcz)){
                $mods->jcz=Gongchu::getUserNamesByIds($model->jcz);
            }
        }else{
            if($model->zzc_audit==0){
                $mods->zzc=Gongchu::getUserNamesByIds($model->zzc).'('.Gongchu::getStatusById($model->zzc_audit).')';
            }else{
                $mods->zzc=Gongchu::getUserNamesByIds($model->zzc).'('.Gongchu::getStatusById($model->zzc_audit).') '.$model->zzc_reason.' '.substr($model->zzc_audit_time,0,-3);
            }
            if($model->dept_audit==2){
                $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader);
                $mods->zzc=Gongchu::getUserNamesByIds($model->zzc);
            }
            if(!empty($model->jcz)){
                if($model->jcz_audit==0){
                    $mods->jcz=Gongchu::getUserNamesByIds($model->jcz).'('.Gongchu::getStatusById($model->jcz_audit).')';
                }else{
                    $mods->jcz=Gongchu::getUserNamesByIds($model->jcz).'('.Gongchu::getStatusById($model->jcz_audit).') '.$model->jcz_reason.' '.substr($model->jcz_audit_time,0,-3);
                }
            }
        }
        if($model->zzc_audit==2){
            if(!empty($model->jcz)){
                $mods->jcz=Gongchu::getUserNamesByIds($model->jcz);
            }
        }else{
            if(!empty($model->jcz)){
                if($model->jcz_audit==0){
                    $mods->jcz=Gongchu::getUserNamesByIds($model->jcz).'('.Gongchu::getStatusById($model->jcz_audit).')';
                }else{
                    $mods->jcz=Gongchu::getUserNamesByIds($model->jcz).'('.Gongchu::getStatusById($model->jcz_audit).') '.$model->jcz_reason.' '.substr($model->jcz_audit_time,0,-3);
                }
                if($model->branch_audit!=2 || $model->dept_audit!=2){
                    $mods->jcz=Gongchu::getUserNamesByIds($model->jcz);
                }
            }
        }
        if($model->dept_leader==0){
            $mods->dept_leader=0;
        }
        if($model->branch_leader==0){
            $mods->branch_leader=0;
        }
        if($model->zzc==0){
            $mods->zzc=0;
        }
        return $this->render('view', [
            'model' => $mods,
        ]);
    }

    /**
     * Creates a new Qingjia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Qingjia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Qingjia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$type)
    {
        $model = $this->findModel($id);
        $mods=$this->findModel($id);
        $mods->dept=Gongchu::getDeptNameById($model->dept);
        $mods->qj_ren=Gongchu::getUserNamesByIds($model->qj_ren);
        $mods->position=Position::getZhiwu($model->position);
        $mods->qj_type=QingjiaType::getQingjiaTypeNameById($model->qj_type);
        $mods->apply_time=substr($model->apply_time,0,-3);
        $mods->qj_time=substr($model->qj_time,0,-3);
        $mods->end_time=substr($model->end_time,0,-3);
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
        if($model->zzc_audit==0){
            if($model->dept_audit==2){
                $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader);
                $mods->zzc=Gongchu::getUserNamesByIds($model->zzc);
                $mods->jcz=Gongchu::getUserNamesByIds($model->jcz);
            }elseif($model->branch_audit==2){
                $mods->zzc=Gongchu::getUserNamesByIds($model->zzc);
                $mods->jcz=Gongchu::getUserNamesByIds($model->jcz);
            }else{
                $mods->zzc=Gongchu::getUserNamesByIds($model->zzc).'('.Gongchu::getStatusById($model->zzc_audit).')';
            }
        }else{
            $mods->zzc=Gongchu::getUserNamesByIds($model->zzc).'('.Gongchu::getStatusById($model->zzc_audit).')'.' '.substr($model->zzc_audit_time,0,-3);
        }
        if(!empty($model->jcz)){
            if($model->jcz_audit==0){
                if($model->dept_audit==2){
                    $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader);
                    $mods->zzc=Gongchu::getUserNamesByIds($model->zzc);
                    $mods->jcz=Gongchu::getUserNamesByIds($model->jcz);
                }elseif($model->branch_audit==2){
                    $mods->zzc=Gongchu::getUserNamesByIds($model->zzc);
                    $mods->jcz=Gongchu::getUserNamesByIds($model->jcz);
                }elseif($model->zzc_audit==2){
                    $mods->jcz=Gongchu::getUserNamesByIds($model->jcz);
                }else{
                    $mods->jcz=Gongchu::getUserNamesByIds($model->jcz).'('.Gongchu::getStatusById($model->jcz_audit).')';
                }
            }else{
                $mods->jcz=Gongchu::getUserNamesByIds($model->jcz).'('.Gongchu::getStatusById($model->jcz_audit).')'.' '.substr($model->jcz_audit_time,0,-3);
            }
        }
        if($model->dept_leader==0){
            $mods->dept_leader=0;
        }
        if($model->branch_leader==0){
            $mods->branch_leader=0;
        }
        if($model->zzc==0){
            $mods->zzc=0;
        }
        if($_POST){
            $auditStatus=$_POST['Qingjia']['zzc_audit'];
            if($type=='dept'){
                if($auditStatus==1){
                    $model->dept_audit=1;//部门审批同意
                    Message::sendMsg('审批同意',Yii::$app->user->identity->username.'同意了一个请假申请',$model->branch_leader,['qingjia/audit/update','id'=>$id,'type'=>'branch','api_url' => "index.php/qingjia/view?id=".$id]);
                }elseif($auditStatus==2){
                    $model->dept_audit=2;//部门审批驳回
                    $model->dept_reason=$_POST['Qingjia']['zzc_reason'];
                    $model->audit_status=2;//申请驳回，审核状态为驳回
                    Message::sendMsg('审批驳回',Yii::$app->user->identity->username.'驳回了一个请假申请',$model->qj_ren,['qingjia/qingjia/view','id'=>$id,'api_url' => "index.php/qingjia/view?id=".$id]);
                }
                $model->dept_audit_time=date('Y-m-d H:i:s',time());
            }elseif($type=='branch'){
                if($auditStatus==1){
                    $model->branch_audit=1;//院审批同意
                    Message::sendMsg('审批同意',Yii::$app->user->identity->username.'同意了一个请假申请',$model->zzc,['qingjia/audit/update','id'=>$id,'type'=>'zzc','api_url' => "index.php/qingjia/view?id=".$id]);
                }elseif($auditStatus==2){
                    $model->branch_audit=2;//院审批驳回
                    $model->branch_reason=$_POST['Qingjia']['zzc_reason'];
                    $model->audit_status=2;//申请驳回，审核状态为驳回
                    Message::sendMsg('审批驳回',Yii::$app->user->identity->username.'驳回了一个请假申请',$model->qj_ren,['qingjia/qingjia/view','id'=>$id,'api_url' => "index.php/qingjia/view?id=".$id]);
                }
                $model->branch_audit_time=date('Y-m-d H:i:s',time());
            }elseif($type=='zzc'){
                if($auditStatus==1){
                    $model->zzc_audit=1;//院审批同意
                    if(!empty($model->jcz)){
                        Message::sendMsg('审批同意',Yii::$app->user->identity->username.'同意了一个请假申请',$model->jcz,['qingjia/audit/update','id'=>$id,'type'=>'jcz','api_url' => "index.php/qingjia/view?id=".$id]);
                    }else{
                        $model->audit_status=1;//申请同意，审核状态为同意
                        Message::sendMsg('审批同意',Yii::$app->user->identity->username.'同意了一个请假申请',$model->qj_ren,['qingjia/qingjia/view','id'=>$id,'api_url' => "index.php/qingjia/view?id=".$id]);
                    }
                }elseif($auditStatus==2){
                    $model->zzc_audit=2;//院审批驳回
                    $model->zzc_reason=$_POST['Qingjia']['zzc_reason'];
                    $model->audit_status=2;//申请驳回，审核状态为驳回
                    Message::sendMsg('审批驳回',Yii::$app->user->identity->username.'驳回了一个请假申请',$model->qj_ren,['qingjia/qingjia/view','id'=>$id,'api_url' => "index.php/qingjia/view?id=".$id]);
                }
                $model->zzc_audit_time=date('Y-m-d H:i:s',time());
            }else{
                if($auditStatus==1){
                    $model->jcz_audit=1;//检察长审批同意
                    $model->audit_status=1;//申请同意，审核状态为同意
                    Message::sendMsg('审批同意',Yii::$app->user->identity->username.'驳回了一个请假申请',$model->qj_ren,['qingjia/qingjia/view','id'=>$id,'api_url' => "index.php/qingjia/view?id=".$id]);
                }elseif($auditStatus==2){
                    $model->jcz_audit=2;//检察长审批驳回
                    $model->jcz_reason=$_POST['Qingjia']['zzc_reason'];
                    $model->audit_status=2;//申请驳回，审核状态为驳回
                    Message::sendMsg('审批驳回',Yii::$app->user->identity->username.'驳回了一个请假申请',$model->qj_ren,['qingjia/qingjia/view','id'=>$id,'api_url' => "index.php/qingjia/view?id=".$id]);
                }
                $model->jcz_audit_time=date('Y-m-d H:i:s',time());
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
     * Deletes an existing Qingjia model.
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
        }elseif($type=='branch'){
            $model=$this->findModel($id);
            $model->setAttribute('branch_delete',1);
            $model->save(false);
        }elseif($type=='zzc'){
            $model=$this->findModel($id);
            $model->setAttribute('zzc_delete',1);
            $model->save(false);
        }else{//检察长删除
            $model=$this->findModel($id);
            $model->setAttribute('jcz_delete',1);
            $model->save(false);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Qingjia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Qingjia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Qingjia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
