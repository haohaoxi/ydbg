<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\functions\functions;
use backend\modules\menu\models\Menu;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = false;
    /**
     * @inheritdoc
     */
    public function behaviors() //静态绑定行为
    {
        return [
            'access' => [
                'class' => AccessControl::className(), //class 仅仅是一个名子 也可以不用
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','top','left','main'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                  //  'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction', //相当于把 yii\web\ErrorAction 这个类作为本类的 error 方法
            ],
        ];
    }

    /*
     * 整体iframe框架显示
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $menu = Menu::get_menus(['is_show'=>1,'is_run'=>1,'action'=>'index']);

            if(count($menu) == 0){
                Yii::$app->user->logout();
                functions::alert('您没有任何显示模块权限,请联系管理员',Yii::$app->urlManager->createUrl(['/site/login']),true,'提示',false);
            }else{
                $menu = reset($menu);
                $url = '';
                if($menu['menutype'] !='') {
                    $url = ["{$menu['module']}/{$menu['controller']}/{$menu['action']}", 'menutype' => $menu['menutype']];
                }else{
                    $url = ["{$menu['module']}/{$menu['controller']}/{$menu['action']}"];
                }
                return Yii::$app->getResponse()->redirect($url);
            }
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }



    public function actionLogout()
    {
        Yii::$app->user->logout();
        Yii::$app->getResponse()->redirect(['/site/login']);
        return $this->goHome();
    }

}
