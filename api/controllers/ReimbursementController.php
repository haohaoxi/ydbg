<?php
namespace api\controllers;
use backend\modules\carwx\models\Carwx;
use Yii;
use backend\modules\travel\models\Travel;
use backend\modules\meet\models\Meet;
use yii\rest\ActiveController;
use api\functionGlobal\FunctionRand;
use backend\modules\message\models\Message;
use backend\modules\gongchu\models\Gongchu;
use yii\db\mssql\PDO;
/**
 * Created by PhpStorm.
 * User: Jun
 * Date: 2016/5/26
 * Time: 13:57
 */

/*
 * 行政办公-报销申请api
 *
 */
class ReimbursementController extends ActiveController{

    public $modelClass = 'backend\modules\travel\models\Travel';
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
    //查看
    public function actionView($id,$userid,$user_key,$type)
    {
        $id = (int)$id;
        $type = (int)$type;
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        $connection = \Yii::$app->db;
        if($type == 1){//机动车
            $data = $connection->createCommand('SELECT * FROM {{%carwx}} WHERE id = :id');
        }elseif($type == 2){//会议费
            $data = $connection->createCommand('SELECT * FROM {{%meet}} WHERE id = :id');
        }elseif($type == 3){//差旅费报销
            $data = $connection->createCommand('SELECT * FROM {{%travel}} WHERE id = :id');
        }
        $data->bindParam(':id', $id, PDO::PARAM_STR);
        $data = $data->queryOne();
        $data['deptname'] = Gongchu::getDeptNameById($data['department']);
        if(!empty($data)){
            FunctionRand::View(1, 'Success', $data);
        }else{
            FunctionRand::Error(2, '参数无效或缺失');
        }
    }

//报销申请
    public function actionShow($reimburse_type){
        if($reimburse_type==1){//
            $travel=new Travel();//实例化差旅表
            /*$_POST['format'] = [
                'userid' => 1,
                'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
            'department' => 1,//报销单位
            'bxr'=>'王东',//报销人
            's_time' => '2016-05-26',//开始
            'e_time' => '2016-05-29',//结束
            'dd' => '南京',//地点
            'sy' => '事由事由事由事由事由事由',//事由
            'ccf_zs' => '2',//车船费（张数）
            'ccf_je' => '500',//车船费（金额）
            'zsf_zs' => '2',//住宿费（张数）
            'zsf_je' => '500',//住宿费（金额）
            'hsbt_zs' => '1',//伙食补贴（张数）
            'hsbt_je' =>'33' ,//伙食补贴（金额）
            'gzf' => '121',//公杂费
            'gj' => '832',//合计
            'zmr'=>'王菲',//证明人
            'glkj'=>1,//管理会计ID
            'glkj_text' => '张超',//管理会计
            'ldsp_text'=>'张领导',//领导审批
            'ldsp'=>1,//领导审批
            'zmr_text'=>'我是证明人，证明人证明人证明人证明人',//证明人
            'zmr'=>1,//证明人
            'bxr'=>1,//报销人
        ];
            $_POST['format'] = json_encode($_POST['format']);*/
            $post = json_decode($_POST['format'],true);
            $_POST['bxr'] = $post['bxr'];
            $post = FunctionRand::PostFormat($post);
            $post['userid'] = (int)$post['userid'];
            FunctionRand::UserAuth($post['userid'],$post['user_key']);
            $travel->attributes = $post;
            if (! $travel->save()) {//失败
                FunctionRand::Error(2, $travel->getFirstErrors());
            }else{//成功
                Message::sendMsgApi('审批',Gongchu::getUserNamesByIds($post['userid']).'的差旅费报销需要您审批',$travel->zmr,['travel/travel/shenpi','id'=>$travel->id,'api_url' => "index.php/reimbursement/view?id=". $travel->id ."&type=3"],$post['userid']);
                FunctionRand::View(1, 'success');
            }
        }elseif ($reimburse_type==2){//机动车维修费
            $carwx=new Carwx();
            /*$_POST['format'] = [
                'userid' => 1,
                'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
                'department' =>'1',//单位
                'wx_time' => '2016-05-26',//维修申请时间
                'cph' => '苏A999999',//车牌
                'wxnr' => '首保',//保养项目
                'jine' => '22',//金额
                'remark' => '啊啊啊啊啊啊啊啊啊',//备注
                'bxr' => '3',//报销人ID
                'bxr_text'=>'张超',//报销人
                'zmr'=>1,//证明人
                'zmr_text'=>'我是证明人，证明人证明人证明人证明人',
                'glkj'=>1,
                'glkj_text'=>'DSFSDFSDF',
                'ldsp'=>1,
                'ldsp_text'=>'领导审批'
            ];
            $_POST['format'] = json_encode($_POST['format']);*/
            $post = json_decode($_POST['format'],true);
            $post = FunctionRand::PostFormat($post);
            $post['userid'] = (int)$post['userid'];
            FunctionRand::UserAuth($post['userid'],$post['user_key']);
            $_POST['bxr'] = $post['bxr'];
            $carwx->attributes = $post;
            if (! $carwx->save()) {//失败
                FunctionRand::Error(2, $carwx->getFirstErrors());
            }else{//成功
                Message::sendMsgApi('审批',Gongchu::getUserNamesByIds($post['userid']).'的机动车报销需要您审批',$carwx->zmr,['carwx/carwx/shenpi','id'=>$carwx->id,'api_url' => "index.php/reimbursement/view?id=". $carwx->id ."&type=1"],$post['userid']);
                FunctionRand::View(1, 'success');
            }
        }else{//会议费申请
            $meet=new Meet();
            /*$_POST['format'] = [
                'userid' => 1,
                'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
                'name' =>'北京人民大会堂',//会议名称
                'kh_time' => '2016-05-26',//报销申请时间
                'wddbs' => '1',//外地代表数/人
                'bddbs' => '2',//本地代表数/人
                'gzrys' => '2',//工作人员数/人
                'chrys' => '2',//参会人员数/人
                'hq' => '7',//会期（含报到和离开时间）/天
                'hyzf' => '200',//会议资费
                'zsf' => '500',//住宿费
                'hsf' => '1000',//伙食费
                'hyszj' =>'800' ,//会议室租金
                'jtf' => '121',//交通费
                'wjysf' => '832',//文件印刷费
                'qtzc'=>'11',//其他支出
                'sjkz'=>'1222',//实际开支
                'bxr' => '3',//报销人ID
                'bxr_text'=>'张超',//报销人
                'zmr'=>1,//证明人
                'zmr_text'=>'我是证明人，证明人证明人证明人证明人',
                'glkj'=>1,
                'glkj_text'=>'DSFSDFSDF',
                'ldsp'=>1,
                'ldsp_text'=>'领导审批'
            ];
            $_POST['format'] = json_encode($_POST['format']);*/
            $post = json_decode($_POST['format'],true);
            $post = FunctionRand::PostFormat($post);
            $post['userid'] = (int)$post['userid'];
            FunctionRand::UserAuth($post['userid'],$post['user_key']);
            $_POST['bxr'] = $post['bxr'];
            $meet->attributes = $post;
            if (! $meet->save()) {//失败
                FunctionRand::Error(2, $meet->getFirstErrors());
            }else{//成功
                Message::sendMsgApi('审批',Gongchu::getUserNamesByIds($post['userid']).'的会议报销需要您审批',$meet->zmr,['meet/meet/shenpi','id'=>$meet->id,'api_url' => "index.php/reimbursement/view?id=". $meet->id ."&type=2"],$post['userid']);
                FunctionRand::View(1, 'success');

            }
        }
    }

