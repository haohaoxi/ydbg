<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use api\functionGlobal\FunctionRand;
use yii\db\mssql\PDO;

/**
 * 考勤管理 api
 */
class KaoqinController extends ActiveController
{
    public $modelClass = 'backend\modules\kaoqinquery\models\KaoqinDay';

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
    public function actionSearch($gonghao,$date,$userid,$user_key)
    {
        FunctionRand::UserAuth((int)$userid,$user_key);
        $connection = \Yii::$app->db;
        $data = $connection->createCommand('SELECT kq_time,weekday,shuaka_time1,shuaka_time2 FROM {{%kaoqin_day}} WHERE worker_no = :gonghao and kq_time like "'.$date.'%"');
        $data->bindParam(':gonghao', $gonghao, PDO::PARAM_STR);
        $data = $data->queryAll();
        if(!empty($data)){
            FunctionRand::View(1, 'Success', $data);
        }else{
            FunctionRand::Error(2, '参数无效或缺失');
        }

    }
}