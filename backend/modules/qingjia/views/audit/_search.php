<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\qingjia\models\AuditSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="default-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'fieldConfig' => [
            'template' => "{span}{input}{error}",
        ]
    ]); ?>
    <?= $form->field($model, 'qingjiaren')->textInput(['class'=>'q'])->span('请假人') ?>
    <?= $form->field($model, 'dept')->dropDownList($depts,['prompt'=>'—选择机构—'])->span('所属机构') ?>

    <?php  echo $form->field($model, 'qj_time')->textInput(['readonly'=>'true','class'=>'q date'])->span('请假时间') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "auditsearch-qj_time",
            trigger    : "auditsearch-qj_time",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {
                this.hide();
            }
        });
    </script>
    <?php  echo $form->field($model, 'end_time')->textInput(['readonly'=>'true','class'=>'q date'])->span('—') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "auditsearch-end_time",
            trigger    : "auditsearch-end_time",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {
                this.hide();
            }
        });
    </script>
         <?= $form->field($model, 'audit_status')->dropDownList(['0'=>'未审批','1'=>'同意','2'=>'驳回'],['prompt'=>'—选择状态—'])->span('状态') ?>
    <input class="btn search" type="submit" value="查询" id="chaxun">
    <input class="btn" type="button" value="重置">
    <div class="clr"></div>

    <?php ActiveForm::end(); ?>

</div>
<!--qingjiasearch-qj_type-->
<script type="text/javascript">
    /* 重置筛选条件 */
    $(":button").click(function(){
        $("#auditsearch-qingjiaren").attr("value","");
        $("#auditsearch-qj_time").attr("value","");
        $("#auditsearch-end_time").attr("value","");
        $("select:first option:first").attr("selected",true);//重置为默认
        $("#auditsearch-audit_status:first option:first").attr("selected",true);//重置为默认
    })
</script>
<!--给查询时间做出判断-->
<script>
    $(function(){
        $("#chaxun").click(function(){
            var release = $("#auditsearch-qj_time").val();
            var modify = $("#auditsearch-end_time").val();
            if(release>modify){
                if(modify!=''){
                    alert('开始时间不能大于结束时间');
                    $("#auditsearch-end_time").val("");
                    return false;
                }
            }
        });
    })
</script>
