<?php

namespace backend\modules\welfareapply\controllers;

use backend\modules\welfare\models\Welfare;
use Yii;
use backend\modules\welfareapply\models\WelfareApply;
use backend\modules\welfareapply\models\WelfareapplySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\message\models\Message;

/**
 * WelfareapplyController implements the CRUD actions for Welfareapply model.
 */
class WelfareapplyController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Welfareapply models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WelfareapplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Welfareapply model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model_welfare = Welfare::findOne($model->welfare_id);
        return $this->render('view', [
            'model' => $model,
            'model_welfare' => $model_welfare,
        ]);
    }

    /**
     * Creates a new Welfareapply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Welfareapply();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->welfare_apply_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Welfareapply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->welfare_apply_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Welfareapply model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($id == '') return false;
        WelfareApply::updateAll(['welfare_apply_mee_id_is_del'=>0],'welfare_apply_id = '.$id);
        //$this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /*
     * 审批记录
     * @return string
     */
    public function actionRecord(){
        $searchModel = new WelfareapplySearch();
        $dataProvider = $searchModel->searchRecord(Yii::$app->request->queryParams);

        return $this->render('record', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
     * 审批表单
     * @param $id
     */
    public function actionSp($id){
        if($id == '') return false;
        $model = $this->findModel($id);
        $model_welfare = Welfare::findOne($model->welfare_id);
        return $this->render('view', [
            'model' => $model,
            'model_welfare' => $model_welfare,
        ]);
    }

    /*
     * 审批同意
     */
    public function actionSpty($id){
        if($id == '') return false;
        WelfareApply::updateAll(['welfare_apply_pack_status'=>'同意','welfare_apply_pack_time'=>date('Y-m-d H:i:s',time())],['welfare_apply_id'=>$id]);

        $msg = WelfareApply::find()->select('welfare_apply_mee_id')->where(['welfare_apply_id'=>$id])->asArray()->one();
        Message::sendMsg('审批',Yii::$app->user->identity->name.'同意了福利申请',$msg['welfare_apply_mee_id'],['welfare/welfare/view','id'=>$id,'api_url' => "index.php/welfare/view?id=". $id]);

        return $this->redirect(['record']);
    }

    /*
     * 审批驳回
     */
    public function actionSpbh($id,$cancel_details){
        if($id == '' || $cancel_details==''){
            echo json_encode(array('status'=>'error','msg'=>'驳回失败！参数不完整'));
            exit();
        }
        WelfareApply::updateAll(['welfare_apply_pack_status'=>'驳回','welfare_apply_pack_cancel_detail'=>$cancel_details,'welfare_apply_pack_time'=>date('Y-m-d H:i:s',time())],['welfare_apply_id'=>$id]);

        $msg = WelfareApply::find()->select('welfare_apply_mee_id')->where(['welfare_apply_id'=>$id])->asArray()->one();
        Message::sendMsg('审批',Yii::$app->user->identity->name.'驳回了福利申请 驳回原因:'.$cancel_details,$msg['welfare_apply_mee_id'],['welfare/welfare/view','id'=>$id,'api_url' => "index.php/welfare/view?id=". $id]);


        echo json_encode(array('status'=>'success','msg'=>'驳回成功'));
        exit();
    }

    /*
  * 审批删除
  * @param $id
  * @return bool|\yii\web\Response
  */
    public function actionSpdelete($id){
        if($id == '') return false;
        WelfareApply::updateAll(['welfare_sp_id_is_del'=>0],['welfare_apply_id'=>$id]);
        return $this->redirect(['record']);
    }

    /*
     * 申批查看
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSpck($id)
    {
        $model = $this->findModel($id);
        $model_welfare = Welfare::findOne($model->welfare_id);
        return $this->render('view', [
            'model' => $model,
            'model_welfare' => $model_welfare,
        ]);
    }


    /*
     * 福利领取
     */
    public function actionMyget(){
        $searchModel = new WelfareapplySearch();
        $dataProvider = $searchModel->searchMyget(Yii::$app->request->queryParams);

        return $this->render('Myget', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
     * 领取操作
     * @param $id
     */
    public function actionLingqu($id){
        if($id == '') return false;
        WelfareApply::updateAll(['welfare_lq'=>'已领取','welfare_lq_time'=>date('Y-m-d H:i:s')],['welfare_apply_id'=>$id]);
        return $this->redirect(['myget']);
    }

    /**
     * Finds the Welfareapply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Welfareapply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Welfareapply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
