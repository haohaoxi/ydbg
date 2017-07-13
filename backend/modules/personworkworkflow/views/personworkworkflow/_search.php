<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\personworkworkflow\models\PersonworkworkflowSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personworkworkflow-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'w_p_id') ?>

    <?= $form->field($model, 'w_person_id') ?>

    <?= $form->field($model, 'w_s_time') ?>

    <?= $form->field($model, 'w_e_time') ?>

    <?php // echo $form->field($model, 'w_s_status') ?>

    <?php // echo $form->field($model, 'w_e_status') ?>

    <?php // echo $form->field($model, 'w_type') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
