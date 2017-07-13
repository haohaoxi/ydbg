<?php

namespace backend\modules\qingjia\models;

use Yii;

/**
 * This is the model class for table "{{%qingjia_type}}".
 *
 * @property integer $id
 * @property string $name
 */
class QingjiaType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%qingjia_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return array 获取请假类型
     */
    public static function getQingjiaTypes(){
        $query=QingjiaType::find()->asArray()->all();
        $qingjiaTypes=array();
        foreach($query as $v){
            $qingjiaTypes[$v['id']]=$v['name'];
        }
        return $qingjiaTypes;
    }

    /**
     * @param $id
     * @return string 根据id获取请假类型名
     */
    public static function getQingjiaTypeNameById($id){
        $name='';
        $query=QingjiaType::findOne($id);
        if(!empty($query)){
            $name=$query->name;
        }
        return $name;
    }

}
