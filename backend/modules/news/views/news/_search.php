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
    <?= $form->field($model, 'title')->span('新闻标题') ?>
    <?= $form->field($model, 'adate')->textInput(array('readonly'=>'true','class' =>'q date'))->span('发布时间') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "newssearch-adate",
            trigger    : "newssearch-adate",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?= $form->field($model, 'sdate')->textInput(array('readonly'=>'true','class' =>'q date'))->span('-')?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "newssearch-sdate",
            trigger    : "newssearch-sdate",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <a href="<?= Yii::$app->urlManager->createUrl(['news/news/create']) ?>" class="btn" style="float: right">新增新闻</a>
    <?= Html::input('submit','','查询', ['class' => 'btn' , 'style' => 'float:right']) ?>
    <?= Html::input('button','','重置', ['class' => 'btn' , 'style' => 'float:right']) ?>
    <br class="clr">
    <?php ActiveForm::end(); ?>
</div>

<script>
    $(":button").click(function(){
        $("#newssearch-adate").attr("value","");
        $("#newssearch-sdate").attr("value","");
        $("#newssearch-title").attr("value","");
    })
</script>


