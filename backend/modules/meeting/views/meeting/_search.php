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

    <?= $form->field($model, 'subject')->textInput(['class' => 'q'])->span('会议主题') ?>
    <?= $form->field($model, 'join_rens')->textInput(['class' => 'q'])->span('参加人员') ?>
    <?= $form->field($model, 'time_s')->textInput(['readonly'=>'true','class'=>'q date'])->span('会议开始时间') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "meetingsearch-time_s",
            trigger    : "meetingsearch-time_s",
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
            inputField : "meetingsearch-time_e",
            trigger    : "meetingsearch-time_e",
            dateFormat: "%Y-%m-%d ",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>

    <?= Html::a('发起会议', ['create'], ['class' => 'btn']) ?>
    <input class="btn search" type="submit" value="查询" id="chaxun">
    <input class="btn" type="button" value="重置">
    <div class="clr"></div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    /* 重置筛选条件 */
    $(":button").click(function(){
        $("#meetingsearch-subject").attr("value","");
        $("#meetingsearch-join_rens").attr("value","");
        $("#meetingsearch-time_s").attr("value","");
        $("#meetingsearch-time_e").attr("value","");
        $("select:first option:first").attr("selected",true);//重置为默认
    })
</script>
<!--给查询时间做出判断-->
<script>
    $(function(){
        $("#chaxun").click(function(){
            var release = $("#meetingsearch-time_s").val();
            var modify = $("#meetingsearch-time_e").val();
            if(release>modify){
                if(modify!=''){
                    alert('时间格式错误');
                    $("#meetingsearch-time_e").val("");
                    return false;
                }
            }
        });
    })
</script>