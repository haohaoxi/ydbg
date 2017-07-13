<?php

namespace backend\modules\studysj\models;

use Yii;

/**
 * This is the model class for table "{{%study_sj}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $mechanism
 * @property string $standard
 * @property string $start_time
 * @property string $end_time
 * @property integer $status
 * @property string $user
 * @property string $offen
 * @property integer $questions
 */
class Studysj extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%study_sj}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'mechanism', 'standard', 'start_time', 'end_time', 'status', 'user', 'questions','offen'], 'required'],
            ['name','unique','message' => 'name已经被占用！'],
            [['start_time', 'end_time','create_time','p_id'], 'safe'],
            [['status', 'questions','offen'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['mechanism'], 'string', 'max' => 255],
            [['standard'], 'string', 'max' => 20],
            [['user'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '试卷名称',
            'mechanism' => '考试机构',
            'standard' => '合格标准',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
            'status' => '状态',
            'user' => '出卷人',
            'offen' => '考试时长',
            'questions' => '考试题数',
            'p_id' => '题目id编号',
        ];
    }
}
