<?php

namespace backend\modules\deptcontact\models;

use Yii;

/**
 * This is the model class for table "{{%dept_contact}}".
 *
 * @property integer $id
 * @property string $dept_name
 * @property string $dept_type
 * @property integer $principal
 * @property integer $principal_text
 * @property integer $branch_leader
 * @property integer $branch_leader_text
 */
class DeptContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dept_contact}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dept_name', 'dept_type'], 'required'],
            ['dept_name','unique','message'=>'用户名已占用'],
            [['principal', 'branch_leader'], 'integer'],
            [['principal_text', 'branch_leader_text'], 'string', 'max' => 80],
            [['principal_text', 'branch_leader_text'], 'safe'],
            [['dept_name', 'dept_type'], 'string', 'max' => 80],
            [['dept_name'],'match','pattern'=>'/^[\x{4e00}-\x{9fa5}]{1,}$/u','message'=>'{attribute}必须填汉字'],
            [['dept_type'],'match','pattern'=>'/^[~！@#￥%……&*（）——+《》？：”、｛｝~!@#$%^&*()_+}{":?><\x{4e00}-\x{9fa5}]{1,}$/u','message'=>'{attribute}必须填汉字及符号'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'dept_name' => Yii::t('app', '机构名称'),
            'dept_type' => Yii::t('app', '机构类型'),
            'principal' => Yii::t('app', '负责人id'),
            'principal_text' => Yii::t('app', '负责人'),
            'branch_leader' => Yii::t('app', '分管领导id'),
            'branch_leader_text' => Yii::t('app', '分管领导'),
        ];
    }

    /*
     * 获取所有部门信息
     */
    public static function getDept(){
        return self::find()->select('id,dept_name')->asArray()->all();
    }

    /*
   * 获取所有单独信息
   */
    public static function getDeptOne($id=''){
        if($id == '') return false;
        $data =  self::find()->where(['id'=>$id])->select('id,dept_name')->asArray()->all();
        return $data[0];
    }
}
