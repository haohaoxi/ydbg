<?php

namespace backend\modules\chuchai\models;

use Yii;

/**
 * This is the model class for table "{{%chuchai}}".
 *
 * @property integer $id
 * @property integer $dept
 * @property string $cc_ren
 * @property integer $cc_count
 * @property string $apply_time
 * @property string $cc_date
 * @property string $end_date
 * @property string $cc_place
 * @property string $cc_task
 * @property string $cc_transporation
 * @property integer $dept_leader
 * @property integer $dept_audit
 * @property string $dept_audit_time
 * @property string $dept_reason
 * @property integer $branch_leader
 * @property integer $branch_audit
 * @property string $branch_audit_time
 * @property string $branch_reason
 * @property integer $chief
 * @property integer $chief_audit
 * @property string $chief_audit_time
 * @property string $chief_reason
 * @property integer $user_delete
 * @property integer $dept_delete
 * @property integer $branch_delete
 * @property integer $chief_delete
 */
class Chuchai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%chuchai}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dept', 'cc_ren', 'cc_count', 'apply_time', 'cc_date', 'end_date', 'cc_place', 'cc_task', 'cc_transporation', 'dept_leader','branch_leader', 'chief','dept_audit'], 'required'],
            [['cc_count', 'dept_audit', 'branch_audit', 'chief_audit', 'user_delete', 'dept_delete', 'branch_delete', 'chief_delete'], 'integer'],
            [['cc_ren', 'cc_task'], 'string'],
            [['apply_time', 'cc_date', 'end_date', 'dept_audit_time', 'branch_audit_time', 'chief_audit_time'], 'safe'],
            [['cc_place', 'chief_reason'], 'string', 'max' => 50],
            [['cc_transporation'], 'string', 'max' => 80],
            [['dept_reason', 'branch_reason'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dept' => '所属机构',
            'cc_ren' => '出差人员',
            'cc_count' => '出差人数',
            'apply_ren' =>'申请人',
            'apply_time' => '申请时间',
            'cc_date' => '出差时间',
            'end_date' => '结束时间',
            'cc_place' => '出差地点',
            'cc_task' => '出差任务',
            'cc_transporation' => '乘坐交通工具',
            'dept_leader' => '科室负责人意见',
            'dept_audit' => 'Dept Audit',
            'dept_audit_time' => 'Dept Audit Time',
            'dept_reason' => 'Dept Reason',
            'branch_leader' => '分管领导意见',
            'branch_audit' => 'Branch Audit',
            'branch_audit_time' => 'Branch Audit Time',
            'branch_reason' => 'Branch Reason',
            'chief' => '检察长审批',
            'chief_audit' => '状态',
            'chief_audit_time' => 'Chief Audit Time',
            'chief_reason' => 'Chief Reason',
            'user_delete' => 'User Delete',
            'dept_delete' => 'Dept Delete',
            'branch_delete' => 'Branch Delete',
            'chief_delete' => 'Chief Delete',
            'chuchairen'=>'出差人员',
        ];
    }
}
