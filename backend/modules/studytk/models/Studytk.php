<?php

namespace backend\modules\studytk\models;

use Yii;

/**
 * This is the model class for table "{{%study_tk}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $users
 * @property string $time
 * @property string $tions
 * @property string $daan
 * @property string $jiexi
 * @property string $type
 */
class Studytk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%study_tk}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'users', 'time', 'tions', 'daan', 'jiexi'], 'required'],
            [['name', ], 'unique'],
            [['time'], 'safe'],
            [['jiexi'], 'string','max'=>1000],
            [['tions'], 'string','max'=>5000],
            [['name',], 'string', 'max' => 255],
            [['users'], 'string', 'max' => 50],
            [[ 'daan'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '题目名',
            'users' => '录入人',
            'time' => '录入日期',
            'tions' => '选项',
            'daan' => '答案',
            'jiexi' => '解析',
            'type' => '题型',
        ];
    }
}
