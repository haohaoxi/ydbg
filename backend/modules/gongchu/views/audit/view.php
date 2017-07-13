<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use backend\modules\gongchu\models\Gongchu;

/* @var $this yii\web\View */
/* @var $model backend\modules\gongchu\models\Gongchu */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gongchus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
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
        <strong>【公出详情】</strong>
        <span><em>*</em>科（室、局）</span>
        <?= $form->field($model, 'dept')->textInput(['disabled'=>true,'name'=>'deptname']) ?><br class="clr" />
        <span><em>*</em>公出人</span>
        <?= $form->field($model, 'gc_ren')->textInput(['disabled'=>true,'maxlength' => true,'onclick'=>'showDiv("gongchuren","move_ren")','name'=>'']) ?><br class="clr" />
        <span><em>*</em>公出人数</span>
        <?= $form->field($model, 'gc_count')->textInput(['disabled'=>true,]) ?><br class="clr" />
        <span><em>*</em>公出时间</span>
        <?= $form->field($model, 'gc_time')->textInput(['disabled'=>true,'class'=>'q date']) ?><br class="clr" />
        <span><em>*</em>结束时间</span>
        <?= $form->field($model, 'end_time')->textInput(['disabled'=>true,'class'=>'q date']) ?><br class="clr" />
        <span>公出地点</span>
        <?= $form->field($model, 'gc_place')->textInput(['disabled'=>true,'maxlength' => true]) ?><br class="clr" />
        <span class="tall"><em>*</em>因公外出</span>
        <?= $form->field($model, 'ygwc',['options'=>['class'=>'tall']])->textarea(['disabled'=>true,'rows' => 3]) ?><br class="clr" />
        <span>申请时间</span>
        <?= $form->field($model, 'apply_time')->textInput(['disabled'=>true,'maxlength' => true]) ?><br class="clr" />
        <span><em>*</em>经办人</span>
        <?= $form->field($model, 'jb_ren')->textInput(['disabled'=>true]) ?><br class="clr" />
        <?php if(!empty($model->dept_leader)):?>
            <span><em>*</em>科室领导</span>
            <?= $form->field($model, 'dept_leader')->textInput(['disabled'=>true,'onclick'=>'showDiv("dept","move_dept")','name'=>'dept_leader']) ?><br class="clr" />
        <?php endif ?>
        <?php if(!empty($model->yuan_leader)):?>
            <span><em>*</em>院领导</span>
            <?= $form->field($model, 'yuan_leader')->textInput(['disabled'=>true,'onclick'=>'showDiv("yuan","move_yuan")','name'=>'yuan_leader']) ?><br class="clr" />
        <?php endif ?>
        <?php if(!empty($model->jcz)):?>
            <span><em>*</em>检察长</span>
            <?= $form->field($model, 'jcz')->textInput(['disabled'=>true,'onclick'=>'showDiv("jcz","move_jcz")','name'=>'jcz_leader']) ?><br class="clr" />
        <?php endif ?>

        <?= Html::a('返回','#:;',['class'=>'btn','onclick'=>'goback();']) ?>
        <br class="clr" />

        <?php ActiveForm::end(); ?>

    </div>
</div>
<script type="text/javascript">
    function goback(){
        window.location.href='<?= Yii::$app->urlManager->createUrl('gongchu/audit/index');?>';
    }
</script>
