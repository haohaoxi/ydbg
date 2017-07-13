<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\functions\functions;
?>
<link rel="stylesheet" type="text/css" href="js/jsdt/calendar/jscal2.css">
<link rel="stylesheet" type="text/css" href="js/jsdt/calendar/border-radius.css">
<link rel="stylesheet" type="text/css" href="js/jsdt/calendar/win2k.css">
<script type="text/javascript" src="js/jsdt/calendar/calendar.js"></script>
<script type="text/javascript" src="js/jsdt/calendar/lang/en.js"></script>
<div class="boxer">
    <div class="jiya-tab-con">
        <?php $form = ActiveForm::begin(
            [
                'action'=>Yii::$app->urlManager->createUrl(['personwork/personwork/create','menutype'=>intval($_GET['menutype'])]),
                'method' => 'post',
                'options' => ['class' => '','enctype' => 'multipart/form-data'],
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'fieldConfig' => [
                    'template' => "{input}{error}",//D:\wamp2\www\jsdt\vendor\yiisoft\yii2\helpers\BaseHtml.php 1222L
                    'inputOptions' => ['class' => 'q'],
                ]
            ]
        ); ?>
        <input type="hidden" name="menutype" value="<?= $_GET['menutype'] ?>">
        <div class="jiya-tab-top3" id="jiya-tab1">
            <div class="basic">
                <div class="default-table aj-table">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="aj_tle">主题：</td>
                            <td class="aj_input"><?= $form->field($model, 'p_title') ?></td>
                        </tr>
                        <tr>
                            <td class="aj_tle">工作开始时间：</td>
                            <td class="aj_input"><?= $form->field($model, 'p_s_time')->textInput(array('readonly'=>'true','class' =>'q date')) ?></td>
                            <script type="text/javascript">
                                Calendar.setup({
                                    weekNumbers: true,
                                    inputField : "personwork-p_s_time",
                                    trigger    : "personwork-p_s_time",
                                    dateFormat: "%Y-%m-%d %H:%m:%S",
                                    showTime: true,
                                    format:'-',
                                    minuteStep: 1,
                                    min:"<?= date('Y-m-d H:i:s'); ?>",
                                    onSelect   : function() {this.hide();}
                                });
                            </script>
                        </tr>
                        <tr>
                            <td class="aj_tle">工作结束时间：</td>
                            <td class="aj_input"><?= $form->field($model, 'p_e_time')->textInput(array('readonly'=>'true','class' =>'q date')) ?></td>
                            <script type="text/javascript">
                                Calendar.setup({
                                    weekNumbers: true,
                                    inputField : "personwork-p_e_time",
                                    trigger    : "personwork-p_e_time",
                                    dateFormat: "%Y-%m-%d %H:%m:%S",
                                    showTime: true,
                                    minuteStep: 1,
                                    min:"<?= date('Y-m-d H:i:s'); ?>",
                                    onSelect   : function() {this.hide();}
                                });
                            </script>
                        </tr>
                        <tr>
                            <td class="aj_tle">优先级：</td>
                            <td class="aj_input"><?= $form->field($model, 'p_level')->dropDownList(functions::getLevel()) ?></td>
                        </tr>
                        <tr>
                            <td class="aj_tle">审批人：</td>
                            <td class="aj_input"><?= $form->field($model, 'p_spr') ?></td>
                        </tr>
                        <tr>
                            <td class="aj_tle">受理人：</td>
                            <td class="aj_input"><?= $form->field($model, 'p_y_slr') ?></td>
                        </tr>
                        <tr>
                            <td class="aj_tle">详情：</td>
                            <td class="aj_input"><?= $form->field($model, 'p_details')->textarea(['rows'=>6]) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="aj_page">
                <?= Html::input('button','','返回', ['class' => 'but','onclick'=>'javascript:history.go(-1);']) ?>
                <?= Html::input('submit','','存档', ['class' => 'but']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>