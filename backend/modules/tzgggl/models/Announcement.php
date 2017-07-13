<?php

namespace backend\modules\tzgggl\models;

use Yii;

/**
 * This is the model class for table "announcement".
 *
 * @property integer $id
 * @property string $title
 * @property string $pubdate
 * @property string $author
 * @property string $attachment
 * @property string $content
 */
class Announcement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'announcement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pubdate'], 'safe'],
            [['title'], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 40],
            [['attachment'], 'string', 'max' => 200],
            [['author'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '通告标题',
            'pubdate' => '发布时间',
            'author' => '发布人',
            'attachment' => '上传附件',
            'content' => '内容',
        ];
    }
}
