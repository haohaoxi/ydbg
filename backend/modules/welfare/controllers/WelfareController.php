<?php

namespace backend\modules\welfare\controllers;

use backend\controllers\CommonController;
use backend\modules\user\models\User;
use backend\modules\welfareapply\models\WelfareApply;
use Yii;
use backend\modules\welfare\models\Welfare;
use backend\modules\welfare\models\WelfareSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\message\models\Message;

/**
 * WelfareController implements the CRUD actions for Welfare model.
 */
class WelfareController extends CommonController
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
     * Lists all Welfare models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WelfareSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Welfare model.
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
     * Creates a new Welfare model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Welfare();
        $jigou = WelfareSearch::getName();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'jigou' => $jigou,
            ]);
        }
    }

    /**
     * Updates an existing Welfare model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->welfare_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Welfare model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($id == '') return false;
        Welfare::updateAll(['welfare_is_del'=>0],'welfare_id = '.$id);
        //$this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /*
     * 福利申请
     */
    public function actionSq($id){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /*
     * 申请提交
     * welfare_id
     * welfare_sp_id
     */
    public function actionSqtj(){
        if(!empty($_POST['welfare_id']) && !empty($_POST['welfare_sp_id'])  && !empty($_POST['welfare_name'])){
            $welfare_id = intval($_POST['welfare_id']);
            $welfare_sp_id = intval($_POST['welfare_sp_id']);
            $welfare_name = $_POST['welfare_name'];
            $welfare_apply_mee_id_text = User::getNames(Yii::$app->user->identity->id);
            $welfare_sp_id_text = User::getNames($welfare_sp_id);
            $model = new WelfareApply();
            $model->welfare_id = $welfare_id;
            $model->welfare_name = $welfare_name;
            $model->welfare_apply_mee_id = Yii::$app->user->identity->id;
            $model->welfare_sp_id = $welfare_sp_id;
            $model->welfare_sq_time = date('Y-m-d H:i:s');
            $model->welfare_department = Yii::$app->user->identity->department;
            $model->welfare_apply_mee_name = $welfare_apply_mee_id_text[0]['name'];
            $model->welfare_sp_name = $welfare_sp_id_text[0]['name'];
            $model->isNewRecord;
            $model->save();

            Message::sendMsg('审批',Yii::$app->user->identity->name.'的福利申请需要你审批',$welfare_sp_id,['welfare/welfare/sp','id'=>$model->welfare_apply_id,'api_url' => "index.php/welfare/view?id=". $model->welfare_apply_id]);

            $this->redirect(Yii::$app->urlManager->createUrl(['welfare/welfare/index']));
        }
    }

    /**
     * Finds the Welfare model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Welfare the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Welfare::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
