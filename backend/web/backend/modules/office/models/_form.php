<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\office\models\Office */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="office-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'office_id')->textInput() ?>

    <?= $form->field($model, 'office_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_price')->textInput() ?>

    <?= $form->field($model, 'office_part')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_num')->textInput() ?>

    <?= $form->field($model, 'office_start_time')->textInput() ?>

    <?= $form->field($model, 'office_end_time')->textInput() ?>

    <?= $form->field($model, 'office_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
