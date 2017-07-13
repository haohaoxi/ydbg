<?php

namespace backend\modules\qingjia\controllers;

use backend\controllers\CommonController;
use Yii;
use backend\modules\qingjia\models\Qingjia;
use backend\modules\qingjia\models\QingjiaSearch;
use backend\modules\qingjia\models\QingjiaType;
use backend\modules\gongchu\models\Gongchu;
use backend\modules\position\models\Position;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\functions\functions;
use backend\modules\message\models\Message;

/**
 * QingjiaController implements the CRUD actions for Qingjia model.
 */
class QingjiaController extends CommonController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   // 'delete' => ['post'],
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
        $searchModel = new QingjiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $qingjiaType=QingjiaType::getQingjiaTypes();
        return $this->render('index', [
            'qingjiaType'=>$qingjiaType,
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
                if($model->branch_audit==2 || $model->dept_audit==2){
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
        $qingjiaType=QingjiaType::getQingjiaTypes();
        $deptAuditors=Gongchu::getDeptAuditors(208);//获取有公出申请审核权限的部门人员信息 参数为：menuid
        $deptUsers=Gongchu::getDeptNames();
        $userId=Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            $model->dept=$_POST['Qingjia']['dept'];
            $model->position=$_POST['Qingjia']['position'];
            $model->apply_time=date('Y-m-d H:i:s',time());
            if($model->dept_leader==$userId){
                $model->dept_leader=0;
                $model->dept_audit=1;//如果为用户本身为科室领导，则更新科室状态为审批同意，方便下级审核审核
                $jsr=$model->branch_leader;
                $type='branch';
            }elseif($model->branch_leader==$userId){
                $model->dept_leader=0;
                $model->dept_audit=1;//如果为用户本身为科室领导，则更新科室状态为审批同意，方便下级审核审核
                $model->branch_leader=0;
                $model->branch_audit=1;//如果为用户本身为院领导，则更新科室状态为审批同意，方便下级审核审核
                $jsr=$model->zzc;
                $type='zzc';
            }elseif($model->zzc==$userId){
                $model->dept_leader=0;
                $model->dept_audit=1;//如果为用户本身为科室领导，则更新科室状态为审批同意，方便下级审核审核
                $model->branch_leader=0;
                $model->branch_audit=1;//如果为用户本身为院领导，则更新科室状态为审批同意，方便下级审核审核
                $model->zzc=0;
                $model->zzc_audit=1;
                $jsr=$model->jcz;
                $type='jcz';
            }else{
                $jsr=$model->dept_leader;
                $type='dept';
            }
            if(isset($_POST['Qingjia']['jcz'])){
                $model->jcz=$_POST['Qingjia']['jcz'];
                $model->jcz_audit=$_POST['Qingjia']['jcz_audit'];
            }
            $model->qingjiaren=$_POST['qingjiaren'];
            $model->audit_status=0;//发起申请，默认审核状态为未审核
            if($model->save()){
                Message::sendMsg('请假申请',Yii::$app->user->identity->username.'发起了一个请假申请',$jsr,['qingjia/audit/update','id'=>$model->id,'type'=>$type,'api_url' => "index.php/qingjia/view?id=".$model->id]);
                return $this->redirect(['index']);
            }else{
                functions::alert('申请失败');
            }
        } else {
            return $this->render('create', [
                'deptUsers'=>$deptUsers,
                'deptAuditors'=>$deptAuditors,
                'qingjiaType'=>$qingjiaType,
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
     * Deletes an existing Qingjia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //更新删除状态
        $model=$this->findModel($id);
        $model->setAttribute('user_delete',1);//逻辑删除请假申请
        $model->save(false);

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
