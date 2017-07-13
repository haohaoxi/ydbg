<?php

namespace backend\modules\role\models;

use Yii;
use yii\base\Exception;

/**
 * This is the model class for table "{{%role_menu}}".
 *
 * @property integer $id
 * @property integer $role_id
 * @property integer $menu_id
 */
class RoleMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%role_menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'menu_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'role_id' => Yii::t('app', 'Role ID'),
            'menu_id' => Yii::t('app', 'Menu ID'),
        ];
    }

    /*
     * 设置权限方法
     * @param $role_id
     * @param $menus_id
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function set_permissions($role_id,$menus_id){
        $db = \Yii::$app->db;
        $transaction=$db->beginTransaction();
        try
        {
            $db->createCommand('delete FROM {{%role_menu}} where role_id ='.$role_id)->execute();
            $menus_arg = [];
            foreach($menus_id as $value){
                $menus_arg[] = [$role_id,$value];
            }
            $db->createCommand()->batchInsert('{{%role_menu}}', ['role_id', 'menu_id'], $menus_arg)->execute();
            $transaction->commit();

        }
        catch(Exception $e) // 如果有一条查询失败，则会抛出异常
        {
            $transaction->rollBack();
        }
        return true;
    }

    /*
     * 根据角色id 获取菜单id
     * @param $role_id
     */
    public static function get_menu_id($role_id){
        $menus_id = self::find()->select('menu_id')->where(['role_id'=>$role_id])->asArray()->all();
        $menus_id = array_column($menus_id,'menu_id');
        return $menus_id;
    }
}
