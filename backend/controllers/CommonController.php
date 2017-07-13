<?php
namespace backend\controllers;

use backend\functions\functions;
use backend\modules\menu\models\Menu;
use backend\modules\message\models\Message;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
/**
 * 公共基础控制器
 */
class CommonController extends Controller
{
    protected $_isPermission = true; //是否进行rbac权限验证

    public function beforeAction($action)
    {
        parent::beforeAction($action);
        $this->readMsg();
        return $this->hasPermission();
    }


    public function afterAction($action,$result){
        $result = parent::afterAction($action,$result);
        return $result;
    }

    /*
     * @param $m_id
     */
    private function readMsg(){
      if(!empty($_GET['m_id'])){
          $id = intval($_GET['m_id']);
          Message::updateAll(['is_reader'=>'已读'],'id = '.$id);
      }
    }

    /*
     * RBAC权限判断
     */
    protected function hasPermission(){
        if (Yii::$app->user->isGuest) {
            Yii::$app->getResponse()->redirect(Yii::$app->urlManager->createUrl(['/site/login']));
        }else{
            if($this->_isPermission === false) return true; //为开启权限判断的话则不进行验证权限
            $super_admin = \Yii::$app->params['super_admin']; //获取超级用户账号
            $username = Yii::$app->user->identity->username; //获取登录账号
            if(in_array($username,$super_admin)) return true; //如果是超级账户的话 则免除验证 拥有最高权限
            $moduleId = Yii::$app->controller->module->id; //获取模块id
            var_dump($moduleId);
            $controllerId =  Yii::$app->controller->id; //获取控制器id
            var_dump($controllerId);
            $actionId =  Yii::$app->controller->action->id; //获取方法id
            var_dump($actionId);
            $userId = Yii::$app->user->identity->id; //获取用户id
            var_dump($userId);

            $menu = Menu::get_menus(['is_show'=>1,'is_run'=>1,'action'=>'index']);
            if(count($menu) == 0){
                Yii::$app->user->logout();
                functions::alert('您没有任何显示模块权限,请联系管理员',Yii::$app->urlManager->createUrl(['/site/logout']),true,'提示');
            }

            $query = new \yii\db\Query();
            $role_user = $query->select('role_id')->from("{{role_user}}")->where(['user_id'=>$userId])->one();
            $role_id = $role_user['role_id'];//获取角色id
            if($role_id == 1) return true;

            $where = ['module'=>$moduleId,'controller'=>$controllerId,'action'=>$actionId,'is_run'=>1];
            if(!empty($_GET['menutype'])) $where['menutype'] = $_GET['menutype'];

            if(!$menu = $query->select('id,name')->from("{{menu}}")->where($where)->one()){   //获取当前方法的验证权限记录id

                functions::alert('该菜单功能不存在或者未启用.'.(YII_DEBUG == true ? ($moduleId.'-'.$controllerId.'-'.$actionId) : ''));
            }
            $menu_id = $menu['id'];
            if(!$query->select('id')->from("{{role_menu}}")->where(['role_id'=>$role_id,'menu_id'=>$menu_id])->one()){

                $Referrer = urldecode(Yii::$app->request->referrer);//获取来源网址
                $Referrer = parse_url($Referrer);
                if(isset($Referrer['query'])){
                    $Referrer = $Referrer['query'];
                    $Referrer = explode('/',str_replace('r=','',$Referrer));//来源页面模块
                    if(isset($Referrer[2])){
                        $Referrerwhere = ['module'=>$Referrer[0],'controller'=>$Referrer[1],'action'=>$Referrer[2],'is_run'=>1];
                        if(!empty($_GET['menutype'])) $Referrerwhere['menutype'] = $_GET['menutype'];

                        if(!$_menu = $query->select('id,name')->from("{{menu}}")->where($Referrerwhere)->one()){   //获取当前方法的验证权限记录id
                            functions::alert('该菜单功能不存在或者未启用.'.(YII_DEBUG == true ? ($moduleId.'-'.$controllerId.'-'.$actionId) : ''));
                        }
                    }
                }
                $menu = Menu::get_menus(['is_show'=>1,'is_run'=>1,'action'=>'index']);
                if(count($menu) == 0){
                    Yii::$app->user->logout();
                    functions::alert('您没有任何显示模块权限,请联系管理员',Yii::$app->urlManager->createUrl(['/site/logout']),true,'提示');
                }else{
                    $menu = reset($menu);
                    if($menu['menutype'] !='') {
                        $url = ["{$menu['module']}/{$menu['controller']}/{$menu['action']}", 'menutype' => $menu['menutype']];
                    }else{
                        $url = ["{$menu['module']}/{$menu['controller']}/{$menu['action']}"];
                    }
                    functions::alert('您无该模块操作权限，请联系管理员',Yii::$app->urlManager->createUrl($url));
                }
            }
            return true;
        }
    }


    public static function alertLogout($message,$url='',$isAlert=true,$title='提示'){
        echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>',$title,'</title></head><body>';
        echo '<script type="text/javascript">';
        echo $isAlert?'alert("'.$message.'");':'';
        //Yii::$app->user->logout();//退出
        echo $url==''?'history.back();':'location.href="'.$url.'";';
        echo '</script>';
        echo '</body></html>';
        exit();
    }





}
