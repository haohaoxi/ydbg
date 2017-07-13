<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use api\functionGlobal\FunctionRand;
use yii\db\mssql\PDO;
use backend\modules\personworkworkflow\models\PersonWorkWorkflow;
use backend\modules\gongchu\models\Gongchu;
use backend\modules\message\models\Message;
use backend\modules\user\models\User;
/**
 * 个人办公 api
 */
class PersonworkController extends ActiveController
{
    public $modelClass = 'backend\modules\personwork\models\PersonWork';

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
    //个人办公首面
    public function actionList($userid,$user_key,$menutype)
    {
        $userid = (int)$userid;
        $menutype = (int)$menutype;
        FunctionRand::UserAuth($userid,$user_key);
        $page = !isset($_GET['page'])?1:(int)$_GET['page'];
        $page_size = 8;
        $offset = ($page - 1)*$page_size;

        $modelClass = $this->modelClass;
        $query = $modelClass::find()->select(['p_id', 'p_level', 'p_title', 'p_e_time', 'w_s_status','p_y_slr','p_spr']);
        if($menutype == 1) { //未办工作
            $query->joinWith(['personWorkWorkflow' => function ($query) {
                $query->where('w_person_id = ' . (int)$_GET['userid'] . ' and w_s_status in ("未受理","未审批") and w_e_status ="无" and w_type = "普通"');
            }])->where(' (p_e_time > "' . date('Y-m-d H:i:s') . '" or p_e_time="") and p_del = 1')->orderBy('w_id desc');
        }elseif($menutype == 2){ //代办工作
            $query->joinWith(['personWorkWorkflow' => function ($query) {
                $query->where('w_person_id = ' . (int)$_GET['userid'] . ' and w_s_status in ("未受理","未审批") and w_e_status ="无" and w_type = "代办"');
            }])->where(' (p_e_time > "' . date('Y-m-d H:i:s') . '" or p_e_time="") and p_del = 1')->orderBy('w_id desc');
        }elseif($menutype == 3){ //已办工作
            $query->joinWith(['personWorkWorkflow' => function ($query) {
                $query->where('w_person_id = ' . (int)$_GET['userid'] . ' and w_e_status !="无" and w_del = 1');
            }])->orderBy('w_id desc');
        }elseif($menutype == 4){ //逾期工作
            $query->joinWith(['personWorkWorkflow' => function ($query) {
                $query->where('w_person_id = ' . (int)$_GET['userid'] . ' and w_e_status ="无"');
            }])->where(' (p_e_time < "' . date('Y-m-d H:i:s') . '")  and p_del = 1')->orderBy('w_id desc');
        }
        $count = $query->count();
        $rows = $query
            ->orderBy(['p_e_time' => SORT_DESC])
            ->limit($page_size)
            ->offset($offset)
            ->asArray()->all();
        foreach($rows as $key=>$val){
            $slr = explode(",",$val['p_y_slr']);
            $spr = explode(",",$val['p_spr']);
            if(!empty($slr) && in_array($userid, $slr)){
                $rows[$key]['sp_sl'] = 'sl';
            }elseif(!empty($spr) && in_array($userid, $spr)){
                $rows[$key]['sp_sl'] = 'sp';
            }else{
                $rows[$key]['sp_sl'] = '';
            }
        }
        FunctionRand::Page(1, 'Success', $count, $page_size, $page, $rows);
    }
    //我发起的、我审批的
    public function actionFslist($userid,$user_key,$type)
    {
        $userid = (int)$userid;
        $type = (int)$type;
        FunctionRand::UserAuth($userid,$user_key);
        $page = !isset($_GET['page'])?1:(int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1)*$page_size;
        $modelClass = new $this->modelClass();
        $query = $modelClass->find();
        if($type == 1) {//我发起的
            $query->where("p_fsq = :p_fsq and p_del = 1",['p_fsq' => $userid]);
            $count = $query;
            $count = $count->count();
            $data = $query->select(['p_id','p_fsq','p_c_time'])
                ->orderBy('p_c_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        }elseif($type == 2) {//我审批的
            $query->where(['w_del' => '1','w_s_status' => '未审批','w_person_id' => $userid])->join('LEFT JOIN', 'person_work_workflow', 'person_work_workflow.w_p_id = person_work.p_id');
            $count = $query;
            $count = $count->count();
            $data = $query->select(['p_id','p_fsq','p_c_time'])
                ->orderBy('p_c_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        }
        $model = 'backend\modules\personworkworkflow\models\PersonWorkWorkflow';
        $query_sqr = $model::find();
        foreach($data as $key => $value){
            $data[$key]['fqr_name'] = Gongchu::getUserNamesByIds($value['p_fsq']);
            $sqr = $query_sqr->select(['w_e_status'])
                ->where(['w_p_id' => $value['p_id']])
                ->asArray()->all();
            $sqarr = [];
            foreach($sqr as $k => $v){
                if($v['w_e_status'] == '无'){
                    $sqarr[] = '未审批';
                }else{
                    $sqarr[] = $v['w_e_status'];
                }
            }
            $data[$key]['sqstr'] = implode('/',$sqarr);
        }
        FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
    }
    //个人办公详情
    public function actionView($id,$userid,$user_key)
    {
        $id = (int)$id;
        FunctionRand::UserAuth((int)$userid,$user_key);
        $connection = \Yii::$app->db;
        $data = $connection->createCommand('SELECT * FROM {{%person_work}} WHERE p_id = :id');
        $data->bindParam(':id', $id, PDO::PARAM_STR);
        $data = $data->queryOne();
        if($data){
            $spr = $connection->createCommand('SELECT * FROM {{%person_work_workflow}} WHERE w_p_id = '.$data['p_id'].' and w_s_status = "未审批"');
            $spr = $spr->queryAll();
            foreach($spr as $key => $val){
                $val['spr_name'] = Gongchu::getUserNamesByIds($val['w_person_id']);
                $data['spr'][] = $val;
            }
            $slr = $connection->createCommand('SELECT * FROM {{%person_work_workflow}} WHERE w_p_id = '.$data['p_id'].' and w_s_status = "未受理" and w_person_id = '.$userid);
            $slr = $slr->queryOne();
            if($slr){
                $slr['w_y_slr'] = Gongchu::getUserNamesByIds($slr['w_y_slr']);
                $data['slr'] = $slr;
            }
        }
        if(!empty($data)){
            FunctionRand::View(1, 'Success', $data);
        }else{
            FunctionRand::Error(2, '参数无效或缺失');
        }
    }
    //工作发起
    public function actionAdd()
    {
        /*$_POST['format'] = [
            'userid' => 1,
            'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
            'p_title' => 'title',
            'p_s_time' => '2016-05-24 14:05:00',
            'p_e_time' => '2016-06-24 14:05:00',
            'p_level' => '一般',
            'p_y_slr' => '1,2,8,9',
            'p_details' => '详情详情',
            'p_spr' => ''
        ];
        $_POST['format'] = json_encode($_POST['format']);*/
        $post = json_decode($_POST['format'],true);
        $post = FunctionRand::PostFormat($post);
        $post['userid'] = (int)$post['userid'];
        FunctionRand::UserAuth($post['userid'],$post['user_key']);
        $model = new $this->modelClass();
        $model_workflow = new PersonWorkWorkflow();
        $db = \Yii::$app->db;
        $model->attributes = $post;
        $model->p_fsq = $post['userid'];
        $model->p_c_time = date('Y-m-d H:i:s',time());
        $transaction=$db->beginTransaction();
        try
        {
            $_POST['userid'] = $post['userid'];
            $model->save();
            if($model->p_spr == ''){ //审批人为空 则自动进入受理流程
                if($model->p_y_slr !=''){ //获取受理人id
                    $slr = explode(',',$model->p_y_slr);
                    foreach($slr as $value){ //循环插入受理人
                        $model_workflow->w_p_id = $model->p_id;
                        $model_workflow->w_person_id = $value;
                        $model_workflow->w_person_key = 0;
                        $model_workflow->w_s_time = date('Y-m-d H:i:s',time());
                        $model_workflow->w_s_status = '未受理';
                        $model_workflow->w_type = '普通';
                        $model_workflow->isNewRecord = true;
                        $model_workflow->insert() && $model_workflow->w_id = 0 ;
                    }
                    //Message::sendMsgApi('发起工作',gongchu::getUserNamesByIds($model->p_fsq).'发起了《'.$model->p_title.'》工作',$model->p_y_slr,['personwork/personwork/index','menutype'=>1,'PersonworkSearch[p_id]'=>$model->p_id,'api_url' => "index.php/personwork/view?id=".$model->p_id],$model->p_fsq);
                }
            }else { //审批人不为空 则自动进入审批流程
                $next_id = $model::getNextPerson($model->p_id,'','p_spr');
                $model_workflow->w_p_id = $model->p_id;
                $model_workflow->w_person_id = $next_id;
                $model_workflow->w_person_key = 0;
                $model_workflow->w_s_time = date('Y-m-d H:i:s',time());
                $model_workflow->w_s_status = '未审批';
                $model_workflow->w_type = '普通';
                $model_workflow->isNewRecord;
                $model_workflow->save();
                Message::sendMsgApi('审批',gongchu::getUserNamesByIds($model->p_fsq).'的【'.$model->p_title.'】需要您审批',$next_id,['personwork/personwork/sp','menutype'=>1,'id'=>$model->p_id,'api_url' => "index.php/personwork/view?id=".$model->p_id],$model->p_fsq);
            }
            $transaction->commit();
            FunctionRand::View(1, '工作发起成功');
        }
        catch(Exception $e)
        {
            FunctionRand::Errow(2, '工作发起失败，请重试');exit;
        }
    }
    //删除工作
    public function actionDel($id,$userid,$user_key)
    {
        $id = (int)$id;
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        $modelClass = new $this->modelClass();
        $modelClass::updateAll(['p_del'=>0],'p_id = '.$id);
        PersonWorkWorkflow::updateAll(['w_del'=>0],'w_p_id = '.$id);
        FunctionRand::View(1, '删除成功');
    }
    /*
     * 审批驳回
     * @param $id 工作记录id
     * @param $w_type 是否是代办
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSpbh($id,$w_type)
    {

        /*$_POST['format'] = [
            'userid' => 1,
            'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
            'cancel_detail' => 'XxxxXX',
        ];
        $_POST['format'] = json_encode($_POST['format']);*/
        $post = json_decode($_POST['format'],true);
        $post = FunctionRand::PostFormat($post);
        $id = (int)$id;
        $post['userid'] = (int)$post['userid'];
        FunctionRand::UserAuth($post['userid'],$post['user_key']);
        if($data = PersonWorkWorkflow::find()->where(['w_p_id'=>$id,'w_person_id'=> $post['userid'],'w_type'=>$w_type])->asArray()->orderBy('w_id desc')->one()){
            $db = \Yii::$app->db;
            $transaction=$db->beginTransaction();
            try
            {
                $db = \Yii::$app->db;
                $query = $db->createCommand('update {{person_work_workflow}} set w_e_time="'.date('Y-m-d H:i:s',time()).'",w_e_status="驳回",w_cancel_details =:w_cancel_details  where w_id ='.$data['w_id']); //修改原来记录
                $query->bindParam(':w_cancel_details', $post['cancel_detail'], PDO::PARAM_STR);
                $query = $query->execute();
                $query = $db->createCommand('update {{person_work}} set p_cancel_detail = :p_cancel_detail where p_id='.$id); //修改原来记录
                $query->bindParam(':p_cancel_detail', $post['cancel_detail'], PDO::PARAM_STR);
                $query = $query->execute();
                $modelClass = new $this->modelClass();
                $info= $modelClass::getPersonWorkInfo($data['w_p_id']);
                Message::sendMsgApi('审批',gongchu::getUserNamesByIds($post['userid']).'驳回了【'.$info['p_title'].'】',$info['p_fsq'],['personwork/personwork/view','menutype'=>5,'id'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=".$info['p_id']],$post['userid']);
                $transaction->commit();
                FunctionRand::View(1, 'success');exit;
            }catch(Exception $e)
            {
                $transaction->rollBack();
                FunctionRand::Error(2, 'false',$e->getMessage());exit;
            }
        }
    }
    /*
     * 审批同意
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSpty($id,$w_type,$userid,$user_key)
    {
        $id = (int)$id;
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        if($data = PersonWorkWorkflow::find()->where('w_p_id=:w_p_id and w_person_id=:w_person_id and w_type=:w_type',['w_p_id'=>$id,'w_person_id' => $userid,'w_type'=>$w_type])->asArray()->orderBy('w_id desc')->one()){
            $db = \Yii::$app->db;
            $transaction=$db->beginTransaction();
            try
            {
                $model_workflow = new PersonWorkWorkflow();
                $model = new $this->modelClass();
                $db = \Yii::$app->db;
                $db->createCommand('update {{person_work_workflow}} set w_e_time="'.date('Y-m-d H:i:s',time()).'",w_e_status="同意"  where w_id ='.$data['w_id'])->execute(); //修改原来记录
                $next_id = $model::getNextPerson($id,$data['w_person_key'],'p_spr');
                $info= $model::getPersonWorkInfo($data['w_p_id']);
                if($next_id == -1){ //已经是最后一位审批人 转到受理人
                    $PersonWork = $model::find()->where(['p_id'=>$data['w_p_id']])->asArray()->one();
                    $slr = explode(',',$PersonWork['p_y_slr']);
                    foreach($slr as $value){ //循环插入受理人
                        $model_workflow->w_p_id = $data['w_p_id'];
                        $model_workflow->w_person_id = $value;
                        $model_workflow->w_person_key = 0;
                        $model_workflow->w_s_time = date('Y-m-d H:i:s',time());
                        $model_workflow->w_s_status = '未受理';
                        $model_workflow->w_type = '普通';
                        $model_workflow->isNewRecord = true;
                        $model_workflow->insert() && $model_workflow->w_id = 0 ;
                    }
                    //Message::sendMsgApi('工作受理',gongchu::getUserNamesByIds($userid).'工作受理《'.$info['p_title'].'》',$PersonWork['p_y_slr'],['personwork/personwork/index','menutype'=>1,'PersonworkSearch[p_id]'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=".$info['p_id']],$userid);
                    //Message::sendMsgApi('审批同意',gongchu::getUserNamesByIds($userid).'审批同意《'.$info['p_title'].'》',$info['p_fsq'],['personwork/personwork/index','menutype'=>1,'PersonworkSearch[p_id]'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=".$info['p_id']],$userid);

                }else{ //选择下一个审批人 继续往下执行审批流程
                    $model_workflow->w_p_id = $data['w_p_id'];
                    $model_workflow->w_person_id = $next_id;
                    $model_workflow->w_person_key = ++$data['w_person_key'];
                    $model_workflow->w_s_time = date('Y-m-d H:i:s',time());
                    $model_workflow->w_s_status = '未审批';
                    $model_workflow->w_type = '普通';
                    $model_workflow->isNewRecord;
                    $model_workflow->save();
                    Message::sendMsgApi('审批',gongchu::getUserNamesByIds($userid).'的【'.$info['p_title'].'】需要你审批',$next_id,['personwork/personwork/sp','menutype'=>1,'id'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=".$info['p_id']],$userid);
                    Message::sendMsgApi('审批',gongchu::getUserNamesByIds($userid).'同意了【'.$info['p_title'].'】',$info['p_fsq'],['personwork/personwork/view','menutype'=>5,'id'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=".$info['p_id']],$userid);
                }
                $transaction->commit();
                FunctionRand::View(1, 'success');exit;
            }catch(Exception $e)
            {
                $transaction->rollBack();
                FunctionRand::Error(2, 'false',$e->getMessage());exit;
            }
        }
    }
    /*
        * 受理完成
        * @param $id
        * @return string
        * @throws NotFoundHttpException
        */
    public function actionSlwc($id,$w_type,$userid,$user_key){
        $id = (int)$id;
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        if($data = PersonWorkWorkflow::find()->where('w_p_id=:w_p_id and w_person_id=:w_person_id and w_type=:w_type',['w_p_id'=>$id,'w_person_id' => $userid,'w_type'=>$w_type])->asArray()->orderBy('w_id desc')->one()){
            $db = \Yii::$app->db;
            $transaction=$db->beginTransaction();
            try
            {
                $db = \Yii::$app->db;
                $db->createCommand('update {{person_work_workflow}} set w_e_time="'.date('Y-m-d H:i:s',time()).'",w_e_status="完成"  where w_id ='.$data['w_id'])->execute(); //修改原来记录
                $transaction->commit();
                $modelClass = new $this->modelClass();
                $info= $modelClass::getPersonWorkInfo($data['w_p_id']);
                //Message::sendMsgApi('受理完成',gongchu::getUserNamesByIds($userid).'受理完成了《'.$info['p_title'].'》工作',$info['p_fsq'],['personwork/personwork/index','menutype'=>5,'PersonworkSearch[p_id]'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=".$info['p_id']],$userid);
                FunctionRand::View(1, 'success');exit;
            }catch(Exception $e)
            {
                $transaction->rollBack();
                FunctionRand::Error(2, 'false',$e->getMessage());exit;
            }
        }
    }
    /*
     * 催办
     * @param $id
     */
    public function actionCuiban($id,$userid,$user_key){
        $id = (int)$id;
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        $eessage_num = Message::find()->where(['fsr'=>$userid,'type' => '催办工作'])->andFilterWhere(['like', 'time', date('Y-m-d',time())])->asArray()->all();
        $num = 0;
        foreach ($eessage_num as $item) {
            $url = json_decode($item['url'],1);
            if(isset($url['PersonworkSearch[p_id]'])){
                if($url['PersonworkSearch[p_id]'] == $id){
                    $num++;
                }
            }
        }
        if($num >= 15){
            die(json_encode(['code' => 2,'error' => '今日催办次数已超过10次，无法继续催办!']));
        }
        $data = $this->findModel($id);
        $_data = PersonWorkWorkflow::find()->where(['w_p_id'=>$id])->asArray()->orderBy('w_id desc')->one();
        $status = $_data['w_s_status'];
        $w_person_id = $_data['w_person_id'];
        $w_person_key = $_data['w_person_key'];
        $ids = "";
        $type = '';
        if($status == '未受理'){
            $type = 'sl';
            $wsl = PersonWorkWorkflow::find()->select('w_person_id')->where(['w_p_id'=>$id,'w_s_status'=>'未受理','w_e_status'=>'无'])->asArray()->orderBy('w_id desc')->all();
            $wsl = array_unique(array_column($wsl,'w_person_id'));
            $wsl = implode(',',$wsl);
            $ids = $wsl;
        }elseif($status == '未审批'){
            $type = 'sp';
            $ids = $w_person_id;
        }
        Message::sendMsgApi('催办',Gongchu::getUserNamesByIds($userid).'的工作【'.$data['p_title'].'】需要您'.$type='sl'?'受理':'审批',$ids,['personwork/personwork/'.$type,'menutype'=>1,'id'=>$data['p_id'],'api_url' => "index.php/personwork/view?id=".$id],$userid);
        FunctionRand::View(1, 'success');
    }
    /*
         * 受理退办
         * @param $id
         * @return string
         * @throws NotFoundHttpException
         */
    public function actionSltb($id,$w_type){
        /*$_POST['format'] = [
            'cancel_detail' => 'CCCCCC',
            'userid' => 1,
            'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
        ];
        $_POST['format'] = json_encode($_POST['format']);*/
        $post = json_decode($_POST['format'],true);
        $post['userid'] = (int)$post['userid'];
        $id = (int)$id;
        FunctionRand::UserAuth($post['userid'],$post['user_key']);
        if($data = PersonWorkWorkflow::find()->where(['w_p_id'=>$id,'w_person_id'=>$post['userid'],'w_type'=>$w_type])->asArray()->orderBy('w_id desc')->one()){
            $db = \Yii::$app->db;
            $transaction=$db->beginTransaction();
            try
            {
                $db = \Yii::$app->db;
                $query = $db->createCommand('update {{person_work_workflow}} set w_e_time="'.date('Y-m-d H:i:s',time()).'",w_e_status="退办",w_cancel_details = :w_cancel_details  where w_id ='.$data['w_id']); //修改原来记录
                $query->bindParam(':w_cancel_details', $post['cancel_detail'], PDO::PARAM_STR);
                $query = $query->execute();
                $query = $db->createCommand('update {{person_work}} set p_cancel_detail= :p_cancel_detail where p_id='.$id); //修改原来记录
                $query->bindParam(':p_cancel_detail', $post['cancel_detail'], PDO::PARAM_STR);
                $query = $query->execute();

                $modelClass = new $this->modelClass();
                $info= $modelClass::getPersonWorkInfo($data['w_p_id']);
                //Message::sendMsgApi('退办工作',gongchu::getUserNamesByIds($post['userid']).'退办了《'.$info['p_title'].'》工作 退办原因:'.$post['cancel_detail'],$info['p_fsq'],['personwork/personwork/index','menutype'=>3,'PersonworkSearch[p_id]'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=".$info['p_id']],$post['userid']);
                $transaction->commit();
                FunctionRand::View(1, 'success');exit;
            }catch(Exception $e)
            {
                $transaction->rollBack();
                FunctionRand::Error(2, 'false',$e->getMessage());exit;
            }
        }
    }
    /*
     * 受理代办
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSldb($id,$w_type,$db_id,$userid,$user_key)
    {
        $id = (int)$id;
        $db_id = (int)$db_id;
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        if($data = PersonWorkWorkflow::find()->where('w_p_id=:w_p_id and w_person_id=:w_person_id and w_type=:w_type',['w_p_id'=>$id,'w_person_id' => $userid,'w_type'=>$w_type])->asArray()->orderBy('w_id desc')->one()){
            $db = \Yii::$app->db;
            $transaction=$db->beginTransaction();
            try
            {
                $db = \Yii::$app->db;
                $db->createCommand('update {{person_work_workflow}} set w_e_time="'.date('Y-m-d H:i:s',time()).'",w_e_status="代办"  where w_id ='.$data['w_id'])->execute(); //修改原来记录

                $model_workflow = new PersonWorkWorkflow();
                $model_workflow->w_p_id = $data['w_p_id'];
                $model_workflow->w_person_id = $db_id;
                $model_workflow->w_person_key = 0;
                $model_workflow->w_s_time = date('Y-m-d H:i:s',time());
                $model_workflow->w_s_status = '未受理';
                $model_workflow->w_type = '代办';
                $model_workflow->w_y_slr = $userid;
                $model_workflow->isNewRecord;
                $model_workflow->save();
                $transaction->commit();
                $modelClass = new $this->modelClass();
                $info= $modelClass::getPersonWorkInfo($data['w_p_id']);
                $name = User::getNames($info['p_fsq']);
                //Message::sendMsgApi('代办工作',gongchu::getUserNamesByIds($userid).'让您代办了《'.$info['p_title'].'》工作',$db_id,['personwork/personwork/index','menutype'=>2,'PersonworkSearch[p_id]'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=". $info['p_id']],$userid);
                //Message::sendMsgApi('工作被代办',gongchu::getUserNamesByIds($userid).'选择了《'.$info['p_title'].'》工作的代办 代办人:'.$name[0]['name'],$info['p_fsq'],['personwork/personwork/index','menutype'=>2,'PersonworkSearch[p_id]'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=". $info['p_id']],$userid);
                FunctionRand::View(1, 'success');exit;
            }catch(Exception $e)
            {
                $transaction->rollBack();
                FunctionRand::Error(2, 'false',$e->getMessage());exit;
            }
        }
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
