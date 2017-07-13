<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "{{%role_user}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $role_id
 */
class RoleUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%role_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'role_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'role_id' => Yii::t('app', 'Role ID'),
        ];
    }

    /*
     * 根据用户id获取角色id
     * @param $user_id
     */
    public static function getRoleId($user_id){
        $RoleUser = self::findOne(['user_id'=>$user_id]);
        $role_id = $RoleUser['role_id'];
        return $role_id;
    }

    /*
     * 设置用户角色
     * @param $user_id
     * @param $role_id
     */
    public function setUserRole($user_id,$role_id){
        if($this->find()->where(['user_id'=>$user_id])->one()){
            return $this->updateAll(['role_id'=>$role_id],"user_id =".$user_id);
        }else{
            $this->role_id = $role_id;
            $this->user_id = $user_id;
            $this->isNewRecord = true;
            $this->insert() && $this->id = 0;
            return true;
        }
    }


}
