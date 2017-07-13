<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use \backend\modules\role\models\Role;
use \backend\functions\functions;
use backend\functions\api;
?>
<div class="boxer">
    <div class="user-add">
        <div class="default-table user-add-table">
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <?php $form = ActiveForm::begin(
                    [
                        'method' => 'post',
                        'options' => ['class' => ''],
                        'validateOnChange'=>true,
                        'fieldConfig' => [
                            'template' => "{input}",
                            'inputOptions' => ['class' => 'q'],
                        ]
                    ]
                ); ?>
                <tbody><tr>
                    <th colspan="2">【修改账号】</th>
                </tr>
                <tr>
                    <td><i>*</i>账号</td>
                    <td><?= $model->username; ?></td>
                </tr>
                <tr>
                    <td><i>*</i>姓名</td>
                    <td><?= $form->field($model, 'name')->textInput(['class'=>'q text']) ?></td>
                </tr>
                <tr>
                    <td><i>*</i>角色名称</td>
                    <td><?= $form->field($model, 'role_id')->dropDownList(ArrayHelper::map(Role::get_roles(), 'id', 'name'),['class'=>'q text']) ?></td>
                </tr>

                </tbody></table>
        </div>
        <br class="clr">
        <div class="user-btn index-search">
            <?= Html::input('reset','','重置', ['class' => 'but']) ?>
            <?= Html::input('submit','','存档', ['class' => 'but']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>