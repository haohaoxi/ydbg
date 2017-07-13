<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\studytk\models\StudytkSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="tab">
    <ul>
        <li><a href="/index.php?r=studytk%2Fstudytk%2Findex" class="on">题库</a></li>
        <li><a href="/index.php?r=studysj%2Fstudysj%2Findex"  >试卷</a></li>
        <li><a href="/index.php?r=studyjl%2Fstudyjl%2Findex" >考试记录</a></li>
    </ul>
    <a href="/index.php?r=studytk%2Fstudytk%2Fcreate" class="test-add">新增试题</a>
</div>
    <div class="clr"></div>
    <div class="default-search study-search">
<div class="studytk-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => ''],
        'fieldConfig' => [
            'template' => "{span}{input}{error}",
            'inputOptions' => ['class' => 'q'],
        ]
    ]); ?>

<!--    --><?php //echo  $form->field($model, 'id') ?>

    <?= $form->field($model, 'name')->span('题目名') ?>

    <?= $form->field($model, 'users')->span('录入人') ?>
    <?= $form->field($model, 'adate')->textInput(array('readonly'=>'true','class' =>'q date'))->span('录入时间') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "studytksearch-adate",
            trigger    : "studytksearch-adate",
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
            inputField : "studytksearch-sdate",
            trigger    : "studytksearch-sdate",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
        <input type="button" value="重置" class="btn" />
        <input type="submit" value="查询" class="btn" id="re" />
        <div class="clr"></div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
    $(":button").click(function(){
        $("#studytksearch-name").attr("value","");
        $("#studytksearch-users").attr("value","");
        $("#studytksearch-adate").attr("value","");
        $("#studytksearch-sdate").attr("value","");
    })
</script>


<!--判断时间后置时间不能大于前置时间-->
<script>
    $(function(){
        $("#re").click(function(){
            var front = $("#studytksearch-adate").val();
            var back = $("#studytksearch-sdate").val();
            if(front!= '' && back!='' && front>back ){
                alert("时间错误！");
                $("#studytksearch-sdate").val("");
                return false;
            }
        })
    })
</script>
