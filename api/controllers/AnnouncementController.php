<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use api\functionGlobal\FunctionRand;
use backend\modules\news\models\News;
use backend\modules\tzgggl\models\Announcement;
use backend\modules\deptcontact\models\DeptContact;
use backend\modules\user\models\User;
/**
 * 通知公告，院内新闻 api
 */
class AnnouncementController extends ActiveController
{
    public $modelClass = 'common\models\User';

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

//  通知公告
    public function actionAnnouncement($userid,$user_key)
    {
        FunctionRand::UserAuth((int)$userid,$user_key);
        $announcement = new Announcement();
        $user = new User();
        $dept = new DeptContact();

        $page = !isset($_GET['page']) ? 1:(int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1)*$page_size;
        $count = $announcement->find()->count();
        $announce_data = $announcement->find()->limit($page_size)->offset($offset)->asArray()->all();

        foreach($announce_data as $k => $value){
            $announce_data[$k]['content'] = htmlspecialchars($value['content']);
        }

        $data = $announce_data;

        foreach($announce_data as $key=> $val){
            $id = $user->find()->select('department')->asArray()->where('name=:name',['name'=>$val['author']])->one();
            $dept_data = $dept->find()->select('dept_name')->where('id=:id',['id'=>$id['department']])->asArray()->one();
            $data[$key]['dept_name'] = $dept_data['dept_name'];
        }
        FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
    }


    //通知公告详情
    public function actionDetailsAnnouncement($userid,$user_key,$id)
    {
        $userid = (int)$userid;
        $id = (int)$id;
        FunctionRand::UserAuth($userid, $user_key);
        $user = new User();
        $dept = new DeptContact();
        if (isset($_POST['format'])) {

//            $_POST['format'] = [
//                'title' => 'aaaa',
//                'content' => '11111111111',
//                'attachment' => 'www.baidu.com',
//            ];
//            $_POST['format'] = json_encode($_POST['format']);

            $post = json_decode($_POST['format'],true);
            $model = $this->findAnnouncementModel($userid);
            $model->attributes = FunctionRand::PostFormat($post);
            if (! $model->save()) {
                FunctionRand::Error(2, $model->getFirstErrors());
            }else{
                FunctionRand::View(1, 'success');
            }
        }
        $announcement = new Announcement();
        $announcement_data = $announcement->find()->where('id=:id',['id'=>$id])->asArray()->all();
        foreach($announcement_data as $k => $value){
            $announcement_data[$k]['content'] = htmlspecialchars($value['content']);
        }
        $data = $announcement_data;
        foreach($announcement_data as $key => $val){
            $uId = $user->find()->select('department')->asArray()->where('name=:name',['name'=>$val['author']])->one();
            $dept_data = $dept->find()->select('dept_name')->where('id=:id',['id'=>$uId['department']])->asArray()->one();
            $data[$key]['dept_name'] = $dept_data['dept_name'];
        }
        FunctionRand::View(1,'成功',$data);

    }



//  院内新闻
    public function actionNews($userid,$user_key)
    {
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);

        $new = new News();
        $user = new User();
        $dept = new DeptContact();

        $page = !isset($_GET['page'])?1:(int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1)*$page_size;
        $count = $new->find()->count();

        $news_data = $new->find()->limit($page_size)->offset($offset)->asArray()->all();
        foreach($news_data as $k => $value){
            $news_data[$k]['content'] = htmlspecialchars($value['content']);
        }
        $data = $news_data;

        foreach($news_data as $key => $val){
            $id = $user->find()->select('department')->asArray()->where('name=:name',['name'=>$val['author']])->one();
            $dept_data = $dept->find()->select('dept_name')->where('id=:id',['id'=>$id['department']])->asArray()->one();
            $data[$key]['dept_name'] = $dept_data['dept_name'];
        }

        FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
    }



    //院内新闻详情
    public function actionDetailsNews($userid,$user_key,$id)
    {
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        $user = new User();
        $dept = new DeptContact();
        if(isset($_POST['format'])){

//            $_POST['format'] = [
//                'title' => 'aaaa',
//                'content' => '11111111111',
//                'attachment' => 'www.baidu.com',
//            ];
//            $_POST['format'] = json_encode($_POST['format']);

            $post = json_decode($_POST['format'],true);
            $model = $this->findNewsModel($userid);
            $model->attributes = FunctionRand::PostFormat($post);
            if (! $model->save()) {
                FunctionRand::Error(2, $model->getFirstErrors());
            }else{
                FunctionRand::View(1, 'success');
            }
        }

        $news = new News();
        $news_data = $news->find()->where('id=:id',['id'=>$id])->asArray()->all();

        foreach($news_data as $k => $value){
            $news_data[$k]['content'] = htmlspecialchars($value['content']);
        }
        $data = $news_data;
        foreach($news_data as $key => $val){
            $uId = $user->find()->select('department')->asArray()->where('name=:name',['name'=>$val['author']])->one();
            $dept_data = $dept->find()->select('dept_name')->where('id=:id',['id'=>$uId['department']])->asArray()->one();
            $data[$key]['dept_name'] = $dept_data['dept_name'];
        }
        FunctionRand::View(1,'成功',$data);
    }

    protected function findNewsModel($id)
    {
        $modelClass = new News();
        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            FunctionRand::View(0, NotFoundHttpException('The requested page does not exist.'));
        }
    }

    protected function findAnnouncementModel($id)
    {
        $modelClass = new Announcement();
        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            FunctionRand::View(0, NotFoundHttpException('The requested page does not exist.'));
        }
    }

}