<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\VehicleApply */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vehicle Applies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="boxer" id="boxer-zh">
    <div class="default-form qingjia-form">
        <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => "{input}{error}",
                'inputOptions' => ['class' => 'q'],
                'errorOptions'=>['class' => 'tishi'],
            ]
        ]); ?>

        <strong>【申请记录查看】</strong>
        <span><em>*</em>车牌号</span>
        <?= $form->field($model, 'v_license')->textInput(['disabled' => true,'maxlength' => true]) ?>

        <span><em>*</em>科室</span>
        <?= $form->field($model, 'dept')->textInput(['disabled' => true]) ?>

        <span><em>*</em>用车人</span>
        <?= $form->field($model, 'v_user')->textInput(['disabled' => true])?>

        <span><em>*</em>驾驶员</span>
        <?= $form->field($model, 'driver')->textInput(['disabled' => true,'maxlength' => true]) ?>

        <span><em>*</em>申请人</span>
        <?= $form->field($model, 'apply_ren')->textInput(['disabled' => true,'maxlength' => true]) ?>

        <span><em>*</em>用车时间</span>
        <?= $form->field($model, 'use_time')->textInput(['disabled' => true,'maxlength' => true,'class' => 'q date'])?>

        <span><em>*</em>去向</span>
        <?= $form->field($model, 'quxiang')->textInput(['disabled' => true,'maxlength' => true])?>

        <span><em>*</em>用车事由</span>
        <?= $form->field($model, 'reason')->textInput(['disabled' => true])?>

        <?php if(!empty($model->dept_leader)):?>
            <span><em>*</em>科室负责人</span>
            <?= $form->field($model, 'dept_leader')->textInput(['disabled'=>true,'maxlength' => true,'style'=>'width:250px']) ?><br class="clr" />
        <?php endif ?>

        <span><em>*</em>分管领导</span>
        <?= $form->field($model, 'branch_leader')->textInput(['disabled' => true,'style'=>'width:250px']) ?>

        <?= Html::a('返回','#',['class'=>'btn','onclick'=>'goback();']) ?>
        <br class="clr">

        <?php ActiveForm::end(); ?>
    </div>

</div>
<script type="text/javascript">
    function goback(){
        window.location.href='<?= Yii::$app->urlManager->createUrl('vehicle/vehicleapply/index');?>';
    }
</script>