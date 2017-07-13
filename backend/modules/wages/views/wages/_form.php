<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\wages\models\Wages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= $form->field($model, 'dwbh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yfgz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zwdjgz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jbgz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jcgz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gjhljt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jxjt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gzjt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shbt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gwjt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zwjt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dqjt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kqj')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hyxjt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tzbt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'blgz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fdgz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qtyf')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ycxbk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dkje')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zfgjj')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ylaobxj')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sybxj')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ylbxj')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grsds')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sdf')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qtdk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sfgz')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
