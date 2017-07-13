<?php

namespace backend\modules\welfareapply\models;

use Yii;

/**
 * This is the model class for table "{{%welfare_apply}}".
 *
 * @property integer $welfare_apply_id
 * @property integer $welfare_id
 * @property string $welfare_name
 * @property integer $welfare_apply_mee_id
 * @property integer $welfare_sp_id
 * @property string $welfare_apply_pack_status
 * @property string $welfare_apply_pack_cancel_detail
 * @property string $welfare_lq
 * @property string $welfare_sq_time
 * @property string $welfare_lq_time
 * @property string $welfare_department
 * @property string $welfare_apply_mee_name
 * @property string $welfare_sp_name
 */
class WelfareApply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%welfare_apply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['welfare_id', 'welfare_name', 'welfare_apply_mee_id', 'welfare_sp_id','welfare_sq_time','welfare_department','welfare_apply_mee_name','welfare_sp_name'], 'required'],
            [['welfare_id', 'welfare_apply_mee_id', 'welfare_sp_id'], 'integer'],
            [['welfare_apply_pack_status', 'welfare_apply_pack_cancel_detail', 'welfare_lq','welfare_lq_time','welfare_apply_pack_time'], 'string'],
            [['welfare_name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'welfare_apply_id' => Yii::t('app', 'Welfare Apply ID'),
            'welfare_id' => Yii::t('app', '关联id'),
            'welfare_name' => Yii::t('app', '福利名称'),
            'welfare_apply_mee_id' => Yii::t('app', '申请人账号ID'),
            'welfare_sp_id' => Yii::t('app', '审批人id'),
            'welfare_apply_pack_status' => Yii::t('app', '审批人状态，是否同意，默认为0，同意为1'),
            'welfare_apply_pack_cancel_detail' => Yii::t('app', '驳回详情'),
            'welfare_lq' => Yii::t('app', '是否领取'),
            'welfare_sq_time' => Yii::t('app', '申请时间'),
            'welfare_lq_time' => Yii::t('app', '领取时间'),
            'welfare_department' => Yii::t('app', '机构'),
            'welfare_apply_mee_name' => Yii::t('app', '申请人'),
            'welfare_sp_name' => Yii::t('app', '审批人'),
            'welfare_apply_pack_time' => Yii::t('app', '处理时间'),
        ];
    }

    /*
     * 是否有申请记录
     */
    public static function hasApply($id){
        return self::find()->where(['welfare_id'=>$id,'welfare_apply_mee_id'=>Yii::$app->user->identity->id])->asArray()->one();
    }
}
