<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\chuchai\models\ChuchaiSearch */
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

    <?= $form->field($model, 'cc_place')->textInput(['class' => 'q'])->span('出差地点') ?>

    <?= $form->field($model, 'chuchairen')->textInput(['class' => 'q'])->span('出差人员') ?>

    <?= $form->field($model, 'cc_date')->textInput(['readonly'=>'true','class'=>'q date'])->span('出差时间') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "chuchaisearch-cc_date",
            trigger    : "chuchaisearch-cc_date",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?= $form->field($model, 'end_date')->textInput(['readonly'=>'true','class'=>'q date'])->span('—') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "chuchaisearch-end_date",
            trigger    : "chuchaisearch-end_date",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>

    <?= $form->field($model, 'audit_status')->dropDownList(['0'=>'审批中','1'=>'同意','2'=>'驳回'],['prompt'=>'—选择状态—'])->span('状态') ?>

    <?= Html::a('出差申请', ['create'], ['class' => 'btn']) ?>
    <input class="btn search" type="submit" value="查询" id="chaxun">
    <input class="btn" type="button" value="重置">
    <div class="clr"></div>
    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    /* 重置筛选条件 */
    $(":button").click(function(){
        $("#chuchaisearch-chuchairen").attr("value","");
        $("#chuchaisearch-cc_place").attr("value","");
        $("#chuchaisearch-cc_date").attr("value","");
        $("#chuchaisearch-end_date").attr("value","");
        $("select:first option:first").attr("selected",true);//重置为默认
    })
</script>
<!--给查询时间做出判断-->
<script>
    $(function(){
        $("#chaxun").click(function(){
            var release = $("#chuchaisearch-cc_date").val();
            var modify = $("#chuchaisearch-end_date").val();
            if(release>modify){
                if(modify!=''){
                    alert('时间格式错误');
                    $("#chuchaisearch-end_date").val("");
                    return false;
                }
            }
        });
    })
</script>