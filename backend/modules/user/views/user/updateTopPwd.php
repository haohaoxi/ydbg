<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use \backend\modules\deptcontact\models\DeptContact;
use \backend\modules\gongchu\models\Gongchu;
use \backend\modules\personwork\models\PersonWork;
use \backend\modules\user\models\User;
$data = Gongchu::getLeader(Yii::$app->user->identity->department);
$first =  current($data);
$aciton = Yii::$app->controller->action->id;

?>
<?=Html::cssFile('@web/css/ydbg/inside.css')?>
<div class="boxer">

    <?php $form = ActiveForm::begin(
        [
            'action'=>Yii::$app->urlManager->createUrl(['user/user/update-top-pwd']),
            'method' => 'post',
            'options' => ['class' => ''],
            'enableClientValidation' => true,
            'enableAjaxValidation' => false,
            'fieldConfig' => [
                'template' => "{input}{error}",//D:\wamp2\www\jsdt\vendor\yiisoft\yii2\helpers\BaseHtml.php 1222L
                'inputOptions' => ['class' => 'q'],
                'errorOptions'=>['class' => 'tishi']
            ]
        ]
    ); ?>
    <div class="default-form baoxiao-form">
        <strong>【密码修改】</strong>
        <span>旧密码</span>
        <div class="r">
            <?= $form->field($model, 'oldpwd')->passwordInput() ?>
        </div>
        <br class="clr">

        <span>新密码</span>
        <div class="r">
            <?= $form->field($model, 'password_hash')->passwordInput() ?>
        </div>
        <br class="clr">

        <span>确认新密码</span>
        <div class="r">
            <?= $form->field($model, 'rePwd')->passwordInput() ?>
        </div>
        <br class="clr">

        <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>
        <?= Html::input('submit','','提交', ['class' => 'btn']) ?>

    </div>
    <?php ActiveForm::end(); ?>
</div>
