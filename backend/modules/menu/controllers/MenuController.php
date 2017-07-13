<?php

namespace backend\modules\menu\controllers;

use backend\functions\functions;
use Yii;
use backend\modules\menu\models\Menu;
use backend\controllers\CommonController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\functions\MenuTree;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends CommonController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $cat=new MenuTree('',array('id','parent_id','name','fullname'));
        $data=$cat->getTree(Menu::get_menus(true));//获取分类结构
        $this->getView()->title = '菜单管理';
        return $this->render('index', [
            'data' => $data
        ]);
    }


    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menu();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            $cat=new MenuTree('',array('id','parent_id','name','fullname'));

            print_r($cat);
            $_list=$cat->getTree(Menu::get_menus(true));//获取分类结构
            $list = array('0'=>'顶级菜单');
            foreach($_list as $value){
                $list[$value['id']] = $value['fullname'];
            }
            $model->order=0;
            return $this->render('create', [
                'model' => $model,
                'list' => $list
            ]);
        }
    }

    /**
     * Updates an existing Menu model.
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
            $cat=new MenuTree('',array('id','parent_id','name','fullname'));
            $_list=$cat->getTree(Menu::get_menus(true));//获取分类结构
            $list = array('0'=>'顶级菜单');
            foreach($_list as $value){
                $list[$value['id']] = $value['fullname'];
            }
            return $this->render('update', [
                'model' => $model,
                'list' => $list
            ]);
        }
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $del_ids = Menu::get_ids($id);
        if($del_ids != ''){
            $del_ids = $id.','.substr($del_ids,0,-1); //删除ids
        }else{
            $del_ids = $id;
        }
        Menu::deleteAll("id in ($del_ids)");
        //$this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
