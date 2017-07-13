<?php
use backend\assets\MhjcyAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
MhjcyAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>

<body>
<?php $this->beginBody() ?>
<div class="top-box">
    <h1><img src="image/mhjcy/system_logo.png" border="0" alt="" class="back_home" /></h1>
    <div class="top-user">hello ! <?= Yii::$app->user->identity->username; ?></div>
    <div class="top-link"><a href="<?= Yii::$app->urlManager->createUrl("/site/index"); ?>" class="idx">首页</a><span>|</span><a href="<?= Yii::$app->urlManager->createUrl("/user/user/update-top-pwd");?>" target="box-iframe">修改密码</a>|<a href="<?= Yii::$app->urlManager->createUrl("/user/user/pie");?>" target="box-iframe">图表</a></div>
    <div class="top_out"><a href="javascript:;">退出</a></div>
</div>

<script type="text/javascript">
    jQuery(function($){
        $(".back_home").click(function(){
            window.top.location.reload();
        });

        $(".top-link").on("click","a.idx",function(){
            window.top.location.reload();
        });

        $(".top_out").on("click","a",function(){
            window.top.art.dialog({
                title: '是否退出',
                content: '<div style="font-size:18px;">是否退出到登陆页？</div>',
                ok: function () {
                    window.top.location.href="<?= Yii::$app->urlManager->createUrl("/site/logout"); ?>";
                }
            });
        });
    });
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>