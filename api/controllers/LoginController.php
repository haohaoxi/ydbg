<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use api\functionGlobal\FunctionRand;
use yii\db\mssql\PDO;
use backend\modules\gongchu\models\Gongchu;
use backend\modules\user\models\User;

/**
 * 用户登录 api
 */
class LoginController extends ActiveController
{
    public $modelClass = 'common\models\LoginForm';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items'
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['contentNegotiator']['formats']['application/xml']);
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        // 注销系统自带的实现方法
        unset($actions['index'], $actions['update'], $actions['create'], $actions['delete'], $actions['view']);
        return $actions;
    }
    //登录
    public function actionLogin()
    {
        /*$_POST['format'] = [
            'username' => 'admin',
            'password' => 'ZmptaC4qJH5jaGguYWRtaW44ODg=',
        ];
        $_POST['format'] = json_encode($_POST['format']);*/
        $post = json_decode($_POST['format'],1);
        $post['password'] = substr(base64_decode($post['password']),12);
        $_POST = [];
        $_POST['LoginForm'] = $post;
        if (!\Yii::$app->user->isGuest) {
            FunctionRand::View(100, '您已登录');
        }
        $model = new $this->modelClass();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $userinfo = \Yii::$app->user->identity;
            $user_key = md5($userinfo->id.'&%@kju;?'.$userinfo->auth_key);
            $dept_leader = Gongchu::getDeptLeader($userinfo->department); //科室负责人
            $branch_leader = Gongchu::getBranchLeader($userinfo->department); //分管负责人
            $deptname = Gongchu::getDeptNameById($userinfo->department); //所属机构
            $position_name = Gongchu::getPositionName($userinfo->position);
            $userData = ['id' => $userinfo->id, 'username' => $userinfo->username, 'name' =>$userinfo->name, 'email' =>$userinfo->email, 'telphone' =>$userinfo->telphone,'last_login_at' =>$userinfo->last_login_at, 'gonghao' =>$userinfo->gonghao, 'department' => $userinfo->department, 'position' => $userinfo->position,'position_name' => $userinfo->$position_name,  'dept_name' => $deptname,
                'status' =>$userinfo->status, 'user_key' =>$user_key, 'dept_id' => $dept_leader[0], 'dep_name' => $dept_leader[1], 'branch_id' => $branch_leader[0], 'branch_name' => $branch_leader[1]];
            FunctionRand::View(101, '登录成功',$userData);
        } else {
            FunctionRand::Error(102, '账户或密码有误');
        }
    }
    //修改密码
    public function actionUpdpass()
    {
        /*$_POST['format'] = [
            'userid' => 1,
            'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
            'oldpwd' => 'admin999',
            'password' => 'admin888',
            'rePwd' => 'admin888',
        ];
        $_POST['format'] = json_encode($_POST['format']);*/
        $post = json_decode($_POST['format'],true);
        $post = FunctionRand::PostFormat($post);
        $post['userid'] = (int)$post['userid'];
        FunctionRand::UserAuth($post['userid'],$post['user_key']);
        $model = User::findOne($post['userid']);
        if(!Yii::$app->getSecurity()->validatePassword($post['oldpwd'], $model->password_hash)) {
            FunctionRand::Error(2, '原始密码错误');
        }
        $model->scenario = 'updateApiPwd';
        $model->password = $post['password'];
        $model->oldpwd = $post['oldpwd'];
        $model->rePwd = $post['rePwd'];
        $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);//利用password_hash模式加密密码字符
        if($model->validate()){
            $model->save();
            FunctionRand::View(1, 'success');
        }else{
            FunctionRand::Error(2, $model->getFirstErrors());
        }exit;
    }
    //用户退出
    public function actionLogout($userid,$user_key)
    {
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        $model = User::findOne($userid);
        Yii::$app->user->logout();
        $model->last_login_at = time();
        if (! $model->save()) {
            FunctionRand::Error(2, $model->getFirstErrors());
        }else{
            FunctionRand::View(1, 'success');
        }
    }
}
