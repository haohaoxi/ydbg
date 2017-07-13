<?php
use backend\assets\JsdtAsset;
use yii\helpers\Html;
use backend\functions\functions;
use backend\modules\menu\models\Menu;
JsdtAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->params['web_name']) ?></title>
    <?php $this->head() ?>
</head>
<script type="text/javascript">
    function preview(oper){
        bdhtml=window.document.body.innerHTML;//获取当前页的html代码
        sprnstr="<!--startprint"+oper+"-->";//设置打印开始区域
        eprnstr="<!--endprint"+oper+"-->";//设置打印结束区域
        prnhtml=bdhtml.substring(bdhtml.indexOf(sprnstr)+18); //从开始代码向后取html

        prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr));//从结束代码向前取html
        window.document.body.innerHTML=prnhtml;
        window.print();
        window.document.body.innerHTML=bdhtml;
    }
</script>

<div id="preview"></div>
<body id="box-body" scroll="no">
<?php $this->beginBody() ?>
<div class="box-top">
    <h1 onclick="location.href='/'"></h1>
    <div class="top-link">
        <a href="<?= Yii::$app->urlManager->createUrl("/site/logout");?>" id="log_out">退出</a>
        <i class="quit"></i>
        <em>|</em>
        <a href="<?= Yii::$app->urlManager->createUrl("/user/user/update-top-pwd");?>">修改密码</a>
        <i class="pwd"></i>
        <em>|</em>
        <span>当前账号：<?= Yii::$app->user->identity->username; ?></span>
        <i class="user"></i>
        <br class="clr" />
    </div>
</div>
<div class="box-menu">
    <?php
    $pid_cid = functions::getPidCid();
    $p_id = $pid_cid['p_id']; //父id
    $c_id = $pid_cid['c_id']; //子id
    ?>

<?php
$menu = functions::list_to_tree(Menu::get_menus(true),'id','parent_id','_child',0);
//print_r($menu);exit;
foreach($menu as $key=>$value){
$name = $value['name'];
$active = $p_id == $value['id'] ? 'active' : '';
$value = (isset($value['_child']) && count($value['_child']) >0) ? $value['_child'][0] : $value;
$url = $value['menutype'] != '' ? ['/'.$value['module'].'/'.$value['controller'].'/'.$value['action'],'menutype'=>$value['menutype']] : ['/'.$value['module'].'/'.$value['controller'].'/'.$value['action']] ;
?>
<a href="<?= Yii::$app->urlManager->createUrl($url) ?>" class="<?= $active; ?>"><?= $name ?></a>
<?php } ?>
    <div id="date"></div>
    <br class="clr" />
</div>
<?php
if(isset($menu[$p_id]['_child']) && count($menu[$p_id]['_child']) > 0 ){
$child_menu = $menu[$p_id]['_child'];
?>
<div class="left-menu">
    <ul>
        <?php
        foreach($child_menu as $value){
            if(!empty($c_id)){
                $on = intval($c_id) == $value['id'] ? 'on' : '';
            }else{
                $on = '';
            }
            $url = $value['menutype'] != '' ? ['/'.$value['module'].'/'.$value['controller'].'/'.$value['action'],'menutype'=>$value['menutype']] : ['/'.$value['module'].'/'.$value['controller'].'/'.$value['action']] ;
        ?>
            <li><a href="<?= Yii::$app->urlManager->createUrl($url) ?>" class="<?= $on; ?>"><?= $value['name']; ?></a></li>
        <?php }} ?>
    </ul>
</div>
<?= $content ?>
<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
