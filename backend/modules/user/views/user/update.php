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
        <strong>【修改账号】</strong>
        <span><em>*</em>账号</span>
        <?= $form->field($model, 'username')->textInput(['class'=>'q text','placeholder'=>'<请输入请输入5-10位数字、字母组成的账号>','readonly'=>'true']) ?>
        <span><em>*</em>姓名</span>
        <?= $form->field($model, 'name')->textInput(['class'=>'q text','placeholder'=>'<请输入>']) ?><br class="clr" />
        <span><em>*</em>工号</span>
        <?= $form->field($model, 'gonghao')->textInput(['class'=>'q text','placeholder'=>'<请输入>']) ?><br class="clr" />
        <span><em>*</em>人员编号</span>
        <?= $form->field($model, 'number')->textInput(['class'=>'q text','placeholder'=>'<请输入>']) ?><br class="clr" />
        <span><em>*</em>所属机构</span>
        <?= $form->field($model, 'department')->dropDownList(Gongchu::getDepts(),['class'=>'q text']) ?><br class="clr" />
        <span><em>*</em>行政职务</span>
        <?= $form->field($model, 'position')->dropDownList(Position::getZhiwu(),['class'=>'q text']) ?><br class="clr" />
        <span><em>*</em>角色</span>
        <?= $form->field($model, 'role_id')->dropDownList(ArrayHelper::map(Role::get_roles(), 'id', 'name'),['class'=>'q text']) ?><br class="clr" />
        <span><em>*</em>手机号码</span>
        <?= $form->field($model, 'telphone')->textInput(['class'=>'q text','placeholder'=>'<请输入>']) ?><br class="clr" />
        
        <?= Html::input('submit','','存档', ['class' => 'btn']) ?>
        <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>
        <br class="clr" />

        <?php ActiveForm::end(); ?>
    </div>
</div>