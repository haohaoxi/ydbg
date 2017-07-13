<?php

namespace backend\modules\studysj\controllers;

use backend\controllers\CommonController;
use backend\modules\studytk\models\Studytk;
use backend\functions\functions;
use yii\db\Expression;
use Yii;
use backend\modules\studysj\models\Studysj;
use backend\modules\studysj\models\StudysjSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\user\models\User;
/**
 * StudysjController implements the CRUD actions for Studysj model.
 */
class StudysjController extends CommonController
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
     * Lists all Studysj models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudysjSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Studysj model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $user = Studysj::find()->select('user,p_id')->where(['id'=>$id])->asArray()->one();

        $p_id = explode(',',$user['p_id']);
            foreach($p_id as $ke=>$vo){
                $studytk[] = Studytk::find()->select('name,type')->where(['id'=>$vo])->asArray()->all();
    }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'user' =>$user['user'],
            'studytk'=>$studytk,
      ]);
    }

    /**
     * Creates a new Studysj model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Studysj();
        $user = User::find()->select('name')->where(['username'=>yii::$app->user->identity->username])->asArray()->one();
        $model->user = $user['name'];
        $model->status = "";
        if($model->load(Yii::$app->request->post())){
            $p_id = Studytk::find()->select('id')
                ->orderBy(new Expression('rand()'))
                ->limit($_POST['Studysj']['questions'])->asArray()->all();
            $arr = array();
            foreach($p_id as $key=>$v){
               $arr[] .=$v['id'];
            };
            $text = implode(",", $arr);//85,64,84,63,74,80,60,75,61,66,81,58,77,90,87,69,68,73,92,62,79,76,59,70,57,67,86,82,88,83
            $start_time = strtotime($_POST['Studysj']['start_time']);
            $end_time = strtotime($_POST['Studysj']['end_time']);
            $data =strtotime(date("Y-m-d",time()));
            if($start_time > $data){
                $model->status = 0;
            }else if ($start_time <= $data && $end_time >= $data ){
                $model->status = 1;
            }else if ( $end_time < $data ){
                $model->status = 2;
            }else if($start_time <=$data){
                $model->status = 1;
            }

            $model->p_id = $text;
            $model->create_time=date('Y-m-d H:i:s',time());//创建时间 Bob 0618
//            echo '<pre>';
//            print_r($model);
//            print_r($_POST);exit;

            if($model->save()){
                return $this->redirect(['index', 'id' => $model->id]);
            }else{
                functions::alert('试卷名称重复');
            }
//            print_r($model->status);die;
//            $connection = Yii::$app->db;
//            $connection->createCommand()->insert('study_sj', ['name' =>$_POST['Studysj']['name']
//                , 'user' => $model->user,'mechanism'=>$_POST['Studysj']['mechanism'],'standard'=>$_POST['Studysj']['standard'],'start_time'=>$_POST['Studysj']['start_time'],
//                'end_time'=>$_POST['Studysj']['end_time'],'offen'=>$_POST['Studysj']['offen'],'questions'=>$_POST['Studysj']['questions'],'p_id'=>$text
//            ,'status'=>$model->status])->execute();

        }else{
            return $this->render('create',[
                'model'=>$model,
            ]);
        }
    }

    /**
     * Updates an existing Studysj model.
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
     * Deletes an existing Studysj model.
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
     * Finds the Studysj model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Studysj the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Studysj::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
