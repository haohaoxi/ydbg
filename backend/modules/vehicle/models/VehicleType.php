<?php

namespace backend\modules\vehicle\models;

use Yii;

/**
 * This is the model class for table "{{%vehicle_type}}".
 *
 * @property integer $id
 * @property string $name
 */
class VehicleType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vehicle_type}}';
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

    public static function getVehicles(){
        $query=VehicleType::find()
            ->asArray()
            ->all();
        $vehicles=array();
        foreach($query as $v){
            $vehicles[$v['id']]=$v['name'];
        }
        return $vehicles;
    }

    public static function getVehicleNameById($id){
        $name='';
        $query=VehicleType::findOne($id);
        if(!empty($query)){
            $name=$query->name;
        }
        return $name;
    }

    public static function getVehicleIdByName($name){
        $id='';
        $query=VehicleType::find()->where('name=:name',[':name'=>$name])->asArray()->one();
        if(!empty($query)){
            $id=$query['id'];
        }
        return $id;
    }
}
