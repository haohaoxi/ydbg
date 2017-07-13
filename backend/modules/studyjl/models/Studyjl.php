<?php

namespace backend\modules\studyjl\models;

use Yii;

/**
 * This is the model class for table "{{%study_jl}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $start_date
 * @property string $username
 * @property string $mechan
 * @property integer $result
 * @property string $pate_date
 * @property string $exam
 * @property string $duration
 * @property string $select
 */
class Studyjl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%study_jl}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'start_date', 'username', 'mechan', 'result', 'pate_date'], 'required'],
            [['start_date', 'pate_date','exam','duration','select'], 'safe'],
            [['result'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['username'], 'string', 'max' => 50],
            [['mechan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '考试名称',
            'start_date' => '考试开始时间',
            'username' => '人员名称',
            'mechan' => '所属机构',
            'result' => '考试结果',
            'pate_date' => '参加考试时间',
            'exam' => '是否考试',
        ];
    }
}
