<?php

namespace backend\modules\peoplecontact\controllers;

use backend\functions\functions;
use Yii;
use backend\modules\peoplecontact\models\PeopleContact;
use backend\modules\peoplecontact\models\PeoplecontactSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use scotthuangzl\export2excel\Export2ExcelBehavior;
use yii\web\UploadedFile;
use backend\modules\position\models\Position;
/**
 * PeoplecontactController implements the CRUD actions for PeopleContact model.
 */
class PeoplecontactController extends Controller
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
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'download' => [
                'class' => 'scotthuangzl\export2excel\DownloadAction',
            ],
        ];
    }

    /**
     * Lists all PeopleContact models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PeoplecontactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $list = $searchModel->getDeptList();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'list'=>$list,

        ]);
    }

    /**
     * Displays a single PeopleContact model.
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
     * Creates a new PeopleContact model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PeopleContact();
        $searchModel = new PeoplecontactSearch();
        $list = $searchModel->getDeptList();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'list'=>$list,
            ]);
        }
    }

    /**
     * Updates an existing PeopleContact model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $searchModel = new PeoplecontactSearch();
        $list = $searchModel->getDeptList();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'list'=>$list,
            ]);
        }
    }

    /**
     * Deletes an existing PeopleContact model.
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
     * Finds the PeopleContact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PeopleContact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PeopleContact::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /*
     * 导出excel
    */
    public function actionExcel(){
        if(!isset($_SESSION['excel_people_sql'])) die('未找到查询条件');
        $sql = $_SESSION['excel_people_sql'];
        $excel_data = Export2ExcelBehavior::excelDataFormat(PeopleContact::findBySql($sql)->asArray()->all());
        $excel_title = $excel_data['excel_title'];
        $excel_title = ['序号','姓名','所属机构','行政职务','手机号码','外线1','外线2','内线'];
        $excel_ceils = $excel_data['excel_ceils'];
//        print_r($excel_ceils);exit;
        foreach ($excel_ceils as $key => &$value){
            $value[0] = $key+1;
            $value[3] = Position::getZhiwu($value[3]);
            $value[2] = PeopleContact::getdeptname($value[2]);
            unset($value[8]);
        }
        $excel_content = array(
            array(
                'sheet_name' => '人员通讯录',
                'sheet_title' => $excel_title,
                'ceils' => $excel_ceils,
                'freezePane' => 'A1',
                'headerColor' => Export2ExcelBehavior::getCssClass("header"),
                'headerColumnCssClass' => array(
                    'id' => Export2ExcelBehavior::getCssClass('blue'),
                    'Status_Description' => Export2ExcelBehavior::getCssClass('grey'),
                ), //define each column's cssClass for header line only.  You can set as blank.
                'oddCssClass' => Export2ExcelBehavior::getCssClass("odd"),
                'evenCssClass' => Export2ExcelBehavior::getCssClass("even"),
            ),
            array(
                'sheet_name' => 'Important Note',
                'sheet_title' => array("Important Note For Region Template"),
                'ceils' => array(
                    array("1.Column Platform,Part,Region must need update.")
                , array("2.Column Regional_Status only as Regional_Green,Regional_Yellow,Regional_Red,Regional_Ready.")
                , array("3.Column RTS_Date, Master_Desc, Functional_Desc, Commodity, Part_Status are only for your reference, will not be uploaded into NPI tracking system."))
            ),
        );
        $excel_file = "export_Excel";
        $this->export2excel($excel_content, $excel_file);
    }

    /***
     * 导入
     */

    public function actionImport()
    {
        $model = new PeopleContact();
        $user = new PeoplecontactSearch();
        if(isset($_POST['dosubmit'])){
            $upload = UploadedFile::getInstance($model, 'file');
            if($upload ){
                $file_name = $user->rname($upload);//上传文件名称
                $extensions = substr(strrchr($file_name, '.'), 1);
                if($extensions == 'xlsx' || $extensions =='xls'){
                    $rPath = Yii::getAlias('@backend') . "/web/uploads/excel/peoples/" . date('Ymd') . "/";//相对路径
                    if (!file_exists($rPath)) {
//                        mkdir($rPath);
                        mkdir($rPath,0777,true);
                        chmod($rPath,0777);

                    }
                    if ($upload->saveAs($rPath . $file_name)) {
                        $filename =  $rPath.$file_name;
                    } else {
                        exit('上传文件失败');
                    }
                    $flag = PeoplecontactSearch::getPhpExcelLead($filename, $extensions);
                }else{
                    functions::alert('上传内容不是excel文件');
                }
            }else{
                functions::alert('上传内容不能为空');
            }
            if ($flag == 1) {
                functions::alertClose("导入成功");
            } else {
                functions::alert("导入失败");
            }
        }else{
            return $this->renderAjax('import', [
                'model'=>$model,
            ]);
        }

    }
}
