<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use \backend\modules\role\models\Role;
use \backend\functions\functions;
use backend\functions\api;
?>
<div class="boxer">
    <?php $form = ActiveForm::begin(
        [
            'method' => 'post',
            'options' => ['class' => ''],
            'fieldConfig' => [
                'template' => "{input}",
                'inputOptions' => ['class' => 'q'],
            ]
        ]
    ); ?>
    <div class="user-add">
        <div class="default-table user-add-table">
            <table width="100%" border="0" cellspacing="1" cellpadding="0">

                <tbody>
                <tr>
                    <th colspan="2">【新增账号】</th>
                </tr>
                <tr>
                    <td><i>*</i>账号</td>
                    <td><?= $form->field($model, 'username')->textInput(['class'=>'q text','placeholder'=>'<请输入请输入5-10位数字、字母组成的账号>']) ?></td>
                </tr>
                <tr>
                    <td><i>*</i>姓名</td>
                    <td><?= $form->field($model, 'name')->textInput(['class'=>'q text','placeholder'=>'<请输入>']) ?></td>
                </tr>
                <tr>
                    <td><i>*</i>密码</td>
                    <td><?= $form->field($model, 'password')->passwordInput(['class'=>'q text']) ?></td>
                </tr>
                <tr>
                    <td><i>*</i>确认密码</td>
                    <td><?= $form->field($model, 'rePwd')->passwordInput(['class'=>'q text']) ?></td>
                </tr>
                <tr>
                    <td><i>*</i>角色名称</td>
                    <td><?= $form->field($model, 'role_id')->dropDownList(ArrayHelper::map(Role::get_roles(), 'id', 'name'),['class'=>'q text']) ?></td>
                </tr>
                <tr>
                    <td><i>*</i>所属机构</td>
                    <td><?= $form->field($model, 'department' )->textInput(['class'=>'q text','placeholder'=>'<请输入>']) ?></td>
                </tr>

                </tbody></table>
        </div>

        <br class="clr">
        <div class="user-btn index-search">
            <?= Html::input('reset','','重置', ['class' => 'but']) ?>
            <?= Html::input('submit','','存档', ['class' => 'but']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>