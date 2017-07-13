<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<link href="css/ydbg/common.css" type="text/css" rel="stylesheet" />
<link href="css/ydbg/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/ydbg/jquery.min.js"></script>
<script type="text/javascript" src="js/ydbg/jquery.placeholder.js"></script>
<script type="text/javascript">
    jQuery(function($){
        $(".login-box input.i").placeholder();
    });
</script>
<style type="text/css">
.login-form{

}
</style>
<body id="login">
<div class="login-form">
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="login-input">
    <?= $form->field($model, 'username')->textInput(['class'=>"i"])->label('') ?>
    </div>
    <div class="login-input login-pwd">
    <?= $form->field($model, 'password')->passwordInput(['class'=>'i pwd'])->label('') ?>
    </div>
    <?= Html::input('submit','login-button',Yii::t('app','登录'),['class' =>'btn']) ?>
    <?php ActiveForm::end(); ?>
</div>
</body>