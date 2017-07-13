<?php

namespace backend\modules\vehicle\models;

use Yii;

/**
 * This is the model class for table "{{%vehicle_apply}}".
 *
 * @property integer $id
 * @property integer $vehicleid
 * @property integer $dept
 * @property string $v_user
 * @property string $driver
 * @property string $use_time
 * @property string $quxiang
 * @property string $reason
 * @property integer $dept_leader
 * @property integer $dept_audit
 * @property string $dept_audit_time
 * @property string $dept_reason
 * @property integer $branch_leader
 * @property integer $branch_audit
 * @property string $branch_audit_time
 * @property string $branch_reason
 * @property integer $apply_delete
 * @property integer $dept_delete
 * @property integer $branch_delete
 */
class VehicleApply extends \yii\db\ActiveRecord
{
    public $v_license;
    public $return_time;
    public $end_t;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vehicle_apply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vehicleid', 'dept', 'v_user', 'driver', 'use_time', 'quxiang', 'reason', 'dept_leader', 'branch_leader'], 'required'],
            [['vehicleid', 'dept_audit', 'branch_audit', 'apply_delete', 'dept_delete', 'branch_delete'], 'integer'],
            [['use_time', 'dept_audit_time', 'branch_audit_time'], 'safe'],
            [['reason'], 'string'],
            [['v_user', 'driver'], 'string', 'max' => 50],
            [['quxiang'], 'string', 'max' => 100],
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
            'vehicleid' => 'Vehicleid',
            'dept' => '科室',
            'v_user' => '用车人',
            'driver' => '驾驶员',
            'use_time' => '用车时间',
            'quxiang' => '去向',
            'reason' => '用车事由',
            'dept_leader' => '科室负责人',
            'dept_audit' => '科室审核',
            'dept_audit_time' => 'Dept Audit Time',
            'dept_reason' => 'Dept Reason',
            'branch_leader' => '分管领导',
            'branch_audit' => '状态',
            'branch_audit_time' => 'Branch Audit Time',
            'branch_reason' => 'Branch Reason',
            'apply_delete' => 'Apply Delete',
            'dept_delete' => 'Dept Delete',
            'branch_delete' => 'Branch Delete',
            'v_license'=>'车牌号',
            'return_time'=>'还车时间',
        ];
    }
}
