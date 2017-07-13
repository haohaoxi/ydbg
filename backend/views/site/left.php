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
<div class="left-menu">

    <?php
        foreach($menu as $key=>$value){
    ?>
    <div class="menu-list"<?php if($key==0){echo ' style="margin-top: 0px;"';} ?>>
        <div class="menu-top<?php if($key==0){echo ' menu-open';} ?>"><a href="javascript:;"><span><?= $value['name'] ?></span><i></i></a></div>
        <ul<?php if($key!=0){echo ' class="hid"';} ?>>
            <?php
            if(isset($value['_child'])){
            foreach($value['_child'] as $value_child){
            ?>
                <li><a href="javascript:void(0)" onclick="_MP('<?= Yii::$app->urlManager->createUrl([$value_child['module'].'/'.$value_child['controller'].'/'.$value_child['action'],'menu_id'=>$value_child['id']]) ?>');" target="box-iframe"><?= $value_child['name'] ?><i class="<?= $value_child['class'] ?>"></i></a></li>
            <?php }} ?>
        </ul>
    </div>
    <?php } ?>

</div>

<script type="text/javascript">
    jQuery(function($){
        $(".menu-top").on("click","a",function(){
            if ($(this).parent("div").hasClass("menu-open")) {
                $(this).parent("div").removeClass("menu-open");
                $(this).parent().siblings("ul").hide();
            } else {
                $(this).parent("div").addClass("menu-open");
                $(this).parent().siblings("ul").show();
            }
        });
        $(".menu-list ul").on("click","a",function(){
            if (!$(this).hasClass("on")) {
                $(".menu-list ul a").removeClass();
                $(this).addClass("on");
            }
        });
        $(".menu-home").on("click","a",function(){
            $(".menu-list ul a").removeClass();
        });
    });

    function _MP(menu) {
        window.parent._MP(menu);
    }

</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>