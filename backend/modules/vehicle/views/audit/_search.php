<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\AuditSearch */
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
    <?= $form->field($model, 'v_user')->textInput(['class' => 'q'])->span('用车人') ?>
    <?php  echo $form->field($model, 's_time')->textInput(['class' => 'q date'])->span('用车时间') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "auditsearch-s_time",
            trigger    : "auditsearch-s_time",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?php  echo $form->field($model, 'e_time')->textInput(['class' => 'q date'])->span('—') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "auditsearch-e_time",
            trigger    : "auditsearch-e_time",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?= $form->field($model, 'dept')->dropDownList($depts,['prompt'=>'--选择科(室、局)--'])->span('所属机构'); ?>
    <?= $form->field($model, 'audit_status')->dropDownList(['0'=>'未审批','1'=>'同意','2'=>'驳回'],['prompt'=>'—选择状态—'])->span('状态') ?>

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
        $("#vehicleapplysearch-use_time").attr("value","");
        $("#auditsearch-s_time").attr("value","");
        $("#auditsearch-e_time").attr("value","");
        $("select:first option:first").attr("selected",true);//重置为默认
        $("#auditsearch-audit_status:first option:first").attr("selected",true);//重置为默认

    })
</script>
<!--给查询时间做出判断-->
<script>
    $(function(){
        $("#chaxun").click(function(){
            var release = $("#auditsearch-s_time").val();
            var modify = $("#auditsearch-e_time").val();
            if(release>modify){
                if(modify!=''){
                    alert('开始时间不能大于结束时间');
                    $("#auditsearch-e_time").val("");
                    return false;
                }
            }
        });
    })
</script>
