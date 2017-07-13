<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use \backend\modules\deptcontact\models\DeptContact;
use \backend\modules\gongchu\models\Gongchu;
use \backend\modules\personwork\models\PersonWork;
use \backend\modules\user\models\User;
use \backend\modules\office\models\Office;
$data = Gongchu::getLeader(Yii::$app->user->identity->department);
$first =  current($data);
$aciton = Yii::$app->controller->action->id;

?>
<?=Html::cssFile('@web/css/ydbg/inside.css')?>
<div class="boxer">
    <?php
        if($model->apply_cgsq == '否'){
        $office = Office::getOffice($model->apply_office_id);
    ?>
    <?php $form = ActiveForm::begin(
        [
            'action'=>Yii::$app->urlManager->createUrl(['officeapply/officeapply/sqtj']),
            'method' => 'post',
            'options' => ['class' => '','onsubmit'=>"return toVaild()"],
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'fieldConfig' => [
                'template' => "{input}{error}",//D:\wamp2\www\jsdt\vendor\yiisoft\yii2\helpers\BaseHtml.php 1222L
                'inputOptions' => ['class' => 'q'],
                'errorOptions'=>['class' => 'tishi']
            ]
        ]
    ); ?>

    <div class="default-form baoxiao-form">
        <strong>【办公用品申请详情】</strong>
        <span>申请人</span>
        <div class="r">
            <input type="text" class="q view" name="" id="" value="<?= $model->apply_mee_text ?>" readonly=""/>
        </div>
        <br class="clr">

        <span>科室</span>
        <div class="r">
            <?php
            $data = DeptContact::getDeptOne($model->apply_department);
            ?>
            <input type="text" class="q view" name="" id="" value="<?=  $data['dept_name'] ?>" readonly=""/>
        </div>
        <br class="clr">

        <span>办公用品申时间</span>
        <div>
            <input type="text" value="<?= $model->apply_sq_time ?>"  name="" class="q view" readonly="">
        </div>
        <br class="clr">

        <span>办公用品名称</span>
        <div>
            <input type="text" value="<?= $model->apply_office_name ?>"  name="" class="q view" readonly="">
        </div>
        <br class="clr">

        <span>预计单价/元</span>
        <div class="r">
            <input type="text" class="q view"  id="" name="" value="<?= $model->apply_price ?>" readonly="" />
        </div>
        <br class="clr">

        <span>适用机构</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $office['office_part_name'] ?>" readonly="" />
        </div>
        <br class="clr">

        <span>库存数量</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $office['office_num'] ?>" readonly="" />
        </div>
        <br class="clr">

        <span>用品类型</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $office['office_type'] ?>" readonly="" />
        </div>
        <br class="clr">

        <span>申请数量</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->apply_num ?>" readonly="" />
        </div>
        <br class="clr">

        <span><em>*</em>预计金额/元</span>
        <div class="r">
            <input type="text" class="q view" name="" id="" value="<?= $model->apply_money ?>"/>
        </div>
        <br class="clr">

        <span>行装科意见</span>
        <?php
        $status = '('.$model->apply_pack_status.')' ;
        if($model->apply_pack_status == '驳回'){
            $status .= '&nbsp;&nbsp;&nbsp;&nbsp;'.$model->apply_pack_result.'&nbsp;&nbsp;&nbsp;&nbsp;'.$model->apply_pack_time;
        }elseif($model->apply_pack_status == '同意'){
            $status .= '&nbsp;&nbsp;&nbsp;&nbsp;'.$model->apply_pack_time;
        }
        ?>
        <div class="r">
            <input type="text" class="q view" name="" id="" value="<?= $model->apply_pack_text ?><?= $status; ?>"/>
        </div>
        <br class="clr">

        <?php if($model->apply_genneral_id != ''){ ?>
        <span>检察长意见</span>
        <?php
        $status = '('.$model->apply_genneral_status.')' ;
        if($model->apply_genneral_status == '驳回'){
            $status .= '&nbsp;&nbsp;&nbsp;&nbsp;'.$model->apply_genneral_result.'&nbsp;&nbsp;&nbsp;&nbsp;'.$model->apply_genneral_time;
        }elseif($model->apply_genneral_status == '同意'){
            $status .= '&nbsp;&nbsp;&nbsp;&nbsp;'.$model->apply_genneral_time;
        }
        ?>
        <div class="r">
            <input type="text" class="q view" name="apply_genneral_text" id="apply_genneral_text" value="<?= $model->apply_genneral_text ?><?= $model->apply_pack_status == '驳回' ? '' :$status; ?>"/>
        </div>
        <br class="clr">
        <?php } ?>
        <br class="clr">
        <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>
        <?php if($aciton == 'sp'){ ?>
            <?= Html::a('驳回','javascript:;', ['class' => 'btn btn_bh']) ?>
            <?= Html::a('同意',Yii::$app->urlManager->createUrl(['officeapply/officeapply/spty','id'=>$model->apply_id]), ['class' => 'btn','onclick'=>'return confirm("是否同意该审批？");']) ?>
        <?php } ?>
    </div>
    <?php ActiveForm::end(); ?>

    <?php }else{ ?>

            <?php $form = ActiveForm::begin(
                [
                    'action'=>Yii::$app->urlManager->createUrl(['officeapply/officeapply/sqtj']),
                    'method' => 'post',
                    'options' => ['class' => '','onsubmit'=>"return toVaild()"],
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
                    'fieldConfig' => [
                        'template' => "{input}{error}",//D:\wamp2\www\jsdt\vendor\yiisoft\yii2\helpers\BaseHtml.php 1222L
                        'inputOptions' => ['class' => 'q'],
                        'errorOptions'=>['class' => 'tishi']
                    ]
                ]
            ); ?>

            <div class="default-form baoxiao-form">
                <strong>【办公用品申请详情】</strong>
                <span>申请人</span>
                <div class="r">
                    <input type="text" class="q view" name="" id="" value="<?= $model->apply_mee_text ?>" readonly=""/>
                </div>
                <br class="clr">

                <span>科室</span>
                <div class="r">
                    <?php
                    $data = DeptContact::getDeptOne($model->apply_department);
                    ?>
                    <input type="text" class="q view" name="" id="" value="<?=  $data['dept_name'] ?>" readonly=""/>
                </div>
                <br class="clr">

                <span>办公用品申时间</span>
                <div>
                    <input type="text" value="<?= $model->apply_sq_time ?>"  name="" class="q view" readonly="">
                </div>
                <br class="clr">

                <span>办公用品名称</span>
                <div>
                    <input type="text" value="<?= $model->apply_office_name ?>"  name="" class="q view" readonly="">
                </div>
                <br class="clr">

                <span>预计单价/元</span>
                <div class="r">
                    <input type="text" class="q view"  id="" name="" value="<?= $model->apply_price ?>" readonly="" />
                </div>
                <br class="clr">

                <span>申请数量</span>
                <div class="r">
                    <input type="text" class="q view"  value="<?= $model->apply_num ?>" readonly="" />
                </div>
                <br class="clr">

                <span><em>*</em>预计金额/元</span>
                <div class="r">
                    <input type="text" class="q view" name="" id="" value="<?= $model->apply_money ?>"/>
                </div>
                <br class="clr">

                <span>行装科意见</span>
                <?php
                $status = '('.$model->apply_pack_status.')' ;
                if($model->apply_pack_status == '驳回'){
                    $status .= '&nbsp;&nbsp;&nbsp;&nbsp;'.$model->apply_pack_result.'&nbsp;&nbsp;&nbsp;&nbsp;'.$model->apply_pack_time;
                }elseif($model->apply_pack_status == '同意'){
                    $status .= '&nbsp;&nbsp;&nbsp;&nbsp;'.$model->apply_pack_time;
                }
                ?>

                <div class="r">
                    <input type="text" class="q view" name="" id="" value="<?= $model->apply_pack_text ?><?= $status; ?>"/>
                </div>
                <br class="clr">

                <?php if($model->apply_genneral_id != ''){ ?>
                <span>检察长意见</span>
                <?php
                $status = '('.$model->apply_genneral_status.')' ;
                if($model->apply_genneral_status == '驳回'){
                    $status .= '&nbsp;&nbsp;&nbsp;&nbsp;'.$model->apply_genneral_result.'&nbsp;&nbsp;&nbsp;&nbsp;'.$model->apply_genneral_time;
                }elseif($model->apply_genneral_status == '同意'){
                    $status .= '&nbsp;&nbsp;&nbsp;&nbsp;'.$model->apply_genneral_time;
                }
                ?>
                <div class="r">
                    <input type="text" class="q view" name="apply_genneral_text" id="apply_genneral_text" value="<?= $model->apply_genneral_text ?><?= $model->apply_pack_status == '驳回' ? '' :$status; ?>"/>
                </div>
                <br class="clr">
                <?php } ?>
                <br class="clr">
                <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>
                <?php if($aciton == 'sp'){ ?>
                    <?= Html::a('驳回','javascript:;', ['class' => 'btn btn_bh']) ?>
                    <?= Html::a('同意',Yii::$app->urlManager->createUrl(['officeapply/officeapply/spty','id'=>$model->apply_id]), ['class' => 'btn','onclick'=>'return confirm("是否同意该审批？");']) ?>
                <?php } ?>
            </div>
            <?php ActiveForm::end(); ?>

    <?php } ?>
