<?php

namespace backend\modules\carwx\controllers;

use backend\controllers\CommonController;
use Yii;
use backend\modules\carwx\models\Carwx;
use backend\modules\carwx\models\CarwxSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\message\models\Message;
/**
 * CarwxController implements the CRUD actions for Carwx model.
 */
class CarwxController extends CommonController
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
     * Lists all Carwx models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CarwxSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,1);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'type' => 1,
        ]);
    }

    /*
     * 审批记录
     * @return string
     */
    public function actionRecord(){
        $searchModel = new CarwxSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,2);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'type' => 2,
        ]);
    }

    /**
     * Displays a single Carwx model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /*
     * 审批操作
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionShenpi($id){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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
     * 审批同意
     */
    public function actionSpty($id){
        if($id == '') return false;
        $data = Carwx::getDqStatus($id,Yii::$app->user->identity->id);
        Carwx::updateAll([$data['field'].'_rs'=>1,$data['field'].'_time'=>date('Y-m-d H:i:s',time())],['id'=>$id]);

        $msg = Carwx::find()->select('zmr,'.$data['field'])->where(['id'=>$id])->asArray()->one();
        Message::sendMsg('审批',Yii::$app->user->identity->name.'同意了机动车报销',$msg['zmr'],['carwx/carwx/shenpi','id'=>$id,'api_url' => "index.php/reimbursement/view?id=". $id ."&type=1"]);
        Message::sendMsg('审批',Yii::$app->user->identity->name.'的机动车报销需要您审批',$msg[$data['field']],['carwx/carwx/shenpi','id'=>$id,'api_url' => "index.php/reimbursement/view?id=". $id ."&type=1"]);

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
        $data = Carwx::getDqStatus($id,Yii::$app->user->identity->id);
        Carwx::updateAll([$data['field'].'_rs'=>2,$data['field'].'_detail'=>$cancel_details,$data['field'].'_time'=>date('Y-m-d H:i:s',time())],['id'=>$id]);


        $msg = Carwx::find()->select('zmr')->where(['id'=>$id])->asArray()->one();
        Message::sendMsg('审批',Yii::$app->user->identity->name.'驳回了机动车报销 驳回原因:'.$cancel_details,$msg['zmr'],['carwx/carwx/view','id'=>$id,'api_url' => "index.php/reimbursement/view?id=". $id ."&type=1"]);

        echo json_encode(array('status'=>'success','msg'=>'驳回成功'));
        exit();
    }

    /**
     * Creates a new Carwx model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Carwx();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Message::sendMsg('审批',Yii::$app->user->identity->name.'的机动车报销需要您审批',$model->zmr,['carwx/carwx/shenpi','id'=>$model->id,'api_url' => "index.php/reimbursement/view?id=". $model->id ."&type=1"]);

            return $this->redirect(['index']);
        } else {
            //print_r($model->getErrors());exit;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Carwx model.
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
     * Deletes an existing Carwx model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        if($id == '') return false;
        Carwx::updateAll(['bxr_del'=>0],'id = '.$id);
        //$this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /*
     * 审批删除
     * @param $id
     * @return bool|\yii\web\Response
     */
    public function actionSpdelete($id){
        if($id == '') return false;
        $fields = [];
        $data = Carwx::find()->select('zmr,glkj,ldsp')->where(['id'=>$id])->asArray()->one();
        foreach($data as $key=>$value){
            if($value == Yii::$app->user->identity->id){
                $fields[$key.'_del'] = 0;
            }
        }
        Carwx::updateAll($fields,'id = '.$id);
        return $this->redirect(['record']);
    }


    /**
     * Finds the Carwx model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Carwx the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Carwx::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
