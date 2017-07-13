<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use api\functionGlobal\FunctionRand;
use backend\modules\deptcontact\models\DeptContact;
use backend\modules\peoplecontact\models\PeopleContact;
use backend\modules\txl\models\Txl;
use backend\modules\gongchu\models\Gongchu;

include_once(\Yii::getAlias('@webroot').'/hanzhuanpinyin_class.php');


/**
 * 通讯录 api
 */
class ContactController extends ActiveController
{
    public $modelClass = 'backend\modules\peoplecontact\models\PeopleContact';

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

    //输出部门和部门相对应的人员信息
    public function actionContact($userid,$user_key)
    {
        FunctionRand::UserAuth((int)$userid,$user_key);
        $dept = new DeptContact();
        $people = new PeopleContact();
        //部门信息
        $data_dept = $dept->find()->select(array('id','dept_name'))->asArray()->all();
        $data = $data_dept;
        foreach($data_dept as $key=> $val){
            $data_person = $people->find()->select(array('id','username','dept_id','position','telphone'))->where('dept_id=:dept_id',['dept_id'=>$val['id']])->asArray()->all();
            if($data_person){
                $data[$key]['person'] = $data_person;
            }
        }
        FunctionRand::View(1,'Success',$data);
    }

    //个人通讯录
    public function actionPerson($userid,$user_key)
    {
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        $pin = new \PinYin();
        $txl = new Txl();
//        $people = new PeopleContact();
        $data_person = $txl->find()->select(array('id','name','telephone'))->where('pid=:pid',['pid'=>$userid])->andFilterWhere(['delete'=> 2])->asArray()->all();
        $data = $data_person;
        foreach($data_person as $key=> $val){
            if(!is_numeric($val['name'][0])){
                $data[$key]['pin'] = strtoupper($pin->getFirstPY($val['name'])[0]);
            }else{
                $data[$key]['pin'] = $val['name'][0];
            }
        }
        foreach($data as $value){
            if(!is_numeric($value['pin'])){
                foreach(range('A','Z') as $v){
                    if($v == $value['pin']){
                        $all[$v][]=$value;
                    }
                }
            }else{
                $all['other'][] = $value;
            }

        }
        FunctionRand::View(1,'Success',$all);
    }

    //逻辑删除个人信息
    public function actionDel($userid,$user_key,$id)
    {
        FunctionRand::UserAuth((int)$userid,$user_key);
        $model=$this->findTxlModel($id);
        $model->setAttribute('delete',1);
        $model->save(false);
        FunctionRand::View(1, 'Success');

    }

    //查看编辑个人详情
    public function actionDetails($userid,$user_key,$id)
    {
        FunctionRand::UserAuth((int)$userid,$user_key);
        if(isset($_POST['format'])){
//            $_POST['format'] = [
//            'name' => 'ccc',
//            'telephone' => '12345678901',
//        ];
//        $_POST['format'] = json_encode($_POST['format']);
            $post = json_decode($_POST['format'], true);
            $post['pid'] = $userid;

            $model = $this->findTxlModel($id);
            $model->attributes = FunctionRand::PostFormat($post);
            if ($model->save()) {
                FunctionRand::View(1, 'success');
            } else {
                FunctionRand::Error(2, $model->getFirstErrors());
            }
        }
        $people = new Txl();
        $data_person = $people->find()->select(array('id','name','telephone'))->where('id=:id',['id'=>$id])->andFilterWhere(['delete'=>2])->asArray()->one();
        FunctionRand::View(1,'Success',$data_person);
    }

    //添加通讯录
    public function actionAdd()
    {
        if(isset($_POST['format'])) {
//        $_POST['format'] = [
//            'userid' => 1,
//            'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
//            'name' => 'bbb',
//            'telephone' => '12345678901',
//        ];
//        $_POST['format'] = json_encode($_POST['format']);
            $post = json_decode($_POST['format'], true);
            $post['userid'] = (int)$post['userid'];
            FunctionRand::UserAuth($post['userid'],$post['user_key']);
            $post['pid'] = $post['userid'];
            $model = new Txl();
            $model->attributes = FunctionRand::PostFormat($post);
            if ($model->save()) {
                FunctionRand::View(1, 'success');
            } else {
                FunctionRand::Error(2, $model->getFirstErrors());
            }
        }
    }

    //人员信息api
    public function actionPinfo($type = '',$userid,$user_key)
    {
        FunctionRand::UserAuth((int)$userid,$user_key);
        if($type == 'all'){
            $data = Gongchu::getDeptNames();
        }elseif($type == 'dept'){
            if(empty($_GET['menuid']) || !is_numeric($_GET['menuid'])){
                FunctionRand::Error(2, '无效的参数');
            }
            $data = Gongchu::getDeptAuditors((int)$_GET['menuid']);
        }
        $i = 0;
        foreach ($data as $key=>$val) {
            $datas[$i]['dept'] = $key;
            $j = 0;
            foreach($val as $k => $v){
                $datas[$i]['info'][$j]['id'] = $k;
                $datas[$i]['info'][$j]['name'] = $v;
                $j++;
            }
            $i++;
        }
        FunctionRand::View(1, 'success',$datas);
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

    protected function findTxlModel($id)
    {
        $modelClass = new Txl();
        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            FunctionRand::View(0, NotFoundHttpException('The requested page does not exist.'));
        }
    }
}