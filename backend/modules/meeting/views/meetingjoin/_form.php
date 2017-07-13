<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\meeting\models\Meeting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meeting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_time')->textInput() ?>

    <?= $form->field($model, 'end_time')->textInput() ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agenda')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'arrangement')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attachment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'initiator')->textInput() ?>

    <?= $form->field($model, 'initiate_time')->textInput() ?>

    <?= $form->field($model, 'initiate_dept')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
