<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\officeapply\models\Officeapply */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="officeapply-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'apply_id')->textInput() ?>

    <?= $form->field($model, 'apply_num')->textInput() ?>

    <?= $form->field($model, 'apply_office_id')->textInput() ?>

    <?= $form->field($model, 'apply_mee_id')->textInput() ?>

    <?= $form->field($model, 'apply_mee_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apply_mee_id_is_del')->textInput() ?>

    <?= $form->field($model, 'apply_sq_time')->textInput() ?>

    <?= $form->field($model, 'apply_pack_id')->textInput() ?>

    <?= $form->field($model, 'apply_pack_id_is_del')->textInput() ?>

    <?= $form->field($model, 'apply_pack_status')->dropDownList([ '同意' => '同意', '驳回' => '驳回', '审批中' => '审批中', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'apply_pack_result')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apply_pack_time')->textInput() ?>

    <?= $form->field($model, 'apply_genneral_id')->textInput() ?>

    <?= $form->field($model, 'apply_genneral_id_is_del')->textInput() ?>

    <?= $form->field($model, 'apply_genneral_status')->dropDownList([ '同意' => '同意', '驳回' => '驳回', '审批中' => '审批中', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'apply_genneral_result')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apply_genneral_time')->textInput() ?>

    <?= $form->field($model, 'apply_remarks')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'apply_department')->textInput() ?>

    <?= $form->field($model, 'apply_lq_status')->dropDownList([ '已领取' => '已领取', '未领取' => '未领取', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'apply_lq_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
