<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%charge_appeal_denounce}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property integer $is_anonymous
 * @property string $address
 * @property integer $card_type
 * @property string $card_number
 * @property string $apply_time
 * @property string $title
 * @property string $cases_number
 * @property string $content
 * @property string $reply_content
 * @property string $query_password
 * @property integer $status
 * @property integer $type
 */
class ChargeAppealDenounce extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%charge_appeal_denounce}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'address', 'apply_time', 'title', 'content', 'query_password', 'status', 'type'], 'required'],
            [['is_anonymous', 'card_type', 'status', 'type'], 'integer'],
            [['apply_time'], 'safe'],
            [['name', 'address', 'card_number', 'title', 'cases_number', 'query_password'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 15],
            [['content', 'reply_content'], 'string', 'max' => 100],
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
            'phone' => '联系方式',
            'is_anonymous' => 'Is Anonymous',
            'address' => '地址',
            'card_type' => '身份认证类型',
            'card_number' => '身份编码',
            'apply_time' => 'Apply Time',
            'title' => '标题',
            'cases_number' => '案件号',
            'content' => 'Content',
            'reply_content' => '回复内容',
            'query_password' => 'Query Password',
            'status' => '状态',
            'type' => '类型',
        ];
    }
}
