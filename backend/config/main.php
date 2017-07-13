<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
return [
    'defaultRoute'=>'user/user/index',
    //'defaultRoute'=>'personwork/personwork/index',
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'language'=>'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'charset'=>'utf-8',
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            'class' => 'backend\modules\user\Module',
        ],
        'menu' => [
            'class' => 'backend\modules\menu\Module',
        ],
        'role' => [
            'class' => 'backend\modules\role\Module',
        ],
        'deptcontact' => [
            'class' => 'backend\modules\deptcontact\Module',
        ],
        'peoplecontact' => [
            'class' => 'backend\modules\peoplecontact\Module',
        ],
        'xxjxgl' => [
            'class' => 'backend\modules\xxjxgl\Module',
        ],
        'studytk' => [
            'class' => 'backend\modules\studytk\Module',
        ],
        'studysj' => [
            'class' => 'backend\modules\studysj\Module',
        ],
        'studyjl' => [
            'class' => 'backend\modules\studyjl\Module',
        ],
        'gongchu' => [
            'class' => 'backend\modules\gongchu\Module',
        ],
        'personwork' => [
            'class' => 'backend\modules\personwork\Module',
        ],
        'personworkworkflow' => [
            'class' => 'backend\modules\personworkworkflow\Module',
        ],
        'tzgggl' =>[
            'class' => 'backend\modules\tzgggl\Module',
        ],
        'news' =>[
            'class' => 'backend\modules\news\Module',
        ],
        'wages' => [
            'class' => 'backend\modules\wages\Module',
        ],
        'officesupplies'=>[
            'class'=>'backend\modules\officesupplies\Module'
        ],
        'studysj'=>[
            'class'=>'backend\modules\studysj\Module'
        ],
        'studytk'=>[
            'class'=>'backend\modules\studytk\Module'
        ],
        'chuchai' => [
            'class' => 'backend\modules\chuchai\Module',
        ],
        'travel' => [
            'class' => 'backend\modules\travel\Module',
        ],
        'office' => [
            'class' => 'backend\modules\office\Module',
        ],
        'officeapply' => [
            'class' => 'backend\modules\officeapply\Module',
        ],
		'kaoqinquery' => [
            'class' => 'backend\modules\kaoqinquery\Module',
        ],
        'welfare' => [
            'class' => 'backend\modules\welfare\Module',
        ],
        'welfareapply' => [
            'class' => 'backend\modules\welfareapply\Module',
        ],
        'meeting' => [
            'class' => 'backend\modules\meeting\Module',
		],
        'carwx' => [
            'class' => 'backend\modules\carwx\Module',
        ],
        'meet' => [
            'class' => 'backend\modules\meet\Module',
        ],
		'vehicle' => [
            'class' => 'backend\modules\vehicle\Module',
        ],
        'qingjia' => [
            'class' => 'backend\modules\qingjia\Module',
        ],
        'message' => [
            'class' => 'backend\modules\message\Module',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'on afterLogin' => function($event) {
                $user = $event->identity;
                $user->last_login_at = time();
                $user->last_login_ip = \Yii::$app->request->getUserIP();
                $user->save();
                //Yii::$app->user->identity->role_id 获取用户信息
            }
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
