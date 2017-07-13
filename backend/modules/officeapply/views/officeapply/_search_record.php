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
    <?= $form->field($model, 'apply_department')->dropDownList(ArrayHelper::map(DeptContact::getDept(),'id','dept_name'),['prompt'=>'--选择机构--','style'=>'width:150px;'])->span('') ?>
    <span>申请人</span>
    <?= $form->field($model, 'apply_mee_text')->textInput()->span('') ?>
    <span>申请日期</span>
    <?= $form->field($model, 'apply_sq_time_s')->textInput(array('readonly'=>'true','class' =>'q date'))->span('') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "officeapplysearch-apply_sq_time_s",
            trigger    : "officeapplysearch-apply_sq_time_s",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <span>至</span>
    <?= $form->field($model, 'apply_sq_time_e')->textInput(array('readonly'=>'true','class' =>'q date'))->span('') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "officeapplysearch-apply_sq_time_e",
            trigger    : "officeapplysearch-apply_sq_time_e",
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
            var release = $("#officeapplysearch-apply_sq_time_s").val();
            var modify = $("#officeapplysearch-apply_sq_time_e").val();
            if(release>modify){
                if(modify!=''){
                    alert('时间格式错误');
                    $("#officeapplysearch-apply_sq_time_e").val("");
                    return false;
                }
            }
        });
    })
</script>