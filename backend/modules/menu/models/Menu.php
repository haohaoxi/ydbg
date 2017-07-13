<?php

namespace backend\modules\menu\models;

use Yii;
use backend\modules\user\models\RoleUser;
use backend\modules\role\models\RoleMenu;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $order
 * @property integer $is_show
 * @property string $class
 * @property string $module
 * @property string $controller
 * @property string $menutype
 * @property string $action
 * @property integer $parent_id
 */
class Menu extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','order', 'module', 'controller', 'action'], 'required'],
            [['order', 'is_show', 'parent_id','is_run'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['class'], 'string', 'max' => 500],
            [['menutype'], 'string', 'max' => 50],
            [['module', 'controller', 'action'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '菜单名称'),
            'order' => Yii::t('app', '排序'),
            'is_show' => Yii::t('app', '是否显示'),
            'class' => Yii::t('app', '样式'),
            'module' => Yii::t('app', '模块'),
            'controller' => Yii::t('app', '控制器'),
            'menutype' => Yii::t('app', '参数'),
            'action' => Yii::t('app', '方法'),
            'parent_id' => Yii::t('app', '父级菜单'),
            'is_run' => Yii::t('app', '是否允许操作'),
        ];
    }

    /*
     * 获取菜单数据
     */
    public static function get_menus($where=['is_show'=>1]){
        $data = self::find()->orderBy('order desc')->where($where)->asArray()->all();
        $super_admin = \Yii::$app->params['super_admin']; //获取超级用户账号
        $username = Yii::$app->user->identity->username; //获取登录账号
        $query = new \yii\db\Query();
        $role_user = $query->select('role_id')->from("{{role_user}}")->where(['user_id'=>Yii::$app->user->identity->id])->one();
        $role_id = $role_user['role_id'];//获取角色id
        if(!in_array($username,$super_admin) && $role_id !=1){   //如果是超级账户的话 则免除验证 拥有最高权限
            $role_id = RoleUser::getRoleId(Yii::$app->user->identity->id);
            $menus_id = RoleMenu::get_menu_id($role_id);
            foreach($data as $key=>$value){
                if(!in_array($value['id'],$menus_id)){
                    unset($data[$key]);
                }
            }
        }
        return $data;
    }


    /*
     * 数据应用到子栏目
     * @param $id
     * @param $data
     * @return bool
     */
    public static function setChildDate($id,$data){
        if($id == "")  return false;
        $ids = substr(self::get_ids($id),0,-1);
        if($ids == "")  return true;
        self::updateAll($data,"id in(".$ids.")");
    }

    /*
     * 递归获取ids
     * @param $id
     */
    public static function get_ids($id,&$ids=""){
        $data = self::find()->select('id')->where(['parent_id'=>$id])->asArray()->all();
            $data = array_column($data,'id');
            if(count($data) != 0) $ids .= implode(',',$data).',';
            foreach($data as $value){
                self::get_ids($value,$ids);
            }
        return $ids;
    }

    /*
     * 递归第一个子id
     * @param $id
     */
    public static function get_child_id($id){
        $where = ['parent_id'=>$id,'is_run'=>1,'is_show'=>1];
        if(!empty($_GET['menutype'])) $where['menutype'] = intval($_GET['menutype']);
        if($data = self::find()->select('id')->where($where)->asArray()->orderBy('order desc')->one()){
        return $data['id'];
        }else{
            return false;
        }
    }

    /*
     *
     * @param $id pid
     * @return mixed
     */
    public static function get_parent_top_id($id){
        $data = self::find()->select('id,parent_id')->where(['id'=>$id])->asArray()->one();
        if($data['parent_id'] != 0){
            return self::get_parent_top_id($data['parent_id']);
        }
        return $data['id'];
    }

}
