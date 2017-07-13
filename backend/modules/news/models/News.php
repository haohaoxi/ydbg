<?php

namespace backend\modules\news\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $pubdate
 * @property string $author
 * @property string $attachment
 * @property string $content
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
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
            'title' => '标题',
            'pubdate' => '时间',
            'author' => '发布人',
            'attachment' => '附件',
            'content' => '内容',
        ];
    }
}
