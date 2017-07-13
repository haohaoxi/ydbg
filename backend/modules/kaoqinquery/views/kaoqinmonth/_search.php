<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\kaoqinquery\models\KaoqinmonthSearch */
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

    <?= $form->field($model, 'kq_time')->textInput(['readonly'=>'true','class'=>'q date'])->span('考勤时间') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "kaoqinmonthsearch-kq_time",
            trigger    : "kaoqinmonthsearch-kq_time",
            dateFormat: "%Y-%m-%d ",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?= $form->field($model, 'kq_endtime')->textInput(['readonly'=>'true','class'=>'q date'])->span('—') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "kaoqinmonthsearch-kq_endtime",
            trigger    : "kaoqinmonthsearch-kq_endtime",
            dateFormat: "%Y-%m-%d ",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?= $form->field($model, 'username')->textInput(['class' => 'q'])->span('考勤人员') ?>

    <?= Html::a('导入月报', Yii::$app->urlManager->createUrl(['/kaoqinquery/kaoqinmonth/create']), ['class' => 'btn']) ?>
    <input class="btn search" type="submit" value="查询" id="chaxun">
    <input class="btn" type="button" value="重置">
    <div class="clr"></div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    /* 重置筛选条件 */
    $(":button").click(function(){
        $("#kaoqinmonthsearch-username").attr("value","");
        $("#kaoqinmonthsearch-kq_time").attr("value","");
        $("#kaoqinmonthsearch-kq_endtime").attr("value","");
    })
</script>
<!--给查询时间做出判断-->
<script>
    $(function(){
        $("#chaxun").click(function(){
            var release = $("#kaoqinmonthsearch-kq_time").val();
            var modify = $("#kaoqinmonthsearch-kq_endtime").val();
            if(release>modify){
                if(modify!=''){
                    alert('时间格式错误');
                    $("#kaoqinmonthsearch-kq_endtime").val("");
                    return false;
                }
            }
        });
    })
</script>