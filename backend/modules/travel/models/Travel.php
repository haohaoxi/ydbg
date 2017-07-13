<?php

namespace backend\modules\travel\models;

use Yii;

/**
 * This is the model class for table "{{%travel}}".
 *
 * @property integer $id
 * @property integer $department
 * @property string $time
 * @property string $s_time
 * @property string $e_time
 * @property string $dd
 * @property string $sy
 * @property string $ccf_zs
 * @property string $ccf_je
 * @property string $zsf_zs
 * @property string $zsf_je
 * @property string $hsbt_zs
 * @property string $hsbt_je
 * @property string $gzf
 * @property string $gj
 * @property string $bxr
 * @property string $zmr
 * @property string $zmr_time
 * @property integer $zmr_rs
 * @property string $zmr_detail
 * @property string $glkj
 * @property string $glkj_time
 * @property integer $glkj_rs
 * @property string $glkj_detail
 * @property string $ldsp
 * @property string $ldsp_time
 * @property integer $ldsp_rs
 * @property string $ldsp_detail
 * @property string $zmr_text
 * @property string $ldsp_text
 * @property string $glkj_text
 * @property string $bxr_del
 * @property string $zmr_del
 * @property string $glkj_del
 * @property string $ldsp_del
 */
class Travel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%travel}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department','s_time', 'e_time', 'dd', 'sy', 'gj', 'bxr', 'zmr', 'glkj', 'ldsp','zmr_text','ldsp_text','glkj_text'], 'required'],
            [['department', 'zmr_rs', 'glkj_rs', 'ldsp_rs', 'zmr', 'glkj', 'ldsp', 'bxr','bxr_del','zmr_del','glkj_del','ldsp_del', 'ccf_zs', 'ccf_je', 'zsf_zs', 'zsf_je', 'hsbt_zs', 'hsbt_je', 'gzf'], 'integer'],
            [['time', 's_time', 'e_time', 'zmr_time', 'glkj_time', 'ldsp_time'], 'safe'],
            [['dd', 'ccf_zs', 'ccf_je', 'zsf_zs', 'zsf_je', 'hsbt_zs', 'hsbt_je', 'gzf', 'gj','zmr_text','ldsp_text','glkj_text','bxr_text'], 'string', 'max' => 100],
            [['sy'], 'string', 'max' => 600],
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
            'department' => Yii::t('app', '部门'),
            'time' => Yii::t('app', '申请时间'),
            's_time' => Yii::t('app', '开始时间'),
            'e_time' => Yii::t('app', '结束时间'),
            'dd' => Yii::t('app', '地点'),
            'sy' => Yii::t('app', '事由'),
            'ccf_zs' => Yii::t('app', '车船费（张数）'),
            'ccf_je' => Yii::t('app', '车船费（金额）'),
            'zsf_zs' => Yii::t('app', '住宿费（张数）'),
            'zsf_je' => Yii::t('app', '住宿费（金额）'),
            'hsbt_zs' => Yii::t('app', '伙食补贴（张数）'),
            'hsbt_je' => Yii::t('app', '伙食补贴（金额）'),
            'gzf' => Yii::t('app', '公杂费'),
            'gj' => Yii::t('app', '合计'),
            'bxr' => Yii::t('app', '报销人'),
            'zmr' => Yii::t('app', '证明人'),
            'zmr_time' => Yii::t('app', '证明人审核时间'),
            'zmr_rs' => Yii::t('app', '证明人审核结果  1:同意 0:审批中 '),
            'zmr_detail' => Yii::t('app', '证明人驳回详细信息'),
            'glkj' => Yii::t('app', '管理会计'),
            'glkj_time' => Yii::t('app', '管理会计审核时间'),
            'glkj_rs' => Yii::t('app', '管理会计审核结果  1:同意 0:审批中 '),
            'glkj_detail' => Yii::t('app', '管理会计驳回详细信息'),
            'ldsp' => Yii::t('app', '领导审批'),
            'ldsp_time' => Yii::t('app', '领导审批审核时间'),
            'ldsp_rs' => Yii::t('app', '领导审批结果  1:同意 0:审批中 '),
            'ldsp_detail' => Yii::t('app', '管理会计驳回详细信息'),
            'zmr_text' => Yii::t('app', '证明人'),
            'glkj_text' => Yii::t('app', '管理会计'),
            'ldsp_text' => Yii::t('app', '领导审批'),
            'bxr_text' => Yii::t('app', '报销人'),
            'bxr_del' => Yii::t('app', '报销人删除'),
            'zmr_del' => Yii::t('app', '证明人删除'),
            'glkj_del' => Yii::t('app', '管理删除'),
            'ldsp_del' => Yii::t('app', '领导删除'),
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
