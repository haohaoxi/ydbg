<?php

namespace backend\modules\officeapply\controllers;

use backend\modules\office\models\Office;
use Yii;
use backend\modules\officeapply\models\OfficeApply;
use backend\modules\officeapply\models\OfficeapplySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\message\models\Message;

/**
 * OfficeapplyController implements the CRUD actions for Officeapply model.
 */
class OfficeapplyController extends Controller
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
     * Lists all Officeapply models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OfficeapplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Officeapply model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Officeapply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Officeapply();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->apply_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Officeapply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->apply_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Officeapply model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($id == '') return false;
        OfficeApply::updateAll(['apply_mee_id_is_del'=>0],'apply_id = '.$id);
        //$this->findModel($id)->delete();
        return $this->redirect(['index']);
    }


    /*
     * 审批记录
     * @return string
     */
    public function actionRecord(){
        $searchModel = new OfficeapplySearch();
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
        $model_office = Office::findOne($model->apply_office_id);
        return $this->render('view', [
            'model' => $model,
            'model_office' => $model_office,
        ]);
    }

    /*
     * 审批同意
     */
    public function actionSpty($id){
        if($id == '') return false;
        $data = OfficeApply::getDqStatus($id,Yii::$app->user->identity->id);
        $rs_status = str_replace('_id','_status',$data['field']);
        $rs_time = str_replace('_id','_time',$data['field']);
        OfficeApply::updateAll([$rs_status=>'同意',$rs_time=>date('Y-m-d H:i:s',time())],['apply_id'=>$id]);

        $msg = OfficeApply::find()->select('*')->where(['apply_id'=>$id])->asArray()->one();
        Message::sendMsg('审批',Yii::$app->user->identity->name.'同意了办公用品采购',$msg['apply_mee_id'],['officeapply/officeapply/view','id'=>$id,'api_url' => "index.php/officeapply/view?id=". $id]);
        Message::sendMsg('审批',Yii::$app->user->identity->name.'的办公用品采购需要您审批',$msg[$data['field']],['officeapply/officeapply/sp','id'=>$id,'api_url' => "index.php/officeapply/view?id=". $id]);

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
        $data = OfficeApply::getDqStatus($id,Yii::$app->user->identity->id);
        $rs_status = str_replace('_id','_status',$data['field']);
        $rs_time = str_replace('_id','_time',$data['field']);
        $rs_result = str_replace('_id','_result',$data['field']);

        OfficeApply::updateAll([$rs_status=>'驳回',$rs_result=>$cancel_details,$rs_time=>date('Y-m-d H:i:s',time())],['apply_id'=>$id]);

        $msg = OfficeApply::find()->select('*')->where(['apply_id'=>$id])->asArray()->one();
        Message::sendMsg('审批',Yii::$app->user->identity->name.'驳回了办公用品采购',$msg['apply_mee_id'],['officeapply/officeapply/view','id'=>$id,'api_url' => "index.php/officeapply/view?id=". $id]);

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
        $fields = [];
        $data = OfficeApply::find()->select('apply_pack_id,apply_genneral_id')->where(['apply_id'=>$id])->asArray()->one();
        foreach($data as $key=>$value){
            if($value == Yii::$app->user->identity->id){
                $fields[$key.'_is_del'] = 0;
            }
        }
        OfficeApply::updateAll($fields,'apply_id = '.$id);
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /*
     * 福利领取
     */
    public function actionMyget(){
        $searchModel = new OfficeapplySearch();
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
        OfficeApply::updateAll(['apply_lq_status'=>'已领取','apply_lq_time'=>date('Y-m-d H:i:s')],['apply_id'=>$id]);
        return $this->redirect(['myget']);
    }

    /**
     * Finds the Officeapply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Officeapply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Officeapply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
