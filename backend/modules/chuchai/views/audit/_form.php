<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\gongchu\models\Gongchu;

/* @var $this yii\web\View */
/* @var $model backend\modules\chuchai\models\Chuchai */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    .btn1{
        margin-left: 200px;
    }
    .btn1 input{
        display: inline;
        width: 60px;
        height: 28px;
        border: 0px;
        background: #6d9be2;
        text-align: center;
        line-height: 30px;
        color: #fff;
        font-size: 14px;
        margin: 0px 5px;
        overflow: hidden;
        cursor: pointer;
        margin-top: 10px;

    }
</style>
<div class="boxer" id="boxer-zh">
    <div class="default-form">
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
        <strong>【出差详情】</strong>
        <span><em>*</em>科（室、局）</span>
        <?= $form->field($model, 'dept')->textInput(['disabled'=>true,'value'=>$model->dept,'name'=>'deptname']) ?>
        <span><em>*</em>出差人员</span>
        <?= $form->field($model, 'cc_ren')->textInput(['maxlength' => true,'value'=>$model->cc_ren,'disabled'=>true]) ?>
        <span><em>*</em>出差人数</span>
        <?= $form->field($model, 'cc_count')->textInput(['disabled'=>true,'value'=>$model->cc_count]) ?>
        <span><em>*</em>申请人</span>
        <?= $form->field($model, 'apply_ren')->textInput(['disabled'=>true,'value'=>$model->apply_ren]) ?>
        <span><em>*</em>申请时间</span>
        <?= $form->field($model, 'apply_time')->textInput(['disabled'=>true,'value'=>$model->apply_time]) ?>
        <span><em>*</em>出差时间</span>
        <?= $form->field($model, 'cc_date')->textInput(['disabled'=>true,'value'=>$model->cc_date]) ?>
        <span><em>*</em>结束时间</span>
        <?= $form->field($model, 'end_date')->textInput(['disabled'=>true,'value'=>$model->end_date]) ?>
        <span><em>*</em>出差地点</span>
        <?= $form->field($model, 'cc_place')->textInput(['disabled'=>true,'value'=>$model->cc_place]) ?>
        <span class="tall"><em>*</em>出差任务</span>
        <?= $form->field($model, 'cc_task',['options'=>['class'=>'tall']])->textarea(['disabled'=>true,'rows' => 3]) ?>
        <span><em>*</em>乘坐交通工具</span>
        <?= $form->field($model, 'cc_transporation')->textInput(['disabled'=>true,'value'=>$model->cc_transporation]) ?>
        <?php if(!empty($model->dept_leader)):?>
            <span><em>*</em>科室负责人意见</span>
            <?= $form->field($model, 'dept_leader')->textInput(['disabled'=>true,'value'=>$model->dept_leader,'name'=>'dept_leader']) ?>
        <?php endif ?>
        <?php if(!empty($model->branch_leader)):?>
            <span><em>*</em>分管领导意见</span>
            <?= $form->field($model, 'branch_leader')->textInput(['disabled'=>true,'value'=>$model->branch_leader,'name'=>'branch_leader']) ?>
        <?php endif ?>
        <span><em>*</em>检察长审批</span>
        <?= $form->field($model, 'chief')->textInput(['disabled'=>true,'value'=>$model->chief,'name'=>'chief_leader']) ?>

        <?php if(isset($_GET['type']) && (($_GET['type']=='dept' && $model->dept_audit==0) || ($_GET['type']=='branch' && $model->branch_audit==0)
                || ($_GET['type']=='chief' && $model->chief_audit==0))):?>
            <?= Html::input('button','','同意', ['class' => 'btn','onclick'=>'agree()']) ?>
            <?= Html::input('button','','驳回', ['class' => 'btn','onclick'=>'showDiv("bohui","move_bohui")']) ?>
        <?php endif ?>
        <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'goback();']) ?>

        <div style="display: none">
            <?= $form->field($model, 'dept_audit')->hiddenInput(['value'=>0])->span('') ?>
            <?= $form->field($model, 'branch_audit')->hiddenInput(['value'=>0])->span('')  ?>
            <?= $form->field($model, 'chief_audit')->hiddenInput(['value'=>0])->span('')  ?>
            <?= $form->field($model, 'chief_reason')->hiddenInput(['value'=>''])->span('')  ?>

        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<script type="text/javascript" src="/js/popDiv.js"></script>
<script type="text/javascript">
    function goback(){
        window.location.href='<?= Yii::$app->urlManager->createUrl('chuchai/audit/index');?>';
    }
    function disAgree(){
        document.getElementById("chuchai-chief_audit").value=2;//驳回状态
        var reason=document.getElementById("chuchai-chief_reason").value=document.getElementById("bohui_reason").value;
        if(reason==null||reason.length == 0){
            alert('驳回理由不能为空');
            return false;
        }
        $("#w0").submit();
    }
    function agree(){
        if(confirm('确认审核通过?')){
            $("#chuchai-chief_audit").val(1);
            $("#w0").submit();
        }
    }
</script>
<div id="bohui" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_bohui"><!--移动弹出层-->
        <div class="ui-dialog-title">请填写驳回缘由</div>
        <div class="qingjia-bohui">
            <textarea name="" id="bohui_reason"></textarea>
            <input type="button" value="确定" onclick="disAgree()"/>
            <input type="button" value="关闭" class="cz" onclick="closeDiv('bohui');" />
        </div>
    </div>
</div>