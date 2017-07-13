<?php

namespace backend\modules\meeting\models;

use Yii;

/**
 * This is the model class for table "{{%meet_join}}".
 *
 * @property integer $id
 * @property integer $meetid
 * @property integer $join_ren
 * @property integer $type
 * @property integer $status
 */
class MeetJoin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%meet_join}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meetid', 'join_ren'], 'required'],
            [['meetid', 'join_ren', 'type', 'status'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'meetid' => 'Meetid',
            'join_ren' => 'Join Ren',
            'type' => 'Type',
            'status' => 'Status',
        ];
    }
}
