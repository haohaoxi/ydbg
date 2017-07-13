<?php

namespace backend\modules\kaoqinquery\models;

use Yii;

/**
 * This is the model class for table "{{%kaoqin_day}}".
 *
 * @property integer $id
 * @property string $deptname
 * @property integer $worker_no
 * @property string $username
 * @property string $kq_time
 * @property string $weekday
 * @property string $shangban_type
 * @property string $shuaka_time1
 * @property string $shuaka_time2
 * @property double $yingkq_minutes
 * @property double $yingkq_hours
 * @property double $yingkq_days
 * @property double $shicq_hours
 * @property double $shicq_days
 * @property double $kg_minutes
 * @property double $qj_minutes
 * @property double $qj_hours
 */
class KaoqinDay extends \yii\db\ActiveRecord
{
    public $kq_endtime;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kaoqin_day}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['deptname', 'worker_no', 'username', 'kq_time', 'weekday', 'shangban_type', 'shuaka_time1', 'shuaka_time2', 'yingkq_minutes', 'yingkq_hours', 'yingkq_days', 'shicq_hours', 'shicq_days', 'kg_minutes', 'qj_minutes', 'qj_hours'], 'required'],
            [['kq_time','kq_endtime'], 'safe'],
            [['deptname', 'username'], 'string', 'max' => 50],
            [['shangban_type','yingkq_minutes', 'yingkq_hours', 'yingkq_days', 'shicq_hours', 'shicq_days', 'kg_minutes', 'qj_minutes', 'qj_hours','shuaka_time1', 'shuaka_time2'], 'string', 'max' => 20],
            [['weekday'], 'string', 'max' => 10]
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
            'username' => '姓名',
            'kq_time' => '考勤时间',
            'weekday' => '星期',
            'shangban_type' => '所上班制',
            'shuaka_time1' => '刷卡时1',
            'shuaka_time2' => '刷卡时2',
            'yingkq_minutes' => '应出勤分钟',
            'yingkq_hours' => '应出勤小时',
            'yingkq_days' => '应出勤天数',
            'shicq_hours' => '实出勤小时',
            'shicq_days' => '实出勤天数',
            'kg_minutes' => '旷工分钟',
            'qj_minutes' => '请假分钟',
            'qj_hours' => '请假小时',
        ];
    }
}
