<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use api\functionGlobal\FunctionRand;
use yii\db\mssql\PDO;
use backend\modules\meeting\models\MeetJoin;
use backend\modules\gongchu\models\Gongchu;
use backend\modules\message\models\Message;

/**
 *  会议管理 api
 */
class MeetingController extends ActiveController
{
    public $modelClass = 'backend\modules\meeting\models\Meeting';

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
    //我发起的
    public function actionList($userid,$user_key,$type = 0)
    {
        if(empty($type) || !is_numeric($type)){
            FunctionRand::Error(2, '参数无效或缺失');
        }
        $userid = (int)$userid;
        $type = (int)$type;
        FunctionRand::UserAuth($userid,$user_key);
        $page = !isset($_GET['page'])?1:(int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1)*$page_size;
        $modelClass = new $this->modelClass();
        $query = $modelClass->find();
        if($type == 1){//我参于的
            $connection = \Yii::$app->db;
            $count= $connection->createCommand('SELECT count(*) FROM {{%meet_join}}  WHERE join_ren = :join_ren and  isdelete = 0');
            $count->bindParam(':join_ren', $userid, PDO::PARAM_STR);
            $count = $count->queryScalar();
            $data = $query->select(['meeting.id','meeting.subject','meeting.place','meeting.start_time'])
                ->join('LEFT JOIN', 'meet_join', 'meet_join.meetid = meeting.id')
                ->where(['meet_join.join_ren' => $userid,'meet_join.isdelete' => 0])
                ->orderBy('meeting.start_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        }else{//我发起的
            $count = $query->where(['initiator' => $userid,'isdelete' => 0])->count();
            $data = $query->select(['id','subject','place','start_time'])
                ->where(['initiator' => $userid,'isdelete' => 0])
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        }
        FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
    }
    //查看会议
    public function actionView($id,$userid,$user_key)
    {
        $id = (int)$id;
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid,$user_key);
        $data = [];
        $model = $this->findModel($id);
        $model->initiator = Gongchu::getUserNamesByIds($model->initiator);//发起人
        $model->initiate_dept = Gongchu::getDeptNameById($model->initiate_dept);
        $model->initiate_time = substr($model->initiate_time,0,-3);
        $data = $model->attributes;
        $query = MeetJoin::find()->where('meetid=:meetid',[":meetid"=>$id])->asArray()->all();
        $joinArr = array();
        $allRen = array();
        foreach($query as $v){
            $joinArr[$v['id']][]=$v['type'];
            $joinArr[$v['id']][]=$v['join_ren'];
            $allRen[]=$v['join_ren'];
        }
        $host=array();
        $joinren=array();
        foreach($joinArr as $k=>$v){
            if($v[0]==1){
                $host[$k]=$v[1];
            }else{
                $joinren[$k]=$v[1];
            }
        }
        $hostStr='';//主持人
        $joinrenStr='';//参加人员
        foreach($host as $vh){
            $hostStr.=Gongchu::getUserNamesByIds($vh).',';
        }
        foreach($joinren as $vj){
            $joinrenStr.=Gongchu::getUserNamesByIds($vj).',';
        }
        $data['hostStr'] = $hostStr;
        $data['joinrenStr'] = $joinrenStr;
        $model->hosts=substr($hostStr,0,-1);
        $model->join_ren=substr($joinrenStr,0,-1);
        if(in_array($userid,$allRen)){
            $meetJoin=MeetJoin::find()->select('id')->where("meetid=:meetid and join_ren=:join_ren",[':meetid'=>$id,':join_ren'=>$userid])->asArray()->one();
            $meetJoins=MeetJoin::findOne($meetJoin['id']);
            $meetJoins->status=1;//已查阅状态
            $meetJoins->save();
        }
        $status=array();
        foreach($query as $v){
            $status[$v['join_ren']]=$v['status'];
        }
        $viewStatus=array();
        $i = 0;
        foreach($status as $ks=>$vs){
            $name=Gongchu::getUserNamesByIds($ks);
            $sta=$vs==1?'已查阅':'未查阅';
            $viewStatus[$i]['username']=$name;
            $viewStatus[$i]['status']=$sta;
            $i++;
        }
        $data['viewStatus'] = $viewStatus;
        FunctionRand::View(1, 'success',$data);
    }
    //发起会议
    public function actionAdd()
    {
        $modelClass = $this->modelClass;
        $model = new $modelClass();
        /*$_POST['format'] = [
            'userid' => 1,
            'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
            'subject' => '会议主题',
            'start_time' => '2016-06-05 13:00:00',
            'end_time' => '2016-06-05 16:00:00',
            'place' => '会议地点',
            'hosts' => '1,2',
            'join_ren' => '8,9,10,11',
            'join_rens' => '参会人1,参会人2,参会人3',
            'agenda' => '会议议程',
            'arrangement' => '会议安排',
            'initiate_dept' => 5
        ];
        $_POST['format'] = json_encode($_POST['format']);*/
        $post = json_decode($_POST['format'],true);
        $post = FunctionRand::PostFormat($post);
        $post['userid'] = (int)$post['userid'];
        FunctionRand::UserAuth($post['userid'],$post['user_key']);
        $model->initiator = $post['userid'];
        $model->initiate_time = date('Y-m-d H:i:s',time());
        if($model->save()){
            $meetingId=Yii::$app->db->getLastInsertID();
            $hosts = $post['hosts'];
            $joinrens = $post['join_ren'];
            Message::sendMsgApi('会议发起',Gongchu::getUserNamesByIds($post['userid']).'发起了一个会议',$hosts,['meetingjoin/meetingjoin/index','api_url' => "index.php/meeting/view?id=".$model->id],$post['userid']);
            Message::sendMsgApi('会议发起',Gongchu::getUserNamesByIds($post['userid']).'发起了一个会议',$joinrens,['meetingjoin/meetingjoin/index','api_url' => "index.php/meeting/view?id=".$model->id],$post['userid']);
            $hostArr=explode(",",$hosts);
            $joinrenArr=explode(",",$joinrens);
            foreach($hostArr as $v){
                $joins = new MeetJoin();
                $joins->setAttributes(['meetid'=>$meetingId,'join_ren'=>$v,'type'=>1,'status'=>0]);
                $joins->save();
            }
            foreach ($joinrenArr as $vr) {
                $joins =new MeetJoin();
                $joins->setAttributes(['meetid'=>$meetingId,'join_ren'=>$vr,'type'=>0,'status'=>0]);
                $joins->save();
            }
            FunctionRand::View(1, 'success');
        }else{
            FunctionRand::Error(2, $model->getFirstErrors());
        }
    }
    //删除会议安排
    public function actionDel($meetid,$isinitiator,$userid,$user_key)
    {
        if(empty($meetid) || !is_numeric($isinitiator)){
            FunctionRand::Error(2, '参数无效或缺失');
        }
        $userid = (int)$userid;
        $meetid = (int)$meetid;
        FunctionRand::UserAuth($userid,$user_key);
        if($isinitiator){//如果是发起人
            $model = $this->findModel($meetid);
        }else{
            $modelClass = 'backend\modules\meeting\models\MeetJoin';
            $model = $modelClass::findOne(['meetid' => $meetid,'join_ren' => $userid]);
        }
        $model->setAttribute('isdelete',1);
        $model->save(false);
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