</div>

<script>
    $(function(){
        $('#officeapply_apply_num').on('change',function(){
            var num =  parseFloat($('#officeapply_apply_num').val() == '' ? 0 : $('#officeapply_apply_num').val());
            var price =  parseFloat($('#officeapply_price').val() == '' ? 0 : $('#officeapply_price').val());
            var total = (price * num);
            $("#officeapply_apply_money").val(total);
        })
    });
</script>


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

    //行装科start
    var xzk = '<div class="gongchu-ren">';
    <?php
        $getJigouUser = PersonWork::getJigouUser('us.id !='.Yii::$app->user->identity->id);
        if($getJigouUser != false){
        foreach($getJigouUser as $key=>$value){
    ?>
    xzk += '<div class="gongchu-ren-ks"><a href="javascript:;" data="ks1"><?= $key; ?></a></div>' +
    '<div class="gongchu-ren-list" id="ks1_con">';
    <?php
         foreach($value as $k=>$v){
    ?>
    xzk += '<label for="ren<?= $k; ?>"><input type="radio" id="ren<?= $k; ?>" name="xzk" value="<?= $k; ?>" attr_name="<?= $v; ?>" /><?= $v; ?></label>';
    <?php
         }
    ?>
    xzk += '<div class="clr"></div></div>';
    <?php }} ?>
    xzk += '</div>';
    //行装科end


    //行装科start
    var jcz = '<div class="gongchu-ren">';
    <?php
        $getJigouUser = PersonWork::getJigouUser('us.id !='.Yii::$app->user->identity->id);
        if($getJigouUser != false){
        foreach($getJigouUser as $key=>$value){
    ?>
    jcz += '<div class="gongchu-ren-ks"><a href="javascript:;" data="ks1"><?= $key; ?></a></div>' +
    '<div class="gongchu-ren-list" id="ks1_con">';
    <?php
         foreach($value as $k=>$v){
    ?>
    jcz += '<label for="ren<?= $k; ?>"><input type="radio" id="ren<?= $k; ?>" name="jcz" value="<?= $k; ?>" attr_name="<?= $v; ?>" /><?= $v; ?></label>';
    <?php
         }
    ?>
    jcz += '<div class="clr"></div></div>';
    <?php }} ?>
    jcz += '</div>';
    //行装科end

    seajs.use(['jquery'], function ($) {
        $('.boxer').on('click','#apply_pack_text', function () {
            $(':input[name="apply_pack_id"]').val('');
            $(':input[name="apply_pack_text"]').val('');
            d = top.dialog({
                id: '',
                title: '选择机构领导',
                content: xzk,
                width: 550,
                height: 500,
                quickClose: true,
                button: [
                    {
                        value: '确定',
                        callback: function () {
                            var xzk = $(':radio[name="xzk"]:checked ').val();
                            if(xzk == undefined){
                                alert('请填选择机构领导');
                                return false;
                            }
                            $('#apply_pack_id').val(xzk);
                            $('#apply_pack_text').val($(':radio[name="xzk"]:checked ').attr('attr_name'));
                        }
                    }
                ],
                onshow: function () {
                    console.log('onshow');
                },
                oniframeload: function () {
                    console.log('oniframeload');
                },
                onclose: function () {
                    if (this.returnValue) {
                        /*这个地方是当弹框关闭的时候，可以获取从弹框返回的值，可用来刷新页面*/
                        //location.reload();
                    }
                },
                onremove: function () {
                    console.log('onremove');
                }
            });
            d.showModal();
        });



        $('.boxer').on('click','#apply_genneral_text', function () {
            $(':input[name="apply_genneral_id"]').val('');
            $(':input[name="apply_genneral_text"]').val('');
            dd = top.dialog({
                id: '',
                title: '选择检察长',
                content: jcz,
                width: 550,
                height: 500,
                quickClose: true,
                button: [
                    {
                        value: '确定',
                        callback: function () {
                            var xzk = $(':radio[name="jcz"]:checked ').val();
                            if(xzk == undefined){
                                alert('请填选择检察长');
                                return false;
                            }
                            $('#apply_genneral_id').val(xzk);
                            $('#apply_genneral_text').val($(':radio[name="jcz"]:checked ').attr('attr_name'));
                        }
                    }
                ],
                onshow: function () {
                    console.log('onshow');
                },
                oniframeload: function () {
                    console.log('oniframeload');
                },
                onclose: function () {
                    if (this.returnValue) {
                        /*这个地方是当弹框关闭的时候，可以获取从弹框返回的值，可用来刷新页面*/
                        //location.reload();
                    }
                },
                onremove: function () {
                    console.log('onremove');
                }
            });
            dd.showModal();
        });




        $('.boxer').on('click', 'a.btn_bh', function () {
            bh = top.dialog({
                id: '',
                title: '请填写驳回原因',
                content: '<div class="person-alert-con"><textarea name="cancel_details" id=""></textarea></div>',
                width: 480,
                height: 400,
                quickClose: true,
                button: [
                    {
                        value: '发送',
                        callback: function () {
                            var cancel_details = $(":input[name='cancel_details']").val()
                            if (cancel_details == '') {
                                alert('驳回原因必须填写');
                                return false;
                            }
                            $.get("<?= Yii::$app->urlManager->createUrl(['officeapply/officeapply/spbh','id'=>$model->apply_id]); ?>", {cancel_details: cancel_details}, function (data) {
                                if (typeof data != "object") {
                                    var obj = eval('(' + data + ')');
                                }
                                if (obj.status == 'success') {
                                    alert(obj.msg);
                                    window.location.href = '<?= Yii::$app->urlManager->createUrl(['officeapply/officeapply/record']); ?>';
                                } else if (obj.status == 'error') {
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
            bh.showModal();
            return false;
        });
    });





    function toVaild(){
        if($('#apply_pack_text').val() == '' && $('#officeapply_sp_id').val() == ''){
            alert('机构领导不能为空！');
            return false;
        }
    }
</script>
