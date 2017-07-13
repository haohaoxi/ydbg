<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\gongchu\models\GongchuSearch */
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

    <?= $form->field($model, 'gongchurens')->textInput(['class' => 'q'])->span('公出人员') ?>
    <?= $form->field($model, 'gc_time')->textInput(['readonly'=>'true','class'=>'q date'])->span('公出时间') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "gongchusearch-gc_time",
            trigger    : "gongchusearch-gc_time",
            dateFormat: "%Y-%m-%d ",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>

    <?php echo $form->field($model, 'end_time')->textInput(['readonly'=>'true','class'=>'q date'])->span('——',['style'=>'width:10px;'])?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "gongchusearch-end_time",
            trigger    : "gongchusearch-end_time",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?= $form->field($model, 'audit_status')->dropDownList(['0'=>'审批中','1'=>'同意','2'=>'驳回'],['prompt'=>'—选择状态—'])->span('状态'); ?>

    <?= Html::a('公出申请', ['create'], ['class' => 'btn']) ?>
    <input class="btn search" type="submit" value="查询" id="chaxun">
    <input class="btn" type="button" value="重置">
    <div class="clr"></div>
    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    /* 重置筛选条件 */
    $(":button").click(function(){
        $("#gongchusearch-gongchurens").attr("value","");
        $("#gongchusearch-gc_time").attr("value","");
        $("#gongchusearch-end_time").attr("value","");
        $("select:first option:first").attr("selected",true);//重置为默认
    })
</script>
<!--给查询时间做出判断-->
<script>
    $(function(){
        $("#chaxun").click(function(){
            var qjtime=$("#gongchusearch-gc_time").val();
            var endtime=$("#gongchusearch-end_time").val();
            qjtime1 = qjtime.replace(/\-/gi,"/");
            endtime1 = endtime.replace(/\-/gi,"/");
            var time1 = new Date(qjtime1).getTime();
            var time2 = new Date(endtime1).getTime();
            if(time1>time2){
                alert('开始时间不能大于结束时间');
                $("#gongchu-end_time").val('');
                return false;
            }
        });
    })
</script>