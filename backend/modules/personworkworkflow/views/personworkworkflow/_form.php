<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\personworkworkflow\models\Personworkworkflow */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personworkworkflow-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'w_p_id')->textInput() ?>

    <?= $form->field($model, 'w_person_id')->textInput() ?>

    <?= $form->field($model, 'w_s_time')->textInput() ?>

    <?= $form->field($model, 'w_e_time')->textInput() ?>

    <?= $form->field($model, 'w_s_status')->dropDownList([ '未受理' => '未受理', '未审批' => '未审批', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'w_e_status')->dropDownList([ '同意' => '同意', '完成' => '完成', '退办' => '退办', '驳回' => '驳回', '代办' => '代办', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'w_type')->dropDownList([ '代办' => '代办', '普通' => '普通', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
