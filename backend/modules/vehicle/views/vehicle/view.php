<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\Vehicle */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    span label{
        color: #ff0000;
    }
</style>
<div class="boxer" id="boxer-zh">
    <div class="default-form qingjia-form">
        <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => "{input}{error}",
                'inputOptions' => ['class' => 'q'],
                'errorOptions'=>['class' => 'tishi'],
            ]
        ]); ?>
        <strong>【查看车辆】</strong>
        <span><em>*</em>车辆用途</span>
        <?= $form->field($model, 'v_usage')->textInput(['maxlength' => true,'disabled'=>true]) ?>

        <span><em>*</em>单位名称</span>
        <?= $form->field($model, 'dept')->textInput(['maxlength' => true,'disabled'=>true]) ?>

        <span><em>*</em>组织机构代码证</span>
        <?= $form->field($model, 'code_no')->textInput(['maxlength' => true,'disabled'=>true])?>

        <span><em>*</em>车牌号</span>
        <?= $form->field($model, 'v_license')->textInput(['maxlength' => true,'disabled'=>true]) ?>

        <span><em>*</em>机动车证书编号</span>
        <?= $form->field($model, 'regist_no')->textInput(['maxlength' => true,'disabled'=>true]) ?>

        <span><em>*</em>车辆登记日期</span>
        <?= $form->field($model, 'regist_date')->textInput(['disabled'=>true]) ?>

        <span><em>*</em>汽车分类</span>
        <?= $form->field($model, 'v_type')->textInput(['disabled'=>true]) ?>

        <span><em>*</em>规格型号</span>
        <?= $form->field($model, 'xinghao')->textInput(['maxlength' => true,'disabled'=>true]) ?>

        <span><em>*</em>排量</span>
        <?= $form->field($model, 'pailiang')->textInput(['maxlength' => true,'disabled'=>true]) ?>

        <span><em>*</em>数量</span>
        <?= $form->field($model, 'count')->textInput(['disabled'=>true])?>

        <span><em>*</em>金额（万元）</span>
        <?= $form->field($model, 'money')->textInput(['disabled'=>true])?>

        <span><em>*</em>省控办审批情况</span>
        <?= $form->field($model, 'audit')->textInput(['maxlength' => true,'disabled'=>true]) ?>

        <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>
        <br class="clr">

        <?php ActiveForm::end(); ?>

        </div>

</div>
