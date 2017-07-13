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
            'action'=>Yii::$app->urlManager->createUrl(['office/office/sqtj']),
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
        <strong>【办公用品详情】</strong>

        <?php
        if($aciton == 'sq') {
            ?>
            <span>申请人</span>
            <div class="r">
                <?php
                $data = User::getNames(Yii::$app->user->identity->id);
                ?>
                <input type="text" class="q view" name="" id="" value="<?= $data[0]['name']; ?>" readonly=""/>
            </div>
            <br class="clr">

            <span>科室</span>
            <div class="r">
                <?php
                $data = DeptContact::getDeptOne(Yii::$app->user->identity->department);
                ?>
                <input type="text" class="q view" name="" id="" value="<?= $data['dept_name']; ?>" readonly=""/>
            </div>
            <br class="clr">
        <?php
        }
        ?>

        <span>办公用品名称</span>
        <div>
            <input type="text" value="<?= $model->office_name ?>" class="q view" readonly="">
        </div>
        <br class="clr">

        <span>预计单价/元</span>
        <div class="r">
            <input type="text" class="q view"  id="office_price" name="office_price" value="<?= $model->office_price ?>" readonly="" />
        </div>
        <br class="clr">

        <span style="height: 80px">适用机构</span>
        <div class="r" style="height: 80px">
            <textarea type="textarea" class="q view"  style="height: 80px;width: 560px!important;" value="" readonly="" ><?= $model->office_part_name ?></textarea>
        </div>
        <br class="clr">

        <span>库存数量</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->office_num ?>" readonly="" />
        </div>
        <br class="clr">

        <span>用品类型</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->office_type ?>" readonly="" />
        </div>
        <br class="clr">

        <span>申请开始时间</span>
        <div class="r">
            <input type="text" class="q date time view"  value="<?= $model->office_start_time ?>" readonly="" />
        </div>
        <br class="clr">

        <span>申请结束时间</span>
        <div class="r">
            <input type="text" class="q date time view"  value="<?= $model->office_end_time ?>" readonly="" />
        </div>
        <br class="clr">

        <?php
        if($aciton == 'sq') {
            ?>
            <span><em>*</em>申请数量</span>
            <div class="r">
                <input type="text" class="q view" name="office_apply_num" id="office_apply_num" value="1"/>
            </div>
            <br class="clr">

            <span><em>*</em>预计金额/元</span>
            <div class="r">
                <input type="text" class="q view" name="office_apply_money" id="office_apply_money" value="<?= $model->office_price ?>"/>
            </div>
            <br class="clr">

            <?php
            $data = Gongchu::getDeptLeader(Yii::$app->user->identity->department);
            ?>

            <span><em>*</em>行装科意见</span>
            <div class="r">
                <input type="text" class="q view" name="apply_pack_text" id="apply_pack_text" value=""/>
            </div>
            <br class="clr">

            <?php
            $data = Gongchu::getBranchLeader(Yii::$app->user->identity->department);
            ?>
            <span>检察长意见</span>
            <div class="r">
                <input type="text" class="q view" name="apply_genneral_text" id="apply_genneral_text" value=""/>
            </div>
            <br class="clr">
        <?php
        }
        ?>
        <br class="clr">
        <input type="hidden" class="q view" name="apply_pack_id" id="apply_pack_id" value=""/>
        <input type="hidden" class="q view" name="apply_genneral_id" id="apply_genneral_id" value=""/>

        <input type="hidden" class="q view" name="office_id" id="office_id" value="<?= $model->office_id; ?>"/>
        <input type="hidden" class="q view" name="office_name" id="office_name" value="<?= $model->office_name; ?>"/>
        <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>
        <?php
        if($aciton == 'sq') {
            ?>
            <?= Html::input('submit','','提交', ['class' => 'btn','onclick'=>'return confirm("是否提交？");']) ?>
        <?php
        }
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
    $(function(){
        $('#office_apply_num').on('change',function(){
            var num =  parseFloat($('#office_apply_num').val() == '' ? 0 : $('#office_apply_num').val());
            var price =  parseFloat($('#office_price').val() == '' ? 0 : $('#office_price').val());
            var total = (price * num);
            $("#office_apply_money").val(total);
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
            $('.gongchu-ren-ks').on('click',function(){
                $(this).next('div[class="gongchu-ren-list"]').toggle();
            });
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
            $('.gongchu-ren-ks').on('click',function(){
                $(this).next('div[class="gongchu-ren-list"]').toggle();
            });
        });
    });


    function toVaild(){
        if($('#apply_pack_text').val() == '' || $('#apply_pack_id').val() == ''){
            alert('行装科意见不能为空！');
            location = location;
            return false;
        }
    }
</script>
