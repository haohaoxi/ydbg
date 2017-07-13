<?php
namespace api\controllers;
use backend\modules\office\models\Office;
use backend\modules\officeapply\models\OfficeApply;
use Yii;
use yii\rest\ActiveController;
use api\functionGlobal\FunctionRand;
use backend\modules\deptcontact\models\DeptContact;
use backend\modules\message\models\Message;
use backend\modules\gongchu\models\Gongchu;
/**
 * Created by PhpStorm.
 * User: Jun
 * Date: 2016/5/26
 * Time: 13:37
 */

/*
 * 行政办公-办公用品申请Api
 *
 */
class OfficesuppliesController extends ActiveController{
    
    public $modelClass = 'backend\modules\officeapply\models\OfficeApply';

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
        // 注销系统自带的实现方
        unset($actions['index'], $actions['update'], $actions['create'], $actions['delete'], $actions['view']);
        return $actions;
    }
    
    //查看办公用品申请单
    public function actionView($id,$userid,$user_key)
    {
        FunctionRand::UserAuth((int)$userid,$user_key);
        $modelClass = new $this->modelClass();
        $data = $modelClass::find($id)->select(['office_apply.*','office.office_num','office.office_part_name','office.office_type'])
            ->join('LEFT JOIN','office','office.office_id=office_apply.apply_office_id' )
            ->where(['apply_id'=>(int)$id])
            ->asArray()->one();
        $data['deptname'] = Gongchu::getDeptNameById($data['apply_department']);
        FunctionRand::View(1, 'Success',$data);

    }
    //查看办公用品详情
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
        $off=new Office();
        $data = $off::find($id)->select('office.*')
            ->where(['office_id'=>(int)$id])
            ->asArray()->one();
        //var_dump($data);die;
        FunctionRand::View(1, 'Success',$data);
    }
    //行政办公-办公用品申请
    public function actionShow($userid,$user_key,$materials_type)
    {
        //var_dump($materials_type);die;
        $intuserid=((int)$userid);
        $type=(int)$materials_type;
        FunctionRand::UserAuth($userid,$user_key);
        //办公用品申请
        $page = !isset($_GET['page']) ? 1 : (int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1) * $page_size;
        $office=new Office();
        $count=$office->find()
            ->select('*')
            //->join('LEFT JOIN','office_apply','office.office_id=office_apply.apply_office_id' )
            ->andwhere(['office_is_del'=>1])
            ->count();
        //办公用品申请
        if($type==1) {
            $data=$office->find()
                ->select('*')
                //->join('LEFT JOIN','office_apply','office.office_id=office_apply.apply_office_id' )
                ->andwhere(['office_is_del'=>1])
                ->limit($page_size)->offset($offset)
                ->asArray()
                ->all();
            //$contace=new DeptContact();//通过ID查询机构�?
            //$jigou=$contace->find()->select('dept_name')->where('id=:id',['id'=>$data[0]['apply_department']])->asArray()->one();
            /*foreach ($data as $key=>$val){

                $val['departments']=$jigou['dept_name'];//机构名称
            }*/
            FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
        }else {//采购申请
            /*$_POST['format'] = [
                'apply_mee_text'=>'王东',//申请�?
                'apply_office_name'=>'毛笔',//办公用品名称
                'apply_num'=>'22',//数量
                'apply_price'=>'1.66',//预计单价
                'apply_money'=>'37',//预计金额
                'apply_remarks'=>'可以的可以的可以的可以的可以�?,//备注
                'apply_pack_result'=>'顶顶顶顶�?,//行装科意�?
                'apply_genneral_result'=>'打发打发打发',//检察长意见
                'apply_pack_id'=> '2',//行装科负责人ID
                'apply_genneral_id'=> '2',//检察长id
                'apply_pack_text'=> "行装科负责人�?//行装科负责人
            ];
            $_POST['format'] = json_encode($_POST['format']);*/
            $post = json_decode($_POST['format'],true);
            $post = FunctionRand::PostFormat($post);
            $office=new OfficeApply();
            $office->attributes = $post;
            $office->apply_sq_time = date('Y-m-d H:i:s',time());
            if (! $office->save()) {//失败
                FunctionRand::Error(2, $office->getFirstErrors());
            }else{//成功
                Message::sendMsgApi('审批',Gongchu::getUserNamesByIds($userid).'的办公用品申请需要你审批',intval($_POST['apply_pack_id']),['officeapply/officeapply/sp','id'=>$model->apply_id,'api_url' => "index.php/officesupplies/view?id=".$model->apply_id],$userid);
                FunctionRand::View(1, 'success');
            }
        }
    }

    //我发起的、我审批的list,办公用品申领List
    public function actionList($userid,$user_key,$type)
    {
        $type = (int)$type;
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid, $user_key);
        $page = !isset($_GET['page']) ? 1 : (int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1) * $page_size;
        $office=new OfficeApply();
        $query = $office->find();
        if ($type == 2) {//我审批的
            $query->where('(apply_pack_id=:dept_leader and apply_pack_id_is_del=:dept_delete) or (apply_genneral_id=:dept_leader and apply_genneral_id_is_del=:dept_delete and apply_pack_status=:dept_audit)', [':dept_leader'=>$userid,':dept_delete'=>1,':dept_audit'=>'同意',]);
            $count = $query;
            $count = $count->count();
            $data = $query->select(['apply_id','apply_mee_text','apply_sq_time','apply_pack_status','apply_office_name'])
                ->join('LEFT JOIN', 'office','office.office_id= office_apply.apply_office_id')
                ->andwhere(['apply_cgsq'=>'否'])
                ->orderBy('apply_sq_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        } elseif ($type==1){//我发起的
            $query->where("apply_mee_id = :apply_mee_id and apply_mee_id_is_del = 1",['apply_mee_id' => $userid]);
            $count = $query;
            $count = $count->count();
            $data = $query->select(['apply_id','apply_mee_text','apply_sq_time','apply_pack_status','apply_office_name'])
                ->join('LEFT JOIN', 'office','office.office_id= office_apply.apply_office_id')
                ->andwhere(['apply_cgsq'=>'否'])
                ->orderBy('apply_sq_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        }
        FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
    }

    //我发起的、我审批的list,办公用品采购List
    public function actionBuy ($userid,$user_key,$type){
        $intuserid=((int)$userid);
        $type = (int)$userid;
        FunctionRand::UserAuth($intuserid, $user_key);
        $page = !isset($_GET['page']) ? 1 : (int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1) * $page_size;
        $office=new OfficeApply();
        $query = $office->find();
        if ($type == 2) {//我审批的
            $query->where('(apply_pack_id=:dept_leader and apply_pack_id_is_del=:dept_delete) or (apply_genneral_id=:dept_leader and apply_genneral_id_is_del=:dept_delete and apply_pack_status=:dept_audit)', [':dept_leader'=>$intuserid,':dept_delete'=>1,':dept_audit'=>'同意',]);
            $count = $query;
            $count = $count->count();
            $data = $query->select(['apply_id','apply_mee_text','apply_sq_time','apply_pack_status','apply_office_name'])
                ->join('LEFT JOIN', 'office','office.office_id= office_apply.apply_office_id')
                ->andwhere(['apply_cgsq'=>'是'])
                ->orderBy('apply_sq_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        } elseif ($type==1){//我发起的
            $query->where("apply_mee_id = :apply_mee_id and apply_mee_id_is_del = 1",['apply_mee_id' => $intuserid]);
            $count = $query;
            $count = $count->count();
            $data = $query->select(['apply_id','apply_mee_text','apply_sq_time','apply_pack_status','apply_office_name'])
                ->join('LEFT JOIN', 'office','office.office_id= office_apply.apply_office_id')
                ->andwhere(['apply_cgsq'=>'是'])
                ->orderBy('apply_sq_time desc')
                ->limit($page_size)->offset($offset)
                ->asArray()->all();
        }
        FunctionRand::Page(1, 'Success', $count, $page_size, $page, $data);
    }
    
    //删除记录
     public function actionDel($id,$type,$userid,$user_key)
     {
         $id = (int)$id;
         $userid = (int)$userid;
         FunctionRand::UserAuth($userid, $user_key);
         if($type=='genneral'){
             $model=$this->findModel($id);
             $model->setAttribute('apply_genneral_id_is_del',0);
             $model->save(false);
         }elseif($type == 'pack'){
             $model=$this->findModel($id);
             $model->setAttribute('apply_pack_id_is_del',0);
             $model->save(false);
         }else{
             $model=$this->findModel($id);
             $model->setAttribute('apply_mee_id_is_del',0);
             $model->save(false);
         }
         FunctionRand::View(1, 'success');
     }
    
    //审批
    public function actionShenpi($id){
        /*$_POST['format'] = [
            'userid' => 1,
            'user_key' => 'ec51ff66c94c0ad78ee7e39fa550862d',
            'audit' => '驳回',
            'reason' => '驳回原因',
        ];
        $_POST['format'] = json_encode($_POST['format']);*/
        $post = json_decode($_POST['format'],1);
        FunctionRand::UserAuth($post['userid'], $post['user_key']);
        $post = FunctionRand::PostFormat($post);
        $post['userid'] = (int)$post['userid'];
        $data = OfficeApply::getDqStatus($id,$post['userid']);
        $rs_status = str_replace('_id','_status',$data['field']);
        $rs_time = str_replace('_id','_time',$data['field']);
        $msg = OfficeApply::find()->select('*')->where(['apply_id'=>$id])->asArray()->one();
        if($post['audit'] == '同意'){
            OfficeApply::updateAll([$rs_status=>'同意',$rs_time=>date('Y-m-d H:i:s',time())],['apply_id'=>$id]);
            Message::sendMsgApi('审批',gongchu::getUserNamesByIds($post['userid']).'同意了办公用品申请',$msg['apply_mee_id'],['officeapply/officeapply/view','id'=>$id,'api_url' => "index.php/officeapply/view?id=". $id],$post['userid']);
            Message::sendMsgApi('审批',gongchu::getUserNamesByIds($post['userid']).'的办公用品申请需要您审批',$msg[$data['field']],['officeapply/officeapply/sp','id'=>$id,'api_url' => "index.php/officeapply/view?id=". $id],$post['userid']);
        }elseif($post['audit'] == '驳回'){
            $rs_result = str_replace('_id','_result',$data['field']);
            OfficeApply::updateAll([$rs_status=>'驳回',$rs_result=>$post['reason'],$rs_time=>date('Y-m-d H:i:s',time())],['apply_id'=>$id]);
            Message::sendMsgApi('审批',gongchu::getUserNamesByIds($post['userid']).'驳回了办公用品申请',$msg['apply_mee_id'],['officeapply/officeapply/view','id'=>$id,'api_url' => "index.php/officeapply/view?id=". $id],$post['userid']);
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