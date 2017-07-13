<?php

namespace backend\modules\officeapply\models;

use Yii;

/**
 * This is the model class for table "{{%office_apply}}".
 *
 * @property integer $apply_id
 * @property integer $apply_num
 * @property integer $apply_office_id
 * @property integer $apply_mee_id
 * @property string $apply_mee_text
 * @property integer $apply_mee_id_is_del
 * @property string $apply_sq_time
 * @property integer $apply_pack_id
 * @property integer $apply_pack_id_is_del
 * @property string $apply_pack_status
 * @property string $apply_pack_result
 * @property string $apply_pack_time
 * @property integer $apply_genneral_id
 * @property integer $apply_genneral_id_is_del
 * @property string $apply_genneral_status
 * @property string $apply_genneral_result
 * @property string $apply_genneral_time
 * @property string $apply_remarks
 * @property integer $apply_department
 * @property string $apply_lq_status
 * @property string $apply_lq_time
 */
class OfficeApply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%office_apply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apply_num', 'apply_office_id', 'apply_mee_id', 'apply_mee_text', 'apply_sq_time', 'apply_pack_id', 'apply_department','apply_money','apply_pack_text','apply_price','apply_office_name'], 'required'],
            [['apply_id', 'apply_num', 'apply_office_id', 'apply_mee_id', 'apply_mee_id_is_del', 'apply_pack_id', 'apply_pack_id_is_del', 'apply_genneral_id', 'apply_genneral_id_is_del', 'apply_department'], 'integer'],
            [['apply_sq_time', 'apply_pack_time', 'apply_genneral_time', 'apply_lq_time'], 'safe'],
            [['apply_pack_status', 'apply_genneral_status', 'apply_remarks', 'apply_lq_status','apply_genneral_text'], 'string'],
            [['apply_mee_text', 'apply_pack_result', 'apply_genneral_result'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'apply_id' => Yii::t('app', 'Apply ID'),
            'apply_num' => Yii::t('app', '需要申请办公用品数量'),
            'apply_office_id' => Yii::t('app', '办公用品ＩＤ'),
            'apply_mee_id' => Yii::t('app', '申请人账号ID'),
            'apply_mee_text' => Yii::t('app', '申请人'),
            'apply_mee_id_is_del' => Yii::t('app', '是否删除 1:否 0:是'),
            'apply_sq_time' => Yii::t('app', '申请时间'),
            'apply_pack_id' => Yii::t('app', '行装科负责人ID'),
            'apply_pack_id_is_del' => Yii::t('app', '是否删除 1:否 0:是'),
            'apply_pack_status' => Yii::t('app', '行装科审批状态'),
            'apply_pack_result' => Yii::t('app', '行装科意见'),
            'apply_pack_time' => Yii::t('app', '行装科处理时间'),
            'apply_genneral_id' => Yii::t('app', '检察长id'),
            'apply_genneral_id_is_del' => Yii::t('app', '是否删除 1:否 0:是'),
            'apply_genneral_status' => Yii::t('app', '检察长审批状态'),
            'apply_genneral_result' => Yii::t('app', '检察长意见'),
            'apply_genneral_time' => Yii::t('app', '检察长处理时间'),
            'apply_remarks' => Yii::t('app', '备注'),
            'apply_department' => Yii::t('app', '机构'),
            'apply_lq_status' => Yii::t('app', 'Apply Lq Status'),
            'apply_lq_time' => Yii::t('app', '领取时间'),
            'apply_money' => Yii::t('app', '金额'),
            'apply_pack_text' => Yii::t('app', '行装科负责人'),
            'apply_genneral_text' => Yii::t('app', '检察长'),
            'apply_price' => Yii::t('app', '单价'),
            'apply_office_name' => Yii::t('app', '办公用品名称'),
        ];
    }

    /*
 * 是否有申请记录
 */
    public static function hasApply($id){
        return self::find()->where(['apply_office_id'=>$id,'apply_mee_id'=>Yii::$app->user->identity->id])->asArray()->one();
    }



    public function beforeValidate()
    {
        if(parent::beforeValidate()){
            if($this->isNewRecord){
                $this->apply_department = Yii::$app->user->identity->department;
                $this->apply_mee_id = Yii::$app->user->identity->id;
                $this->apply_mee_text = Yii::$app->user->identity->username;
                $this->apply_sq_time = date('Y-m-d H:i:s');
                $this->apply_office_id = isset($this->apply_office_id) ? $this->apply_office_id : 0;
                $this->apply_cgsq = isset($this->apply_cgsq) ? $this->apply_cgsq : '否';
                if(Yii::$app->controller->action->id == 'cgtj'){
                    $this->apply_cgsq =  '是';
                }
            }
            return true;
        }else{
            return false;
        }
    }


    /*
     * 获取当前用户所在审核状态
     * @param $id
     * @param $user_id
     */
    public static function getDqStatus($id,$user_id){
        if($id== '' || $user_id == '') return false;
        $data = self::find()->select('apply_pack_id,apply_pack_status,apply_genneral_id,apply_genneral_status')->where(['apply_id'=>$id])->asArray()->one();
        $_data = array();
        foreach($data as $key=>$value){
            if(in_array($key,['apply_pack_id','apply_genneral_id'])){
                if($value == $user_id){
                    $sf = '';
                    $rs = $data[str_replace('_id','_status',$key)];
                    if($key == 'apply_pack_id'){
                        $sf = '行装科负责人';
                    }elseif($key == 'apply_genneral_id'){
                        $sf = '检察长';
                    }

                    $_data[] = ['rs'=>$rs,'sf'=>$sf,'field'=>$key];
                }
            }
        }

        if(count($_data) == 1) return $_data[0];

        foreach($_data as $key=>$value){
            if($value['rs'] == 0){
                return $value;
            }
        }
        return end($_data);
    }
}
