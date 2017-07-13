<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use api\functionGlobal\FunctionRand;

/**
 * 消息管理 api
 */
class MessageController extends ActiveController
{
    public $modelClass = 'backend\modules\message\models\Message';

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
    //所有消息数
    public function actionMessagenum($userid,$user_key)
    {
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        $modelClass = new $this->modelClass();
        $data['num'] = $modelClass::getMessageNumApi($userid);
        FunctionRand::View(1, 'success' ,$data);
    }
    //消息列表
    public function actionList($userid,$user_key)
    {
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        $modelClass = new $this->modelClass();
        $page = !isset($_GET['page'])?1:(int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1)*$page_size;
        $query = $modelClass->find();
        $count = $query->where('jsr = '.$userid)->count();
        $data = $query
            ->orderBy('is_reader asc,id desc')
            ->limit($page_size)->offset($offset)
            ->asArray()->all();
        foreach($data as $key => $value){
            $url = json_decode($value['url'],1);
            $data[$key]['link'] = $url['api_url'];
        }
        FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
    }
    /*
     * 设为已读
     * @param $id
     */
    public function actionYd($id,$userid,$user_key)
    {
        $id = (int)$id;
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        if($id == '') return false;
        $modelClass = new $this->modelClass();
        $modelClass::updateAll(['is_reader'=>'已读'],'id = '.$id);
        FunctionRand::View(1, 'Success');
    }
    //删除消息记录
    public function actionDel($id,$userid,$user_key)
    {
        $id = (int)$id;
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        $this->findModel($id)->delete();
        FunctionRand::View(1, 'Success');
    }
    protected function findModel($id)
    {
        $modelClass = $this->modelClass;
        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            FunctionRand::View(0, NotFoundHttpException('The requested page does not exist.'));
        }
    }
}