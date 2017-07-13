<?php

namespace backend\modules\welfare\models;

use Yii;

/**
 * This is the model class for table "{{%welfare}}".
 *
 * @property integer $welfare_id
 * @property string $welfare_name
 * @property string $welfare_type
 * @property string $welfare_start_time
 * @property string $welfare_end_time
 * @property string $welfare_part_id
 * @property string $welfare_part_name
 * @property string $welfare_detail
 */
class Welfare extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%welfare}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['welfare_name',  'welfare_start_time', 'welfare_part_id', 'welfare_part_name','welfare_detail'], 'required'],
            [['welfare_start_time','welfare_type',  'welfare_end_time'], 'safe'],
            [['welfare_detail'], 'string'],
            [['welfare_name', 'welfare_type'], 'string', 'max' => 20],
            [['welfare_part_name'], 'string', 'max' => 500],
            [['welfare_part_id'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'welfare_id' => Yii::t('app', 'Welfare ID'),
            'welfare_name' => Yii::t('app', '福利名称'),
            'welfare_type' => Yii::t('app', '福利类型'),
            'welfare_start_time' => Yii::t('app', '开始时间'),
            'welfare_end_time' => Yii::t('app', '结束时间'),
            'welfare_part_id' => Yii::t('app', '适用机构ID，每个ID用英文“，”隔开,例如：1,2,34 '),
            'welfare_part_name' => Yii::t('app', '适用机构'),
            'welfare_detail' => Yii::t('app', '福利明细'),
        ];
    }

    /*
     * 获得机构
     * @return array|bool
     */
    public static function getJigou($where=1){
        $conn=Yii::$app->db;
        $sql = 'select * from dept_contact  where '.$where.' order by id asc';
        $data = $conn->createCommand($sql)->queryAll();
        if(count($data) == 0 ) return false;
        return $data;
    }
}
