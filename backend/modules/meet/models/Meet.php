<?php

namespace backend\modules\meet\models;

use Yii;

/**
 * This is the model class for table "{{%meet}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $department
 * @property string $time
 * @property string $kh_time
 * @property integer $wddbs
 * @property integer $bddbs
 * @property integer $gzrys
 * @property integer $chrys
 * @property integer $hq
 * @property string $hyzf
 * @property string $zsf
 * @property string $hsf
 * @property string $hyszj
 * @property string $jtf
 * @property string $wjysf
 * @property string $qtzc
 * @property string $sjkz
 * @property integer $bxr
 * @property string $bxr_text
 * @property integer $bxr_del
 * @property integer $zmr
 * @property string $zmr_text
 * @property string $zmr_time
 * @property integer $zmr_rs
 * @property string $zmr_detail
 * @property integer $zmr_del
 * @property integer $glkj
 * @property string $glkj_text
 * @property string $glkj_time
 * @property integer $glkj_rs
 * @property string $glkj_detail
 * @property integer $glkj_del
 * @property integer $ldsp
 * @property string $ldsp_text
 * @property string $ldsp_time
 * @property integer $ldsp_rs
 * @property string $ldsp_detail
 * @property integer $ldsp_del
 */
class Meet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%meet}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'kh_time', 'chrys', 'hq', 'hyzf', 'sjkz', 'bxr', 'bxr_text', 'zmr', 'zmr_text', 'glkj', 'glkj_text', 'ldsp', 'ldsp_text'], 'required'],
            [['department', 'wddbs', 'bddbs', 'gzrys', 'chrys', 'hq', 'bxr', 'bxr_del', 'zmr', 'zmr_rs', 'zmr_del', 'glkj', 'glkj_rs', 'glkj_del', 'ldsp', 'ldsp_rs', 'ldsp_del'], 'integer'],
            [['time', 'kh_time', 'zmr_time', 'glkj_time', 'ldsp_time'], 'safe'],
            [['hyzf', 'zsf', 'hsf', 'hyszj', 'jtf', 'wjysf', 'qtzc', 'sjkz'], 'number'],
            [['name'], 'string', 'max' => 200],
            [['bxr_text', 'zmr_text', 'glkj_text', 'ldsp_text'], 'string', 'max' => 100],
            [['zmr_detail', 'glkj_detail', 'ldsp_detail'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '会议名称'),
            'department' => Yii::t('app', '部门'),
            'time' => Yii::t('app', '报销申请时间'),
            'kh_time' => Yii::t('app', '开会时间'),
            'wddbs' => Yii::t('app', '外地代表数/人'),
            'bddbs' => Yii::t('app', '本地代表数/人'),
            'gzrys' => Yii::t('app', '工作人员数/人'),
            'chrys' => Yii::t('app', '参会人员数/人'),
            'hq' => Yii::t('app', '会期（含报到和离开时间）/天'),
            'hyzf' => Yii::t('app', '会议资费'),
            'zsf' => Yii::t('app', '住宿费'),
            'hsf' => Yii::t('app', '伙食费'),
            'hyszj' => Yii::t('app', '会议室租金'),
            'jtf' => Yii::t('app', '交通费'),
            'wjysf' => Yii::t('app', '文件印刷费'),
            'qtzc' => Yii::t('app', '其他支出'),
            'sjkz' => Yii::t('app', '实际开支'),
            'bxr' => Yii::t('app', '报销人'),
            'bxr_text' => Yii::t('app', '报销人'),
            'bxr_del' => Yii::t('app', '报销人是否删除 1:否 0:是'),
            'zmr' => Yii::t('app', '证明人'),
            'zmr_text' => Yii::t('app', '证明人'),
            'zmr_time' => Yii::t('app', '证明人审核时间'),
            'zmr_rs' => Yii::t('app', '证明人审核结果   0:审批中 1:同意 2:驳回'),
            'zmr_detail' => Yii::t('app', '证明人驳回详细信息'),
            'zmr_del' => Yii::t('app', '证明人是否删除 1:否 0:是'),
            'glkj' => Yii::t('app', '管理会计'),
            'glkj_text' => Yii::t('app', '管理会计'),
            'glkj_time' => Yii::t('app', '管理会计审核时间'),
            'glkj_rs' => Yii::t('app', '管理会计审核结果  0:审批中 1:同意 2:驳回'),
            'glkj_detail' => Yii::t('app', '管理会计驳回详细信息'),
            'glkj_del' => Yii::t('app', '管理会计是否删除 1:否 0:是'),
            'ldsp' => Yii::t('app', '领导审批'),
            'ldsp_text' => Yii::t('app', '领导审批'),
            'ldsp_time' => Yii::t('app', '领导审批审核时间'),
            'ldsp_rs' => Yii::t('app', '领导审批结果   0:审批中 1:同意 2:驳回'),
            'ldsp_detail' => Yii::t('app', '领导会计驳回详细信息'),
            'ldsp_del' => Yii::t('app', '领导是否删除 1:否 0:是'),
        ];
    }

    public function beforeSave($insert = true)
    {
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                $this->time = date('Y-m-d H:i:s');
                $this->bxr = isset(Yii::$app->user->identity->id) && Yii::$app->user->identity->id !='' ? Yii::$app->user->identity->id : intval($_POST['bxr']);
            }
            return true;
        }else{
            return false;
        }
    }

    /*
     * 获取当前用户所在审核状态
     * @param $id
     * @param $user_id
     */
    public static function getDqStatus($id,$user_id){
        if($id== '' || $user_id == '') return false;
        $data = self::find()->select('zmr,zmr_rs,glkj,glkj_rs,ldsp,ldsp_rs')->where(['id'=>$id])->asArray()->one();
        $_data = array();
        foreach($data as $key=>$value){
            if(in_array($key,['zmr','glkj','ldsp'])){
                if($value == $user_id){
                    $sf = '';
                    $rs = $data[$key.'_rs'];
                    $rs_text = '';
                    if($key == 'zmr'){
                        $sf = '证明人';
                    }elseif($key == 'glkj'){
                        $sf = '管理会计';
                    }elseif($key == 'ldsp'){
                        $sf = '领导审批';
                    }
                    if($rs == 0){
                        $rs_text = '未审批';
                    }elseif($rs == 1){
                        $rs_text = '同意';
                    }elseif($rs == 2){
                        $rs_text = '驳回';
                    }

                    $_data[] = ['rs'=>$rs,'rs_text'=>$rs_text,'sf'=>$sf,'field'=>$key];
                }
            }
        }

        if(count($_data) == 1) return $_data[0];

        foreach($_data as $key=>$value){
            if($value['rs'] == 0){
                return $value;
            }
        }
        return end($_data);
    }
}
