<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\functions\functions;
?>
<link rel="stylesheet" type="text/css" href="js/jsdt/calendar/jscal2.css">
<link rel="stylesheet" type="text/css" href="js/jsdt/calendar/border-radius.css">
<link rel="stylesheet" type="text/css" href="js/jsdt/calendar/win2k.css">
<script type="text/javascript" src="js/jsdt/calendar/calendar.js"></script>
<script type="text/javascript" src="js/jsdt/calendar/lang/en.js"></script>
<div class="jiya-search user-search">
    <?php $form = ActiveForm::begin([
        'action'=>Yii::$app->urlManager->createUrl(['personwork/personwork/index','menutype'=>intval($_GET['menutype'])]),
        'method' => 'get',
        'options' => ['class' => ''],
        'fieldConfig' => [
            'template' => "{span}{input}{error}",
            'inputOptions' => ['class' => 'q'],
        ]
    ]); ?>

    <?= $form->field($model, 'p_title')->span('主题') ?>

    <?php if(!empty($_GET['menutype']) && $_GET['menutype'] !=4){ ?>

    <?= $form->field($model, 'p_level')->dropDownList(functions::getLevel(),['prompt'=>'--选择优先级--'])->span('优先级') ?>

    <?php } ?>

    <?= $form->field($model, 'p_y_slr_text')->span('受理人') ?>

    <?= $form->field($model, 'p_s_time_s')->textInput(array('readonly'=>'true','class' =>'q date'))->span('工作开始时间') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "personworksearch-p_s_time_s",
            trigger    : "personworksearch-p_s_time_s",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?= $form->field($model, 'p_s_time_e')->textInput(array('readonly'=>'true','class' =>'q date'))->span('-') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "personworksearch-p_s_time_e",
            trigger    : "personworksearch-p_s_time_e",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?= Html::input('submit','','查询', ['class' => 'but']) ?>
    <?= Html::input('reset','','重置', ['class' => 'but']) ?>
    <?php ActiveForm::end(); ?>
    <?php if(!empty($_GET['menutype']) && $_GET['menutype'] == 5){ ?>
    <a href="<?= Yii::$app->urlManager->createUrl(['personwork/personwork/create','menutype'=>intval($_GET['menutype'])]) ?>">发起工作</a>
    <?php } ?>
    <br class="clr">
</div>

