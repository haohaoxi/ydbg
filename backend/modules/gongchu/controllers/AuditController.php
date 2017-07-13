<?php

namespace backend\modules\gongchu\controllers;

use backend\controllers\CommonController;
use Yii;
use backend\modules\gongchu\models\Gongchu;
use backend\modules\gongchu\models\AuditSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\functions\functions;
use backend\modules\message\models\Message;

/**
 * AuditController implements the CRUD actions for Gongchu model.
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
     * Lists all Gongchu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $userId=Yii::$app->user->id;
        $searchModel = new AuditSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$userId);
        $depts=Gongchu::getDepts();
        return $this->render('index', [
            'depts'=>$depts,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gongchu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $mods=$this->findModel($id);
        $mods->dept=Gongchu::getDeptNameById($model->dept);
        $mods->gc_ren=Gongchu::getUserNamesByIds($model->gc_ren);
        $mods->jb_ren=Gongchu::getUserNamesByIds($model->jb_ren);
        $mods->apply_time=substr($model->apply_time,0,-3);
        if($model->dept_audit==0){//审批中 状态 不加审批时间 驳回理由
            $mods->dept_leader=Gongchu::getUserNamesByIds($model->dept_leader).'('.Gongchu::getStatusById($model->dept_audit).')';
        }else{
            $mods->dept_leader=Gongchu::getUserNamesByIds($model->dept_leader).'('.Gongchu::getStatusById($model->dept_audit).') '.$model->dept_reason.' '.substr($model->dept_audit_time,0,-3);
        }
        if($model->dept_audit==2){//如果科室领导驳回，则院领导直接显示名字即可
            $mods->yuan_leader=Gongchu::getUserNamesByIds($model->yuan_leader);
        }else{
            if($model->yuan_audit==0){//审批中 状态 不加审批时间 驳回理由
                $mods->yuan_leader=Gongchu::getUserNamesByIds($model->yuan_leader).'('.Gongchu::getStatusById($model->yuan_audit).')';
            }else{
                $mods->yuan_leader=Gongchu::getUserNamesByIds($model->yuan_leader).'('.Gongchu::getStatusById($model->yuan_audit).') '.$model->yuan_reason.' '.substr($model->yuan_audit_time,0,-3);
            }
            if(!empty($model->jcz)){
                if($model->jcz_audit==0){//审批中 状态 不加审批时间 驳回理由
                    $mods->jcz=Gongchu::getUserNamesByIds($model->jcz).'('.Gongchu::getStatusById($model->jcz_audit).')';
                }else{
                    $mods->jcz=Gongchu::getUserNamesByIds($model->jcz).'('.Gongchu::getStatusById($model->jcz_audit).') '.$model->jcz_reason.' '.substr($model->jcz_audit_time,0,-3);
                }
            }
        }
        if($model->dept_leader==0){
            $mods->dept_leader=0;
        }
        if($model->yuan_leader==0){
            $mods->yuan_leader=0;
        }
        return $this->render('view', [
            'model' => $mods,
        ]);
    }

    /**
     * Creates a new Gongchu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gongchu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 申请审核
     * Updates an existing Gongchu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$type)
    {
        $model = $this->findModel($id);
        $mods=$this->findModel($id);
        $mods->dept=Gongchu::getDeptNameById($model->dept);
        $mods->gc_ren=Gongchu::getUserNamesByIds($model->gc_ren);
        $mods->jb_ren=Gongchu::getUserNamesByIds($model->jb_ren);
        $mods->apply_time=substr($model->apply_time,0,-3);
        if($model->dept_audit==0){//审核中状态 不加审批时间
            $mods->dept_leader=Gongchu::getUserNamesByIds($model->dept_leader).'('.Gongchu::getStatusById($model->dept_audit).')';
        }else{
            $mods->dept_leader=Gongchu::getUserNamesByIds($model->dept_leader).'('.Gongchu::getStatusById($model->dept_audit).')'.' '.substr($model->dept_audit_time,0,-3);
        }
        if($model->yuan_audit==0){
            $mods->yuan_leader=Gongchu::getUserNamesByIds($model->yuan_leader).'('.Gongchu::getStatusById($model->yuan_audit).')';
        }else{
            $mods->yuan_leader=Gongchu::getUserNamesByIds($model->yuan_leader).'('.Gongchu::getStatusById($model->yuan_audit).')'.' '.substr($model->yuan_audit_time,0,-3);
        }
        if(!empty($model->jcz)){
            if($model->jcz_audit==0){
                $mods->jcz=Gongchu::getUserNamesByIds($model->jcz).'('.Gongchu::getStatusById($model->jcz_audit).')';
            }else{
                $mods->jcz=Gongchu::getUserNamesByIds($model->jcz).'('.Gongchu::getStatusById($model->jcz_audit).')'.' '.substr($model->jcz_audit_time,0,-3);
            }
        }
        if($model->dept_leader==0){
            $mods->dept_leader=0;
        }
        if($model->yuan_leader==0){
            $mods->yuan_leader=0;
        }
        if($_POST){
            $auditStatus=$_POST['Gongchu']['yuan_audit'];
            if($type=='dept'){
                if($auditStatus==1){
                    $model->dept_audit=1;//部门审批同意
                    Message::sendMsg('审批同意',Yii::$app->user->identity->username.'同意了一个公出申请',$model->yuan_leader,['gongchu/audit/update','id'=>$id,'type'=>'yuan','api_url' => "index.php/gongchu/view?id=".$id]);
                }elseif($auditStatus==2){
                    $model->dept_audit=2;//部门审批驳回
                    $model->dept_reason=$_POST['Gongchu']['yuan_reason'];
                    $model->audit_status=2;//申请驳回，审核状态为驳回
                    Message::sendMsg('审批驳回',Yii::$app->user->identity->username.'驳回了一个公出申请',$model->jb_ren,['gongchu/gongchu/view','id'=>$id,'api_url' => "index.php/gongchu/view?id=".$id]);
                }
                $model->dept_audit_time=date('Y-m-d H:i:s',time());
            }elseif($type=='yuan'){
                if($auditStatus==1){
                    $model->yuan_audit=1;//院审批同意
                    if(!empty($model->jcz)){
                        Message::sendMsg('审批同意',Yii::$app->user->identity->username.'同意了一个公出申请',$model->jcz,['gongchu/audit/update','id'=>$id,'type'=>'jcz','api_url' => "index.php/gongchu/view?id=".$id]);
                    }else{
                        $model->audit_status=1;//申请同意，审核状态为同意
                        Message::sendMsg('审批同意',Yii::$app->user->identity->username.'同意了一个公出申请',$model->jb_ren,['gongchu/gongchu/view','id'=>$id,'api_url' => "index.php/gongchu/view?id=".$id]);
                    }
                }elseif($auditStatus==2){
                    $model->yuan_audit=2;//院审批驳回
                    $model->yuan_reason=$_POST['Gongchu']['yuan_reason'];
                    $model->audit_status=2;//申请驳回，审核状态为驳回
                    Message::sendMsg('审批驳回',Yii::$app->user->identity->username.'驳回了一个公出申请',$model->jb_ren,['gongchu/gongchu/view','id'=>$id,'api_url' => "index.php/gongchu/view?id=".$id]);
                }
                $model->yuan_audit_time=date('Y-m-d H:i:s',time());
            }else{
                if($auditStatus==1){
                    $model->jcz_audit=1;//院审批同意
                    $model->audit_status=1;//申请同意，审核状态为同意
                    Message::sendMsg('审批同意',Yii::$app->user->identity->username.'同意了一个公出申请',$model->jb_ren,['gongchu/gongchu/view','id'=>$id,'api_url' => "index.php/gongchu/view?id=".$id]);
                }elseif($auditStatus==2){
                    $model->jcz_audit=2;//院审批驳回
                    $model->jcz_reason=$_POST['Gongchu']['yuan_reason'];
                    $model->audit_status=2;//申请驳回，审核状态为驳回
                    Message::sendMsg('审批驳回',Yii::$app->user->identity->username.'驳回了一个公出申请',$model->jb_ren,['gongchu/gongchu/view','id'=>$id,'api_url' => "index.php/gongchu/view?id=".$id]);
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
     * Deletes an existing Gongchu model.
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
            $model->setAttribute('yuan_delete',1);
            $model->save(false);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Gongchu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gongchu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gongchu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
