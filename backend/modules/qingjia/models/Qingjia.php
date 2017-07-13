<?php

namespace backend\modules\qingjia\models;

use Yii;

/**
 * This is the model class for table "{{%qingjia}}".
 *
 * @property integer $id
 * @property integer $qj_ren
 * @property string $apply_time
 * @property integer $dept
 * @property integer $position
 * @property integer $qj_type
 * @property string $qj_time
 * @property string $end_time
 * @property double $qj_day
 * @property string $qj_reason
 * @property integer $dept_leader
 * @property integer $dept_audit
 * @property string $dept_audit_time
 * @property string $dept_reason
 * @property integer $branch_leader
 * @property integer $branch_audit
 * @property string $branch_audit_time
 * @property string $branch_reason
 * @property integer $zzc
 * @property integer $zzc_audit
 * @property string $zzc_audit_time
 * @property string $zzc_reason
 * @property integer $jcz
 * @property integer $jcz_audit
 * @property string $jcz_audit_time
 * @property string $jcz_reason
 * @property integer $user_delete
 * @property integer $dept_delete
 * @property integer $branch_delete
 * @property integer $zzc_delete
 * @property integer $jcz_delete
 * @property integer $audit_status
 */
class Qingjia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%qingjia}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qj_ren', 'qj_type', 'qj_time', 'end_time', 'qj_day', 'qj_reason', 'dept_leader', 'branch_leader', 'zzc'], 'required'],
            [['qj_type', 'dept_audit', 'branch_audit', 'zzc_audit','jcz_audit', 'user_delete', 'dept_delete', 'branch_delete', 'zzc_delete', 'jcz_delete'], 'integer'],
            [['apply_time', 'qj_time', 'end_time', 'dept_audit_time', 'branch_audit_time', 'zzc_audit_time', 'jcz_audit_time'], 'safe'],
            [['qj_type'],'required','message'=>'请假类型不能为空'],
            [['qj_day'], 'number'],
            [['qj_reason'], 'string'],
            [['dept_reason', 'branch_reason', 'zzc_reason', 'jcz_reason'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'qj_ren' => '请(休)假人',
            'apply_time' => '申请时间',
            'dept' => '所属机构',
            'position' => '行政职务',
            'qj_type' => '请假类型',
            'qj_time' => '请假时间',
            'end_time' => '结束时间',
            'qj_day' => '请假时长(天)',
            'qj_reason' => '请假事由',
            'dept_leader' => '科室领导意见',
            'dept_audit' => 'Dept Audit',
            'dept_audit_time' => 'Dept Audit Time',
            'dept_reason' => 'Dept Reason',
            'branch_leader' => '分管领导意见',
            'branch_audit' => 'Branch Audit',
            'branch_audit_time' => 'Branch Audit Time',
            'branch_reason' => 'Branch Reason',
            'zzc' => '政治处意见',
            'zzc_audit' => '状态',
            'zzc_audit_time' => 'Zzc Audit Time',
            'zzc_reason' => 'Zzc Reason',
            'jcz' => '检察长意见',
            'jcz_audit' => 'Jcz Audit',
            'jcz_audit_time' => 'Jcz Audit Time',
            'jcz_reason' => 'Jcz Reason',
            'user_delete' => 'User Delete',
            'dept_delete' => 'Dept Delete',
            'branch_delete' => 'Branch Delete',
            'zzc_delete' => 'Zzc Delete',
            'jcz_delete' => 'Jcz Delete',
            'audit_status'=>'状态',
        ];
    }
}
