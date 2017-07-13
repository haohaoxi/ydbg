<?php

namespace backend\modules\kaoqinquery\controllers;

use backend\controllers\CommonController;
use Yii;
use backend\modules\kaoqinquery\models\KaoqinMonth;
use backend\modules\kaoqinquery\models\KaoqinmonthSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
use backend\functions\functions;

/**
 * KaoqinmonthController implements the CRUD actions for KaoqinMonth model.
 */
class KaoqinmonthController extends CommonController
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
     * Lists all KaoqinMonth models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KaoqinmonthSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KaoqinMonth model.
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
     * Creates a new KaoqinMonth model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model =new KaoqinMonth();
        if(isset($_POST['import'])){
            if(!empty($_FILES['excel']['name'])){
                $file = UploadedFile::getInstanceByName('excel');
                if(!$file->name){
                    functions::alert('文件不能为空！');
                }
                if(!in_array($file->extension,['xls','xlsx'])){
//                functions::alert('文件后缀名必须为xls,xlsx！');
                    functions::alert('请上传excel格式文件！');
                }

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
//                $objPHPExcel=$objReader->load($excel_file);
                $objPHPExcel = PHPExcel_IOFactory::load($excel_file);//改成这个写法就好了 20160613 Bob 防止假文件上传失败
                $objWorksheet=$objPHPExcel->getActiveSheet();
                $highestRow=$objWorksheet->getHighestRow();
                $highestColumn=$objWorksheet->getHighestColumn();
                $highestColumnIndex=PHPExcel_Cell::columnIndexFromString($highestColumn)-1;
                $excelData=array();
                $execlDataTitle=array();
                for($colt=1;$colt<=$highestColumnIndex;++$colt){
                    $execlDataTitle[]=$objWorksheet->getCellByColumnAndRow($colt,1)->getValue();
                }
                if(!empty($execlDataTitle)){
                    if(($execlDataTitle[0]!='部门' || $execlDataTitle[1]!='工号' || $execlDataTitle[2]!='卡号')){
                        functions::alert('导入失败!请检查上传的模板是否正确');
                    }
                }else{
                    functions::alert('导入失败!请检查上传的模板是否正确');
                }
                for($row=2;$row<=$highestRow;$row++){
                    for($col=1;$col<=$highestColumnIndex;++$col){
                        if($col==5){//日期格式处理
                            $kaoqinDate=$objWorksheet->getCellByColumnAndRow($col,$row)->getValue();
                            if(!strstr($kaoqinDate,'-')) {
                                $excelData[$row][$col-1] = date('Y-m-d',($kaoqinDate - 25569) * 24*60*60);
                            }else{
                                $excelData[$row][$col-1] = $kaoqinDate;
                            }
                        }else{
                            $excelData[$row][]=$objWorksheet->getCellByColumnAndRow($col,$row)->getValue();
                        }
                    }
                }
                $db = \Yii::$app->db;
                $transaction=$db->beginTransaction();
                try
                {
                    $model = new KaoqinMonth();
                    $Attributes = $model->getAttributes();
                    unset($Attributes['id']);
                    unset($Attributes['uploader']);
                    if(!empty($excelData)){
                        foreach($excelData as $value){
                            if(!empty($value[1])){//工号不为空
                                $k = 0;
                                foreach($Attributes as $key=>$v){
                                    $model->$key = (string)$value[$k];
                                    $k++;
                                }
                                $model->isNewRecord = true;
                                $model->uploader=Yii::$app->user->id;//添加上传者
                                if($model->insert()){
                                    $model->id = 0;
                                }else{
                                    $transaction->rollBack();
                                    functions::alert('导入失败!');
                                }
                            }
                        }
                        $transaction->commit();
                    }else{
                        functions::alert('导入为空，导入失败！');
                    }
                }catch(Exception $e)
                {
                    $transaction->rollBack();
                    print_r($e->getMessage());
                    exit();
                }
                functions::alert('导入成功！',Yii::$app->urlManager->createUrl(['/kaoqinquery/kaoqinmonth/index']));
            }else{
                functions::alert('请选择上传文件！');
            }
        }else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing KaoqinMonth model.
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
     * Deletes an existing KaoqinMonth model.
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
     * Finds the KaoqinMonth model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KaoqinMonth the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KaoqinMonth::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
