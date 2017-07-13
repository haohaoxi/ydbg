<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\meeting\models\Meeting */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Meetings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="boxer" id="boxer-zh">
    <div class="default-form">
        <?php $form = ActiveForm::begin([
            'options' => ['class' => '','enctype' => 'multipart/form-data'],
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'fieldConfig' => [
                'template' => "{input}{error}",
                'inputOptions' => ['class' => 'q'],
                'errorOptions'=>['class' => 'tishi'],
            ]
        ]); ?>
        <strong>【查看参会反馈】</strong>
        <span>发起人</span>
    <?= $form->field($model, 'initiator')->textInput(['disabled'=>true,'maxlength' => true]) ?><br class="clr" />
        <span>发起人科室</span>
    <?= $form->field($model, 'initiate_dept')->textInput(['disabled'=>true,'maxlength' => true]) ?><br class="clr" />
        <span>发起时间</span>
    <?= $form->field($model, 'initiate_time')->textInput(['disabled'=>true,'maxlength' => true]) ?><br class="clr" />
        <span><em>*</em>会议主题</span>
    <?= $form->field($model, 'subject')->textInput(['disabled'=>true,'maxlength' => true])->span('<label>*</label>') ?><br class="clr" />
        <span><em>*</em>会议开始时间</span>
        <?= $form->field($model, 'start_time')->textInput(['disabled'=>true,'class'=>'q date'])->span('<label>*</label>') ?><br class="clr" />
        <span><em>*</em>会议结束时间</span>
    <?= $form->field($model, 'end_time')->textInput(['disabled'=>true,'class'=>'q date'])->span('<label>*</label>') ?><br class="clr" />
        <span><em>*</em>会议地点</span>
    <?= $form->field($model, 'place')->textInput(['disabled'=>true,'maxlength' => true])->span('<label>*</label>') ?><br class="clr" />
        <span><em>*</em>会议主持</span>
    <?= $form->field($model, 'hosts')->textInput(['disabled'=>true,'maxlength' => true])->span('<label>*</label>') ?><br class="clr" />
        <span><em>*</em>参加人员</span>
    <?= $form->field($model, 'join_ren')->textInput(['disabled'=>true,'maxlength' => true])->span('<label>*</label>') ?><br class="clr" />
        <span class="tall">会议议程</span>
    <?= $form->field($model, 'agenda',['options'=>['class'=>'tall']])->textarea(['disabled'=>true,'rows' => 3]) ?>
        <span class="tall">会务安排</span>
    <?= $form->field($model, 'arrangement',['options'=>['class'=>'tall']])->textarea(['disabled'=>true,'rows' => 3]) ?><br class="clr" />
    <span>附件</span>
        <div class="upload">
    <?= Html::a($model->attachment,Yii::$app->urlManager->createUrl(['/meeting/meeting/down','id'=>$model->id]),['style'=>'color:blue']) ?>
            </div>
    <br class="clr">

    <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'goback();']) ?>
    <br class="clr">

    <?php ActiveForm::end(); ?>
</div>
</div>
<script type="text/javascript">
    function goback(){
        window.location.href='<?= Yii::$app->urlManager->createUrl('meeting/meetingjoin/index');?>';
    }
</script>