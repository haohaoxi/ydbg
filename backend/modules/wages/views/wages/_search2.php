<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\wages\models\WagesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wages-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'time') ?>

    <?= $form->field($model, 'dwbh') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'yfgz') ?>

    <?php // echo $form->field($model, 'zwdjgz') ?>

    <?php // echo $form->field($model, 'jbgz') ?>

    <?php // echo $form->field($model, 'jcgz') ?>

    <?php // echo $form->field($model, 'gjhljt') ?>

    <?php // echo $form->field($model, 'jxjt') ?>

    <?php // echo $form->field($model, 'gzjt') ?>

    <?php // echo $form->field($model, 'shbt') ?>

    <?php // echo $form->field($model, 'gwjt') ?>

    <?php // echo $form->field($model, 'zwjt') ?>

    <?php // echo $form->field($model, 'dqjt') ?>

    <?php // echo $form->field($model, 'kqj') ?>

    <?php // echo $form->field($model, 'hyxjt') ?>

    <?php // echo $form->field($model, 'tzbt') ?>

    <?php // echo $form->field($model, 'blgz') ?>

    <?php // echo $form->field($model, 'fdgz') ?>

    <?php // echo $form->field($model, 'qtyf') ?>

    <?php // echo $form->field($model, 'ycxbk') ?>

    <?php // echo $form->field($model, 'dkje') ?>

    <?php // echo $form->field($model, 'zfgjj') ?>

    <?php // echo $form->field($model, 'ylaobxj') ?>

    <?php // echo $form->field($model, 'sybxj') ?>

    <?php // echo $form->field($model, 'ylbxj') ?>

    <?php // echo $form->field($model, 'grsds') ?>

    <?php // echo $form->field($model, 'sdf') ?>

    <?php // echo $form->field($model, 'fz') ?>

    <?php // echo $form->field($model, 'qtdk') ?>

    <?php // echo $form->field($model, 'sfgz') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
