<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\modules\deptcontact\models\DeptContact;
use \yii\helpers\ArrayHelper;
?>
<div class="default-search">
    <?php $form = ActiveForm::begin([
        'action' => ['record'],
        'method' => 'get',
        'options' => ['class' => ''],
        'fieldConfig' => [
            'template' => "{span}{input}{error}",
            'inputOptions' => ['class' => 'q'],
        ]
    ]); ?>

    <span>科室	</span>
    <?= $form->field($model, 'welfare_department')->dropDownList(ArrayHelper::map(DeptContact::getDept(),'id','dept_name'),['prompt'=>'--选择机构--','style'=>'width:150px;'])->span('') ?>
    <span>申请人	</span>
    <?= $form->field($model, 'welfare_apply_mee_name')->textInput()->span('') ?>
    <span>申请时间	</span>
    <?= $form->field($model, 'welfare_sq_time_s')->textInput(array('readonly'=>'true','class' =>'q date'))->span('') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "welfareapplysearch-welfare_sq_time_s",
            trigger    : "welfareapplysearch-welfare_sq_time_s",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <span>至</span>
    <?= $form->field($model, 'welfare_sq_time_e')->textInput(array('readonly'=>'true','class' =>'q date'))->span('') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "welfareapplysearch-welfare_sq_time_e",
            trigger    : "welfareapplysearch-welfare_sq_time_e",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?= Html::input('reset','','重置', ['class' => 'btn']) ?>
    <?= Html::input('submit','','查询', ['class' => 'btn','id'=>'chaxun']) ?>
    <div class="clr"></div>
    <?php ActiveForm::end(); ?>
</div>
<!--给查询时间做出判断-->
<script>
    $(function(){
        $("#chaxun").click(function(){
            var release = $("#welfareapplysearch-welfare_sq_time_s").val();
            var modify = $("#welfareapplysearch-welfare_sq_time_e").val();
            if(release>modify){
                if(modify!=''){
                    alert('时间格式错误');
                    $("#welfareapplysearch-welfare_sq_time_e").val("");
                    return false;
                }
            }
        });
    })
</script>