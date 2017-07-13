<?php

namespace backend\modules\role\controllers;

use backend\modules\user\models\RoleUser;
use common\models\User;
use Yii;
use backend\modules\role\models\Role;
use backend\modules\role\models\RoleMenu;
use backend\modules\role\models\RoleSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\functions\MenuTree;
use backend\modules\menu\models\Menu;
use backend\functions\functions;
use backend\controllers\CommonController;
/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends CommonController
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                  //  'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex()
    {
        $data = Role::get_roles(true);
        return $this->render('index',['data'=>$data]);
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Role();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $transaction=Yii::$app->db->beginTransaction();
        try {
            $this->findModel($id)->delete();
            $data = RoleUser::find()->where(['role_id'=>$id])->asArray()->all();
            if($data){
                $_user_ids = "";
                foreach($data as $value){
                    $_user_ids .= $value['user_id'].',';
                }
                $_user_ids = substr($_user_ids,0,-1);
                RoleUser::deleteAll(['role_id'=>$id]); //删除role_user表信息
                User::deleteAll("id in ($_user_ids)"); //删除user表信息
            }
            $transaction->commit();

            return $this->redirect(['index']);
        }catch (Exception $e) {
            $transaction->rollback();
            throw new NotFoundHttpException('操作失败,请重新操作');
        }
    }

    /*
     * 权限分配
     */
    public function actionPermissions(){

        if(!empty($_POST['role_id'])){
            $post = Yii::$app->request->post();
            $role_id = intval($post['role_id']);
            if(empty($_POST['p_ids'])){
                functions::alert('权限不能为空！');
            }
            $menus_id = functions::safe_filter($post['p_ids']);
            if(RoleMenu::set_permissions($role_id,$menus_id)){
                return $this->redirect(['index']);
            }
        }else{
            $role_id = intval(Yii::$app->request->get('id'));
            if($role_id){
                $cat=new MenuTree('',array('id','parent_id','name','fullname'));
                $menu=$cat->getTree(Menu::get_menus(['is_run'=>1]));//获取所有有效的权限节点(菜单)
                $RoleMenu = RoleMenu::find()->select('menu_id')->where(['role_id'=>$role_id])->asArray()->all();//获取该角色id下面拥有的权限菜单id
                $RoleMenu = array_column($RoleMenu, 'menu_id');
                return $this->render('permissions', [
                    'menu'=>$menu,
                    'RoleMenu'=>$RoleMenu,
                    'role_id'=>$role_id
                ]);
            }
        }
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Role::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
