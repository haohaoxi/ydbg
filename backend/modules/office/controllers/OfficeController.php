<?php

namespace backend\modules\office\controllers;

use backend\controllers\CommonController;
use backend\functions\functions;
use backend\modules\officeapply\models\OfficeApply;
use Yii;
use backend\modules\office\models\Office;
use backend\modules\office\models\OfficeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\user\models\User;
use yii\db\Expression;
use backend\modules\message\models\Message;
use backend\modules\welfare\models\WelfareSearch;

/**
 * OfficeController implements the CRUD actions for Office model.
 */
class OfficeController extends CommonController
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
     * Lists all Office models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OfficeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Office model.
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
     * Creates a new Office model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Office();
        $jigou = WelfareSearch::getName();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->office_id]);
        } else {
            //print_r($model->getErrors());exit;
            return $this->render('create', [
                'model' => $model,
                'jigou' => $jigou,
            ]);
        }
    }

    /**
     * Updates an existing Office model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->office_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Office model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($id == '') return false;
        Office::updateAll(['office_is_del'=>0],'office_id = '.$id);
        //$this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /*
     * 办公用品申请
     */
    public function actionSq($id){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /*
     * 申请提交
     */
    public function actionSqtj(){
        if(!empty($_POST)){
            if($rs = Office::findOne(intval($_POST['office_id']))){
                if($rs['office_num'] < $_POST['office_apply_num']){
                    functions::alert('您申请的物品数量已超过储存数量');
                }
            }else{
                exit;
            }
            $apply_pack_text = User::getNames(intval($_POST['apply_pack_id']));
            $apply_mee_text = User::getNames(Yii::$app->user->identity->id);
            $model = new OfficeApply();
            $model->apply_office_id = intval($_POST['office_id']);
            $model->apply_office_name = ($_POST['office_name']);
            $model->apply_num = intval($_POST['office_apply_num']);
            $model->apply_price = ($_POST['office_price']);
            $model->apply_money = $_POST['office_apply_money'];
            $model->apply_mee_id = Yii::$app->user->identity->id;
            $model->apply_mee_text = $apply_mee_text[0]['name'];
            $model->apply_sq_time = date('Y-m-d H:i:s');
            $model->apply_pack_id = intval($_POST['apply_pack_id']);
            $model->apply_pack_text = $apply_pack_text[0]['name'];
            $model->apply_department = Yii::$app->user->identity->department;
            if(!empty($_POST['apply_genneral_id'])){
                $apply_genneral_text = User::getNames(intval($_POST['apply_genneral_id']));
                $model->apply_genneral_id = intval($_POST['apply_genneral_id']);
                $model->apply_genneral_text = $apply_genneral_text[0]['name'];
            }
            $model->isNewRecord;
            if($model->save()){
                Office::updateAll(['office_num'=> new Expression('office_num-'.intval($_POST['office_apply_num']))],['office_id'=>intval($_POST['office_id'])]);

                Message::sendMsg('审批',Yii::$app->user->identity->name.'的办公用品申请需要你审批',intval($_POST['apply_pack_id']),['officeapply/officeapply/sp','id'=>$model->apply_id,'api_url' => "index.php/officesupplies/view?id=".$model->apply_id]);

                $this->redirect(Yii::$app->urlManager->createUrl(['office/office/index']));
            }else{
                print_r($model->getErrors());exit;
            }
        }
    }


    /*
     * 采购申请
     */
    public function actionCg(){
        $model = new OfficeApply();
        return $this->render('caigou', [
            'model' => $model,
        ]);
    }

    /*
     * 采购提交
     * @return string|\yii\web\Response
     */
    public function actionCgtj(){
        $model = new OfficeApply();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Message::sendMsg('审批',Yii::$app->user->identity->name.'的办公用品采购申请需要您审批',$model->apply_pack_id,['officeapply/officeapply/sp','id'=>$model->apply_id,'api_url' => "index.php/officesupplies/view?id=".$model->apply_id]);

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Office model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Office the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Office::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
