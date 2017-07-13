<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\office\models\OfficeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="office-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'office_id') ?>

    <?= $form->field($model, 'office_name') ?>

    <?= $form->field($model, 'office_price') ?>

    <?= $form->field($model, 'office_part') ?>

    <?= $form->field($model, 'office_num') ?>

    <?php // echo $form->field($model, 'office_start_time') ?>

    <?php // echo $form->field($model, 'office_end_time') ?>

    <?php // echo $form->field($model, 'office_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
