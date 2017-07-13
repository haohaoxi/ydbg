<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\functions\functions;
?>
<div class="default-search person-search">
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
        cal_s = Calendar.setup({
            weekNumbers: true,
            inputField : "personworksearch-p_s_time_s",
            trigger    : "personworksearch-p_s_time_s",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            reverseWheel:true,
            onSelect   : function() {
                if (!/^(\d{4})(\d{2})(\d{2})$/.test(this.selection.get())) {
                    alert("日期格式不正确!");
                    $('#personworksearch-p_s_time_s').val('');
                    return false
                }

                var date = Calendar.intToDate(this.selection.get());
                cal_e.args.min = date;
                cal_e.redraw();
                this.hide();
            }
        });
    </script>
    <?= $form->field($model, 'p_s_time_e')->textInput(array('readonly'=>'true','class' =>'q date'))->span('-') ?>
    <script type="text/javascript">
        cal_e = Calendar.setup({
            weekNumbers: true,
            inputField : "personworksearch-p_s_time_e",
            trigger    : "personworksearch-p_s_time_e",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            reverseWheel:true,
            onSelect   : function() {
                if (!/^(\d{4})(\d{2})(\d{2})$/.test(this.selection.get())) {
                    alert("日期格式不正确!");
                    $('#personworksearch-p_s_time_e').val('');
                    return false
                }
                var date = Calendar.intToDate(this.selection.get());
                cal_s.args.max = date;
                cal_s.redraw();
                this.hide();
            }

            });
    </script>
    <?php if(!empty($_GET['menutype']) && $_GET['menutype'] == 5){ ?>
        <a href="<?= Yii::$app->urlManager->createUrl(['personwork/personwork/create','menutype'=>intval($_GET['menutype'])]) ?>" class="btn yuqi-return">发起工作</a>
    <?php } ?>
    <?= Html::input('reset','','重置', ['class' => 'btn']) ?>
    <?= Html::input('submit','','查询', ['class' => 'btn']) ?>
    <?php ActiveForm::end(); ?>

    <div class="clr"></div>
</div>

