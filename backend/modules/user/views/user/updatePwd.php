<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use \backend\modules\role\models\Role;
use \backend\functions\functions;
use backend\functions\api;
?>
<div class="boxer">
    <div class="default-form">
        <?php $form = ActiveForm::begin(
            [
                'method' => 'post',
                'options' => ['class' => ''],
                'validateOnChange'=>true,
                'fieldConfig' => [
                    'template' => "{input}{error}",
                    'inputOptions' => ['class' => 'q'],
                    'errorOptions'=>['class' => 'tishi'],
                ]
            ]
        ); ?>
        <strong>【密码修改】</strong>
        <span><em>*</em>账号</span>
        <?= $form->field($model, 'username')->textInput(['class'=>'q text','readonly'=>'true']) ?><br class="clr" />
        <span><em>*</em>密码</span>
        <?= $form->field($model, 'password')->passwordInput(['class'=>'q text']) ?><br class="clr" />
        <span><em>*</em>确认密码</span>
        <?= $form->field($model, 'rePwd')->passwordInput(['class'=>'q text']) ?><br class="clr" />

        <?= Html::input('submit','','存档', ['class' => 'btn']) ?>
        <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>

        <br class="clr" />
        <?php ActiveForm::end(); ?>
    </div>
</div>
