<?php
if (strpos($_SERVER['REQUEST_URI'], 'login/login') !== false) {
    //如果是请求登录页面，则判断请求传来的Key是否正确，正确则正常调用接口，否则不给调用
    //defined('API_KEY') or define('API_KEY',  md5('minhao-chh'.date('Y|m|d').'RE*P%$E@^'));
    defined('API_KEY') or define('API_KEY',  md5('minhao-chh2016|05|19RE*P%$E@^'));
    if(!isset($_GET['key']) || $_GET['key'] !== API_KEY)
    {
        die(json_encode(['code' => 101,'msg' => 'Invalid API key']));
    }
}
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);
$application = new yii\web\Application($config);
$application->run();
