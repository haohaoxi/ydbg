<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\meeting\models\MeetingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="default-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'fieldConfig' => [
            'template' => "{span}{input}{error}",
//            'inputOptions' => ['class' => 'q'],
        ]

    ]); ?>

    <?= $form->field($model, 'place')->textInput(['class' => 'q'])->span('会议地点') ?>
    <?= $form->field($model, 'time_s')->textInput(['readonly'=>'true','class'=>'q date'])->span('会议开始时间') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "meetingjoinsearch-time_s",
            trigger    : "meetingjoinsearch-time_s",
            dateFormat: "%Y-%m-%d ",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?= $form->field($model, 'time_e')->textInput(['readonly'=>'true','class'=>'q date'])->span('—',['style'=>'width:10px;']) ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "meetingjoinsearch-time_e",
            trigger    : "meetingjoinsearch-time_e",
            dateFormat: "%Y-%m-%d ",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?= $form->field($model, 'status')->dropDownList(['0'=>'未开始','1'=>'进行中','2'=>'已结束'],['prompt'=>'—选择状态—'])->span('会议状态'); ?>

    <input class="btn search" type="submit" value="查询" id="chaxun">
    <input class="btn" type="button" value="重置">
    <div class="clr"></div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    /* 重置筛选条件 */
    $(":button").click(function(){
        $("#meetingjoinsearch-place").attr("value","");
        $("#meetingjoinsearch-join_ren").attr("value","");
        $("#meetingjoinsearch-time_s").attr("value","");
        $("#meetingjoinsearch-time_e").attr("value","");
        $("select:first option:first").attr("selected",true);//重置为默认
    })
</script>
<!--给查询时间做出判断-->
<script>
    $(function(){
        $("#chaxun").click(function(){
            var release = $("#meetingjoinsearch-time_s").val();
            var modify = $("#meetingjoinsearch-time_e").val();
            if(release>modify){
                if(modify!=''){
                    alert('开始时间不能大于结束时间');
                    $("#meetingjoinsearch-time_e").val("");
                    return false;
                }
            }
        });
    })
</script>
