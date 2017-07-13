<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\functions\api;
?>

<div class="staff-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => ''],
        'fieldConfig' => [
            'template' => "{span}{input}{error}",
            'inputOptions' => ['class' => 'q'],
        ]
    ]); ?>
    <?= $form->field($model, 'title')->span('通告标题') ?>
    <?= $form->field($model, 'adate')->textInput(array('readonly'=>'true','class' =>'q date'))->span('发布时间')?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "tzggglsearch-adate",
            trigger    : "tzggglsearch-adate",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?= $form->field($model, 'sdate')->textInput(array('readonly'=>'true','class' =>'q date'))->span('—') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "tzggglsearch-sdate",
            trigger    : "tzggglsearch-sdate",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <a href="<?= Yii::$app->urlManager->createUrl(['tzgggl/tzgggl/create']) ?>" class="btn" style="float: right">新增通告</a>
    <?= Html::input('submit','','查询', ['class' => 'btn' , 'style' => 'float:right','id'=>'chaxun']) ?>
    <?= Html::input('reset','','重置', ['class' => 'btn' , 'style' => 'float:right']) ?>
    <br class="clr">
    <?php ActiveForm::end(); ?>
</div>
<script>
    $(":button").click(function(){
        $("#tzggglsearch-adate").attr("value","");
        $("#tzggglsearch-sdate").attr("value","");
        $("#tzggglsearch-title").attr("value","");
    })
</script>
<!--给查询时间做出判断-->
<script>
    $(function(){
        $("#chaxun").click(function(){
            var release = $("#tzggglsearch-adate").val();
            var modify = $("#tzggglsearch-sdate").val();
            if(release>modify){
                if(modify!=''){
                    alert('时间格式错误');
                    $("#tzggglsearch-sdate").val("");
                    return false;
                }
            }
        });
    })
</script>


