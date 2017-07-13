<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\modules\deptcontact\models\DeptContact;
use \yii\helpers\ArrayHelper;
?>
<div class="default-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => ''],
        'fieldConfig' => [
            'template' => "{span}{input}{error}",
            'inputOptions' => ['class' => 'q'],
        ]
    ]); ?>

    <span>福利名称	</span>
    <?= $form->field($model, 'welfare_name')->textInput()->span('') ?>
    <span>申请时间	</span>
    <?= $form->field($model, 'time_s')->textInput(array('readonly'=>'true','class' =>'q date'))->span('') ?>
    <script type="text/javascript">
        cal_s = Calendar.setup({
            weekNumbers: true,
            inputField : "welfaresearch-time_s",
            trigger    : "welfaresearch-time_s",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <span>至</span>
    <?= $form->field($model, 'time_e')->textInput(array('readonly'=>'true','class' =>'q date'))->span('') ?>
    <script type="text/javascript">
        cal_e = Calendar.setup({
            weekNumbers: true,
            inputField : "welfaresearch-time_e",
            trigger    : "welfaresearch-time_e",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?= Html::a('新增福利',Yii::$app->urlManager->createUrl(['welfare/welfare/create']), ['class' => 'btn']) ?>
    <?= Html::input('reset','','重置', ['class' => 'btn']) ?>
    <?= Html::input('submit','','查询', ['class' => 'btn','id'=>'chaxun']) ?>
    <div class="clr"></div>
    <?php ActiveForm::end(); ?>
</div>
<!--给查询时间做出判断-->
<script>
    $(function(){
        $("#chaxun").click(function(){
            var release = $("#welfaresearch-time_s").val();
            var modify = $("#welfaresearch-time_e").val();
            if(release>modify){
                if(modify!=''){
                    alert('时间格式错误');
                    $("#welfaresearch-time_e").val("");
                    return false;
                }
            }
        });
    })
</script>