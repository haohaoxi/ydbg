<?php

namespace backend\modules\xxjxgl\controllers;

use backend\controllers\CommonController;
use Yii;
use backend\modules\xxjxgl\models\Xxjxgl;
use backend\modules\user\models\User;
use backend\modules\xxjxgl\models\XxjxglSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\functions\functions;
use backend\modules\xxjxgl\modelsFeature\XxjxglFeature;

/**
 * XxjxglController implements the CRUD actions for Xxjxgl model.
 */
class XxjxglController extends CommonController
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
     * Lists all Xxjxgl models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new XxjxglSearch();
        $model = new Xxjxgl();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' =>$model,
        ]);
    }

    /**
     * Displays a single Xxjxgl model.
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
     * Creates a new Xxjxgl model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public $_size = 10240;
    public function actionCreate()
    {
        $Xxjxgl = new XxjxglFeature();
        $model = new Xxjxgl();
        $model->name = Yii::$app->user->identity->name;
        $model->xx_date = date("Y-m-d H:i:s",time());
        if ($model->load(Yii::$app->request->post())) {
            //附件上传
            if(!empty($_FILES['Xxjxgl']['name']['fujian'])){
                $file = UploadedFile::getInstanceByName('Xxjxgl[fujian]');
                if(!$file->name){
                    functions::alert('文件不能为空！');
                }
                if($file->size > 10*1024*1024){
                    functions::alert('请上传10M内附件');
                }
                $names = iconv('utf-8','gb2312' ,$file->name);
                $extensions = strtolower(substr(strrchr($names, '.'), 1));//大写转小写（L）
                //上传文件类型
                if($extensions == 'doc' || $extensions == 'pdf' || $extensions == 'docx' || $extensions == 'txt'){
                $attfile = Yii::$app->params['upload_file'].'/xxjxgl/' . $names;
                if(!$file->saveAs($attfile)){
                    functions::alert('附件上传失败！请重试！');
                }
            }else{
                functions::alert('附件上传类型错误！');
            }
                $attachment=$file->name;
            }
            if(isset($attachment)){
                $model->fujian = $attachment;
            }
            if(!empty($_FILES['Xxjxgl']['name']['title_content'])){
                $files = UploadedFile::getInstanceByName('Xxjxgl[title_content]');

                if(!$files->name){
                    functions::alert('文件不能为空！');
                }
                if($files->size > 10*1024*1024){
                    functions::alert('请上传10M内附件');
                }
                $names = iconv('utf-8','gb2312' ,$files->name);
                $extensions = strtolower(substr(strrchr($names, '.'), 1));//大写转小写（L）
                //上传文件类型
                if($extensions == 'doc' || $extensions == 'pdf' || $extensions == 'docx' || $extensions == 'zip' || $extensions == 'rar' || $extensions == 'txt'){
                    $attfiles = Yii::$app->params['upload_file'].'/xxjxgls/' . $names;
                    if(!$files->saveAs($attfiles)){
                        functions::alert('相关法律法规上传失败！请重试！');
                    }
                }else{
                    functions::alert('相关法律法规上传文件类型错误！');
                }
                $title_content=$files->name;
            }
            if(isset($title_content)){
                $model->title_content = $title_content;
            }

            if($model->save()){
                return $this->redirect(['index', 'id' => $model->id]);
            }else{
               functions::alert('案件案例标题重复！');
            }
        }else {
            return $this->render('create', [
            'model' => $model,
            ]);
        }
    }
//    附件下载
    public function actionDown($id){
        $attachment= iconv('utf-8','gb2312' ,$this->findModel($id)->fujian);
        $filename=Yii::$app->params['upload_file'].'/xxjxgl/'.$attachment;
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

    public function actionDownfiles($id){
        $attachment= iconv('utf-8','gb2312' ,$this->findModel($id)->title_content);
        $filename=Yii::$app->params['upload_file'].'/xxjxgls/'.$attachment;
        $filepath = str_replace('\\', '/', realpath($filename));
        $filesize = filesize($filepath);
        $filename = substr(strrchr('/'.$filepath, '/'), 1);
        $extension = strtolower(substr(strrchr($filepath, '.'), 1));
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
     * Updates an existing Xxjxgl model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        /*LL
         *
         */
        $model = $this->findModel($id);

        $fujian = $model->fujian ;
        $title_content = $model->title_content;

        if ($model->load(Yii::$app->request->post())) {

            //附件修改
            $fujian_upload=UploadedFile::getInstance($model,'fujian');
            if($fujian_upload){
                if($fujian_upload->size > 10*1024*1024){
                    functions::alert('请上传10M内附件');
                }
                if($fujian_upload->name){
                    $fj_name = iconv('utf-8','gb2312' ,$fujian_upload->name);
                }
                $extensions = strtolower(substr(strrchr($fj_name, '.'), 1));//大写转小写（L）
                if ($extensions == 'doc' || $extensions == 'pdf' || $extensions == 'docx' || $extensions == 'txt') {
                    $attfile = Yii::$app->params['upload_file'] . '/xxjxgl/' . $fj_name;
                    if ($fujian_upload->saveAs($attfile)) {
                        $model->fujian = $fujian_upload->name;
                    }else{
                        functions::alert('附件上传失败！请重试！');
                    }
                }
            }else{
                $model->fujian = $fujian;
            }

            //相关法律修改
            $content_upload=UploadedFile::getInstance($model,'title_content');
            if($content_upload){
                if($content_upload->size > 10*1024*1024){
                    functions::alert('请上传10M内附件');
                }
                if($content_upload->name){
                    $content_name = iconv('utf-8','gb2312' ,$content_upload->name);
                }
                $extensions = strtolower(substr(strrchr($content_name, '.'), 1));//大写转小写（L）
                if($extensions == 'doc' || $extensions == 'pdf' || $extensions == 'docx' || $extensions == 'zip' || $extensions == 'rar' || $extensions == 'txt') {
                    $attfiles = Yii::$app->params['upload_file'] . '/xxjxgls/' . $content_name;
                    if ($content_upload->saveAs($attfiles)) {
                        $model->title_content = $content_upload->name;
                    }else{
                        functions::alert('附件上传失败！请重试！');
                    }
                }else{
                    functions::alert('相关法律法规上传文件类型错误');
                }
            }else{
                $model->title_content = $title_content;
            }


            if($model->save()) {
                return $this->redirect(['index']);
            }else{
                functions::alert('案件案例标题重复！');
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }

    }
    /**
     * Deletes an existing Xxjxgl model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Xxjxgl model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Xxjxgl the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Xxjxgl::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
