<?php

namespace backend\modules\chuchai\controllers;

use backend\controllers\CommonController;
use backend\functions\functions;
use Yii;
use backend\modules\chuchai\models\Chuchai;
use backend\modules\chuchai\models\ChuchaiSearch;
use backend\modules\gongchu\models\Gongchu;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\message\models\Message;

/**
 * ChuchaiController implements the CRUD actions for Chuchai model.
 */
class ChuchaiController extends CommonController
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
     * Lists all Chuchai models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChuchaiSearch();
        $userId=Yii::$app->user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$userId);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Chuchai model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $mods=$this->findModel($id);
        $mods->dept=!empty($model->dept) ? Gongchu::getDeptNameById($model->dept) :'';
        $mods->cc_ren=!empty($model->cc_ren) ? Gongchu::getUserNamesByIds($model->cc_ren) :'';
        $mods->apply_ren=!empty($model->apply_ren) ? Gongchu::getUserNamesByIds($model->apply_ren) :'';
        $mods->apply_time=substr($model->apply_time,0,-3);
        if($model->dept_audit==0){//审批中 状态 不加审批时间 驳回理由
            $mods->dept_leader=Gongchu::getUserNamesByIds($model->dept_leader).'('.Gongchu::getStatusById($model->dept_audit).')';
        }else{
            $mods->dept_leader=Gongchu::getUserNamesByIds($model->dept_leader).'('.Gongchu::getStatusById($model->dept_audit).') '.$model->dept_reason.' '.substr($model->dept_audit_time,0,-3);
        }
        if($model->dept_audit==2){//如果科室领导驳回，则院领导直接显示名字即可
            $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader);
            $mods->chief=Gongchu::getUserNamesByIds($model->chief);
        }else{
            if($model->branch_audit==0){//审批中 状态 不加审批时间 驳回理由
                $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader).'('.Gongchu::getStatusById($model->branch_audit).')';
            }else{
                $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader).'('.Gongchu::getStatusById($model->branch_audit).') '.$model->branch_reason.' '.substr($model->branch_audit_time,0,-3);
            }
            if($model->chief_audit==0){
                $mods->chief=Gongchu::getUserNamesByIds($model->chief).'('.Gongchu::getStatusById($model->chief_audit).')';
            }else{
                $mods->chief=Gongchu::getUserNamesByIds($model->chief).'('.Gongchu::getStatusById($model->chief_audit).') '.$model->chief_reason.' '.substr($model->chief_audit_time,0,-3);
            }
        }
        if($model->branch_audit==2){
            $mods->chief=Gongchu::getUserNamesByIds($model->chief);
        }else{
            if($model->chief_audit==0){
                $mods->chief=Gongchu::getUserNamesByIds($model->chief).'('.Gongchu::getStatusById($model->chief_audit).')';
            }else{
                $mods->chief=Gongchu::getUserNamesByIds($model->chief).'('.Gongchu::getStatusById($model->chief_audit).') '.$model->chief_reason.' '.substr($model->chief_audit_time,0,-3);
            }
            if($model->dept_audit==2){
                $mods->branch_leader=Gongchu::getUserNamesByIds($model->branch_leader);
                $mods->chief=Gongchu::getUserNamesByIds($model->chief);
            }
        }
        if($model->dept_leader==0){
            $mods->dept_leader=0;
        }
        if($model->branch_leader==0){
            $mods->branch_leader=0;
        }
        return $this->render('view', [
            'model' => $mods,
        ]);
    }

    /**
     * Creates a new Chuchai model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Chuchai();
        $deptAuditors=Gongchu::getDeptAuditors(113);//获取有出差申请审核权限的部门人员信息 参数为：menuid
        $deptUsers=Gongchu::getDeptNames();
        $userId=Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            $model->chuchairen=$_POST['chuchairens'];
            $model->branch_leader=$_POST['Chuchai']['branch_leader'];
            $model->apply_ren=$_POST['Chuchai']['apply_ren'];
            $model->chief=$_POST['Chuchai']['chief'];
            $model->audit_status=0;//发起申请，默认审核状态为未审核
            if($model->dept_leader==$userId){
                $model->dept_leader=0;
                $model->dept_audit=1;//如果为用户本身为科室领导，则更新科室状态为审批同意，方便下级审核审核
                $jsr=$model->branch_leader;
                $type='branch';
            }elseif($model->branch_leader==$userId){
                $model->dept_leader=0;
                $model->dept_audit=1;//如果为用户本身为科室领导，则更新科室状态为审批同意，方便下级审核审核
                $model->branch_leader=0;
                $model->branch_audit=1;//如果为用户本身为院领导，则更新科室状态为审批同意，方便下级审核审核
                $jsr=$model->chief;
                $type='chief';
            }else{
                $jsr=$model->dept_leader;
                $type='dept';
            }

            if($model->save(false)){
                Message::sendMsg('出差申请',Yii::$app->user->identity->username.'发起了一个出差申请',$jsr,['chuchai/audit/update','id'=>$model->id,'type'=>$type,'api_url' => "index.php/chuchai/view?id=".$model->id]);
                return $this->redirect(['index']);
            }else{
                functions::alert('申请失败');
            }

        } else {
            return $this->render('create', [
                'deptUsers'=>$deptUsers,
                'deptAuditors'=>$deptAuditors,
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Chuchai model.
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
     * Deletes an existing Chuchai model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //更新删除状态
        $model=$this->findModel($id);
        $model->setAttribute('user_delete',1);//逻辑删除
        $model->save(false);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Chuchai model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Chuchai the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chuchai::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
