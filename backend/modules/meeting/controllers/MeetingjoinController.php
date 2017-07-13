<?php

namespace backend\modules\meeting\controllers;

use backend\controllers\CommonController;
use backend\modules\meeting\models\MeetJoin;
use Yii;
use backend\modules\meeting\models\Meeting;
use backend\modules\meeting\models\MeetingjoinSearch;
use backend\modules\gongchu\models\Gongchu;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MeetjoinController implements the CRUD actions for Meeting model.
 */
class MeetingjoinController extends CommonController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Meeting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MeetingjoinSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Meeting model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=Meeting::findOne($id);
        $model->initiator=Gongchu::getUserNamesByIds($model->initiator);//发起人
        $model->initiate_dept=Gongchu::getDeptNameById($model->initiate_dept);
        $model->initiate_time=substr($model->initiate_time,0,-3);
        $model->start_time=substr($model->start_time,0,-3);
        $model->end_time=substr($model->end_time,0,-3);
        $userId=Yii::$app->user->id;
        $query=MeetJoin::find()->where('meetid=:meetid',[":meetid"=>$id])->asArray()->all();
        $joinArr=array();
        $allRen=array();
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
        $model->hosts=substr($hostStr,0,-1);
        $model->join_ren=substr($joinrenStr,0,-1);
        if(in_array($userId,$allRen)){
            $meetJoin=MeetJoin::find()->select('id')->where("meetid=:meetid and join_ren=:join_ren",[':meetid'=>$id,':join_ren'=>$userId])->asArray()->one();
            $meetJoins=MeetJoin::findOne($meetJoin['id']);
            $meetJoins->status=1;//已查阅状态
            $meetJoins->save();
        }
        $status=array();
        foreach($query as $v){
            $status[$v['join_ren']]=$v['status'];
        }
        $viewStatus=array();
        foreach($status as $ks=>$vs){
            $name=Gongchu::getUserNamesByIds($ks);
            $sta=$vs==1?'已查阅':'未查阅';
            $viewStatus[$name]=$sta;
        }
        return $this->render('view', [
            'model' => $model,
            'status'=>$viewStatus,
        ]);
    }

    //附件下载
    public function actionDown($id){
        $attachment=$this->findModel($id)->attachment;
        $attachments = iconv('utf-8','gb2312' ,$attachment );
        $filename=Yii::$app->params['upload_file'].'/meeting_attachment/'.$attachments;
        $filepath = str_replace('\\', '/', realpath($filename));
        $filesize = filesize($filepath);
        $filename = substr(strrchr('/'.$filepath, '/'), 1);
        $extension = strtolower(substr(strrchr($filepath, '.'), 1));
        // use this unless you want to find the mime type based on extension,文件后缀格式,不解释.
        $mime = array('application/octet-stream');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: '.sprintf('%d', $filesize));
        header('Expires: 0');
        if (isset($_SERVER['HTTP_USER_AGENT']) &&((strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)))
        {
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
        }
        else
        {
            header('Pragma: no-cache');
        }
        $handle = fopen($filepath, 'rb');
        fpassthru($handle);
        fclose($handle);
    }
    /**
     * Creates a new Meeting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Meeting();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Meeting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Meeting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=new MeetJoin();
        $result=$model->find()->select('id')->where('meetid=:meetid and join_ren=:join_ren',[':meetid'=>$id,':join_ren'=>Yii::$app->user->id])->asArray()->one();
        $mods=MeetJoin::findOne($result['id']);
        $mods->isdelete=1;
        if($mods->save()){
            return $this->redirect(['index']);
        }else{
            $mods->getErrors();
        }
    }

    /**
     * Finds the Meeting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Meeting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Meeting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
