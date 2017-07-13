<?php

namespace backend\modules\personwork\controllers;

use backend\controllers\CommonController;
use backend\modules\personworkworkflow\models\PersonWorkWorkflow;
use backend\modules\user\models\User;
//use common\models\User;
use Yii;
use backend\modules\personwork\models\PersonWork;
use backend\modules\personwork\models\PersonworkSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\message\models\Message;
/**
 * PersonworkController implements the CRUD actions for Personwork model.
 */
class PersonworkController extends CommonController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Personwork models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(empty($_GET['menutype'])) exit('参数丢失');
        $searchModel = new PersonworkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,intval($_GET['menutype']));
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Personwork model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Personwork model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PersonWork();
        $model_workflow = new PersonWorkWorkflow();
        if ($model->load(Yii::$app->request->post())) {
            $db = \Yii::$app->db;
            $transaction=$db->beginTransaction();
            try
            {
                if(!$model->save() && $model->validate()){
                    $transaction->rollBack();
                    print_r($model->getErrors());
                    exit();
                }
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
                        //Message::sendMsg('受理',Yii::$app->user->identity->name.'的【'.$model->p_title.'】需要您受理',$model->p_y_slr,['personwork/personwork/sl','menutype'=>1,'id'=>$model->p_id,'api_url' => "index.php/personwork/view?id=".$model->p_id]);
                    }

                }else{ //审批人不为空 则自动进入审批流程
                    $next_id = PersonWork::getNextPerson($model->p_id,'','p_spr');
                    $model_workflow->w_p_id = $model->p_id;
                    $model_workflow->w_person_id = $next_id;
                    $model_workflow->w_person_key = 0;
                    $model_workflow->w_s_time = date('Y-m-d H:i:s',time());
                    $model_workflow->w_s_status = '未审批';
                    $model_workflow->w_type = '普通';
                    $model_workflow->isNewRecord;
                    $model_workflow->save();
                    Message::sendMsg('审批',\Yii::$app->user->identity->name.'的【'.$model->p_title.'】需要您审批',$next_id,['personwork/personwork/sp','menutype'=>1,'id'=>$model->p_id,'api_url' => "index.php/personwork/view?id=".$model->p_id]);
                }
                $transaction->commit();
                return $this->redirect(['index','menutype'=>intval($_GET['menutype'])]);

            }
            catch(Exception $e)
            {
                $transaction->rollBack();
                print_r($e->getMessage());
                exit();
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Personwork model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->p_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Personwork model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        if($id == '') return false;
        PersonWork::updateAll(['p_del'=>0],'p_id = '.$id);
        PersonWorkWorkflow::updateAll(['w_del'=>0],'w_p_id = '.$id);
/*        $this->findModel($id)->delete();
        PersonWorkWorkflow::deleteAll(['w_p_id' =>$id]);*/

        return $this->redirect(['index','menutype'=>intval($_GET['menutype'])]);
    }

    public function actionDeletefalse($id)
    {
        if($id == '') return false;
        PersonWorkWorkflow::updateAll(['w_del'=>0],'w_id = '.$id);
        return $this->redirect(['index','menutype'=>intval($_GET['menutype'])]);
    }

    /*
     * 催办
     * @param $id
     */
    public function actionCuiban($id){
        if($id == '') return false;
        $data = Personwork::getPersonWorkInfo($id);
        $_data = PersonWorkWorkflow::find()->where(['w_p_id'=>$id])->asArray()->orderBy('w_id desc')->one();
        $status = $_data['w_s_status'];
        $w_person_id = $_data['w_person_id'];
        $w_person_key = $_data['w_person_key'];
        $type = '';
        $ids = "";
        if($status == '未受理'){
            $type = 'sl';
            $wsl = PersonWorkWorkflow::find()->select('w_person_id')->where(['w_p_id'=>$id,'w_s_status'=>'未受理','w_e_status'=>'无'])->asArray()->orderBy('w_id desc')->all();
           // print_r(PersonWorkWorkflow::find()->select('w_person_id')->where(['w_p_id'=>$id,'w_s_status'=>'未受理','w_e_status'=>'无'])->asArray()->orderBy('w_id desc')->createCommand()->getRawSql());exit;
            $wsl = array_unique(array_column($wsl,'w_person_id'));
            $wsl = implode(',',$wsl);
            $ids = $wsl;
        }elseif($status == '未审批'){
            $type = 'sp';
            $ids = $w_person_id;
        }
        Message::sendMsg('催办',Yii::$app->user->identity->name.'的工作【'.$data['p_title'].'】需要您'.($type=='sl'?'受理':'审批'),$ids,['personwork/personwork/'.$type,'menutype'=>1,'id'=>$data['p_id'],'api_url' => "index.php/personwork/view?id=".$data['p_id']]);
        return $this->redirect(['index','menutype'=>5]);
    }

    /*
     * 受理
     * @param $id、
     */
    public function actionSl($id){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /*
     * 受理代办
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSldb($id,$w_type,$db_id){
        if($id == '' || $w_type == '' || $db_id==''){
            echo json_encode(array('status'=>'error','msg'=>'代办失败！参数不完整'));
            exit();
        }
        if($data = PersonWorkWorkflow::find()->where(['w_p_id'=>$id,'w_person_id'=>Yii::$app->user->identity->id,'w_type'=>$w_type])->asArray()->orderBy('w_id desc')->one()){
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
                $model_workflow->w_y_slr = Yii::$app->user->identity->id;
                $model_workflow->isNewRecord;
                $model_workflow->save();
                $transaction->commit();
                $info= Personwork::getPersonWorkInfo($data['w_p_id']);
                $name = User::getNames($info['p_fsq']);
                //Message::sendMsg('代办',Yii::$app->user->identity->name.'的工作【'.$info['p_title'].'】需要您代办',$db_id,['personwork/personwork/sl','menutype'=>2,'id'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=". $info['p_id']]);

                echo json_encode(array('status'=>'success','msg'=>'选择代办成功'));
                exit();
                return $this->redirect(['index','menutype'=>intval($_GET['menutype'])]);
            }catch(Exception $e)
            {
                $transaction->rollBack();
                print_r($e->getMessage());exit;
                exit();
            }
        }
    }

    /*
     * 受理退办
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSltb($id,$w_type,$cancel_details){
        if($id == '' || $w_type == '' || $cancel_details==''){
            echo json_encode(array('status'=>'error','msg'=>'退办失败！参数不完整'));
            exit();
        }
        $cancel_length = mb_strlen($cancel_details, 'UTF-8');
        if($cancel_length > 150){
            echo json_encode(array('status'=>'error','msg'=>'退办原因不能大于150个字符！'));
            exit();
        }

        if($data = PersonWorkWorkflow::find()->where(['w_p_id'=>$id,'w_person_id'=>Yii::$app->user->identity->id,'w_type'=>$w_type])->asArray()->orderBy('w_id desc')->one()){

            $db = \Yii::$app->db;
            $transaction=$db->beginTransaction();
            try
            {
                $cancel_detail = $cancel_details;
                $db = \Yii::$app->db;
                $db->createCommand('update {{person_work_workflow}} set w_e_time="'.date('Y-m-d H:i:s',time()).'",w_e_status="退办",w_cancel_details="'.$cancel_detail.'"  where w_id ='.$data['w_id'])->execute(); //修改原来记录
                $db->createCommand('update {{person_work}} set p_cancel_detail="'.$cancel_detail.'" where p_id='.$id)->execute(); //修改原来记录


                $info= Personwork::getPersonWorkInfo($data['w_p_id']);
                //Message::sendMsg('受理',Yii::$app->user->identity->name.'退办了【'.$info['p_title'].'】 退办原因:'.$cancel_detail,$info['p_fsq'],['personwork/personwork/view','menutype'=>3,'id'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=".$info['p_id']]);


                $transaction->commit();
                echo json_encode(array('status'=>'success','msg'=>'退办成功'));
                exit();
                return $this->redirect(['index','menutype'=>intval($_GET['menutype'])]);
            }catch(Exception $e)
            {
                $transaction->rollBack();
                print_r($e->getMessage());exit;
                exit();
            }
        }
    }

    /*
     * 受理完成
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSlwc($id,$w_type){
        if($id == '' || $w_type == '') return false;
        if($data = PersonWorkWorkflow::find()->where(['w_p_id'=>$id,'w_person_id'=>Yii::$app->user->identity->id,'w_type'=>$w_type])->asArray()->orderBy('w_id desc')->one()){
            $db = \Yii::$app->db;
            $transaction=$db->beginTransaction();
            try
            {
                $db = \Yii::$app->db;
                $db->createCommand('update {{person_work_workflow}} set w_e_time="'.date('Y-m-d H:i:s',time()).'",w_e_status="完成"  where w_id ='.$data['w_id'])->execute(); //修改原来记录


                $info= Personwork::getPersonWorkInfo($data['w_p_id']);
                //Message::sendMsg('受理',Yii::$app->user->identity->name.'完成了【'.$info['p_title'].'】',$info['p_fsq'],['personwork/personwork/view','menutype'=>5,'id'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=".$info['p_id']]);

                $transaction->commit();
                return $this->redirect(['index','menutype'=>intval($_GET['menutype'])]);
            }catch(Exception $e)
            {
                $transaction->rollBack();
                exit();
            }
        }
    }


    /*
     * 审批
     * @param $id、
     */
    public function actionSp($id){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /*
     * 审批驳回
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSpbh($id,$w_type,$cancel_details){
        if($id == '' || $w_type == '' || $cancel_details==''){
            echo json_encode(array('status'=>'error','msg'=>'驳回失败！参数不完整'));
            exit();
        }
        if($data = PersonWorkWorkflow::find()->where(['w_p_id'=>$id,'w_person_id'=>Yii::$app->user->identity->id,'w_type'=>$w_type])->asArray()->orderBy('w_id desc')->one()){
            $db = \Yii::$app->db;
            $transaction=$db->beginTransaction();
            try
            {
                $cancel_detail = $cancel_details;
                $db = \Yii::$app->db;
                $db->createCommand('update {{person_work_workflow}} set w_e_time="'.date('Y-m-d H:i:s',time()).'",w_e_status="驳回",w_cancel_details="'.$cancel_detail.'"  where w_id ='.$data['w_id'])->execute(); //修改原来记录
                $db->createCommand('update {{person_work}} set p_cancel_detail="'.$cancel_detail.'" where p_id='.$id)->execute(); //修改原来记录

                $info= Personwork::getPersonWorkInfo($data['w_p_id']);
                Message::sendMsg('审批',Yii::$app->user->identity->name.'驳回了【'.$info['p_title'].'】',$info['p_fsq'],['personwork/personwork/view','menutype'=>5,'id'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=".$info['p_id']]);


                $transaction->commit();
                echo json_encode(array('status'=>'success','msg'=>'驳回成功'));
                exit();
                return $this->redirect(['index','menutype'=>intval($_GET['menutype'])]);
            }catch(Exception $e)
            {
                $transaction->rollBack();
                print_r($e->getMessage());exit;
                exit();
            }
        }
    }

    /*
     * 审批同意
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSpty($id,$w_type){
        if($id == '' || $w_type == '') return false;
        if($data = PersonWorkWorkflow::find()->where(['w_p_id'=>$id,'w_person_id'=>Yii::$app->user->identity->id,'w_type'=>$w_type])->asArray()->orderBy('w_id desc')->one()){
            $db = \Yii::$app->db;
            $transaction=$db->beginTransaction();
            try
            {

                $model_workflow = new PersonWorkWorkflow();
                $db = \Yii::$app->db;
                $db->createCommand('update {{person_work_workflow}} set w_e_time="'.date('Y-m-d H:i:s',time()).'",w_e_status="同意"  where w_id ='.$data['w_id'])->execute(); //修改原来记录

                $next_id = PersonWork::getNextPerson($id,$data['w_person_key'],'p_spr');
                if($next_id == -1){ //已经是最后一位审批人 转到受理人
                    $PersonWork = PersonWork::find()->where(['p_id'=>$data['w_p_id']])->asArray()->one();
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

                    $info= Personwork::getPersonWorkInfo($data['w_p_id']);
                    //Message::sendMsg('受理',Yii::$app->user->identity->name.'的《'.$info['p_title'].'》需要您受理',$PersonWork['p_y_slr'],['personwork/personwork/sl','menutype'=>1,'id'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=".$info['p_id']]);
                    //Message::sendMsg('受理',Yii::$app->user->identity->name.'同意了【'.$info['p_title'].'】',$info['p_fsq'],['personwork/personwork/view','menutype'=>5,'id'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=".$info['p_id']]);

                }else{ //选择下一个审批人 继续往下执行审批流程
                    $model_workflow->w_p_id = $data['w_p_id'];
                    $model_workflow->w_person_id = $next_id;
                    $model_workflow->w_person_key = ++$data['w_person_key'];
                    $model_workflow->w_s_time = date('Y-m-d H:i:s',time());
                    $model_workflow->w_s_status = '未审批';
                    $model_workflow->w_type = '普通';
                    $model_workflow->isNewRecord;
                    $model_workflow->save();

                    $info= Personwork::getPersonWorkInfo($data['w_p_id']);
                    Message::sendMsg('审批',Yii::$app->user->identity->name.'的【'.$info['p_title'].'】需要你审批',$next_id,['personwork/personwork/sp','menutype'=>1,'id'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=".$info['p_id']]);
                    Message::sendMsg('审批',Yii::$app->user->identity->name.'同意了【'.$info['p_title'].'】',$info['p_fsq'],['personwork/personwork/view','menutype'=>5,'id'=>$info['p_id'],'api_url' => "index.php/personwork/view?id=".$info['p_id']]);


                }
                $transaction->commit();
                return $this->redirect(['index','menutype'=>intval($_GET['menutype'])]);
            }catch(Exception $e)
            {
                $transaction->rollBack();
                exit();
            }
        }
    }

    /**
     * Finds the Personwork model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Personwork the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonWork::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
