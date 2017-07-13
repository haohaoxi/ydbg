<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\qingjia\models\Qingjia */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Qingjias', 'url' => ['index']];
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
        <strong>【请假详情】</strong>
        <span>请(休)假人</span>
        <?= $form->field($model, 'qj_ren')->textInput(['disabled'=>"disabled",'maxlength' => true])?><br class="clr" />
        <span>所属机构</span>
        <?= $form->field($model, 'dept')->textInput(['disabled'=>true,'maxlength' => true])?><br class="clr" />
        <span>行政职务</span>
        <?= $form->field($model, 'position')->textInput(['disabled'=>true,'maxlength' => true])?><br class="clr" />
        <span>请假类型</span>
        <?= $form->field($model, 'qj_type')->textInput(['disabled'=>true,'maxlength' => true]) ?><br class="clr" />
        <span>申请时间</span>
        <?= $form->field($model, 'apply_time')->textInput(['disabled'=>true,'class'=>'q']) ?><br class="clr" />
        <span>请假时间</span>
        <?= $form->field($model, 'qj_time')->textInput(['disabled'=>true,'class'=>'q']) ?><br class="clr" />
        <span>结束时间</span>
        <?= $form->field($model, 'end_time')->textInput(['disabled'=>true,'class'=>'q']) ?><br class="clr" />
        <span>请假时长/天</span>
        <?= $form->field($model, 'qj_day')->textInput(['disabled'=>true,'maxlength' => true]) ?><br class="clr" />
        <span class="tall">请假事由</span>
        <?= $form->field($model, 'qj_reason',['options'=>['class'=>'tall']])->textarea(['disabled'=>true,'rows' => 3]) ?><br class="clr" />
        <?php if(!empty($model->dept_leader)):?>
            <span>科室领导意见</span>
            <?= $form->field($model, 'dept_leader')->textInput(['disabled'=>true,'maxlength' => true,'style'=>'width:300px']) ?><br class="clr" />
        <?php endif ?>
        <?php if(!empty($model->branch_leader)):?>
            <span>分管领导意见</span>
            <?= $form->field($model, 'branch_leader')->textInput(['disabled'=>true,'maxlength' => true,'style'=>'width:300px']) ?><br class="clr" />
        <?php endif ?>
        <?php if(!empty($model->zzc)):?>
            <span>政治处意见</span>
            <?= $form->field($model, 'zzc')->textInput(['disabled'=>true,'style'=>'width:300px']) ?><br class="clr" />
        <?php endif ?>
        <?php if(!empty($model->jcz)):?>
            <span>检察长意见</span>
            <?= $form->field($model, 'jcz')->textInput(['disabled'=>true,'style'=>'width:300px']) ?><br class="clr" />
        <?php endif ?>
        <?= Html::a('返回','#:;',['class'=>'btn','onclick'=>'goback();']) ?>
        <br class="clr">

        <?php ActiveForm::end(); ?>
    </div>
</div>
<script type="text/javascript">
    function goback(){
        window.location.href='<?= Yii::$app->urlManager->createUrl('qingjia/qingjia/index');?>';
    }
</script>