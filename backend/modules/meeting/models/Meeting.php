<?php

namespace backend\modules\meeting\models;

use Yii;

/**
 * This is the model class for table "{{%meeting}}".
 *
 * @property integer $id
 * @property string $subject
 * @property string $start_time
 * @property string $end_time
 * @property string $place
 * @property string $agenda
 * @property string $arrangement
 * @property string $attachment
 * @property integer $initiator
 * @property string $initiate_time
 * @property integer $initiate_dept
 * @property integer $isdelete
 * @property string $join_rens
 */
class Meeting extends \yii\db\ActiveRecord
{
    public $join_ren;//参与人员
    public $hosts;//会议主持
    public $status;//状态
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%meeting}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'start_time', 'end_time', 'place', 'initiator', 'initiate_time', 'initiate_dept'], 'required'],
            [['start_time', 'end_time', 'initiate_time'], 'safe'],
            [['agenda', 'arrangement', 'attachment', 'join_rens'], 'string'],
            [['initiator', 'initiate_dept', 'isdelete'], 'integer'],
            [['subject'], 'string', 'max' => 100],
            [['place'], 'string', 'max' => 50],
            ['attachment','file','maxSize'=>10*1024*1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => '会议主题',
            'start_time' => '会议开始时间',
            'end_time' => '会议结束时间',
            'place' => '会议地点',
            'join_ren'=>'参加人员',
            'hosts'=>'会议主持',
            'status'=>'状态',
            'agenda' => '会议议程',
            'arrangement' => '会务安排',
            'attachment' => '附件',
            'initiator' => '发起人',
            'initiate_time' => '发起时间',
            'initiate_dept' => '科室',
            'join_rens'=>'参加人员',//显示中文名字
        ];
    }
}
