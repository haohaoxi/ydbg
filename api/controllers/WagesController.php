<?php
namespace api\controllers;
use Yii;
use yii\rest\ActiveController;
use api\functionGlobal\FunctionRand;
use yii\db\mssql\PDO;
use backend\modules\officesupplies\models\Officesupplies;
use backend\modules\wages\models\Wages;
/**
 * Created by PhpStorm.
 * User: Jun
 * Date: 2016/5/27
 * Time: 14:53
 */
//工资API
class WagesController extends ActiveController{

    public $modelClass = 'backend\modules\wages\models\Wages';
    public $userid;
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items'
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['contentNegotiator']['formats']['application/xml']);
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        // 注销系统自带的实现方法
        unset($actions['index'], $actions['update'], $actions['create'], $actions['delete'], $actions['view']);
        return $actions;
    }

    //工资API
    public function actionGetwages($userid,$user_key,$date){
        if(empty($userid) || empty($user_key)){//get
            FunctionRand::Error(2, '无效的参数');
        }
        FunctionRand::UserAuth($userid,$user_key);
        $wages=new Wages();
        $page = !isset($_GET['page']) ? 1 : (int)$_GET['page'];
        $page_size = 5;
        $offset = ($page - 1) * $page_size;
        if($date!=null){
            $count = $wages->find()
                ->andWhere('id=:id',['id'=>$userid],'time=:time',['time'=>$date])
                ->count();
            $money = $wages->find()
                ->andWhere('id=:id',['id'=>$userid],'time=:time',['time'=>$date])
                ->limit($page_size)->offset($offset)
                ->asArray()
                ->one();
            $gwaes=array();//组装的查询结果
            $gwaes['time']=$money['time'];
            $gwaes['yf_salary']=$money['yfgz'];//应发工资
            $gwaes['zu_salary']=$money['zwdjgz'];//职务等级工资
            $gwaes['jb_salary']=$money['jbgz'];//级别工资津贴
            $gwaes['jc_salary']=$money['jcgz'];//基础工资
            $gwaes['gj_salary']=$money['gjhljt'];//工教护龄津贴
            $gwaes['jx_salary']=$money['jxjt'];//警衔津贴
            $gwaes['gz_salary']=$money['gzjt'];//工作津贴
            $gwaes['sh_salary']=$money['shbt'];//生活补贴
            $gwaes['gw_salary']=$money['gwjt'];//岗位津贴
            $gwaes['zw_salary']=$money['zwjt'];//职务津贴
            $gwaes['dq_salary']=$money['dqjt'];//地区津贴
            $gwaes['kq_salary']=$money['kqj'];//考勤奖
            $gwaes['hy_salary']=$money['hyxjt'];//行业性津贴
            $gwaes['tz_salary']=$money['tzbt'];//提租补贴
            $gwaes['bl_salary']=$money['blgz'];//保留工资
            $gwaes['fd_salary']=$money['fdgz'];//浮动工资
            $gwaes['qt_salary']=$money['qtyf'];//其他应发
            $gwaes['yc_salary']=$money['ycxbk'];//一次性补扣发
            $gwaes['dk_salary']=$money['dkje'];//代扣金额
            $gwaes['zf_salary']=$money['zfgjj'];//住房公积金
            $gwaes['yl_salary']=$money['ylaobxj'];//养老保险金
            $gwaes['sy_salary']=$money['sybxj'];//失业保险金
            $gwaes['bx_salary']=$money['ylbxj'];//医疗保险金
            $gwaes['gr_salary']=$money['grsds'];//个人所得税
            $gwaes['sd_salary']=$money['sdf'];//水电费
            $gwaes['fz_salary']=$money['fz'];//房租费
            $gwaes['qd_salary']=$money['qtdk'];//其他代扣
            $gwaes['sf_salary']=$money['sfgz'];//实发工资
            FunctionRand::Page(1, 'Success', $count, $page_size, $page, $gwaes);
        }else{
            FunctionRand::Error(2, '无效的参数');
        }
    }
}