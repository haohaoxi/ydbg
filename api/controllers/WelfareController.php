<?php
namespace api\controllers;
use backend\modules\deptcontact\models\DeptContact;
use backend\modules\welfareapply\models\WelfareApply;
use Yii;
use yii\rest\ActiveController;
use backend\modules\welfare\models\Welfare;
use api\functionGlobal\FunctionRand;
use backend\modules\message\models\Message;
use backend\modules\gongchu\models\Gongchu;
use yii\db\mssql\PDO;
/**
 * Created by PhpStorm.
 * User: Jun
 * Date: 2016/5/26
 * Time: 13:55
 */

/*
 * 行政办公-福利申请api
 *
 */
class WelfareController extends ActiveController{

    public $modelClass = 'backend\modules\welfareapply\models\WelfareApply';
    public $modelClass1 = 'backend\modules\welfare\models\Welfare';
    public $userid;
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

    //显示所有的福利
    public function actionShow($userid,$user_key,$dept){
        if(empty($userid) || empty($user_key) || !is_numeric($dept)){//get
            FunctionRand::Error(2, '无效的参数');
        }
        FunctionRand::UserAuth($userid,$user_key);
        $page = !isset($_GET['page']) ? 1 : (int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1) * $page_size;
        $intuserid=((int)$dept);
        $welfare=new Welfare();
        $count=$welfare->find()->select('*')
            ->where('find_in_set('.$userid.',`welfare_part_id`)')
            ->andwhere(['welfare_is_del' => 1])
            ->count();
        $data = $welfare->find()->select('welfare.*')
            ->where('find_in_set('.$userid.',`welfare_part_id`)')
            ->andwhere(['welfare_is_del' => 1])
            ->limit($page_size)->offset($offset)
            ->asArray()
            ->all();
        $apply = new WelfareApply();
        foreach ($data as $key => $value) {
            $row = $apply::find()->where(['welfare_apply_mee_id' => $userid,'welfare_id' => $value['welfare_id']])->asArray()->one();
            if($row){
                $data[$key]['is_appley'] = $row['welfare_lq'] == '已领取'?1:2;
            }else{
                $data[$key]['is_appley'] = 0;
            }
        }
        FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
    }

    //查看
    public function actionView($id,$userid,$user_key)
    {
        if(empty($userid) || empty($user_key) || !is_numeric($id)){
            FunctionRand::Error(2, '参数无效或缺失');
        }
        FunctionRand::UserAuth($userid,$user_key);
        $modelClass = $this->modelClass;
        $data = $modelClass::find($id)->select('welfare_apply.*,welfare_type,welfare_part_name,welfare_detail,welfare_start_time,welfare_end_time')
            ->join('LEFT JOIN','welfare','welfare.welfare_id = welfare_apply.welfare_id' )
            ->asArray()->one();
        $data['deptname'] = Gongchu::getDeptNameById($data['welfare_department']);
        FunctionRand::View(1, 'Success',$data);

    }

