<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\kaoqinquery\models\KaoqinMonth */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="boxer">
    <div class="default-form">
        <?php $form = ActiveForm::begin([
            'options' => ['class' => '','enctype' => 'multipart/form-data'],
            'fieldConfig' => [
                'template' => "{input}",//D:\wamp2\www\jsdt\vendor\yiisoft\yii2\helpers\BaseHtml.php 1222L
                'inputOptions' => ['class' => 'q'],
                'errorOptions'=>['class' => 'tishi'],
            ]
        ]); ?>
        <strong>【导入月报】</strong>
        <span><em>*</em>excel</span><div><input type="file" class="q" placeholder="" name="excel" contentEditable="false"></div><br class="clr">
        <?= Html::input('button','','返回', ['class' => 'btn yuqi-return','onclick'=>'javascript:history.go(-1);']) ?>
        <?= Html::input('submit','import','导入', ['class' => 'btn yuqi-return']) ?>
        <br class="clr">
        <?php ActiveForm::end(); ?>
    </div>
</div>
