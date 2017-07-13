<?php

namespace backend\modules\wages\controllers;

use backend\controllers\CommonController;
use backend\functions\functions;
use Yii;
use backend\modules\wages\models\Wages;
use backend\modules\wages\models\WagesSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use scotthuangzl\export2excel\Export2ExcelBehavior;
use yii\web\UploadedFile;
use \PHPExcel;
use \PHPExcel_IOFactory;
use \PHPExcel_Settings;
use \PHPExcel_Style_Fill;
use \PHPExcel_Writer_IWriter;
use \PHPExcel_Worksheet;
use \PHPExcel_Style;
use \PHPExcel_Cell;
use \PHPExcel_Shared_Date;
/**
 * WagesController implements the CRUD actions for Wages model.
 */
class WagesController extends CommonController
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
            'export2excel' => [
                'class' => Export2ExcelBehavior::className(),
                'prefixStr' => !Yii::$app->user->isGuest ? Yii::$app->user->identity->username : '',
                'suffixStr' => date('Ymd-His'),
            ],
        ];
    }

    public function actions()
    {
        return [
            'download' => [
                'class' => 'scotthuangzl\export2excel\DownloadAction',
            ],
        ];
    }

    /**
     * Lists all Wages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Wages model.
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
     * Creates a new Wages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Wages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Wages model.
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
     * Deletes an existing Wages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionLoadexcel() {
        if(isset($_POST['import'])) {
            if(!empty($_FILES['excel']['name'])){
                $file = UploadedFile::getInstanceByName('excel');
                if(!$file->name){
                    functions::alert('文件不能为空！');
                }
                if(!in_array($file->extension,['xls','xlsx'])){
                    functions::alert('文件后缀名必须为xls,xlsx！');
                }
//            if($file->type != 'application/vnd.ms-excel'){
//                functions::alert('请上传正确格式的文件！');
//            }

                $preRand = time() . mt_rand(0, 99999);
                $excel_file = Yii::$app->params['upload_file'].'/excel/' . $preRand.'_'.iconv("UTF-8","gb2312", $file->name);
                if(!$file->saveAs($excel_file)){
                    functions::alert('excel上传失败！请重试！');
                }
                //  $excel_file = iconv("gb2312","UTF-8", $excel_file);

                if (!file_exists($excel_file)) {
                    functions::alert('未找到excel文件！');
                }

                //判断后缀 为xlsx 则是 Excel2007 否则 Excel5
                $extension = $file->extension == 'xls' ? 'Excel5' : 'Excel2007';
                $objReader=PHPExcel_IOFactory::createReader($extension);
                $objReader->setReadDataOnly(true);
//            $objPHPExcel=$objReader->load($excel_file);
                $objPHPExcel = PHPExcel_IOFactory::load($excel_file);//改成这个写法就好了 20160613 Bob 防止假文件上传失败
                $objWorksheet=$objPHPExcel->getActiveSheet();
                $highestRow=$objWorksheet->getHighestRow();
                $highestColumn=$objWorksheet->getHighestColumn();
                $highestColumnIndex=PHPExcel_Cell::columnIndexFromString($highestColumn)-1;
                $excelData=array();
                /* start 判断模板是否正确*/
                $execlDataTitle=array();
                if($highestColumnIndex==0){
                    functions::alert('导入失败!请以给定的模板进行导入');
                }
                for($colt=0;$colt<=$highestColumnIndex;++$colt){
                    $execlDataTitle[]=$objWorksheet->getCellByColumnAndRow($colt,1)->getValue();
                }
                if(!empty($execlDataTitle)){
                    array_pop($execlDataTitle);//去掉数组的最后一个空值
                    if(($execlDataTitle[0]!='日期')){
                        functions::alert('导入失败!请检查上传的模板是否正确');
                    }
                }else{
                    functions::alert('导入失败!请检查上传的文件模板是否正确');
                }
                /* end 判断模板是否正确*/
                for($row=2;$row<=$highestRow;++$row){
                    for($col=0;$col<=$highestColumnIndex;++$col){
                        if($col=='A'){
                            $excelData[$row][] = gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow($col,$row)->getValue()));
                        }else{
                            $excelData[$row][]=$objWorksheet->getCellByColumnAndRow($col,$row)->getValue();
                        }
                    }
                }


                $db = \Yii::$app->db;
                $transaction=$db->beginTransaction();
                try
                {
                    $model = new Wages();
                    $Attributes = $model->getAttributes();
                    unset($Attributes['id']);
                    foreach($excelData as $value){
                        $k = 0;
                        foreach($Attributes as $key=>$v){
                            $model->$key = (string)$value[$k];
                            $k++;
                        }

                        $where = "number = ".$model->getAttribute('number')." and left (`time`,7) = '".substr($model->getAttribute('time'),0,7)."'";
                        if($model->find()->where($where)->one()){
                            functions::alert('日期:'.substr($model->getAttribute('time'),0,7).' 人员编号:'.$model->getAttribute('number').'已存在 请修改后倒入！');
                        }

                        //print_r($model->getAttributes());
                        //print_r($where);

                        $model->isNewRecord = true;
                        if($model->insert()){
                            $model->id = 0;
                        }else{
                            // print_r($model->getErrors());exit;
                            $transaction->rollBack();
                            functions::alert('导入失败!请检查excel文件格式后重试');
                        }
                    }
                    $transaction->commit();
                }catch(Exception $e)
                {
                    $transaction->rollBack();
                    print_r($e->getMessage());
                    exit();
                }
                functions::alert('导入成功！',Yii::$app->urlManager->createUrl(['wages/wages/index']));
            }else{
                functions::alert('请选择上传文件！');
            }
        }else{
            return $this->render('loadexcel');
        }
    }


    /**
     * Finds the Wages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
