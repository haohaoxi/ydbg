<?php

namespace backend\modules\wages\models;

use Yii;

/**
 * This is the model class for table "{{%wages}}".
 *
 * @property integer $id
 * @property string $time
 * @property string $dwbh
 * @property string $number
 * @property string $name
 * @property string $yfgz
 * @property string $zwdjgz
 * @property string $jbgz
 * @property string $jcgz
 * @property string $gjhljt
 * @property string $jxjt
 * @property string $gzjt
 * @property string $shbt
 * @property string $gwjt
 * @property string $zwjt
 * @property string $dqjt
 * @property string $kqj
 * @property string $hyxjt
 * @property string $tzbt
 * @property string $blgz
 * @property string $fdgz
 * @property string $qtyf
 * @property string $ycxbk
 * @property string $dkje
 * @property string $zfgjj
 * @property string $ylaobxj
 * @property string $sybxj
 * @property string $ylbxj
 * @property string $grsds
 * @property string $sdf
 * @property string $fz
 * @property string $qtdk
 * @property string $sfgz
 */
class Wages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time', 'dwbh', 'number', 'name', 'yfgz', 'zwdjgz', 'jbgz', 'jcgz', 'gjhljt', 'jxjt', 'gzjt', 'shbt', 'gwjt', 'zwjt', 'dqjt', 'kqj', 'hyxjt', 'tzbt', 'blgz', 'fdgz', 'qtyf', 'ycxbk', 'dkje', 'zfgjj', 'ylaobxj', 'sybxj', 'ylbxj', 'grsds', 'sdf', 'fz', 'qtdk', 'sfgz'], 'required'],
            [['time'], 'safe'],
            [['dwbh', 'name'], 'string', 'max' => 100],
            [['number'], 'string', 'max' => 10],
            [['yfgz', 'zwdjgz', 'jbgz', 'jcgz', 'gjhljt', 'jxjt', 'gzjt', 'shbt', 'gwjt', 'zwjt', 'dqjt', 'kqj', 'hyxjt', 'tzbt', 'blgz', 'fdgz', 'qtyf', 'ycxbk', 'dkje', 'zfgjj', 'ylaobxj', 'sybxj', 'ylbxj', 'grsds', 'sdf', 'fz', 'qtdk', 'sfgz'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'time' => Yii::t('app', '日期'),
            'dwbh' => Yii::t('app', '单位编号'),
            'number' => Yii::t('app', '人员编号'),
            'name' => Yii::t('app', '姓名'),
            'yfgz' => Yii::t('app', '应发工资'),
            'zwdjgz' => Yii::t('app', '职务等级工资'),
            'jbgz' => Yii::t('app', '级别工资津贴'),
            'jcgz' => Yii::t('app', '基础工资'),
            'gjhljt' => Yii::t('app', '工教护龄津贴'),
            'jxjt' => Yii::t('app', '警衔津贴'),
            'gzjt' => Yii::t('app', '工作津贴'),
            'shbt' => Yii::t('app', '生活补贴'),
            'gwjt' => Yii::t('app', '岗位津贴'),
            'zwjt' => Yii::t('app', '职务津贴'),
            'dqjt' => Yii::t('app', '地区津贴'),
            'kqj' => Yii::t('app', '考勤奖'),
            'hyxjt' => Yii::t('app', '行业性津贴'),
            'tzbt' => Yii::t('app', '提租补贴'),
            'blgz' => Yii::t('app', '保留工资'),
            'fdgz' => Yii::t('app', '浮动工资'),
            'qtyf' => Yii::t('app', '其他应发'),
            'ycxbk' => Yii::t('app', '一次性补扣发'),
            'dkje' => Yii::t('app', '代扣金额'),
            'zfgjj' => Yii::t('app', '住房公积金'),
            'ylaobxj' => Yii::t('app', '养老保险金'),
            'sybxj' => Yii::t('app', '失业保险金'),
            'ylbxj' => Yii::t('app', '医疗保险金'),
            'grsds' => Yii::t('app', '个人所得税'),
            'sdf' => Yii::t('app', '水电费'),
            'fz' => Yii::t('app', '房租费'),
            'qtdk' => Yii::t('app', '其他代扣'),
            'sfgz' => Yii::t('app', '实发工资'),
        ];
    }
}
