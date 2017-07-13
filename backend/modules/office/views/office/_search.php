<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
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

    <span>办公用品名称</span>
    <?= $form->field($model, 'office_name')->textInput()->span('') ?>
    <?= Html::a('采购申请',Yii::$app->urlManager->createUrl(['office/office/cg']), ['class' => 'btn']) ?>
    <?= Html::a('新增用品',Yii::$app->urlManager->createUrl(['office/office/create']), ['class' => 'btn']) ?>
    <?= Html::input('reset','','重置', ['class' => 'btn']) ?>
    <?= Html::input('submit','','查询', ['class' => 'btn']) ?>
    <div class="clr"></div>
    <?php ActiveForm::end(); ?>
</div>