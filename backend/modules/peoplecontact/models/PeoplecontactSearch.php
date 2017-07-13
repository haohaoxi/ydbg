<?php

namespace backend\modules\peoplecontact\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\peoplecontact\models\PeopleContact;
use backend\modules\position\models\Position;
use backend\functions\functions;

/**
 * PeoplecontactSearch represents the model behind the search form about `backend\modules\peoplecontact\models\PeopleContact`.
 */
class PeoplecontactSearch extends PeopleContact
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['username', 'dept_id', 'position', 'telphone', 'wxone', 'wxtwo', 'inline'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PeopleContact::find()->orderBy('id asc');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 20,]
        ]);

        $this->load($params);
        $dataProvider->setSort([
                'attributes' => [
                    []
                ],
            ]
        );

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'position' => $this->position,
            'dept_id' => $this->dept_id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'telphone', $this->telphone])
            ->andFilterWhere(['like', 'wxone', $this->wxone])
            ->andFilterWhere(['like', 'wxtwo', $this->wxtwo])
            ->andFilterWhere(['like', 'inline', $this->inline]);
        $_SESSION['excel_people_sql'] = $query->createCommand()->getRawSql();
        return $dataProvider;
    }

    /*
    * 搜索人员查询机构选择下拉框
    */
    public function getDeptList(){
        $sql = "select DISTINCT * from dept_contact";
        $data = \yii::$app->db;
        $list =$data->createCommand($sql)->queryAll();
        foreach($list as $key => $values){
            $droplist[$values['id']] = $values['dept_name'];
        }
        return $droplist;
    }
//    /*
//    * 搜索人员查询职务选择下拉框
//    */
//    public function getPosiList(){
//        $sql = "select DISTINCT * from people_contact";
//        $data = \yii::$app->db;
//        $list =$data->createCommand($sql)->queryAll();
//        foreach($list as $key => $values){
//            $droplist[$values['position']] = $values['position'];
//        }
//        return $droplist;
//    }

    /**
     * @function:自定义文件名
     * @param $obj 上传文件的实例化对象
     * @return string 返回文件名
     * @date:2015-06-16
     */
    public function rname($obj){
        $ext = $obj->getExtension();
        $fileName = time().'_'.rand(1,999).'.'.$ext;
        return $fileName;
    }


    /****************以下是导入功能*******************/

    public static function getPhpExcelLead($filename,$name){

        $flag = 0;
        $creator = \Yii::$app->user->identity->username;

        //判断是.xls和.xlsv
        if($name == 'xls'){
            $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        }else{
            $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        }

        $objPhpExcel = $objReader ->load($filename);
        $sheet = $objPhpExcel-> getSheet(0);
        $highestRow = $sheet->getHighestRow();           //取得总行数
        $highestColumn = $sheet->getHighestColumn(); //取得总列数

        $db = \Yii::$app->db;
        $transaction=$db->beginTransaction();
        try
        {
        for($j=2;$j<=$highestRow;$j++)                        //从第二行开始读取数据
        {
            $model = new PeopleContact();
            $model->scenario = 'import';
            $str="";

            for($k='B';$k<=$highestColumn;$k++)            //从B列读取数据
            {
                $str .=$objPhpExcel->getActiveSheet()->getCell("$k$j")->getValue().'|*|';//读取单元格
            }
            $str=mb_convert_encoding($str,'UTF-8','auto');//根据自己编码修改
            $str = explode("|*|",$str);
            if($str[0]!= ''){
                if(!intval($str[1])) {
                    $str[1] = PeopleContact::getDept_Id($str[1]);
                    $str[2] = Position::getZhiwuId($str[2]);
                }
                $model->username = $str[0];
                $model->dept_id = $str[1];
                $model->position = $str[2];
                $model->telphone = $str[3];
                $model->wxone = $str[4];
                $model->wxtwo = $str[5];
                $model->inline = $str[6];

                if($model->save()){
                    $flag = 1;
                }else{
                    functions::alertClose("导入第".($j-1)."行数据出错！");
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
        return $flag;
    }

    /***************end 导入功能**********************/

}
