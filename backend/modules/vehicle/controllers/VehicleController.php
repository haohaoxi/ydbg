<?php

namespace backend\modules\vehicle\controllers;

use backend\controllers\CommonController;
use Yii;
use backend\modules\vehicle\models\Vehicle;
use backend\modules\vehicle\models\VehicleType;
use backend\modules\vehicle\models\VehicleSearch;
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
use scotthuangzl\export2excel\Export2ExcelBehavior;

/**
 * VehicleController implements the CRUD actions for Vehicle model.
 */
class VehicleController extends CommonController
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
     * Lists all Vehicle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VehicleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $vehicles=VehicleType::getVehicles();
        return $this->render('index', [
            'vehicles'=>$vehicles,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vehicle model.
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
     * Creates a new Vehicle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vehicle();
        $vehicles=VehicleType::getVehicles();
        if ($model->load(Yii::$app->request->post())) {
            $model->isdelete=0;
            $model->isreturn=1;
            if($model->save()){
                return $this->redirect(['index']);
            }else{
                functions::alert('新增车辆失败');
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'vehicles'=>$vehicles,
            ]);
        }
    }

    /**
     * Updates an existing Vehicle model.
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
     * 还车
     * @param $id 车辆id
     * @return mixed
     */
    public function actionRevehicle(){
        if(isset($_POST['vehicleid'])){
            $vehicle=Vehicle::findOne($_POST['vehicleid']);
            $vehicle->isreturn=$_POST['revehicle'];
            $vehicle->return_time=date('Y-m-d H:i:s',time());
            $vehicle->count=1;
            $vehicle->save();
        }
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Vehicle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->isdelete=1;
        $model->save(false);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Vehicle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vehicle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vehicle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return string 导入
     */
    public function actionImport(){
        $query=Vehicle::find()->distinct('v_license')->select('v_license')->asArray()->all();
        $vehicles=array();
        foreach($query as $v){
            $vehicles[]=$v['v_license'];
        }
        if(isset($_POST['import'])){
            if(!empty($_FILES['excel']['name'])){
                $file = UploadedFile::getInstanceByName('excel');
                if(!$file->name){
                    functions::alert('文件不能为空！');
                }
                if(!in_array($file->extension,['xls','xlsx'])){
                    functions::alert('文件后缀名必须为xls,xlsx！');
                }

                $preRand = time() . mt_rand(0, 99999);
                $excel_file = Yii::$app->params['upload_file'].'/excel/' . $preRand.'_'.iconv("UTF-8","gb2312", $file->name);
                if(!$file->saveAs($excel_file)){
                    functions::alert('excel上传失败！请重试！');
                }

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
                    if($execlDataTitle[0]!='车辆用途' || $execlDataTitle[11]!='省控办批审情况'){
                        functions::alert('导入失败!请检查上传的模板是否正确');
                    }
                }else{
                    functions::alert('导入失败!请检查上传的模板是否正确');
                }
                for($row=2;$row<=$highestRow;$row++){
                    for($col=1;$col<=$highestColumnIndex;++$col){
                        //根据车牌号去重
                        $v_lience=$objWorksheet->getCellByColumnAndRow(4,$row)->getValue();
                        if(in_array($v_lience,$vehicles)){
                            continue;
                        }
                        if($col==6){//日期格式处理
                            $registDate=$objWorksheet->getCellByColumnAndRow(6,$row)->getValue();
                            if(!strstr($registDate,'-')) {
                                $excelData[$row][5] = date('Y-m-d',($registDate - 25569) * 24*60*60);
                            }else{
                                $excelData[$row][5] = $registDate;
                            }
                        }else{
                            $excelData[$row][]=$objWorksheet->getCellByColumnAndRow($col,$row)->getValue();
                        }
                    }
                }
                if(!empty($excelData)){
                    $count=count($excelData);
                    $db = \Yii::$app->db;
                    $transaction=$db->beginTransaction();
                    try
                    {
                        $model = new Vehicle();
                        $Attributes = $model->getAttributes();
                        unset($Attributes['id']);
                        foreach($excelData as $value){
                            if(!empty($value[0])){
                                $k = 0;
                                foreach($Attributes as $key=>$v){
                                    if($k==6){
                                        $type=VehicleType::getVehicleIdByName($value[$k]);
                                        $model->$key=$type;
                                    }elseif($k<12){
                                        $model->$key = (string)$value[$k];
                                    }
                                    $k++;
                                }
                                $model->isdelete=0;
                                $model->isreturn=1;
                                $model->isNewRecord = true;
                                if($model->insert()){
                                    $model->id = 0;
                                }else{
                                    $transaction->rollBack();
                                    functions::alert('导入失败!请检查上传的模板是否正确');
                                }
                            }
                        }
                        $transaction->commit();
                    }catch(Exception $e)
                    {
                        $transaction->rollBack();
                        print_r($e->getMessage());
                        exit();
                    }
                    functions::alert("导入{$count}条成功！",Yii::$app->urlManager->createUrl(['/vehicle/vehicle/index']));
                }else{
                    functions::alert('导入为空或数据重复，导入失败！');
                }
            }else{
                functions::alert('请选择上传文件！');
            }
        }else{
            return $this->render('import');
        }
    }

    /**
     * 导出
     */
    public function actionExport(){
        $vehicle = new Vehicle();
        $data = $vehicle->find()->asArray()->all();
        foreach($data as $key=> $val){
            $data[$key]['v_type'] = VehicleType::getVehicleNameById($val['v_type']);
        }

        $excel_title = array('序号','车辆用途','单位名称','组织机构代码证','车牌号','机动车登记证书编号','车辆登记日期','汽车分类','规格型号','排量','数量','金额（万元）','省控办批审情况');
        foreach($data as $key=>$value){
            $excel_ceils[] = array($key+1,$value['v_usage'],$value['dept'],$value['code_no'],$value['v_license'],$value['regist_no'],$value['regist_date'],
                $value['v_type'],$value['xinghao'],$value['pailiang'],$value['count'],$value['money'],$value['audit']);
        }
        $excel_content = array(
            array(
                'sheet_name' => '用车信息',
                'sheet_title' => $excel_title,
                'ceils' => $excel_ceils,
                'freezePane' => 'B2',
            ),
        );
        $excel_file = "export_Excel";
        $this->export2excel($excel_content, $excel_file);
    }
}