<?php

namespace backend\modules\studytk\controllers;

use backend\controllers\CommonController;
use backend\functions\functions;
use Yii;
use backend\modules\studytk\models\Studytk;
use backend\modules\studytk\models\StudytkSearch;
use backend\modules\user\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudytkController implements the CRUD actions for Studytk model.
 */
class StudytkController extends CommonController
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
     * Lists all Studytk models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudytkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Studytk model.
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
     * Creates a new Studytk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $model = new Studytk();
        $model->users = Yii::$app->user->identity->name;
        $model->time = date("Y-m-d h:i:s");
        $model->daan = "A";

//        if ($_POST) {
//            $tions = json_encode($_POST['tions']);
//            $connection = Yii::$app->db;
//            $connection->createCommand()->insert('study_tk', ['name' => $_POST['Studytk']['name']
//                , 'users' => $model->users, 'time' => $model->time, 'tions' => $tions, 'daan' => $_POST['daan'], 'jiexi' => $_POST['Studytk']['jiexi'], 'type' => $_POST['Studytk']['type']])->execute();
//            return $this->redirect(['index', 'id' => $model->id]);
        if ($model->load(Yii::$app->request->post())) {
            $model->tions = json_encode($_POST['tions']);
            $model->daan = $_POST['daan'];
            if($model->save()){
                return $this->redirect(['index']);
            }else{
                functions::alert('题库名称重复');
            }
        }else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }
    /**
     * Updates an existing Studytk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->time = $model['time'];
        $model->users = $model['users'];

//        if ($_POST) {
//            $tions = json_encode($_POST['tions']);
//            Studytk::updateAll(['name'=>$_POST['Studytk']['name'],'users'=>$users,'time'=>$time,'tions'=>$tions,'daan'=>$_POST['daan'],'jiexi'=>$_POST['Studytk']['jiexi'],'type'=>$_POST['Studytk']['type']],['id'=>$_GET['id']]);
////            $connection->createCommand()->insert('study_tk', ['name' =>$_POST['Studytk']['name']
////                , 'users' => $model->users,'time'=>$model->time,'tions'=>$tions,'daan'=>$_POST['daan'],'jiexi'=>$_POST['Studytk']['jiexi'],'type'=>$_POST['Studytk']['type']])->execute();
//            return $this->redirect(['index', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
        if ($model->load(Yii::$app->request->post())) {
            $model->tions = json_encode($_POST['tions']);
            $model->daan = $_POST['daan'];
            if($model->save()){
                return $this->redirect(['index']);
            }else{
                functions::alert('题库名称重复');
            }
        }else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Studytk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Studytk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Studytk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Studytk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
