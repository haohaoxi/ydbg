<?php

namespace backend\modules\personwork\models;

use backend\modules\personworkworkflow\models\PersonWorkWorkflow;
use backend\modules\user\models\User;
use backend\modules\user\models\DeptContact;
use Yii;

/**
 * This is the model class for table "{{%person_work}}".
 *
 * @property integer $p_id
 * @property string $p_title
 * @property string $p_s_time
 * @property string $p_e_time
 * @property string $p_c_time
 * @property string $p_level
 * @property integer $p_fsq
 * @property string $p_y_slr
 * @property string $p_spr
 * @property string $p_details
 * @property string $p_cancel_detail
 * @property string $p_del
 */
class PersonWork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%person_work}}';
    }

    public function getPersonWorkWorkflow(){
        return $this->hasOne(PersonWorkWorkflow::className(),['w_p_id'=>'p_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['p_y_slr', 'checks','skipOnError' => false],
            ['p_spr', 'checks','skipOnError' => false],
            [['p_title', 'p_s_time', 'p_details','p_level'], 'required'],
            [['p_s_time', 'p_e_time'], 'safe'],
            [['p_level', 'p_details', 'p_cancel_detail'], 'string'],
            [['p_fsq','p_del'], 'integer'],
            [['p_title'], 'string', 'max' => 80],
            [['p_y_slr', 'p_spr'], 'string', 'max' => 250],
            [['p_y_slr_text'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p_id' => Yii::t('app', '序号'),
            'p_title' => Yii::t('app', '主题'),
            'p_s_time' => Yii::t('app', '工作开始时间'),
            'p_e_time' => Yii::t('app', '工作结束时间'),
            'p_c_time' => Yii::t('app', '创建时间'),
            'p_level' => Yii::t('app', '优先级'),
            'p_fsq' => Yii::t('app', '发起人'),
            'p_y_slr' => Yii::t('app', '原受理人'),
            'p_y_slr_text' => Yii::t('app', '原受理人'),
            'p_spr' => Yii::t('app', '审批人'),
            'p_details' => Yii::t('app', '详情'),
            'p_cancel_detail' => Yii::t('app', '退办原因'),
            'p_del' => Yii::t('app', '是否删除'),
        ];
    }



    public function beforeSave($insert = true)
    {
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                $this->p_c_time = date('Y-m-d H:i:s');
                $this->p_fsq = (isset(Yii::$app->user->identity->id) && Yii::$app->user->identity->id != '')? Yii::$app->user->identity->id:(int)$_POST['userid'];
                if($this->p_y_slr == ''){
                    $this->p_y_slr = (isset(Yii::$app->user->identity->id) && Yii::$app->user->identity->id != '')? Yii::$app->user->identity->id:(int)$_POST['userid'];
                }
                if($this->p_y_slr != ''){
                     $this->p_y_slr_text = implode(',',array_column(User::getNames($this->p_y_slr),'name'));
                }
            }
            return true;
        }else{
            return false;
        }
    }


    /*
     * 受理人和发起人必须其中一个验证方法
     * @param $attribute
     * @param $params
     */
    public function checks($attribute, $params){
        if($this->p_y_slr == '' && $this->p_spr == ''){
            $this->addError($attribute, '受理人和发起人必须填写其中一个。');
            return false;
        }
    }


    /*
     * 获取下一个人id
     * @param string $key 当前id
     * @param string $step 当前人定位key值
     * @param int $field 所在字段
     */
    public static function getNextPerson($id,$step='',$field){
        if($id=='' || $field == '') return false;
        if($data = self::find()->select($field)->where(['p_id'=>intval($id)])->asArray()->one()){
            $ids = explode(',',$data[$field]);
            if($step === '') return $ids[0]; //表示第一个id
            if(!isset($ids[($step+1)])) return -1; //表示已经是最后一个元素
            return $ids[($step+1)];
        }
        return false;
    }

    /*
     * 组织机构以及用户
     * @return array|bool
     */
    public static function getJigouUser($where=1){
        $conn=Yii::$app->db;
        $_data=array();
        $sql = 'select us.id,us.name,us.department,us.username,dp.dept_name from {{%user}} as us left join dept_contact as dp on us.department=dp.id where '.$where.' and us.status=10 and us.id != '.Yii::$app->user->identity->id.' order by us.department asc';
        $data = $conn->createCommand($sql)->queryAll();
        if(count($data) == 0 ) return false;
        foreach($data as $v){
            $_data[$v['dept_name']][$v['id']]=$v['name'];
        }
//        print_r($data);
        return $_data;
    }

    //获取考试机构
    public static function getDept(){
        $conn=Yii::$app->db;
        $sql = 'select dept_name from dept_contact';
        $data = $conn->createCommand($sql)->queryAll();
        $array = array();
        foreach($data as $key=>$vo){
            $array[] = $vo['dept_name'];
        }
        return $array;
    }

    /*
     * 获取信息
     * @param $id
     */
    public static function getPersonWorkInfo($id){
        if($id == '') return false;
        return self::find()->where(['p_id'=>$id])->asArray()->one();
    }

}
