<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\functions\functions;
use backend\functions\api;
use \yii\helpers\ArrayHelper;
use backend\modules\position\models\Position;
?>
<?=Html::cssFile('@web/css/ydbg/add2.css')?>

<div class="boxer">
    <div class="default-form">
        <?php $form = ActiveForm::begin(
            [
                'method' => 'post',
                'options' => ['class' => '','enctype' => 'multipart/form-data'],
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'fieldConfig' => [
                    'template' => "{input}{error}",
                    'inputOptions' => ['class' => ''],
                    'errorOptions'=>['class' => 'tishi'],
                ]
            ]
        ); ?>
        <strong>【基本信息】</strong>
        <span><em>*</em>姓名</span>
        <div><?= $form->field($model, 'username')->textInput(['class'=>'','placeholder'=>'<请输入>']) ?></div><br class="clr" />
        <span><em>*</em>所属机构</span>
        <div class="spec"><?= $form->field($model, 'dept_id')->dropDownList($list,['prompt'=>'请选择'])->span('所属机构') ?></div><br class="clr" />
        <span><em>*</em>行政职务</span>
        <div class="spec"><?= $form->field($model, 'position')->dropDownList(Position::getZhiwu(),['prompt'=>'请选择'])->span('行政职务') ?></div><br class="clr" />
        <strong>【联系方式】</strong>
        <span><em>*</em>手机号码</span>
        <div><?= $form->field($model, 'telphone')->textInput(['class'=>'','placeholder'=>'<请输入>']) ?></div><br class="clr" />
        <span>外线1</span>
        <div><?= $form->field($model, 'wxone')->textInput(['class'=>'','placeholder'=>'<请输入>']) ?></div><br class="clr" />
        <span>外线2</span>
        <div><?= $form->field($model, 'wxtwo')->textInput(['class'=>'','placeholder'=>'<请输入>']) ?></div><br class="clr" />
        <span>内线</span>
        <div><?= $form->field($model, 'inline')->textInput(['class'=>'','placeholder'=>'<请输入>']) ?></div><br class="clr" />

            <?php if(empty($_GET['look_type'])){ ?>
            <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>
            <?= Html::input('submit','','存档', ['class' => 'btn']) ?>
            <?php }else{ ?>
            <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>
            <?php } ?>

    </div>
    <?php ActiveForm::end(); ?>
</div>


