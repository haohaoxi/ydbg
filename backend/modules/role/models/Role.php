<?php

namespace backend\modules\role\models;

use Yii;

/**
 * This is the model class for table "{{%role}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $order
 * @property integer $status
 * @property string $descript
 * @property string $time
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique','message'=>'此角色已被占用'],
            [['order'], 'integer'],
            [['name'], 'string', 'min' => 1,  'max' => 30],
            [['descript'], 'string', 'min' => 1,  'max' => 200],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '角色名称'),
            'order' => Yii::t('app', '排序'),
            'status' => Yii::t('app', '状态'),
            'descript' => Yii::t('app', '描述'),
            'time' => Yii::t('app', '创建日期'),
        ];
    }


    public function beforeSave($insert = true)
    {
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                $this->time = date('Y-m-d');
                $this->status = 1;
            }
            return true;
        }else{
            return false;
        }
    }

    /*
     * 获取所有角色信息
     * @param array $where
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function get_roles($where=['status'=>1]){
        return self::find()->orderBy('id asc')->where($where)->asArray()->all();
    }


    /*
     * 根据角色id获取角色名称
     * @param $user_id
     */
    public static function getRoleName($role_id){
        $Role = self::findOne(['id'=>$role_id]);
        $name = $Role['name'];
        return $name;
    }

}
