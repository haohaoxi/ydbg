<?php

namespace backend\modules\news\controllers;

use backend\controllers\CommonController;
use Yii;
use backend\modules\news\models\News;
use backend\modules\news\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\user\models\User;
use yii\web\UploadedFile;
use backend\functions\functions;
use backend\modules\news\modelsFeature\NewsFeature;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends CommonController
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
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
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate()
    {
        $model = new News();
        $model->author = Yii::$app->user->identity->name;
        $model->pubdate = date("Y-m-d H:i:s",time());

        if ($model->load(Yii::$app->request->post())) {
            $upload = UploadedFile::getInstance($model, 'attachment');
            if(isset($upload)){
                $filesize = $upload->size;
                if($filesize == 0){
                    functions::alert('上传文件内容不能为空');
                }
                if($filesize>(10*1024*1024)){
                    $mas = "上传文件大于10M.请重新上传";
                    functions::alert("$mas");
                }
//                $file_name = $News->rname($upload);
                $file_name = iconv('utf-8','gb2312',$upload->name);
                $extensions = strtolower(substr(strrchr($file_name, '.'), 1));//大写转小写（L）
                //上传文件类型
                if($extensions == 'doc' || $extensions == 'pdf' || $extensions == 'docx' || $extensions == 'txt') {
                    $rPath = Yii::getAlias('@backend') . "/web/upload/news/" . date('Ymd') . "/";
                    if (!file_exists($rPath)) {
                        mkdir($rPath, 0777, true);
                    }
                    if ($upload->saveAs($rPath . $file_name)) {
                        $url = $rPath . $file_name;
                    } else {
                        exit('上传文件失败');
                    }
                }else{
                    functions::alert('上传文件类型错误！');
                }
            }
            if(isset($url)){
                $model->attachment = $upload->name;
            }
            if($model->save()){
                return $this->redirect(['index', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $attachment = $model->attachment;
        $name = Yii::$app->user->identity->name;

        if ($model->load(Yii::$app->request->post())) {
            $upload = UploadedFile::getInstance($model, 'attachment');
            if(isset($upload)){
                $filesize = $upload->size;
                if($filesize == 0){
                    functions::alert('上传文件内容不能为空');
                }
                if($filesize>(10*1024*1024)){
                    $mas = "上传文件大于10M.请重新上传";
                    functions::alert("$mas");
                }
//                $file_name = $News->rname($upload);
                $file_name = iconv('utf-8','gb2312' ,$upload->name );
                $extensions = strtolower(substr(strrchr($file_name, '.'), 1));//大写转小写（L）
                //上传文件类型
                if($extensions == 'doc' || $extensions == 'pdf' || $extensions == 'docx' || $extensions == 'txt') {
                    $rPath = Yii::getAlias('@backend') . "/web/upload/news/" . date('Ymd') . "/";
                    if (!file_exists($rPath)) {
                        mkdir($rPath, 0777, true);
                    }
                    if ($upload->saveAs($rPath . $file_name)) {
                        $url = $rPath . $file_name;
                    } else {
                        exit('上传文件失败');
                    }
                }else{
                    functions::alert('上传文件类型错误！');
                }
            }else{
                $model->attachment =$attachment;
            }
            if(isset($url)){
                $model->attachment = $upload->name;
            }
//            print_r($model->save());die;
            if($model->save()){
                return $this->redirect(['index', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'name' => $name,
                'name' => $model->attachment,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
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
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //附件下载
    public function actionDown($id){
        $attachment=$this->findModel($id)->attachment;
        $attachments = iconv('utf-8','gb2312' ,$attachment);
        $filename='upload/news/'. date('Ymd') .'/'.$attachments;
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
}
