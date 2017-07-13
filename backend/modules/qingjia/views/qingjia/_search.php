<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\qingjia\models\QingjiaSearch */
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

    <?= $form->field($model, 'qj_type')->dropDownList($qingjiaType,['prompt'=>'—选择请假类型—'])->span('请假类型') ?>

    <?php  echo $form->field($model, 'qj_time')->textInput(['readonly'=>'true','class'=>'q date'])->span('请假时间') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "qingjiasearch-qj_time",
            trigger    : "qingjiasearch-qj_time",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?php  echo $form->field($model, 'end_time')->textInput(['readonly'=>'true','class'=>'q date'])->span('—') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "qingjiasearch-end_time",
            trigger    : "qingjiasearch-end_time",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?= $form->field($model, 'audit_status')->dropDownList(['0'=>'审批中','1'=>'同意','2'=>'驳回'],['prompt'=>'—选择状态—'])->span('状态') ?>

    <?= Html::a('请假申请', ['create'], ['class' => 'btn']) ?>
    <input class="btn search" type="submit" value="查询" id="chaxun">
    <input class="btn" type="button" value="重置">
    <div class="clr"></div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    /* 重置筛选条件 */
    $(":button").click(function(){
        $("#qingjiasearch-qj_time").attr("value","");
        $("#qingjiasearch-end_time").attr("value","");
        $("select:first option:first").attr("selected",true);//重置为默认
        $("#qingjiasearch-audit_status:first option:first").attr("selected",true);//重置为默认
    });
</script>
<!--给查询时间做出判断-->
<script>
    $(function(){
        $("#chaxun").click(function(){
            var release = $("#qingjiasearch-qj_time").val();
            var modify = $("#qingjiasearch-end_time").val();
            if(release>modify){
                if(modify!=''){
                    alert('时间格式错误');
                    $("#qingjiasearch-end_time").val("");
                    return false;
                }
            }
        });
    })
</script>