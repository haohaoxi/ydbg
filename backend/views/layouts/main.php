    <?php
    use backend\assets\ydbgAsset;
    use yii\helpers\Html;
    use backend\functions\functions;
    use backend\modules\menu\models\Menu;
    use \backend\modules\message\models\Message;
    $messageCount = Message::getMessageNum();
    ydbgAsset::register($this);
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html lang="<?= Yii::$app->language ?>">
        <head>
            <meta charset="<?= Yii::$app->charset ?>">
            <?= Html::csrfMetaTags() ?>
            <title><?= Html::encode(Yii::$app->params['web_name']) ?></title>
            <?php $this->head() ?>
            <link rel="stylesheet" type="text/css" href="js/ydbg/calendar/jscal2.css">
            <link rel="stylesheet" type="text/css" href="js/ydbg/calendar/border-radius.css">
            <link rel="stylesheet" type="text/css" href="js/ydbg/calendar/win2k.css">
            <script type="text/javascript" src="js/ydbg/calendar/calendar.js"></script>
            <script type="text/javascript" src="js/ydbg/calendar/lang/en.js"></script>
            <script type="text/javascript">
                $(function(){
                    $("#log_out").click(function(){
                        if(confirm('是否退出到登录页?')){
                            window.location.href="<?= Yii::$app->urlManager->createUrl(Yii::$app->params['LogoutAddress']); ?>";
                        }else{
                            return false;
                        }
                    });
                });
            </script>
        </head>
    <script>
        $(document).ready(function(){
            $(':reset').on('click',function(event){
                 $(this).parent('form').find(":input")
                 .not(':button, :submit, :reset, :hidden').each(function(){
                 if($(this).attr('type') != undefined){ //排除 select 控件 无法恢复默认值
                    $(this).val('')
                 }else{
                     if($(this).find('option:eq(0)')){
                         var value = $(this).find('option:eq(0)').val();
                         $(this).find("option[value="+value+"]").attr("selected", "selected");
                     }else{
                         $(this).val('')
                     }
                 }
                 });
                event.preventDefault();
                return false;
            });



        });
    </script>
    <body id="box-body">
    <?php $this->beginBody() ?>
    <div class="box-top">
        <h1></h1>
        <div class="user">
            <span>当前账号：<?= Yii::$app->user->identity->username; ?> 您好！</span>
            <i></i>
            <a href="<?= Yii::$app->urlManager->createUrl("/user/user/update-top-pwd");?>" class="pwd">修改密码</a>
            <i></i>
            <a href="<?=Yii::$app->urlManager->createUrl(Yii::$app->params['LogoutAddress']);?>" id="log_out" class="quit">退出</a>
            <br class="clr" />
        </div>
        <a href="<?= Yii::$app->urlManager->createUrl("/message/message/index");?>" class="msg"><span><?= $messageCount; ?></span></a>
        <div class="clr"></div>
    </div>

    <div class="top-menu">
        <?php
        $pid_cid = functions::getPidCid();
        $p_id = $pid_cid['p_id']; //父id
        $c_id = $pid_cid['c_id']; //子id
        ?>
        <?php
        $menu = functions::list_to_tree(Menu::get_menus(),'id','parent_id','_child',0);
        //print_r($menu);exit;
        foreach($menu as $key=>$value){
            $name = $value['name'];
            $active = $p_id == $value['id'] ? 'active' : '';
            $value = (isset($value['_child']) && count($value['_child']) >0) ? $value['_child'][0] : $value;
            $value = (isset($value['_child']) && count($value['_child']) >0) ? $value['_child'][0] : $value;
            $url = $value['menutype'] != '' ? ['/'.$value['module'].'/'.$value['controller'].'/'.$value['action'],'menutype'=>$value['menutype']] : ['/'.$value['module'].'/'.$value['controller'].'/'.$value['action']] ;
            ?>
            <?php if($value['module']=='#' && $value['controller'] =='#' && $value['action'] == '#'){ ?>
                <a href="javascript:void(0);" class="<?= $active; ?>"><?= $name ?></a>
            <?php }else{ ?>
                <a href="<?= Yii::$app->urlManager->createUrl($url) ?>" class="<?= $active; ?>"><?= $name ?></a>
            <?php } ?>


        <?php } ?>
        <div id="date"></div>
        <div class="clr"></div>
    </div>

    <?php
    if(isset($menu[$p_id]['_child']) && count($menu[$p_id]['_child']) > 0 ){
    $child_menu = $menu[$p_id]['_child'];
    ?>
    <div class="left-menu left-menu-xz" style="height: 233px;">
        <ul class="yiji">
        <?php
        foreach($child_menu as $value){ //一级菜单
        ?>
            <?php
            if(isset($value['_child']) && count($value['_child']) > 0 ){ // 如果存在二级菜单
            ?>
            <li class="items"><a href="javascript:;" class="inactive active"><?= $value['name']; ?></a>
                <ul  style="display: none">
                     <?php
                        foreach($value['_child'] as $vv){
                     ?>
                            <?php
                            if(isset($vv['_child']) && count($vv['_child']) > 0 ){
                            ?>
                                <li><a href="javascript:;" class="inactive active"><?= $vv['name']; ?></a>
                                <ul>
                                <?php
                                foreach($vv['_child'] as $v){
                                    if(!empty($c_id)){
                                        $on = intval($c_id) == $v['id'] ? 'on' : '';
                                    }else{
                                        $on = '';
                                    }
                                    $url = $v['menutype'] != '' ? ['/'.$v['module'].'/'.$v['controller'].'/'.$v['action'],'menutype'=>$value['menutype']] : ['/'.$v['module'].'/'.$v['controller'].'/'.$v['action']] ;
                                    ?>
                                    <li>
                                        <?php if($v['module']=='#' && $v['controller'] =='#' && $v['action'] == '#'){ ?>
                                            <a href="javascript:void(0);" class="<?= $on; ?>"><?= $v['name']; ?></a>
                                        <?php }else{ ?>
                                            <a href="<?= Yii::$app->urlManager->createUrl($url) ?>" class="<?= $on; ?>"><?= $v['name']; ?></a>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                                </ul>

                            <?php }else{ ?>
                                <?php
                                if(!empty($c_id)){
                                    $on = intval($c_id) == $vv['id'] ? 'on' : '';
                                }else{
                                    $on = '';
                                }
                                $url = $vv['menutype'] != '' ? ['/'.$vv['module'].'/'.$vv['controller'].'/'.$vv['action'],'menutype'=>$value['menutype']] : ['/'.$vv['module'].'/'.$vv['controller'].'/'.$vv['action']] ;
                                ?>
                                <li>
                                    <?php if($vv['module']=='#' && $vv['controller'] =='#' && $vv['action'] == '#'){ ?>
                                        <a href="javascript:void(0);" class="<?= $on; ?>"><?= $vv['name']; ?></a>
                                    <?php }else{ ?>
                                        <a href="<?= Yii::$app->urlManager->createUrl($url) ?>" class="<?= $on; ?>"><?= $vv['name']; ?></a>
                                    <?php } ?>
                                </li>
                            <?php } ?>

                    </li>
                        <?php } ?>
                </ul>
            </li>
            <?php }else{ ?>
                <?php
                if(!empty($c_id)){
                    $on = intval($c_id) == $value['id'] ? 'on' : '';
                }else{
                    $on = '';
                }
                $url = $value['menutype'] != '' ? ['/'.$value['module'].'/'.$value['controller'].'/'.$value['action'],'menutype'=>$value['menutype']] : ['/'.$value['module'].'/'.$value['controller'].'/'.$value['action']] ;
                ?>
                <li class="items">
                    <?php if($value['module']=='#' && $value['controller'] =='#' && $value['action'] == '#'){ ?>
                        <a href="javascript:void(0);" class="<?= $on; ?>"><?= $value['name']; ?></a>
                    <?php }else{ ?>
                        <a href="<?= Yii::$app->urlManager->createUrl($url) ?>" class="<?= $on; ?>"><?= $value['name']; ?><br class="clr" /></a>
                    <?php } ?>

                </li>
            <?php } ?>

        <?php } ?>
            </ul>

    </div>
    <?php } ?>
    <?= $content ?>
    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>