<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\studyjl\models\StudyjlSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="tab">
    <ul>
        <li><a href="/index.php?r=studytk%2Fstudytk%2Findex">题库</a></li>
        <li><a href="/index.php?r=studysj%2Fstudysj%2Findex" >试卷</a></li>
        <li><a href="/index.php?r=studyjl%2Fstudyjl%2Findex" class="on">考试记录</a></li>
    </ul>
</div>
<div class="clr"></div>
<div class="default-search study-search">
<div class="studyjl-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => ''],
        'fieldConfig' => [
            'template' => "{span}{input}{error}",
            'inputOptions' => ['class' => 'q'],
        ]
    ]); ?>

    <?= $form->field($model, 'mechan')->textInput()->span("所属机构")?>

    <?= $form->field($model, 'name')->textInput()->span("考试名称") ?>

    <?= $form->field($model, 'username')->textInput()->span("人员姓名") ?>

    <?= $form->field($model, 'start_date')->textInput(['readonly'=>'true','class'=>'q date'])->span("开始考试时间") ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "studyjlsearch-start_date",
            trigger    : "studyjlsearch-start_date",
            dateFormat: "%Y-%m-%d ",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?php  echo $form->field($model, 'pate_date')->textInput(['readonly'=>'true','class'=>'q date'])->span("参加考试时间") ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "studyjlsearch-pate_date",
            trigger    : "studyjlsearch-pate_date",
            dateFormat: "%Y-%m-%d ",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?php // echo $form->field($model, 'result') ?>
    <input type="button" value="重置" class="btn" />
    <input type="submit" value="查询" class="btn" />
    <div class="clr"></div>
</div>
    <script>
        $(function(){
            $(":button").click(function(){
                $("#studyjlsearch-name").attr("value","");
                $("#studyjlsearch-username").attr("value","");
                $("#studyjlsearch-start_date").attr("value","");
                $("#studyjlsearch-pate_date").attr("value","");
                $("#studyjlsearch-mechan").attr("value","");
            })
        })
    </script>
