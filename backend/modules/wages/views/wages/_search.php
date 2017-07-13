<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\functions\functions;
/* @var $this yii\web\View */
/* @var $model backend\modules\wages\models\WagesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="default-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => ''],
        'fieldConfig' => [
            'template' => "{span}{input}{error}",
            'inputOptions' => ['class' => 'q'],
        ]
    ]); ?>
    <span>年份</span>
    <?= $form->field($model, '_s_year')->dropDownList(functions::getWagesYear())->span('') ?>
    <span>月份</span>
    <?= $form->field($model, '_s_month')->dropDownList(functions::getWagesMonth(),['prompt'=>'--选择月份--'])->span('') ?>

    <?php
        if(functions::hasPermissionOne('wages','wages','loadexcel')){
    ?>
    <span>当前账号</span>
    <?= $form->field($model, 'number')->dropDownList([Yii::$app->user->identity->number=>'只显示自己'],['prompt'=>'--显示全部--'])->span('') ?>
    <?php } ?>
    <?= Html::a('模板下载','./excel/Wage_demo.xls', ['class' => 'btn']) ?>
    <?= Html::a('批量导入',Yii::$app->urlManager->createUrl(['wages/wages/loadexcel']), ['class' => 'btn']) ?>
    <?= Html::input('reset','','重置', ['class' => 'btn']) ?>
    <?= Html::input('submit','','查询', ['class' => 'btn']) ?>
    <div class="clr"></div>
    <?php ActiveForm::end(); ?>
</div>
