<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\welfareapply\models\Welfareapply */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="welfareapply-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'welfare_id')->textInput() ?>

    <?= $form->field($model, 'welfare_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'welfare_apply_mee_id')->textInput() ?>

    <?= $form->field($model, 'welfare_sp_id')->textInput() ?>

    <?= $form->field($model, 'welfare_apply_pack_status')->dropDownList([ '审批中' => '审批中', '驳回' => '驳回', '同意' => '同意', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'welfare_apply_pack_cancel_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'welfare_lq')->dropDownList([ '未领取' => '未领取', '已领取' => '已领取', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
