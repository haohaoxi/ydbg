<?php

namespace backend\modules\xxjxgl\models;

use Yii;

/**
 * This is the model class for table "{{%xxjxgl}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $title_content
 * @property string $name
 * @property string $xx_date
 * @property string $content
 * @property string $fujian
 */
class Xxjxgl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%xxjxgl}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'name', 'xx_date'], 'required'],
            ['title','unique'],
            [['xx_date'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['title_content', 'content', 'fujian'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 50],
            ['fujian','file','extensions'=>['doc','pdf','txt','docx'],'maxSize'=>1024*1024*1024],
//            ['title_content', 'file', 'extensions' => ['doc', 'pdf', 'txt'], 'maxSize' => 1024*1024*1024],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '案件案例标题',
            'title_content' => '相关法律法规',
            'name' => '发布人',
            'xx_date' => '发布日期',
            'content' => '正文',
            'fujian' => '附件上传',
        ];
    }
}
