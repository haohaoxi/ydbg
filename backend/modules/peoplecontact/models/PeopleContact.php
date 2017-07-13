<?php

namespace backend\modules\peoplecontact\models;

use Yii;

/**
 * This is the model class for table "{{%people_contact}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $dept_id
 * @property int $position
 * @property string $telphone
 * @property int $wxone
 * @property int $wxtwo
 * @property int $inline
 * @property int $delete
 */
class PeopleContact extends \yii\db\ActiveRecord
{
    public  $file = '';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%people_contact}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wxone','wxtwo','inline','delete'],'safe'],

            [['username', 'dept_id', 'position', 'telphone'], 'required'],
            [['username'], 'string', 'max' => 30],
            [['dept_id'], 'integer'],
            [['position'], 'integer'],
            [['telphone'], 'string', 'max' => 11],

            [['username'],'match','pattern'=>'/^[a-zA-Z\x{4e00}-\x{9fa5}]{1,}$/u','message'=>'{attribute}必须为中文或英文'],
            [['telphone'],'match','pattern'=>'/^1[0-9]{10}$/','message'=>'{attribute}必须为1开头的11位纯数字'],
            [['wxone', 'wxtwo'],'match','pattern'=>'/^[\d]{8}$/','message'=>'{attribute}必须8位纯数字'],
            [['inline'],'match','pattern'=>'/^[\d]{4}$/','message'=>'{attribute}必须为4位数字'],

            ['username','unique', 'on' => ['import']]

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '序号'),
            'username' => Yii::t('app', '姓名'),
            'dept_id' => Yii::t('app', '所属机构'),
            'position' => Yii::t('app', '行政职务'),
            'telphone' => Yii::t('app', '手机号码'),
            'wxone' => Yii::t('app', '外线1'),
            'wxtwo' => Yii::t('app', '外线2'),
            'inline' => Yii::t('app', '内线'),
            'delete' => Yii::t('app', '删除'),
        ];
    }
         /*
       * 根据用户id获取机构id
       * @param $user_id
       */
    public static function getDeptId($id){
        $dept = self::findOne(['id'=>$id]);
        $dept_id = $dept['dept_id'];
        return $dept_id;
    }
    /*
    * 根据用户id获取职务id
    * @param $user_id
    */
    public static function getPositionId($id){
        $dept = self::findOne(['id'=>$id]);
        $posi_id = $dept['position'];
        return $posi_id;
    }
    /*
    * 根据机构ID得到机构名称
    */
    public static function getDeptName($id){
        $sql = "select dept_name from dept_contact where id ='{$id}'";
        $data = \yii::$app->db;
        $datas =$data->createCommand($sql)->queryAll();
        foreach($datas as $keys => $values){
            $name = $values['dept_name'];
            return $name;
        }
    }
    /*
    * 根据机构name得到机构ID
    */
    public static function getDept_Id($name){
        $sql = "select id from dept_contact where dept_name ='{$name}'";
        $data = \yii::$app->db;
        $datas =$data->createCommand($sql)->queryAll();
        foreach($datas as $keys => $values){
            $id = $values['id'];
            return $id;
        }
    }
}
