<?php

namespace backend\modules\personworkworkflow\models;

use backend\modules\personwork\models\PersonWork;
use Yii;

/**
 * This is the model class for table "{{%person_work_workflow}}".
 *
 * @property integer $w_id
 * @property integer $w_p_id
 * @property integer $w_person_id
 * @property string $w_s_time
 * @property string $w_e_time
 * @property string $w_s_status
 * @property string $w_e_status
 * @property string $w_type
 * @property string $w_cancel_details
 * @property string $w_del
 */
class PersonWorkWorkflow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%person_work_workflow}}';
    }

    public function getPersonWork(){
        return $this->hasOne(PersonWork::className(),['w_p_id'=>'w_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['w_p_id', 'w_person_id', 'w_s_time', 'w_s_status'], 'required'],
            [['w_p_id', 'w_person_id'], 'integer'],
            [['w_s_time', 'w_e_time','w_person_key','w_cancel_details','w_y_slr','w_del'], 'safe'],
            [['w_s_status', 'w_e_status', 'w_type'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'w_id' => Yii::t('app', '序号'),
            'w_p_id' => Yii::t('app', '对应person_work表记录id'),
            'w_person_id' => Yii::t('app', '处理人员'),
            'w_s_time' => Yii::t('app', '处理开始时间'),
            'w_e_time' => Yii::t('app', '处理结束时间'),
            'w_s_status' => Yii::t('app', '开始办理状态'),
            'w_e_status' => Yii::t('app', '最后状态'),
            'w_type' => Yii::t('app', '是否是代办(只针对受理者)'),
            'w_cancel_details' => Yii::t('app', '退办原因'),
            'w_y_slr' => Yii::t('app', '原受理人'),
            'w_del' => Yii::t('app', '是否删除'),
        ];
    }

    /*
     * 获取审批详情
     */
    public static function getSp($id){
        if($id=='' || !is_numeric($id)) return false;
        $data = self::find()->where(['w_p_id'=>$id,'w_s_status'=>'未审批'])->orderBy('w_id asc')->asArray()->all();
        $_data = array();
        foreach($data as $key=>$value){
            $_data[$value['w_person_id']] = $value;
        }
        return $_data;
    }

    /*
     * 获取受理详情
     */
    public static function getSl($id){
        if($id=='' || !is_numeric($id)) return false;
        $data = self::find()->where(['w_p_id'=>$id,'w_s_status'=>'未受理'])->orderBy('w_id asc')->asArray()->all();
        $_data = array();
        foreach($data as $key=>$value){
            $_data[$value['w_person_id']] = $value;
        }
        return $_data;
    }
}
