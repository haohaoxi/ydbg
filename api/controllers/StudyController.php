<?php
namespace api\controllers;

use backend\modules\studyjl\models\Studyjl;
use backend\modules\xxjxgl\models\Xxjxgl;
use Yii;
use yii\rest\ActiveController;
use api\functionGlobal\FunctionRand;
use backend\modules\deptcontact\models\DeptContact;
use backend\modules\user\models\User;
use backend\modules\studytk\models\Studytk;
use backend\modules\studysj\models\Studysj;

/**
 * 学习进修 api
 */
class StudyController extends ActiveController
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

//    知识园地
    public function actionKnowledge($userid,$user_key)
    {
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        $xxjx = new Xxjxgl();
        $user = new User();
        $dept = new DeptContact();

        $page = !isset($_GET['page'])?1:(int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1)*$page_size;
        $count = $xxjx->find()->count();

        $xxjx_data = $xxjx->find()->limit($page_size)->offset($offset)->asArray()->all();
        foreach($xxjx_data as $k=> $value){
            $xxjx_data[$k]['content'] = htmlspecialchars($value['content']);
        }

        $data = $xxjx_data;
        foreach($xxjx_data as $key => $val){
            $id = $user->find()->select('department')->asArray()->where('name=:name',['name'=>$val['name']])->one();
            $dept_data = $dept->find()->select('dept_name')->where('id=:id',['id'=>$id['department']])->asArray()->one();
            $data[$key]['dept_name'] = $dept_data['dept_name'];
        }
        FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
    }

//    知识园地详情
    public function actionDetailsKnowledge($userid,$user_key,$id)
    {
        $id = (int)$id;
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        $user = new User();
        $dept = new DeptContact();
        if (isset($_POST['format'])) {

            $post = json_decode($_POST['format'],true);
            $model = $this->findStudytkModel($id);
            $model->attributes = FunctionRand::PostFormat($post);
            if (! $model->save()) {
                FunctionRand::Error(2, $model->getFirstErrors());
            }else{
                FunctionRand::View(1, 'success');
            }
        }
        $xxjx = new Xxjxgl();
        $xxjx_data = $xxjx->find()->where('id=:id',['id'=>$id])->asArray()->all();
        $data = $xxjx_data;
        foreach($xxjx_data as $key => $val){
            $uId = $user->find()->select('department')->asArray()->where('name=:name',['name'=>$val['name']])->one();
            $dept_data = $dept->find()->select('dept_name')->where('id=:id',['id'=>$uId['department']])->asArray()->one();
            $data[$key]['dept_name'] = $dept_data['dept_name'];
        }
        FunctionRand::View(1,'成功',$data);
    }

//    学习进修
    public function actionFurtherStudy($userid,$user_key)
    {
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        $sj = new Studysj();
        $jl = new Studyjl();

        $jl_data = $jl->find()->select(['name','exam'])->where('id=:id',['id'=>$userid])->asArray()->all();

        $page = !isset($_GET['page'])?1:(int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1)*$page_size;
        $count = $sj->find()->count();
        $sj_data = $sj->find()->select(['id','name','start_time','status','offen'])->limit($page_size)->offset($offset)->orderBy('start_time desc')->asArray()->all();

        foreach($sj_data as $key =>$val){
            $sj_data[$key]['exam'] = 0;
            foreach($jl_data as $k => $v){
                if($val['name'] == $v['name']){
                    $sj_data[$key]['exam'] = $v['exam'];
                }
            }
        }

        FunctionRand::Page(1, 'Success', $count, $page_size, $page, $sj_data);
    }

    //学习进修，开始开始考试
    public function actionStart($userid,$user_key,$id)
    {
        FunctionRand::UserAuth((int)$userid,$user_key);

        $sj = new Studysj();
        $data = $sj->find()->select(['name','standard','status','offen','questions'])->where('id=:id',['id'=>$id])->asArray()->all();
        FunctionRand::View(1,'成功',$data);
    }

