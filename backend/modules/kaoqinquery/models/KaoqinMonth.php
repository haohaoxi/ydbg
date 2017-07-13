<?php

namespace backend\modules\kaoqinquery\models;

use Yii;

/**
 * This is the model class for table "{{%kaoqin_month}}".
 *
 * @property integer $id
 * @property string $deptname
 * @property integer $worker_no
 * @property integer $card_no
 * @property string $username
 * @property string $kq_time
 * @property double $ycq_hours
 * @property double $ycq_days
 * @property double $scq_hours
 * @property double $scq_days
 * @property double $kg_hours
 * @property double $kg_days
 * @property double $total_workhours
 * @property double $total_workdays
 * @property integer $delay_times
 * @property integer $zt_times
 * @property double $delay_minutes
 * @property double $zt_minutes
 * @property double $shij_days
 * @property double $sick_days
 * @property double $tiaoxiu_days
 * @property double $gc_days
 * @property double $yxnj_days
 */
class KaoqinMonth extends \yii\db\ActiveRecord
{
    public $kq_endtime;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kaoqin_month}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['deptname', 'worker_no', 'card_no', 'username', 'kq_time', 'ycq_hours', 'ycq_days', 'scq_hours', 'scq_days', 'kg_hours', 'kg_days', 'total_workhours', 'total_workdays', 'delay_times', 'zt_times', 'delay_minutes', 'zt_minutes', 'shij_days', 'sick_days', 'tiaoxiu_days', 'gc_days', 'yxnj_days'], 'required'],
            [['kq_time'], 'safe'],
            [['delay_times', 'zt_times','ycq_hours', 'ycq_days', 'scq_hours', 'scq_days', 'kg_hours', 'kg_days', 'total_workhours', 'total_workdays', 'delay_minutes', 'zt_minutes', 'shij_days', 'sick_days', 'tiaoxiu_days', 'gc_days', 'yxnj_days'], 'string', 'max' => 20],
            [['deptname', 'username'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'deptname' => '部门',
            'worker_no' => '工号',
            'card_no' => '卡号',
            'username' => '姓名',
            'kq_time' => '考勤时间',
            'ycq_hours' => '应出勤小时',
            'ycq_days' => '应出勤天数',
            'scq_hours' => '实出勤小时',
            'scq_days' => '实出勤天数',
            'kg_hours' => '旷工小时',
            'kg_days' => '旷工天数',
            'total_workhours' => '总计工时小时',
            'total_workdays' => '总计工时天数',
            'delay_times' => '迟到次数',
            'zt_times' => '早退次数',
            'delay_minutes' => '迟到分钟',
            'zt_minutes' => '早退分钟',
            'shij_days' => '事假天数',
            'sick_days' => '病假天数',
            'tiaoxiu_days' => '调休天数',
            'gc_days' => '公出天数',
            'yxnj_days' => '已休年假天数',
        ];
    }
}
