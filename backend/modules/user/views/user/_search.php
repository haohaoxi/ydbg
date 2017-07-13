<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\modules\deptcontact\models\DeptContact;
use \yii\helpers\ArrayHelper;
?>

<div class="default-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'fieldConfig' => [
            'template' => "{span}{input}{error}",
        ]
    ]); ?>
    <?= $form->field($model, 'name')->textInput(['class' => 'q'])->span('人员姓名') ?>
    <?= $form->field($model, 'department')->dropDownList(ArrayHelper::map(DeptContact::getDept(),'id','dept_name'),['prompt'=>'--选择机构--'])->span('所属机构') ?>

    <?= Html::a('新建账号',Yii::$app->urlManager->createUrl(['user/user/create']), ['class' => 'btn']) ?>
    <?= Html::input('submit','','查询', ['class' => 'btn']) ?>
    <?= Html::input('reset','','重置', ['class' => 'btn']) ?>
    <div class="clr"></div>
    <?php ActiveForm::end(); ?>

</div>