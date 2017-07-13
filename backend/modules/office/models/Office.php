<?php

namespace backend\modules\office\models;

use Yii;

/**
 * This is the model class for table "{{%office}}".
 *
 * @property string $office_name
 * @property double $office_price
 * @property string $office_part_id
 * @property integer $office_num
 * @property string $office_start_time
 * @property string $office_end_time
 * @property string $office_status
 * @property string $office_part_name
 * @property string $office_type
 * @property integer $office_id
 * @property integer $office_is_del
 * @property integer $office_fbr
 */
class Office extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%office}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['office_name', 'office_price', 'office_part_id', 'office_num', 'office_start_time', 'office_part_name'], 'required'],
            [['office_price'], 'number'],
            [['office_num', 'office_is_del'], 'integer'],
            [[ 'office_end_time', 'office_type','office_fbr'], 'safe'],
            [[ 'office_part_id', 'office_type'], 'string', 'max' => 100],
            [['office_name'], 'string', 'max' => 20],
            [['office_part_name'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'office_name' => Yii::t('app', '办公用品名称'),
            'office_price' => Yii::t('app', '预计单价'),
            'office_part_id' => Yii::t('app', '适用机构ID'),
            'office_num' => Yii::t('app', '库存数量'),
            'office_start_time' => Yii::t('app', '申请开始时间'),
            'office_end_time' => Yii::t('app', '申请结束时间'),
            'office_status' => Yii::t('app', 'Office Status'),
            'office_part_name' => Yii::t('app', '适用机构名称'),
            'office_type' => Yii::t('app', '用品类型'),
            'office_id' => Yii::t('app', 'Office ID'),
            'office_is_del' => Yii::t('app', 'Office Is Del'),
            'office_fbr' => Yii::t('app', '发布人'),
        ];
    }

    public function beforeSave($insert = true)
    {
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                $this->office_fbr = isset(Yii::$app->user->identity->id) && Yii::$app->user->identity->id !='' ? Yii::$app->user->identity->id : intval($_POST['bxr']);
            }
            return true;
        }else{
            return false;
        }
    }

    /*
     * 获取物品信息
     * @param $id
     */
    public static function getOffice($id){
        return self::find()->where(['office_id'=>$id])->asArray()->one();
    }

}
