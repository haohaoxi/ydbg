<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use \backend\modules\deptcontact\models\DeptContact;
use \backend\modules\gongchu\models\Gongchu;
use \backend\modules\personwork\models\PersonWork;
$data = Gongchu::getLeader(Yii::$app->user->identity->department);
$first =  current($data);
$aciton = Yii::$app->controller->action->id;
?>
<?=Html::cssFile('@web/css/ydbg/inside.css')?>
<div class="boxer">
    
    <?php $form = ActiveForm::begin(
        [
            'action'=>Yii::$app->urlManager->createUrl(['welfare/welfare/sqtj']),
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
        <strong>【福利详情】</strong>
        <span>福利名称</span>
        <div>
            <input type="text" value="<?= $model->welfare_name ?>" class="q view" readonly="">
        </div>
        <br class="clr">

        <span>福利类型</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->welfare_type ?>" readonly="" />
        </div>
        <br class="clr">

        <span>申请开始时间</span>
        <div class="r">
            <input type="text" class="q date time view"  value="<?= $model->welfare_start_time ?>" readonly="" />
        </div>
        <br class="clr">

        <span>申请结束时间</span>
        <div class="r">
            <input type="text" class="q date time view"  value="<?= $model->welfare_end_time ?>" readonly="" />
        </div>
        <br class="clr">

        <span style="height: 80px">适用机构</span>
        <div class="r" style="height: 80px">
            <textarea type="textarea" class="q view" style="height: 80px;width: 560px!important;" value="" readonly=""><?= $model->welfare_part_name ?></textarea>
        </div>
        <br class="clr">

        <span>福利明细</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->welfare_detail ?>" readonly="" />
        </div>
        <?php
        if($aciton == 'sq') {
        ?>
        <span><em>*</em>审批人</span>
        <div class="r">
            <input type="text" class="q view" name="welfare_sp_text" id="welfare_sp_text" value=""/>
        </div>
        <br class="clr">
        <?php
        }
        ?>
        <br class="clr">
        <input type="hidden" class="q view" name="welfare_sp_id" id="welfare_sp_id" value=""/>
        <input type="hidden" class="q view" name="welfare_id" id="welfare_id" value="<?= $model->welfare_id; ?>"/>
        <input type="hidden" class="q view" name="welfare_name" id="welfare_name" value="<?= $model->welfare_name; ?>"/>
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

    //审批人start
    var spr = '<div class="gongchu-ren">';
    <?php
        $getJigouUser = PersonWork::getJigouUser('us.id !='.Yii::$app->user->identity->id);
        if($getJigouUser != false){
        foreach($getJigouUser as $key=>$value){
    ?>
    spr += '<div class="gongchu-ren-ks"><a href="javascript:;" data="ks1"><?= $key; ?></a></div>' +
    '<div class="gongchu-ren-list" id="ks1_con">';
    <?php
         foreach($value as $k=>$v){
    ?>
    spr += '<label for="ren<?= $k; ?>"><input type="radio" id="ren<?= $k; ?>" name="spr" value="<?= $k; ?>" attr_name="<?= $v; ?>" /><?= $v; ?></label>';
    <?php
         }
    ?>
    spr += '<div class="clr"></div></div>';
    <?php }} ?>
    spr += '</div>';
    //审批人end

    seajs.use(['jquery'], function ($) {
        $('.boxer').on('click','#welfare_sp_text', function () {
            $(':input[name="welfare_sp_id"]').val('');
            $(':input[name="welfare_sp_text"]').val('');
            d = top.dialog({
                id: '',
                title: '选择机构领导',
                content: spr,
                width: 550,
                height: 500,
                quickClose: true,
                button: [
                    {
                        value: '确定',
                        callback: function () {
                            var spr = $(':radio[name="spr"]:checked ').val();
                            if(spr == undefined){
                                alert('请填选择机构领导');
                                return false;
                            }
                            $('#welfare_sp_id').val(spr);
                            $('#welfare_sp_text').val($(':radio[name="spr"]:checked ').attr('attr_name'));
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
    });


    function toVaild(){
        if($('#welfare_sp_text').val() == '' && $('#welfare_sp_id').val() == ''){
            alert('审批人不能为空！');
            location = location;
            return false;
        }
    }
</script>
