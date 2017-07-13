<?php

namespace backend\modules\user\models;

use backend\functions\functions;
use backend\modules\deptcontact\models\DeptContact;
use Yii;
use common\models\User as Users;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $oldpwd;
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{

    public $password;
    public $role_id;
    public $rePwd = '';
    public $oldpwd;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'required', 'on' => ['create']],
            ['username', 'filter', 'filter' => 'trim', 'on' => ['update', 'create']],
            ['username', 'required', 'on' => ['update', 'create']],
            ['username', 'unique', 'targetClass' => '\common\models\User','filter'=>['status'=>10], 'message' => '用户名已被占用', 'on' => ['create']],
            [['username'],'match','pattern'=>'/^[a-zA-z0-9]{4,20}$/','message'=>'必须为4-20位字母数字或组合', 'on' => ['create']],
            //[['username'],'match','pattern'=>'/[a-zA-z]{1,}/','message'=>'必须为4-20位字母数字组合', 'on' => ['create']],
            //[['username'],'match','pattern'=>'/[\d]{1,}/','message'=>'必须为4-20位字母数字组合', 'on' => ['create']],

            ['username', 'string', 'min' => 4, 'max' => 20, 'on' => ['update', 'create']],

            ['name', 'filter', 'filter' => 'trim', 'on' => ['update', 'create']],
            ['name', 'required', 'on' => ['update', 'create']],
            ['name', 'safe'],
            ['name', 'string', 'min' => 1, 'max' => 30, 'on' => ['update', 'create']],

            ['role_id', 'filter', 'filter' => 'intval', 'on' => ['update', 'create']],
            ['role_id', 'required', 'on' => ['update', 'create']],

            /* cuijun */
            ['password', 'required', 'on' => ['create','updatePwd']],
            [['password'],'match','pattern'=>'/^[a-zA-z0-9]{6,20}$/','message'=>'必须为6-20位字母数字组合', 'on' => ['create','updatePwd','updateTopPwd','updateApiPwd']],
            [['password'],'match','pattern'=>'/[a-zA-z]{1,}/','message'=>'必须为6-20位字母数字组合', 'on' => ['create','updatePwd','updateTopPwd','updateApiPwd']],
            [['password'],'match','pattern'=>'/[\d]{1,}/','message'=>'必须为6-20位字母数字组合', 'on' => ['create','updatePwd','updateTopPwd','updateApiPwd']],
            ['rePwd', 'compare', 'compareAttribute' => 'password', 'on' => ['updatePwd','create'], 'message' => '两次密码输入必须一致'],
           // [['password','rePwd'], 'string', 'min' => 6,  'max' => 20,'on' => ['updatePwd','create']],
            ['password_hash', 'required','message'=>'新密码不能为空', 'on' => ['updateTopPwd']],
            ['password_hash', 'string', 'min' => 6,  'max' => 20,'on' => ['updateTopPwd']],
            ['rePwd', 'compare', 'compareAttribute' => 'password_hash', 'on' => ['updateTopPwd'], 'message' => '两次密码输入必须一致'],
            ['rePwd', 'required', 'on' => ['updatePwd', 'create', 'updateTopPwd']],
            ['oldpwd', 'required', 'on' => ['updateTopPwd']],
            ['oldpwd', 'string', 'min' => 6, 'on' => ['updateTopPwd']],
            ['oldpwd', 'validatePassword', 'on' => ['updateTopPwd']],
            /* cuijun */


            /* wangxue */
            ['password', 'required','message'=>'新密码不能为空', 'on' => ['updateApiPwd']],
            ['password', 'string', 'min' => 6,  'max' => 20,'on' => ['updateApiPwd']],
            ['rePwd', 'compare', 'compareAttribute' => 'password', 'on' => ['updateApiPwd'], 'message' => '两次密码输入必须一致'],
            ['rePwd', 'required', 'on' => ['updateApiPwd']],
            ['oldpwd', 'required', 'on' => ['updateApiPwd']],
            ['oldpwd', 'string', 'min' => 6, 'on' => ['updateApiPwd']],
            /* wangxue */


            ['department','required', 'on' => ['update', 'create']],

            [['gonghao','number'],'required', 'on' => ['update', 'create']],
            [['gonghao'],'unique', 'on' => ['update', 'create'],'message' => '此工号已被占用'],
            [['number'],'unique', 'on' => ['update', 'create'],'message' => '此编号已被占用'],

           // ['number', 'string', 'min' => 1,  'max' => 3,'on' => ['update', 'create']],
          //  ['gonghao', 'string', 'min' => 5,  'max' => 5,'on' => ['update', 'create']],
            [['number'],'match','pattern'=>'/^[0-9]{1,3}$/','message'=>'必须为1-3位数字', 'on' => ['update', 'create']],
            [['gonghao'],'match','pattern'=>'/^[0-9]{5,5}$/','message'=>'必须为5位数字', 'on' => ['update', 'create']],

            [['telphone'],'required','message'=>'{attribute}不能为空','on' => ['update', 'create']],
            [['telphone'], 'unique','message'=>'{attribute}已经被占用了','on' => ['update', 'create']],
            [['telphone'],'match','pattern'=>'/^1[0-9]{10}$/','message'=>'{attribute}格式不正确','on' => ['update', 'create']],
            [['position'],'required','message'=>'{attribute}不能为空','on' => ['update', 'create']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '序号'),
            'username' => Yii::t('app', '账号'),
            'name' => Yii::t('app', '姓名'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password' => Yii::t('app', '密码'),
            'oldpwd'=>Yii::t('app', '旧密码'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', '邮箱'),
            'status' => Yii::t('app', '状态'),
            'created_at' => Yii::t('app', '添加时间'),
            'updated_at' => Yii::t('app', '修改时间'),
            'rePwd' => Yii::t('app', '确认密码'),
            'role_id' => Yii::t('app', '所属角色'),
            'department' => Yii::t('app', '所属机构'),
            'gonghao' => Yii::t('app', '工号'),
            'number' => Yii::t('app', '人员编号'),
            'position'=>Yii::t('app', '行政职务'),
            'telphone'=>Yii::t('app', '手机号码'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new Users();
            print_r($user);die;
            $user->username = $this->username;
            $user->name = $this->name;
            $user->department = $this->department;
            $user->gonghao = $this->gonghao;
            $user->number = $this->number;
            $user->telphone=$this->telphone;//手机号
            $user->position=$this->position;//职务
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }
        return null;
    }


    public function beforeSave($insert = true)
    {
        if (!$this->isNewRecord) {
            $this->updated_at = time();
        }
        return true;
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if(!Yii::$app->security->validatePassword($this->oldpwd, Yii::$app->user->identity->password_hash)){
            $this->addError($attribute, "旧密码错误.");
            return false;
        }
        return true;
    }

    /*
     * 根据id获取用户
     */
    public static function getNames($ids){
        if($ids == '') return false;
        $data = self::find()->select('name')->where('id in ('.$ids.')')->asArray()->all();
        if(!isset($data[0]['name'])) return array(array('name'=>'位置人员'));
        return $data;
    }



}
