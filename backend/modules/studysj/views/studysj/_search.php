<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\studysj\models\StudysjSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="tab">
    <ul>
        <li><a href="/index.php?r=studytk%2Fstudytk%2Findex">题库</a></li>
        <li><a href="/index.php?r=studysj%2Fstudysj%2Findex" class="on" >试卷</a></li>
        <li><a href="/index.php?r=studyjl%2Fstudyjl%2Findex" >考试记录</a></li>
    </ul>
    <a href="/index.php?r=studysj%2Fstudysj%2Fcreate" class="test-add">创建试卷</a>
</div>
<div class="clr"></div>
<div class="default-search study-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => ''],
        'fieldConfig' => [
            'template' => "{span}{input}{error}",
            'inputOptions' => ['class' => 'q'],
        ]
    ]); ?>
    <?php  echo $form->field($model, 'status')->dropDownList(['0'=>'未开始','1'=>'进行中','2'=>'已结束'],['prompt'=>'请选择','id'=>'test-status'])->span('状态') ?>
     <?= $form->field($model, 'name')->textInput(['class'=>'q'])->span('试卷名称') ?>
    <?php  echo $form->field($model, 'user')->textInput(['class'=>'q'])->span('出卷人') ?>

    <input type="button" value="重置" class="btn" />
    <input type="submit" value="查询" class="btn" />
    <div class="clr"></div>
</div>
    <?php ActiveForm::end(); ?>
<!--    --><?php //echo  $form->field($model, 'id') ?>
<!--    --><?php //echo  $form->field($model, 'mechanism') ?>
<!--    --><?php //echo  $form->field($model, 'standard') ?>
<!--    --><?php //echo  $form->field($model, 'start_time') ?>
    <?php // echo $form->field($model, 'end_time') ?>
    <?php // echo $form->field($model, 'offen') ?>

    <?php // echo $form->field($model, 'questions') ?>
    <?php // echo $form->field($model, 'p_id') ?>
<script>
    $(function(){
        $(":button").click(function () {
                $("#studysjsearch-name").attr("value","");
            $("#studysjsearch-user").attr("value","");
            $("select:first option:first").attr("selected",true);//重置为默认
        })
    })
</script>

