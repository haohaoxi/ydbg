<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\Vehicle */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    span label{
        color: #ff0000;
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

        <strong>【新增车辆】</strong>
        <span><em>*</em>车辆用途</span>
        <?= $form->field($model, 'v_usage')->textInput(['maxlength' => true,'value'=>'04执法执勤用车(一般)'],['placeholder'=>"请填写"]) ?><br class="clr" />

        <span><em>*</em>单位名称</span>
        <?= $form->field($model, 'dept')->textInput(['maxlength' => true,'value'=>'闽侯县人民检察院']) ?>

        <span><em>*</em>组织机构代码证</span>
        <?= $form->field($model, 'code_no')->textInput(['maxlength' => true,'value'=>'003606526']) ?>

        <span><em>*</em>车牌号</span>
        <?= $form->field($model, 'v_license')->textInput(['maxlength' => true]) ?>

        <span><em>*</em>机动车证书编号</span>
        <?= $form->field($model, 'regist_no')->textInput(['maxlength' => true]) ?>

        <span><em>*</em>车辆登记日期</span>
        <?= $form->field($model, 'regist_date')->textInput(['readonly'=>true,'value'=>date('Y-m-d',time()),'class'=>"q date"]) ?>

        <span><em>*</em>汽车分类</span>
        <?= $form->field($model, 'v_type')->dropDownList($vehicles,['prompt'=>'--选择车辆类型--','style'=>'margin-top:6px']) ?>

        <span><em>*</em>规格型号</span>
        <?= $form->field($model, 'xinghao')->textInput(['maxlength' => true]) ?>

        <span><em>*</em>排量</span>
        <?= $form->field($model, 'pailiang')->textInput(['maxlength' => true]) ?>

        <span><em>*</em>数量</span>
        <?= $form->field($model, 'count')->textInput(['readonly'=>true,'value'=>1]) ?>

        <span><em>*</em>金额（万元）</span>
        <?= $form->field($model, 'money')->textInput()?>

        <span><em>*</em>省控办审批情况</span>
        <?= $form->field($model, 'audit')->textInput(['maxlength' => true,'value'=>'高检警堪字NO:0021797'])?>

        <?=Html::a(Yii::t('app', '返回'), Yii::$app->urlManager->createUrl(['vehicle/vehicle/index']),['class' =>'btn yuqi-return','id'=>'back']);?>
        <?= Html::input('submit','','存档', ['class' => 'btn']) ?>
        <br class="clr">

        <?php ActiveForm::end(); ?>
    </div>
</div>
<!--确认放弃数据-->
<script type="text/javascript">
    $(function(){
        $("#back").click(function(){
            if(window.confirm('是否放弃所填表单？')){
                return true;
            }else{
                return false;
            }
        })
    })
</script>
