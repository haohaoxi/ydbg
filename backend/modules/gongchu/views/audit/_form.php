<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\gongchu\models\Gongchu;
/* @var $this yii\web\View */
/* @var $model backend\modules\gongchu\models\Gongchu */
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
        <?php
        $dept=Yii::$app->user->identity->department;
        $username=Yii::$app->user->identity->name;
        $userId=Yii::$app->user->id;
        $deptName=Gongchu::getDeptNameById($dept);
        $deptLeader=Gongchu::getDeptLeader($dept);//根据部门号找到部门负责人
        $branchLeader=Gongchu::getBranchLeader($dept);//根据部门号找到院领导

        ?>
        <strong>【公出审批】</strong>
        <span><em>*</em>科(室、局)</span>
        <?= $form->field($model, 'dept')->textInput(['disabled'=>true,'value'=>$model->dept,'name'=>'deptname']) ?>
        <span><em>*</em>公出人</span>
        <?= $form->field($model, 'gc_ren')->textInput(['maxlength' => true,'value'=>$model->gc_ren,'disabled'=>true]) ?>
        <span><em>*</em>公出人数</span>
        <?= $form->field($model, 'gc_count')->textInput(['disabled'=>true,'value'=>$model->gc_count]) ?>
        <span><em>*</em>公出时间</span>
        <?= $form->field($model, 'gc_time')->textInput(['disabled'=>true,'value'=>$model->gc_time]) ?>
        <span><em>*</em>结束时间</span>
        <?= $form->field($model, 'end_time')->textInput(['disabled'=>true,'value'=>$model->end_time]) ?>
        <span><em>*</em>公出地点</span>
        <?= $form->field($model, 'gc_place')->textInput(['disabled'=>true,'value'=>$model->gc_place]) ?>
        <span class="tall"><em>*</em>因公外出</span>
        <?= $form->field($model, 'ygwc',['options'=>['class'=>'tall']])->textarea(['disabled'=>true,'rows' => 3]) ?>
        <span>申请时间</span>
        <?= $form->field($model, 'apply_time')->textInput(['disabled'=>true,'maxlength' => true]) ?><br class="clr" />
        <span><em>*</em>经办人</span>
        <?= $form->field($model, 'jb_ren')->textInput(['disabled'=>true,'value'=>$model->jb_ren]) ?>
        <?php if(!empty($model->dept_leader)){?>
            <span><em>*</em>科室领导</span>
            <?= $form->field($model, 'dept_leader')->textInput(['disabled'=>true,'onclick'=>'showDiv("dept","move_dept")','name'=>'dept_leader']) ?><br class="clr" />
        <?php } ?>
        <?php if(!empty($model->yuan_leader)){?>
            <span><em>*</em>院领导</span>
            <?= $form->field($model, 'yuan_leader')->textInput(['disabled'=>true,'onclick'=>'showDiv("yuan","move_yuan")','name'=>'yuan_leader']) ?><br class="clr" />
        <?php } ?>
        <?php if(!empty($model->jcz)):?>
            <span><em>*</em>检察长</span>
            <?= $form->field($model, 'jcz')->textInput(['disabled'=>true,'value'=>$model->jcz,'name'=>'jcz_leader']) ?>
        <?php endif ?>
        <?php if(isset($_GET['type']) && (($_GET['type']=='dept' && $model->dept_audit==0) || ($_GET['type']=='yuan' && $model->yuan_audit==0)
                || ($_GET['type']=='jcz' && $model->jcz_audit==0))):?>
            <?= Html::input('button','','同意', ['class' => 'btn','onclick'=>'agree()']) ?>
            <?= Html::input('button','','驳回', ['class' => 'btn','onclick'=>'showDiv("bohui","move_bohui")']) ?>
        <?php endif ?>
        <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'goback();']) ?>
        <div style="display: none">
            <?= $form->field($model, 'dept_audit')->hiddenInput(['value'=>0])->span('') ?>
            <?= $form->field($model, 'yuan_audit')->hiddenInput(['value'=>0])->span('')  ?>
            <?= $form->field($model, 'yuan_reason')->hiddenInput(['value'=>''])->span('')  ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<script type="text/javascript" src="/js/popDiv.js"></script>
<script type="text/javascript">
    function disAgree(){
        document.getElementById("gongchu-yuan_audit").value=2;//驳回状态
        var reason=document.getElementById("gongchu-yuan_reason").value=document.getElementById("bohui_reason").value;
        if(reason==null||reason.length == 0){
            alert('驳回理由不能为空');
            return false;
        }
        $("#w0").submit();
    }
    function agree(){
        if(confirm('确认审核通过?')){
            $("#gongchu-yuan_audit").val(1);
            $("#w0").submit();
        }
    }
    function goback(){
        window.location.href='<?= Yii::$app->urlManager->createUrl('gongchu/audit/index');?>';
    }
</script>
<div id="bohui" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_bohui"><!--移动弹出层-->
        <div class="ui-dialog-title">公出驳回</div>
        <div class="qingjia-bohui">
            <textarea name="" id="bohui_reason"></textarea>
            <input type="button" value="确定" onclick="disAgree()"/>
            <input type="button" value="关闭" class="cz" onclick="closeDiv('bohui');" />
        </div>
    </div>
</div>