    //我发起的、我审批的list
    public function actionList($userid,$user_key,$reimburse_type,$type)
    {
        $userid = (int)$userid;
        $type = (int)$type;
        $reimburse_type = (int)$reimburse_type;
        FunctionRand::UserAuth($userid, $user_key);
        $page = !isset($_GET['page']) ? 1 : (int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1) * $page_size;
        $car = new Carwx();//机动车
        $meet = new Meet();//会议
        $travel = new Travel();//差游
        $car = $car->find();
        $meet = $meet->find();
        $travel = $travel->find();
        if($reimburse_type==1){//机动车维修费报销
            if ($type == 1){//我发起的
                $car->where("bxr = :bxr and bxr_del = 1",['bxr' => $userid]);
                $count = $car;
                $count = $count->count();
                $data = $car->select(['id','time','bxr_text','zmr_rs','glkj_rs','ldsp_rs'])
                    ->orderBy('time desc')
                    ->limit($page_size)->offset($offset)
                    ->asArray()->all();
            }else{//我审批的
                $car->where('(zmr=:dept_leader and zmr_del=:dept_del)
                    or (glkj=:dept_leader and glkj_del=:dept_del and zmr_rs=:dept_audit)
                    or (ldsp=:dept_leader and ldsp_del=:dept_del and ldsp_rs=:dept_audit and glkj_rs=:dept_audit)',
                    [':dept_leader'=>$userid,':dept_del'=>1,':dept_audit'=>1,]);
                $count = $car;
                $count = $count->count();
                $data = $car->select(['id','time','bxr_text','zmr_rs','glkj_rs','ldsp_rs'])
                    ->orderBy('time desc')
                    ->limit($page_size)->offset($offset)
                    ->asArray()->all();
            }
            FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
        }elseif ($reimburse_type==2){//会议费
            if ($type == 1){//我发起的
                $meet->where("bxr = :bxr and bxr_del = 1",['bxr' => $userid]);
                $count = $meet;
                $count = $count->count();
                $data = $meet->select(['id','time','bxr_text','zmr_rs','glkj_rs','ldsp_rs'])
                    ->orderBy('time desc')
                    ->limit($page_size)->offset($offset)
                    ->asArray()->all();
            }else{//我审批的
                $meet->where('(zmr=:dept_leader and zmr_del=:dept_del)
                    or (glkj=:dept_leader and glkj_del=:dept_del and zmr_rs=:dept_audit)
                    or (ldsp=:dept_leader and ldsp_del=:dept_del and ldsp_rs=:dept_audit and glkj_rs=:dept_audit)',
                    [':dept_leader'=>$userid,':dept_del'=>1,':dept_audit'=>1,]);
                $count = $meet;
                $count = $count->count();
                $data = $meet->select(['id','time','bxr_text','zmr_rs','glkj_rs','ldsp_rs'])
                    ->orderBy('time desc')
                    ->limit($page_size)->offset($offset)
                    ->asArray()->all();
            }
            FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);

        }else if($reimburse_type==3){//差旅费报销
            if ($type == 1){//我发起的
                $travel->where("bxr = :bxr and bxr_del = 1",['bxr' => $userid]);
                $count = $travel;
                $count = $count->count();
                $data = $travel->select(['id','time','bxr_text','zmr_rs','glkj_rs','ldsp_rs'])
                    ->orderBy('time desc')
                    ->limit($page_size)->offset($offset)
                    ->asArray()->all();
            }else{//我审批的
                $travel->where('(zmr=:dept_leader and zmr_del=:dept_del)
                    or (glkj=:dept_leader and glkj_del=:dept_del and zmr_rs=:dept_audit)
                    or (ldsp=:dept_leader and ldsp_del=:dept_del and ldsp_rs=:dept_audit and glkj_rs=:dept_audit)',
                    [':dept_leader'=>$userid,':dept_del'=>1,':dept_audit'=>1,]);
                $count = $travel;
                $count = $count->count();
                $data = $travel->select(['id','time','bxr_text','zmr_rs','glkj_rs','ldsp_rs'])
                    ->orderBy('time desc')
                    ->limit($page_size)->offset($offset)
                    ->asArray()->all();
            }
            FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
        }
    }
    //删除
    public function actionDel($id,$type_ren,$userid,$user_key,$reimburse_type)
    {
        $id = (int)$id;
        $type_ren  = (int)$type_ren;
        $userid  = (int)$userid;
        $reimburse_type = (int)$reimburse_type;
        FunctionRand::UserAuth($userid, $user_key);
        if($reimburse_type == 1){//机动车维修费报销
            $car = new Carwx();
            $model=$car::findOne($id);
        }elseif($reimburse_type == 2){//会议费
            $car = new Meet();
            $model=$car::findOne($id);
        }elseif($reimburse_type == 3){//差旅费报销
            $model=$this->findModel($id);
        }
        $model->setAttribute($type_ren.'_del',0);
        $model->save(false);
        FunctionRand::View(1, 'Success');
    }
    //审批
    public function actionShenpi($id){
        /*$_POST['format'] = [
            'userid' => 1,
            'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
            'type' => 3,
            'audit' => 2,
            'reason' => '驳回原因',
        ];
        $_POST['format'] = json_encode($_POST['format']);*/
        $post = json_decode($_POST['format'],1);
        $post = FunctionRand::PostFormat($post);
        $id = (int)$id;
        $post['userid'] = (int)$post['userid'];
        FunctionRand::UserAuth($post['userid'], $post['user_key']);
        if($post['type'] == 1){//机动车维修费报销
            $data = Carwx::getDqStatus($id,$post['userid']);
            if($post['audit'] == 1){
                Carwx::updateAll([$data['field'].'_rs'=>1,$data['field'].'_time'=>date('Y-m-d H:i:s',time())],['id'=>$id]);
                $msg = Carwx::find()->select('zmr,'.$data['field'])->where(['id'=>$id])->asArray()->one();
                Message::sendMsgApi('审批',gongchu::getUserNamesByIds($post['userid']).'同意了机动车报销',$msg['zmr'],['carwx/carwx/shenpi','id'=>$id,'api_url' => "index.php/reimbursement/view?id=". $id ."&type=1"],$post['userid']);
                Message::sendMsgApi('审批',gongchu::getUserNamesByIds($post['userid']).'的机动车报销需要您审批',$msg[$data['field']],['carwx/carwx/shenpi','id'=>$id,'api_url' => "index.php/reimbursement/view?id=". $id ."&type=1"],$post['userid']);
            }elseif($post['audit'] == 2){
                Carwx::updateAll([$data['field'].'_rs'=>2,$data['field'].'_detail'=>$post['reason'],$data['field'].'_time'=>date('Y-m-d H:i:s',time())],['id'=>$id]);
                $msg = Carwx::find()->select('zmr')->where(['id'=>$id])->asArray()->one();
                Message::sendMsgApi('审批',gongchu::getUserNamesByIds($post['userid']).'驳回了机动车报销 驳回原因:'.$post['reason'],$msg['zmr'],['carwx/carwx/view','id'=>$id,'api_url' => "index.php/reimbursement/view?id=". $id ."&type=1"],$post['userid']);
            }
        }elseif($post['type'] == 2){//会议费
            $data = Meet::getDqStatus($id,$post['userid']);
            $msg = Meet::find()->select('zmr')->where(['id'=>$id])->asArray()->one();
            if($post['audit'] == 1){
                Meet::updateAll([$data['field'].'_rs'=>1,$data['field'].'_time'=>date('Y-m-d H:i:s',time())],['id'=>$id]);
                $msg = Meet::find()->select('zmr,'.$data['field'])->where(['id'=>$id])->asArray()->one();
                Message::sendMsgApi('审批',gongchu::getUserNamesByIds($post['userid']).'同意了会议报销',$msg['zmr'],['meet/meet/shenpi','id'=>$id,'api_url' => "index.php/reimbursement/view?id=". $id ."&type=2"],$post['userid']);
                Message::sendMsgApi('审批',gongchu::getUserNamesByIds($post['userid']).'的会议报销需要您审批',$msg[$data['field']],['meet/meet/shenpi','id'=>$id,'api_url' => "index.php/reimbursement/view?id=". $id ."&type=2"],$post['userid']);
            }elseif($post['audit'] == 2){
                Meet::updateAll([$data['field'].'_rs'=>2,$data['field'].'_detail'=>$post['reason'],$data['field'].'_time'=>date('Y-m-d H:i:s',time())],['id'=>$id]);
                $msg = Meet::find()->select('zmr')->where(['id'=>$id])->asArray()->one();
                Message::sendMsgApi('审批',gongchu::getUserNamesByIds($post['userid']).'驳回了会议报销 驳回原因:'.$post['reason'],$msg['zmr'],['meet/meet/view','id'=>$id,'api_url' => "index.php/reimbursement/view?id=". $id ."&type=2"],$post['userid']);
            }
        }elseif($post['type'] == 3) {//差旅费报销
            $data = Travel::getDqStatus($id, $post['userid']);
            $msg = Travel::find()->select('zmr')->where(['id' => $id])->asArray()->one();
            if ($post['audit'] == 1) {
                Travel::updateAll([$data['field'] . '_rs' => 1, $data['field'] . '_time' => date('Y-m-d H:i:s', time())], ['id' => $id]);
                $msg = Travel::find()->select('zmr,' . $data['field'])->where(['id' => $id])->asArray()->one();
                Message::sendMsgApi('审批', gongchu::getUserNamesByIds($post['userid']) . '同意了差旅费报销', $msg['zmr'], ['travel/travel/shenpi', 'id' => $id, 'api_url' => "index.php/reimbursement/view?id=" . $id . "&type=3"], $post['userid']);
                Message::sendMsgApi('审批', gongchu::getUserNamesByIds($post['userid']) . '的差旅费报销需要您审批', $msg[$data['field']], ['travel/travel/shenpi', 'id' => $id, 'api_url' => "index.php/reimbursement/view?id=" . $id . "&type=3"], $post['userid']);
            } elseif ($post['audit'] == 2) {
                Travel::updateAll([$data['field'] . '_rs' => 2, $data['field'] . '_detail' => $post['reason'], $data['field'] . '_time' => date('Y-m-d H:i:s', time())], ['id' => $id]);
                $msg = Travel::find()->select('zmr')->where(['id' => $id])->asArray()->one();
                Message::sendMsgApi('审批', gongchu::getUserNamesByIds($post['userid']) . '驳回了差旅费报销 驳回原因:'.$post['reason'], $msg['zmr'], ['travel/travel/view', 'id' => $id, 'api_url' => "index.php/reimbursement/view?id=" . $id . "&type=3"], $post['userid']);
            }
        }
        FunctionRand::View(1, 'success');
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