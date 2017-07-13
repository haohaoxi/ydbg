<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\qingjia\models\Qingjia */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    .qingjia-bohui {
        height: 250px;
        padding: 20px;
        width: 354px;
    }
    .qingjia-bohui textarea {
        height: 200px;
        width: 100%;
    }
    .qingjia-bohui input {
        background: #6d9be2 none repeat scroll 0 0;
        border: 0 none;
        color: #fff;
        cursor: pointer;
        display: inline;
        float: left;
        font-size: 14px;
        height: 28px;
        line-height: 30px;
        margin-left: 100px;
        margin-top: 10px;
        overflow: hidden;
        text-align: center;
        width: 60px;
    }
    .qingjia-bohui input.cz {
        margin-left: 30px;
    }
    .ui-dialog-close {
        background: transparent none repeat scroll 0 0;
        border: 0 none;
        color: #000;
        cursor: pointer;
        width: 300px;
        margin-right: 10px;
        /*float: right;*/
        font-size: 21px;
        font-weight: bold;
        line-height: 1;
        opacity: 0.2;
        padding: 0 4px;
        position: relative;
        right: 13px;
        text-shadow: 0 1px 0 #fff;
        top: 13px;
    }
    .ui-dialog-title {
        cursor: default;
        font-weight: bold;
        line-height: 1.42857;
        margin: 0;
        min-height: 16.4286px;
        overflow: hidden;
        padding: 15px;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .ui-dialog-header {
        border-bottom: 1px solid #e5e5e5;
        white-space: nowrap;
    }

</style>
<div class="boxer" id="boxer-zh">
    <div class="default-form qingjia-form">
        <?php $form = ActiveForm::begin([
            'options' => ['class' => '','enctype' => 'multipart/form-data'],
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'fieldConfig' => [
                'template' => "{input}{error}",
                'inputOptions' => ['class' => 'q'],
                'errorOptions'=>['class' => 'tishi'],
            ]

        ]); ?>
        <strong>【请假审批】</strong>
        <span><em>*</em>请假人</span>
        <?= $form->field($model, 'qj_ren')->textInput(['disabled'=>true,'maxlength' => true])?><br class="clr" />
        <span><em>*</em>所属机构</span>
        <?= $form->field($model, 'dept')->textInput(['disabled'=>true,'maxlength' => true])?><br class="clr" />
        <span><em>*</em>行政职务</span>
        <?= $form->field($model, 'position')->textInput(['disabled'=>true,'maxlength' => true])?><br class="clr" />
        <span><em>*</em>请假类型</span>
        <?= $form->field($model, 'qj_type')->textInput(['disabled'=>true,'maxlength' => true]) ?><br class="clr" />
        <span><em>*</em>申请时间</span>
        <?= $form->field($model, 'apply_time')->textInput(['disabled'=>true,'class'=>'q date']) ?><br class="clr" />
        <span><em>*</em>请假时间</span>
        <?= $form->field($model, 'qj_time')->textInput(['disabled'=>true,'class'=>'q date']) ?><br class="clr" />
        <span><em>*</em>结束时间</span>
        <?= $form->field($model, 'end_time')->textInput(['disabled'=>true,'class'=>'q date']) ?><br class="clr" />
        <span><em>*</em>请假时长/天</span>
        <?= $form->field($model, 'qj_day')->textInput(['disabled'=>true,'maxlength' => true]) ?><br class="clr" />
        <span class="tall"><em>*</em>请假事由</span>
        <?= $form->field($model, 'qj_reason',['options'=>['class'=>'tall']])->textarea(['disabled'=>true,'maxlength' => true]) ?><br class="clr" />
        <?php if(!empty($model->dept_leader)):?>
            <span>科室领导意见</span>
            <?= $form->field($model, 'dept_leader')->textInput(['disabled'=>true,'maxlength' => true,'style'=>'width:300px']) ?><br class="clr" />
        <?php endif ?>
        <?php if(!empty($model->branch_leader)):?>
            <span>分管领导意见</span>
            <?= $form->field($model, 'branch_leader')->textInput(['disabled'=>true,'maxlength' => true,'style'=>'width:300px']) ?><br class="clr" />
        <?php endif ?>
        <?php if(!empty($model->zzc)):?>
            <span>政治处意见</span>
            <?= $form->field($model, 'zzc')->textInput(['disabled'=>true,'style'=>'width:300px']) ?><br class="clr" />
        <?php endif ?>
        <?php if(!empty($model->jcz)):?>
            <span><em>*</em>检察长意见</span>
            <?= $form->field($model, 'jcz')->textInput(['disabled'=>true,'style'=>'width:300px']) ?><br class="clr" />
        <?php endif ?>
        <?php if(isset($_GET['type']) && (($_GET['type']=='dept' && $model->dept_audit==0) || ($_GET['type']=='branch' && $model->branch_audit==0)
                || ($_GET['type']=='zzc' && $model->zzc_audit==0) || ($_GET['type']=='jcz' && $model->jcz_audit==0))):?>
        <?= Html::a('同意','#',['class' => 'btn','onclick'=>'agree()']) ?>
        <?= Html::a('驳回','#',['class' => 'btn','onclick'=>'showDiv("bohui","move_bohui")']) ?>
        <?php endif ?>
        <?= Html::a('返回','#:;',['class'=>'btn','onclick'=>'goback();']) ?>
        <br class="clr" />
        <div style="display: none">
            <?= $form->field($model, 'zzc_audit')->hiddenInput([])->span('')  ?>
            <?= $form->field($model, 'zzc_reason')->hiddenInput([])->span('')  ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<script type="text/javascript" src="/js/popDiv.js"></script>
<script type="text/javascript">
    function disAgree(){
        document.getElementById("qingjia-zzc_audit").value=2;//驳回状态
        var reason=document.getElementById("qingjia-zzc_reason").value=document.getElementById("bohui_reason").value;
        if(reason==null||reason.length == 0){
            alert('驳回理由不能为空');
            return false;
        }
        $("#w0").submit();
    }
    function agree(){
        if(confirm('确认审核通过?')){
            $("#qingjia-zzc_audit").val(1);
            $("#w0").submit();
        }
    }
    function goback(){
        window.location.href='<?= Yii::$app->urlManager->createUrl('qingjia/audit/index');?>';
    }
</script>
<div id="bohui" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_bohui"><!--移动弹出层-->
        <div class="ui-dialog-title">审批驳回</div>
        <div class="qingjia-bohui">
            <textarea name="" id="bohui_reason"></textarea>
            <input type="button" value="确定" onclick="disAgree()"/>
            <input type="button" value="关闭" class="cz" onclick="closeDiv('bohui');" />
        </div>
    </div>
</div>