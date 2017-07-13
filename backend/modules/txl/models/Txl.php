<?php

namespace backend\modules\txl\models;

use Yii;

/**
 * This is the model class for table "txl".
 *
 * @property integer $id
 * @property string $name
 * @property string $telephone
 * @property integer $pid
 */
class Txl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'txl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'telephone', 'pid'], 'required'],
            [['pid'], 'integer'],
            [['name', 'telephone'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'telephone' => 'Telephone',
            'pid' => 'Pid',
        ];
    }
}