    //我发起的、我审批的list
    public function actionList($userid,$user_key,$type)
    {

        if (!is_numeric($type)) {
            FunctionRand::Error(2, '参数无效或缺失');
        }
        FunctionRand::UserAuth($userid, $user_key);
        $page = !isset($_GET['page']) ? 1 : (int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1) * $page_size;
        $welfare=new WelfareApply();
        $query = $welfare->find();
        if ($type == 2) {//我审批的
            $query->where("welfare_sp_id = :welfare_sp_id and welfare_sp_id_is_del = 1",['welfare_sp_id' => $userid]);
            $count = $query;
            $count = $count->count();
            $data = $query->select(['welfare_apply_id','welfare_apply_mee_name','welfare_name','welfare_sq_time','welfare_apply_pack_status'])
                ->orderBy('welfare_sq_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        } elseif ($type==1){//我发起的
            $query->where("welfare_apply_mee_id = :welfare_apply_mee_id and welfare_sp_id_is_del = 1",['welfare_apply_mee_id' => $userid]);
            $count = $query;
            $count = $count->count();
            $data = $query->select(['welfare_apply_id','welfare_apply_mee_name','welfare_name','welfare_sq_time','welfare_apply_pack_status'])
                ->orderBy('welfare_sq_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        }
        FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
    }

    //删除申请
    public function actionDel($id,$type,$userid,$user_key)
    {
        if (!is_numeric($id)) {
            FunctionRand::Error(2, '参数无效或缺失');
        }
        FunctionRand::UserAuth($userid, $user_key);
        if($type=='spr'){
            $model=$this->findModel($id);
            $model->setAttribute('welfare_sp_id_is_del',0);
            $model->save(false);
        }elseif($type == 'sqr'){
            $model=$this->findModel($id);
            $model->setAttribute('welfare_apply_mee_id_is_del',0);
            $model->save(false);
        }
        FunctionRand::View(1, 'success');
    }

    //审批
    public function actionShenpi($id)
    {
        /*$_POST['format'] = [
            'userid' => 12,
            'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
            'audit' => '驳回',
            'reason' => '驳回原因',
        ];
        $_POST['format'] = json_encode($_POST['format']);*/
        $post = json_decode($_POST['format'],1);
        FunctionRand::UserAuth($post['userid'], $post['user_key']);
        $model = new $this->modelClass();
        $msg = WelfareApply::find()->select('welfare_apply_mee_id')->where(['welfare_apply_id'=>$id])->asArray()->one();
        if($post['audit'] == '同意'){
            $model::updateAll(['welfare_apply_pack_status'=>'同意','welfare_apply_pack_time'=>date('Y-m-d H:i:s',time())],['welfare_apply_id'=>$id]);
            Message::sendMsgApi('审批',gongchu::getUserNamesByIds($post['userid']).'同意了福利申请',$msg['welfare_apply_mee_id'],['welfare/welfare/view','id'=>$id,'api_url' => "index.php/welfare/view?id=". $id],$post['userid']);
        }elseif($post['audit'] == '驳回'){
            $model::updateAll(['welfare_apply_pack_status'=>'驳回','welfare_apply_pack_cancel_detail'=>$post['reason'],'welfare_apply_pack_time'=>date('Y-m-d H:i:s',time())],['welfare_apply_id'=>$id]);
            Message::sendMsgApi('审批',gongchu::getUserNamesByIds($post['userid']).'驳回了福利申请 驳回原因:'.$post['reason'],$msg['welfare_apply_mee_id'],['welfare/welfare/view','WelfareapplySearch[welfare_apply_id]'=>$id,'api_url' => "index.php/welfare/view?id=". $id],$post['userid']);
        }
        if($model->save(false)){
            FunctionRand::View(1, 'success');
        }else{
            FunctionRand::Error(2, 'false');
        }


    }

    //福利申请添加
    public function actionAdd(){

        $wel=new WelfareApply();//福利
        //var_dump($_POST);die;
        /*$_POST['format'] = [
        'userid' => 1,
        'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
        'welfare_name'=>'年假福利',//福利名称
        'welfare_id'=>1,//关联ID
        'welfare_apply_mee_id'=>1,//申请人账号ID
        'welfare_sp_id'=>1,//审批人id
        'welfare_department'=>1,//机构
        'welfare_apply_mee_name'=>'王东',//申请人账号
        'welfare_sp_name'=>'AA'//审批人
    ];
        $_POST['format'] = json_encode($_POST['format']);*/
        $post = json_decode($_POST['format'],true);
        $post = FunctionRand::PostFormat($post);
        if(empty($post['userid']) || empty($post['user_key'])){//get
            FunctionRand::Error(2, '无效的参数');
        }
        FunctionRand::UserAuth($post['userid'],$post['user_key']);

        $wel->attributes = $post;
        $wel->welfare_sq_time = date('Y-m-d H:i:s',time());
        if (! $wel->save()) {//数据库插入失败
            FunctionRand::Error(2, $wel->getFirstErrors());
        }else{//成功
            Message::sendMsgApi('审批',Gongchu::getUserNamesByIds($post['userid']).'的福利申请需要你审批',$wel->welfare_sp_id,['welfare/welfare/sp','id'=>$wel->welfare_apply_id,'api_url' => "index.php/welfare/view?id=". $wel->welfare_apply_id],$post['userid']);
            FunctionRand::View(1, 'success');
        }
    }


    //通过ID查看
    public function actionViews($id,$userid,$user_key)
    {
        if(empty($userid) || empty($user_key) || !is_numeric($id)){
            FunctionRand::Error(2, '参数无效或缺失');
        }
        FunctionRand::UserAuth($userid,$user_key);
        //$modelClass = $this->modelClass;
        /*$data = $modelClass::find($id)->select('welfare_apply.*,welfare_is_del,welfare_part_id,welfare_type,welfare_part_name,welfare_detail,welfare_start_time,welfare_end_time')
            ->join('LEFT JOIN','welfare','welfare.welfare_id = welfare_apply.welfare_id' )
            ->asArray()->one();*/
        $wel=new Welfare();
        $data = $wel::find($id)->select('welfare.*')
            ->asArray()->one();
        //var_dump($data);die;
        FunctionRand::View(1, 'Success',$data);
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

