<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\VehicleapplySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="default-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'fieldConfig' => [
            'template' => "{span}{input}{error}",
            'inputOptions' => ['class' => 'q'],
        ]
    ]); ?>
    <?php  echo $form->field($model, 's_time')->textInput(['class' => 'q date','readonly'=>true])->span('用车时间') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "vehicleapplysearch-s_time",
            trigger    : "vehicleapplysearch-s_time",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?php  echo $form->field($model, 'e_time')->textInput(['class' => 'q date','readonly'=>true])->span('—') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "vehicleapplysearch-e_time",
            trigger    : "vehicleapplysearch-e_time",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?= $form->field($model, 'driver')->textInput(['class' => 'q'])->span('驾驶员') ?>

    <?= $form->field($model, 'audit_status')->dropDownList(['0'=>'审批中','1'=>'同意','2'=>'驳回'],['prompt'=>'—选择状态—'])->span('状态') ?>

    <input class="btn" type="button" value="重置">
    <input class="btn search" type="submit" value="查询" id="chaxun">
    <div class="clr"></div>

    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    /* 重置筛选条件 */
    $(":button").click(function(){
        $("#vehicleapplysearch-driver").attr("value","");
        $("#vehicleapplysearch-dept_leader").attr("value","");
        $("#vehicleapplysearch-s_time").attr("value","");
        $("#vehicleapplysearch-e_time").attr("value","");
        $("select:first option:first").attr("selected",true);//重置为默认
    })
</script>
<!--给查询时间做出判断-->
<script>
    $(function(){
        $("#chaxun").click(function(){
            var release = $("#vehicleapplysearch-s_time").val();
            var modify = $("#vehicleapplysearch-e_time").val();
            if(release>modify){
                if(modify!=''){
                    alert('时间格式错误');
                    $("#vehicleapplysearch-e_time").val("");
                    return false;
                }
            }
        });
    })
</script>