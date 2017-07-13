<?php
use yii\helpers\Html;
use backend\modules\personworkworkflow\models\PersonWorkWorkflow;
use \backend\modules\user\models\User;
$user = User::getNames($model->p_fsq);
$menutype = !empty($_GET['menutype']) ? intval($_GET['menutype']) : '';
?>
<?=Html::cssFile('@web/css/ydbg/person.css')?>
<script type="text/javascript">
    jQuery(function($){
        $(".default-form input").placeholder();
    });
</script>
<div class="boxer" id="boxer-zh">
    <div class="default-form person-form">
        <strong>【未办工作详情】</strong>
        <span>发起人</span><div><input type="text" class="q" placeholder="<?= $user[0]['name']; ?>" disabled="disabled" /></div><br class="clr" />
        <span>发起时间</span><div><input type="text" class="q" placeholder="<?= $model->p_c_time; ?>" disabled="disabled" /></div><br class="clr" />
        <span>主题</span><div><input type="text" class="q" placeholder="<?= $model->p_title; ?>" disabled="disabled" /></div><br class="clr" />
        <span>工作开始时间</span><div><input type="text" class="q" placeholder="<?= $model->p_s_time; ?>" disabled="disabled" /></div><br class="clr" />
        <span>工作结束时间</span><div><input type="text" class="q" placeholder="<?= $model->p_e_time; ?>" disabled="disabled" /></div><br class="clr" />
        <span>优先级</span><div><input type="text" class="q" placeholder="<?= $model->p_level; ?>" disabled="disabled" /></div><br class="clr" />
        <span>受理人</span><div><input type="text" class="q" placeholder="<?= $model->p_y_slr_text; ?>" disabled="disabled" /></div><br class="clr" />
        <span>详情</span><div><input type="text" class="q person-information" placeholder="<?= $model->p_details; ?>" disabled="disabled" /></div><br class="clr" />
        <?php if(!empty($_GET['menutype']) && $_GET['menutype'] == 4){ ?>
            <span>工作状态</span><div><input type="text" class="q person-information" placeholder="逾期未办" disabled="disabled" /></div><br class="clr" />
        <?php } ?>
            <ul class="person-ul-onelist">
                <li><span>审批详情</span></li>
            </ul>
            <table class="sp_table">
                <?php $i=0  ?>
                <?php if(count($data = PersonWorkWorkflow::getSp($model->p_id)) >0 ){ ?>
                <?php foreach($data as $key=> $value){ ?>
                    <?php $user = User::getNames($value['w_person_id']); ?>
                    <tr>
                        <td style="width: 100px"><p style="font-weight: bold"><?= ++$i ?>级审批人</p></td>
                        <td style="width: 100px"><p><?= isset($user[0]['name']) ? $user[0]['name'] : '未知人员'; ?></p></td>
                        <td style="width: 100px">
                            <?php if($value['w_e_status'] != '无'){ ?>
                                <p class="yuqi-coin-agree" style="width: 90px;"><?= $value['w_e_status'] ?></p>
                            <?php }else{ ?>
                                <p class="yuqi-coin-ing"><?= $value['w_s_status']=='未审批' ? '审批中':$value['w_s_status'] ?></p>
                            <?php } ?>
                        </td>
                        <td  style="width: 160px">
                            <?php if($value['w_e_status'] != '无'){ ?>
                                <p><?= $value['w_e_time'] ?></p>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if($value['w_cancel_details'] != ''){ ?>
                                <p><?= $value['w_cancel_details'] ?></p>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                <?php } ?>
                <?php $data_column = array_column($data,'w_person_id'); ?>
                <?php if($model->p_spr != ''){ ?>
                <?php $model->p_spr = explode(',',$model->p_spr); ?>
                <?php foreach($model->p_spr as $key=> $value){ ?>
                <?php if(!in_array($value,$data_column)){ ?>
                    <?php $user = User::getNames($value); ?>
                    <tr>
                        <td style="width: 100px"><p style="font-weight: bold"><?= ++$key ?>级审批人</p></td>
                        <td style="width: 100px"><p><?= isset($user[0]['name']) ? $user[0]['name'] : '未知'; ?></p></td>
                        <td style="width: 100px"><p class="yuqi-coin-ing">未审批</p></td>
                        <td  style="width: 160px"></td>
                        <td></td>
                    </tr>
                <?php } ?>
                <?php } ?>
                <?php } ?>
            </table>


            <ul class="person-ul-onelist">
                <li><span>受理详情</span></li>
            </ul>
            <table class="sp_table">
                <?php if(count($data = PersonWorkWorkflow::getSl($model->p_id)) >0 ){ ?>
                <?php foreach($data as $key=> $value){ ?>
                    <?php $user = User::getNames($value['w_person_id']); ?>
                    <?php if($value['w_e_status'] != '代办'){ ?>
                    <tr>
                        <td style="width: 100px"><p><?= isset($user[0]['name']) ? $user[0]['name'] : '未知人员'; ?></p></td>
                        <td style="width: 100px">
                            <?php if($value['w_e_status'] != '无'){ ?>
                                <p class="yuqi-coin-agree" style="width: 90px;"><?= $value['w_e_status'] ?></p>
                            <?php }else{ ?>
                                <p class="yuqi-coin-ing"><?= $value['w_s_status']=='未受理' ? '受理中':$value['w_s_status']; ?></p>
                            <?php } ?>
                        </td>
                        <td  style="width: 160px">
                            <?php if($value['w_e_status'] != '无'){ ?>
                                <p><?= $value['w_e_time'] ?></p>
                            <?php } ?>
                        </td>
                        <?php $w_y_slr = User::getNames($value['w_y_slr']); ?>
                        <td style="width: 200px"><p><?= $value['w_type'] == '代办' ? '(代办)'.'代办人:'.(isset($w_y_slr[0]['name']) ? $w_y_slr[0]['name'] : '未知'): '' ?></p></td>
                        <td>
                            <?php if($value['w_cancel_details'] != ''){ ?>
                                <p><?= $value['w_cancel_details'] ?></p>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                <?php } ?>
                <?php } ?>
                <?php $data_column = array_column($data,'w_person_id'); ?>
                <?php if($model->p_y_slr != ''){ ?>
                    <?php $model->p_y_slr = explode(',',$model->p_y_slr); ?>
                    <?php foreach($model->p_y_slr as $key=> $value){ ?>
                        <?php if(!in_array($value,$data_column)){ ?>
                            <?php $user = User::getNames($value); ?>
                            <tr>
                                <td style="width: 100px"><p><?= isset($user[0]['name']) ? $user[0]['name'] : '未知'; ?></p></td>
                                <td style="width: 100px"><p class="yuqi-coin-ing">未受理</p></td>
                                <td style="width: 200px"><p></p></td>
                                <td  style="width: 160px"></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </table>
        <br class="clr" />
        <?php $menutype = intval($_GET['menutype']); ?>

        <?php if($_GET['menutype']==1){ ?>
            <?php if(Yii::$app->controller->action->id == 'sp'){ ?>
                <?= Html::input('button','','返回', ['class' => 'return yuqi-return','onclick'=>'javascript:history.go(-1);']) ?>
                <?= Html::a('驳回','javascript:;', ['class' => 'btn_bh yuqi-return']) ?>
                <?= Html::a('同意',Yii::$app->urlManager->createUrl(['personwork/personwork/spty','id'=>$model->p_id,'menutype'=>$menutype,'w_type'=>'普通']), ['class' => 'yuqi-return','onclick'=>'return confirm("是否同意该审批？");']) ?>

            <?php }elseif(Yii::$app->controller->action->id == 'sl'){ ?>

                <?= Html::input('button','','返回', ['class' => 'return yuqi-return','onclick'=>'javascript:history.go(-1);']) ?>

                <?= Html::a('代办','javascript:;', ['class' => 'btn_db yuqi-return']) ?>

                <?= Html::a('退办','javascript:;', ['class' => 'btn_tb yuqi-return']) ?>

                <?= Html::a('完成',Yii::$app->urlManager->createUrl(['personwork/personwork/slwc','id'=>$model->p_id,'menutype'=>$menutype,'w_type'=>'普通']), ['class' => 'return yuqi-return','onclick'=>'return confirm("是否完成本次工作？");']) ?>

            <?php } ?>

        <?php }elseif($_GET['menutype']==3){ ?>
            <?= Html::input('button','','返回', ['class' => 'btn yuqi-return','onclick'=>'javascript:history.go(-1);']) ?>

        <?php }elseif($_GET['menutype']==4){ ?>
            <?= Html::input('button','','返回', ['class' => 'btn yuqi-return','onclick'=>'javascript:history.go(-1);']) ?>

        <?php }elseif($_GET['menutype']==2){ ?>

            <?= Html::input('button','','返回', ['class' => 'btn yuqi-return','onclick'=>'javascript:history.go(-1);']) ?>
            <?= Html::a('退办','javascript:;', ['class' => 'btn_tb yuqi-return']) ?>
            <?= Html::a('完成',Yii::$app->urlManager->createUrl(['personwork/personwork/slwc','id'=>$model->p_id,'menutype'=>$menutype,'w_type'=>'代办']), ['class' => 'btn yuqi-return','onclick'=>'return confirm("是否完成本次工作？");']) ?>

        <?php }elseif($_GET['menutype']==5){ ?>
            <?= Html::input('button','','返回', ['class' => 'btn yuqi-return','onclick'=>'javascript:history.go(-1);']) ?>
        <?php } ?>
        <br class="clr" />
    </div>

</div>

<script src="js/ydbg/artDialog/lib/sea.js"></script>
<script>
    seajs.config({
        alias: {
            "jquery": "jquery-1.10.2.js"
        }
    });
</script>
<script>
    seajs.use(['./js/ydbg/artDialog/src/dialog-plus'], function (dialog) {
        window.dialog = dialog;
    });
</script>
<script>
    window.console = window.console || {log:function () {}}
    seajs.use(['jquery'], function ($) {
        $('.default-form').on('click','a.btn_bh', function () {
            d = top.dialog({
                id: '',
                title: '请填写驳回原因',
                content:'<div class="person-alert-con"><textarea name="cancel_details" id=""></textarea></div>',
                width: 480,
                height: 400,
                quickClose: true,
                button: [
                    {
                        value: '发送',
                        callback: function () {
                            var cancel_details = $(":input[name='cancel_details']").val()
                            if(cancel_details == ''){
                                alert('驳回原因必须填写');
                                return false;
                            }
                            $.get("<?= Yii::$app->urlManager->createUrl(['personwork/personwork/spbh','id'=>$model->p_id,'menutype'=>$menutype,'w_type'=>$menutype == 2 ? '代办' : '普通']); ?>", { cancel_details: cancel_details},function(data){
                                if (typeof data != "object"){
                                    var obj = eval('(' + data + ')');
                                }
                                if(obj.status == 'success'){
                                    alert(obj.msg);
                                    window.location.href = '<?= Yii::$app->urlManager->createUrl(['personwork/personwork/index','menutype'=>$menutype]); ?>';
                                }else if(obj.status == 'error'){
                                    alert(obj.msg);
                                }
                            });
                        }
                    }
                ],
                onshow: function () {
                    //   console.log('onshow');
                },
                oniframeload: function () {
                    //   console.log('oniframeload');
                },
                onclose: function () {
                    if (this.returnValue) {
                        /*这个地方是当弹框关闭的时候，可以获取从弹框返回的值，可用来刷新页面*/
                        //location.reload();
                    }
                },
                onremove: function () {
                    //   console.log('onremove');
                }
            });
            d.showModal();
            return false;
        });


        $('.default-form').on('click','a.btn_tb', function () {
            d = top.dialog({
                id: '',
                title: '请填写退办原因',
                content:'<div class="person-alert-con"><textarea name="cancel_details" id=""></textarea></div>',
                width: 480,
                height: 400,
                quickClose: true,
                button: [
                    {
                        value: '发送',
                        callback: function () {
                            var cancel_details = $(":input[name='cancel_details']").val()
                            if(cancel_details == ''){
                                alert('退办原因必须填写');
                                return false;
                            }
                            $.get("<?= Yii::$app->urlManager->createUrl(['personwork/personwork/sltb','id'=>$model->p_id,'menutype'=>$menutype,'w_type'=>$menutype == 2 ? '代办' : '普通']); ?>", { cancel_details: cancel_details},function(data){
                                if (typeof data != "object"){
                                    var obj = eval('(' + data + ')');
                                }
                                if(obj.status == 'success'){
                                    alert(obj.msg);
                                    window.location.href = '<?= Yii::$app->urlManager->createUrl(['personwork/personwork/index','menutype'=>$menutype]); ?>';
                                }else if(obj.status == 'error'){
                                    alert(obj.msg);
                                }
                            });
                        }
                    }
                ],
                onshow: function () {
                    //   console.log('onshow');
                },
                oniframeload: function () {
                    //   console.log('oniframeload');
                },
                onclose: function () {
                    if (this.returnValue) {
                        /*这个地方是当弹框关闭的时候，可以获取从弹框返回的值，可用来刷新页面*/
                        //location.reload();
                    }
                },
                onremove: function () {
                    //   console.log('onremove');
                }
            });
            d.showModal();
            return false;
        });
        var jigou = '<div class="gongchu-ren">';

        <?php
            $getJigouUser = \backend\modules\personwork\models\PersonWork::getJigouUser();
            if($getJigouUser != false){
            foreach($getJigouUser as $key=>$value){
        ?>

        jigou += '<div class="gongchu-ren-ks"><a href="javascript:;" data="ks1"><?= $key; ?></a></div>' +
        '<div class="gongchu-ren-list" id="ks1_con">';

        <?php
             foreach($value as $k=>$v){
        ?>
        jigou += '<label for="ren<?= $k; ?>"><input type="radio" id="ren<?= $k; ?>" name="db_id" value="<?= $k; ?>"/><?= $v; ?></label>';
        <?php
             }
        ?>

        jigou += '<div class="clr"></div></div>';
        <?php }} ?>

        jigou += '</div>';

        $('.default-form').on('click','a.btn_db', function () {
            d = top.dialog({
                id: '',
                title: '请填选择代办人',
                content:jigou,
                width: 550,
                height: 500,
                quickClose: true,
                button: [
                    {
                        value: '确定',
                        callback: function () {
                            var db_id = $(':radio[name="db_id"]:checked ').val();
                            if(db_id == undefined){
                                alert('请填选择代办人');
                                return false;
                            }
                            $.get("<?= Yii::$app->urlManager->createUrl(['personwork/personwork/sldb','id'=>$model->p_id,'menutype'=>$menutype,'w_type'=>$menutype == 2 ? '代办' : '普通']); ?>", { db_id: db_id},function(data){
                                if (typeof data != "object"){
                                    var obj = eval('(' + data + ')');
                                }
                                if(obj.status == 'success'){
                                    alert(obj.msg);
                                    window.location.href = '<?= Yii::$app->urlManager->createUrl(['personwork/personwork/index','menutype'=>$menutype]); ?>';
                                }else if(obj.status == 'error'){
                                    alert(obj.msg);
                                }
                            });
                        }
                    }
                ],
                onshow: function () {
                    //   console.log('onshow');
                },
                oniframeload: function () {
                    //   console.log('oniframeload');
                },
                onclose: function () {
                    if (this.returnValue) {
                        /*这个地方是当弹框关闭的时候，可以获取从弹框返回的值，可用来刷新页面*/
                        //location.reload();
                    }
                },
                onremove: function () {
                    //   console.log('onremove');
                }
            });
            d.showModal();
            return false;
        });
    });
</script>
<script type="text/javascript">
    jQuery(function($){
        $(".gongchu-ren-ks").on("click","a",function(){
            alert('1111');
        });
    });
</script>