//    点击所显示的题目
    public function actionSubject($userid,$user_key,$id)
    {
        FunctionRand::UserAuth((int)$userid,$user_key);

        $sj = new Studysj();
        $tk = new Studytk();
        $sj_data = $sj->find()->select(['questions','p_id'])->where('id=:id',['id'=>$id])->asArray()->one();

        $pid = explode(',',$sj_data['p_id']);

        foreach($pid as $key=> $val){
            $tk_data[] = $tk->find()->select(['id','name','tions'])->where('id=:id',['id' => $val])->asArray()->one();
        }

        foreach($tk_data as $k=> $value){
            $tk_data[$k]['tions'] = json_decode($value['tions'],true);
        }

        FunctionRand::View(1,'成功',$tk_data);
    }

    //结果
    public function actionResult($userid,$user_key,$id)
    {

        FunctionRand::UserAuth((int)$userid,$user_key);
        $jl = new Studyjl();

        $jl_data = $jl->find()->select(['name','result','duration'])->where('id=:id',['id'=>$id])->asArray()->one();

        $data['name'] = $jl_data['name'];

        $data['result'] = ($jl_data['result'] == 1 ? '通过':'不通过');

        $data['duration'] =$jl_data['duration'];

        FunctionRand::View(1,'成功',$data);
    }

    //查看答案
    public function actionLook($userid,$user_key,$id)
    {
        FunctionRand::UserAuth((int)$userid,$user_key);
        $sj = new Studysj();
        $tk = new Studytk();
        $jl = new Studyjl();
        $sj_data = $sj->find()->select(['name','user','p_id'])->where('id=:id',['id'=>$id])->asArray()->one();
        $jl_data = $jl->find()->select('select')->where(['name'=> $sj_data['name'],'username'=>$sj_data['user']])->asArray()->one();
        $select = json_decode($jl_data['select'],true);
        $pid = explode(",",$sj_data['p_id']);

        foreach($pid as  $val){
            $tk_data[] = $tk->find()->select(['name','tions','jiexi','daan','type'])->where('id=:id',['id' => $val])->asArray()->one();
        }
        foreach($tk_data as $key=> $value){
            $tk_data[$key]['select'] = isset($select[$key])?$select[$key]:'';
            $tk_data[$key]['tions'] = json_decode($value['tions'],true);
        }
        FunctionRand::View(1,'成功',$tk_data);
    }

//  交卷
    public function actionPaper($id)
    {
        $user = new User();
        $dept = new DeptContact();
        $model = new Studyjl();
        $sj = new Studysj();
        $tk = new Studytk();
        if(isset($_POST['format'])){
//            $_POST['format'] = [
//                'userid' => 1,
//                'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
//                'start_date' => '2016-05-31 11:11:11',
//                'pate_date'  => '2016-05-31 11:11:11',
//                'duration' => '00:12:12',
//                'test'=>[
//                    '1' => 'a',
//                    '2' => 'b',
//                    '3' => 'c',
//                    '4' => 'd',
//                    ]
//                ];
//            $_POST['format'] = json_encode($_POST['format']);


            $post = json_decode($_POST['format'],true);
            $post =  FunctionRand::PostFormat($post);
            $post['userid'] = (int)$post['userid'];
            $id = (int)$id;
            FunctionRand::UserAuth($post['userid'],$post['user_key']);
            $name = $user->find()->select(['name','department'])->where('id=:id',['id'=>$post['userid']])->asArray()->one();
            $deptname = $dept->find()->select('dept_name')->where('id=:id',['id'=>$name['department']])->asArray()->one();

            $sj_data = $sj->find()->select(['name','standard','p_id'])->where('id=:id',['id'=>$id])->asArray()->one();
            $pid = explode(',',$sj_data['p_id']);

            foreach($pid as $val){
                $tk_data = $tk->find()->select('daan')->where('id=:id',['id' => $val])->asArray()->one();
                $data[]  = $tk_data['daan'];
            }

            $scores = 0;
            $sum = count($data);

            foreach($data as $key => $val){
                $value = isset($post['test'][$key+1])?$post['test'][$key+1]:'';
        
                if($val == $value){
                    $scores++;
                }
            }

            $score = sprintf("%.2f", $scores/$sum) * 100;

            $a = (int)substr($sj_data['standard'],0,strlen($sj_data['standard'])-1);

            if($score>=$a){
                $result = 1;
            }else{
                $result = 0;
            }

            $all['result']     = $result;
            $all['name']       = $sj_data['name'];
            $all['start_date'] = $post['start_date'];
            $all['username']   =  $name['name'];
            $all['mechan']     = $deptname['dept_name'];
            $all['pate_date']  = $post['pate_date'];
            $all['exam']       = 1;
            $all['duration']   = $post['duration'];
            $all['select']     = json_encode($post['test']);

            if (! $model->save()) {
                FunctionRand::Error(2, $model->getFirstErrors());
            }else{
                FunctionRand::View(1, 'success');
            }
        }

    }

    public function findStudytkModel($id)
    {
        $modelClass = new Studytk();
        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            FunctionRand::View(0, NotFoundHttpException('The requested page does not exist.'));
        }
    }

    public function findStudyjlModel($id)
    {
        $modelClass = new Studyjl();
        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            FunctionRand::View(0, NotFoundHttpException('The requested page does not exist.'));
        }
    }
}