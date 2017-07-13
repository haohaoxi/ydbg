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
    <title><?= Html::encode(\Yii::$app->params['web_name']) ?></title>
    <?php $this->head() ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>

<body id="box-body" scroll="no">
<?php $this->beginBody() ?>
<div class="box-top">
    <iframe src="<?php echo Yii::$app->urlManager->createUrl('site/top');?> " allowtransparency="true" style="background-color=transparent" frameborder="0" id="top-iframe" scrolling="no" height="74" width="100%"></iframe>
</div>
<div class="box-left">
    <iframe src="<?php echo Yii::$app->urlManager->createUrl('site/left');?>" allowtransparency="true" style="background-color=transparent" frameborder="0" id="left-iframe" scrolling="auto" width="250"></iframe>
</div>
<div class="box-iframe">
    <iframe src="<?php echo Yii::$app->urlManager->createUrl('site/main');?>" allowtransparency="true" style="background-color=transparent" id="box-iframe" name="box-iframe" frameborder="0" scrolling="auto" width="100%"></iframe>
</div>

<script type="text/javascript">
    jQuery(function($){
        var innerHeight = document.documentElement.clientHeight;
        var innerWidth = document.documentElement.clientWidth;

        $("#box-iframe").attr("height",innerHeight - 74 + "px");
        $("#left-iframe").attr("height",innerHeight - 74 + "px");
        if (innerWidth < 1200) $("#top-iframe").attr("width","1200px");
    });

    function _MP(menu){
        $("#box-iframe").attr('src', menu);
    }
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>