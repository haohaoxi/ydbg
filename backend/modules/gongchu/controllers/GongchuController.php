<?php

namespace backend\modules\gongchu\controllers;

use backend\controllers\CommonController;
use backend\functions\functions;
use Yii;
use backend\modules\gongchu\models\Gongchu;
use backend\modules\gongchu\models\GongchuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\message\models\Message;


/**
 * GongchuController implements the CRUD actions for Gongchu model.
 */
class GongchuController extends CommonController
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
        $searchModel = new GongchuSearch();
        $userId=Yii::$app->user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$userId);
        return $this->render('index', [
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
        $userId=Yii::$app->user->id;
        $deptAuditors=Gongchu::getDeptAuditors(75);//获取有公出申请审核权限的部门人员信息 参数为：menuid
        $deptUsers=Gongchu::getDeptNames();
        if ($model->load(Yii::$app->request->post())) {
            if($model->dept_leader==$userId){
                $model->dept_leader=0;
                $model->dept_audit=1;//如果为用户本身为科室领导，则更新科室状态为审批同意，方便下级审核审核
                $jsr=$model->yuan_leader;
                $type='yuan';
            }elseif($model->yuan_leader==$userId){
                $model->dept_leader=0;
                $model->dept_audit=1;//如果为用户本身为科室领导，则更新科室状态为审批同意，方便下级审核审核
//                $model->yuan_leader=0;
//                $model->yuan_audit=1;//如果为用户本身为院领导，则更新科室状态为审批同意，方便下级审核审核
                $model->yuan_leader=$_POST['Gongchu']['jcz'];
                $model->yuan_audit=$_POST['Gongchu']['jcz_audit'];
                $jsr=$model->yuan_leader;
                $type='yuan';
            }else{
                $jsr=$model->dept_leader;
                $type='dept';
            }
            $model->gongchurens=$_POST['gongchurens'];
            $model->audit_status=0;//发起申请，默认审核状态为未审核
            $model->apply_time=date('Y-m-d H:i:s',time());
            if($model->save(false)){
                Message::sendMsg('公出申请',Yii::$app->user->identity->username.'发起了一个公出申请',$jsr,['gongchu/audit/update','id'=>$model->id,'type'=>$type,'api_url' => "index.php/gongchu/view?id=".$model->id]);
                return $this->redirect(['index']);
            }else{
                functions::alert('信息不能为空，申请失败');
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
     * Updates an existing Gongchu model.
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
     * Deletes an existing Gongchu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {//更新删除状态
        $model=$this->findModel($id);
        $model->setAttribute('user_delete',1);//逻辑删除
        $model->save(false);
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
