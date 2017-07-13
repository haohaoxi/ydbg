<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use \backend\modules\role\models\Role;
use \backend\functions\functions;
use backend\functions\api;
use backend\modules\position\models\Position;
use backend\modules\gongchu\models\Gongchu;
?>
<div class="boxer">
    <div class="default-form">
        <?php $form = ActiveForm::begin(
            [
                'options' => ['class' => '','enctype' => 'multipart/form-data'],
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'fieldConfig' => [
                    'template' => "{input}{error}",
                    'inputOptions' => ['class' => 'q'],
                    'errorOptions'=>['class' => 'tishi'],
                ]
            ]
        ); ?>
        <strong>【修改角色】</strong>
        <span><em>*</em>角色名称</span>
        <?= $form->field($model, 'name')->textInput(['class'=>'q text','placeholder'=>'<请输入>','maxlength'=>30]) ?>
        <span>角色描述</span>
        <?= $form->field($model, 'descript')->textInput(['class'=>'q text','placeholder'=>'<请输入>']) ?><br class="clr" />
        <?= Html::input('submit','','存档', ['class' => 'btn']) ?>
        <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>
        <br class="clr" />

        <?php ActiveForm::end(); ?>
    </div>
</div>