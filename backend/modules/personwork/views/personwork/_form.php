<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\functions\functions;
?>

<link rel="stylesheet" type="text/css" href="js/jsdt/calendar/jscal2.css">
<link rel="stylesheet" type="text/css" href="js/jsdt/calendar/border-radius.css">
<link rel="stylesheet" type="text/css" href="js/jsdt/calendar/win2k.css">
<script type="text/javascript" src="js/jsdt/calendar/calendar.js"></script>
<script type="text/javascript" src="js/jsdt/calendar/lang/en.js"></script>
<script type="text/javascript">
    jQuery(function($){
        $(".default-form input").placeholder();
    });
</script>
<?=Html::cssFile('@web/css/ydbg/person.css')?>
<div class="boxer" id="boxer-zh">
    <div class="default-form person-form">
        <?php $form = ActiveForm::begin(
            [
                'action'=>Yii::$app->urlManager->createUrl(['personwork/personwork/create','menutype'=>intval($_GET['menutype'])]),
                'method' => 'post',
                'options' => ['class' => '','enctype' => 'multipart/form-data'],
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'validateOnSubmit'=>true,
                'fieldConfig' => [
                    'template' => "{input}{error}",//D:\wamp2\www\jsdt\vendor\yiisoft\yii2\helpers\BaseHtml.php 1222L
                    'inputOptions' => ['class' => 'q'],
                    'errorOptions'=>['class' => 'tishi'],

                ]
            ]
        ); ?>
        <strong>【发起工作】</strong>
        <span>主题</span><?= $form->field($model, 'p_title')->textInput(['class'=>'q'])->span() ?><br class="clr" />
        <span>优先级</span>
        <?= $form->field($model, 'p_level')->dropDownList(functions::getLevel()) ?>
        <br class="clr" />
        <span>受理人</span>
        <?= $form->field($model, 'p_y_slr_text')->textInput(array('readonly'=>'true','class'=>'q'))->span()?>
        <br class="clr" />
        <span>工作开始时间</span>
            <?= $form->field($model, 'p_s_time')->textInput(array('readonly'=>'true','class' =>'q date','placeholder'=>'请选择时间')) ?>
            <script type="text/javascript">
                cal_s = Calendar.setup({
                    weekNumbers: true,
                    inputField : "personwork-p_s_time",
                    trigger    : "personwork-p_s_time",
                    dateFormat: "%Y-%m-%d %H:%M",
                    //dateFormat: "%Y-%m-%d",
                    showTime: true,
                    format:'-',
                    minuteStep: 1,
                    min:"<?= date('Y-m-d H:i:s'); ?>",
                    onSelect   : function() {
                        if (!/^(\d{4})(\d{2})(\d{2})$/.test(this.selection.get())) {
                            alert("日期格式不正确!");
                            $('#travelsearch-time_s').val('');
                            return false
                        }

                        var date = Calendar.intToDate(this.selection.get());
                        cal_e.args.min = date;
                        cal_e.redraw();
                        this.hide();
                    }
                });
            </script>
        <br class="clr" />
        <span>工作结束时间</span>
            <?= $form->field($model, 'p_e_time')->textInput(array('readonly'=>'true','class' =>'q date','placeholder'=>'请选择时间')) ?>
            <script type="text/javascript">
                cal_e = Calendar.setup({
                    weekNumbers: true,
                    inputField : "personwork-p_e_time",
                    trigger    : "personwork-p_e_time",
                    //dateFormat: "%Y-%m-%d",
                    dateFormat: "%Y-%m-%d %H:%M",
                    showTime: true,
                    minuteStep: 1,
                    min:"<?= date('Y-m-d H:i:s'); ?>",
                    onSelect   : function() {
                        if (!/^(\d{4})(\d{2})(\d{2})$/.test(this.selection.get())) {
                            alert("日期格式不正确!");
                            $('#travelsearch-time_e').val('');
                            return false
                        }
                        var date = Calendar.intToDate(this.selection.get());
                        cal_s.args.max = date;
                        cal_s.redraw();
                        this.hide();
                    }
                });
            </script>
        <br class="clr" />
        <style>
            .person-form div.field-personwork-p_details{
                height: 80px;
            }
        </style>
        <span class="xiangqing">详情</span>
        <?= $form->field($model, 'p_details')->textInput(['class'=>'q person-information']) ?>
        <br class="clr" />

        <p class="addperson-p-add">添加审批人</p><p class="addperson-p-tip">审批人审批完成后，由受理人进行工作受理</p>
        <ul class="person-ul-list">
        </ul>
        <br class="clr" />
        <?=Html::a(Yii::t('app', '返回'), Yii::$app->urlManager->createUrl(['personwork/personwork/index','menutype'=>'5']),['class' =>'btn yuqi-return','id'=>'back']);?>
        <?= Html::input('submit','','存档', ['class' => 'btn yuqi-return']) ?>
        <br class="clr" />
        <div style="width: 0px;height: 0px;display: none">
            <?= $form->field($model, 'p_y_slr')->hiddenInput() ?>
            <?= $form->field($model, 'p_spr')->hiddenInput() ?>
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

        var slr = '<div class="gongchu-ren">';
        var spr = '<div class="gongchu-ren">';
        <?php
            $getJigouUser = \backend\modules\personwork\models\PersonWork::getJigouUser();
            if($getJigouUser != false){
            foreach($getJigouUser as $key=>$value){
        ?>

        slr += '<div class="gongchu-ren-ks"><a href="javascript:;" data="ks1"><?= $key; ?></a></div>' +
        '<div class="gongchu-ren-list" id="ks1_con">';
        spr += '<div class="gongchu-ren-ks"><a href="javascript:;" data="ks1"><?= $key; ?></a></div>' +
        '<div class="gongchu-ren-list" id="ks1_con">';

        <?php
             foreach($value as $k=>$v){
        ?>
        slr += '<label for="ren<?= $k; ?>"><input type="checkbox" id="ren<?= $k; ?>" name="p_slr[]" value="<?= $k; ?>" attr_name="<?= $v; ?>" /><?= $v; ?></label>';
        spr += '<label for="ren<?= $k; ?>"><input type="radio" id="ren<?= $k; ?>" name="p_spr" value="<?= $k; ?>" attr_name="<?= $v; ?>" /><?= $v; ?></label>';
        <?php
             }
        ?>

        slr += '<div class="clr"></div></div>';
        spr += '<div class="clr"></div></div>';
        <?php }} ?>

        slr += '</div>';
        spr += '</div>';

        seajs.use(['jquery'], function ($) {
            $('.default-form').on('click','#personwork-p_y_slr_text', function () {
                $('#personwork-p_y_slr_text').val('');
                dd = top.dialog({
                    id: 'dialog_slr',
                    title: '选择受理人',
                    content: slr,
                    width: 550,
                    height: 500,
                    quickClose: true,
                    button: [
                        {
                            value: '确定',
                            callback: function () {
                                var p_slr_value =[];
                                var p_slr_text_value =[];
                                $(':checkbox[name="p_slr[]"]:checked').each(function(){
                                    p_slr_value.push($(this).val());
                                    p_slr_text_value.push($(this).attr('attr_name'));
                                });
                                if(p_slr_value.length == 0){
                                    alert('选择受理人');
                                    return false;
                                }
                                $('#personwork-p_y_slr_text').val(p_slr_text_value);
                                $('#personwork-p_y_slr').val(p_slr_value);
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
                $(':checkbox[name="p_slr[]"]').on('change', function () {
                    var p_slr_text = '';
                    $(':checkbox[name="p_slr[]"]:checked').each(function(){
                        p_slr_text += $(this).attr('attr_name')+' ';
                    });
                    if(p_slr_text != ''){
                        $('.ui-dialog-title').html('选择受理人 ('+ p_slr_text +')');
                    }
                });

                $('.gongchu-ren-ks').on('click',function(){
                    $(this).next('div[class="gongchu-ren-list"]').toggle();
                });
                return false;
            });



            $('.default-form').on('click','.addperson-p-add', function () {
                d = top.dialog({
                    id: 'dialog_spr',
                    title: '选择审批人',
                    content: spr,
                    width: 550,
                    height: 500,
                    quickClose: true,
                    button: [
                        {
                            value: '确定',
                            callback: function () {
                                var spr_id = $(':radio[name="p_spr"]:checked ').val();
                                if(spr_id == undefined){
                                    alert('请填选择审批人人');
                                    return false;
                                }

                                var cf = '';
                                $('.p_spr').each(function(){
                                    if(spr_id == $(this).attr('attr_value')){
                                        cf = spr_id;
                                    }
                                });
                                if(cf != ''){
                                    alert('不可重复选择审批人');
                                    return false;
                                }
                                var number = getEndNumber();
                                $('.person-ul-list').append('<li><span><n class="number">'+number+'</n>级审批人</span><p class="p_spr" attr_value="'+spr_id+'">'+$(':radio[name="p_spr"]:checked ').attr('attr_name')+'</p><p class="p_spr_del" onclick="p_spr_del(this);">X</p></li>');
                                return p_spr_change();
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
                return false;
            });
        });

        function number_change(){
            var _number = 1;
            if($('.number').length != 0){
                $('.number').each(function(){
                    $(this).html(_number);
                    _number++;
                });
            }
        }

        function p_spr_change(){
            var p_slr_ =[];
            $('.p_spr').each(function(){
                p_slr_.push($(this).attr('attr_value'));
            });
            if(p_slr_.length > 0){
                $('#personwork-p_spr').val(p_slr_);
            }
            return true;
        }

        function p_spr_del(obj){
            $(obj).parent('li').remove();
            p_spr_change();
            number_change();
        }

        function toVaild(){
            if($('#personwork-p_y_slr').val() == '' && $('#personwork-p_spr').val() == ''){
                alert('受理人和审批人必须填写其中一项！');
                return false;
            }
        }

        function getEndNumber(){
            if($('.number').length == 0) return 1;
            return $('.number').length + 1;
        }


    </script>
    <!--确认放弃数据-->
    <script type="text/javascript">
        $(function(){
            $("#back").click(function(){
                if(window.confirm('是否放弃所填表单？')){
                    return true;
                }else{
                    return false;
                }
            })
        })
    </script>