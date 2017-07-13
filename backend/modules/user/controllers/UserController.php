<?php

namespace backend\modules\user\controllers;

use backend\modules\role\models\Role;
use Yii;
use backend\modules\user\models\User;
use backend\modules\user\models\UserSearch;
use backend\modules\user\models\RoleUser;
use yii\base\Exception;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\CommonController;
use common\models\User as Users;
use backend\functions\functions;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends CommonController
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        $model->scenario='create';
        if ($model->load(Yii::$app->request->post()) && $user = $model->signup()) {
            $role = new RoleUser();
            $role->setUserRole($user->attributes['id'],$model->role_id); //设置用户角色
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario='update';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $role = new RoleUser();
            $role->setUserRole($model->id,$model->role_id); //设置用户角色
            return $this->redirect(['index']);
        } else {
            $model->role_id = RoleUser::getRoleId($id);
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /*
     * 密码修改操作
     * @param $id
     * @return string|\yii\web\Response
     * @throws Exception
     */
    public function actionUpdatePwd($id)
    {
        $model = User::findOne($id);
        $model->scenario = 'updatePwd';
        if ($model->load(Yii::$app->request->post())) {
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);//利用password_hash模式加密密码字符
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->password='';
            return $this->render('updatePwd', [
                'model' => $model,
            ]);
        }
    }

    /*
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     **/
    public function actionDelete($id)
    {
        $transaction=Yii::$app->db->beginTransaction();
        try {
            User::updateAll(['status'=>0],['id'=>$id]);
            //$this->findModel($id)->delete();
            //RoleUser::deleteAll(['user_id'=>$id]); //删除role_user表信息
            $transaction->commit();
            return $this->redirect(['index']);
        }catch (Exception $e) {
            $transaction->rollback();//如果操作失败, 数据回滚
            throw new NotFoundHttpException('操作失败,请重新操作');
        }
    }

    /*
     * 修改密码
     * @return string
     */
    public function actionUpdateTopPwd(){
        $model = new User();
        $model->scenario = 'updateTopPwd';
        if($model->load(Yii::$app->request->post())  && $model->validate()){
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->rePwd);
                $model->rePwd = $model->password_hash;
                $model->id= \Yii::$app->user->id;
                $model->isNewRecord = false;
                $model->save();
                functions::alert('密码修改成功！');
                return $this->redirect(['/site/login']);
        }else{
            return $this->render('updateTopPwd', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
