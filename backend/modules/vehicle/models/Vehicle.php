<?php

namespace backend\modules\vehicle\models;

use Yii;

/**
 * This is the model class for table "{{%vehicle}}".
 *
 * @property integer $id
 * @property string $v_usage
 * @property string $dept
 * @property string $code_no
 * @property string $v_license
 * @property string $regist_no
 * @property string $regist_date
 * @property integer $v_type
 * @property string $xinghao
 * @property string $pailiang
 * @property integer $count
 * @property double $money
 * @property string $audit
 * @property integer $isdelete
 * @property integer $isreturn
 */
class Vehicle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vehicle}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['v_license','v_usage','dept','code_no','audit', 'regist_no', 'regist_date', 'v_type', 'xinghao', 'pailiang', 'money', 'isdelete', 'isreturn'], 'required'],
            [['regist_date'], 'safe'],
            [['v_type', 'count', 'isdelete', 'isreturn'], 'integer'],
            [['money'], 'number'],
            [['v_usage'], 'string', 'max' => 100],
            [['dept', 'xinghao', 'audit'], 'string', 'max' => 50],
            [['code_no', 'v_license', 'regist_no'], 'string', 'max' => 20],
            [['pailiang'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'v_usage' => '车辆用途',
            'dept' => '单位名称',
            'code_no' => '组织机构',
            'v_license' => '车牌号',
            'regist_no' => '证书编号',
            'regist_date' => '车辆登记日期',
            'v_type' => '汽车分类',
            'xinghao' => '规格型号',
            'pailiang' => '排量',
            'count' => '数量',
            'money' => '金额',
            'audit' => '审批情况',
            'isdelete' => 'Isdelete',
            'isreturn' => 'Isreturn',
        ];
    }
}
