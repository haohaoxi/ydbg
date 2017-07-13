<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\functions\functions;
use \backend\modules\deptcontact\models\DeptContact;
use \yii\helpers\ArrayHelper;
use \backend\modules\gongchu\models\Gongchu;
use \backend\modules\personwork\models\PersonWork;
?>
<?=Html::cssFile('@web/css/ydbg/inside.css')?>
<div class="boxer" id="boxer-zh">
    <?php $form = ActiveForm::begin(
        [
            'action'=>Yii::$app->urlManager->createUrl(['meet/meet/create']),
            'method' => 'post',
            'options' => ['class' => ''],
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'fieldConfig' => [
                'template' => "{input}{error}",//D:\wamp2\www\jsdt\vendor\yiisoft\yii2\helpers\BaseHtml.php 1222L
                'inputOptions' => ['class' => 'q'],
                'errorOptions'=>['class' => 'tishi'],

            ]
        ]
    ); ?>

    <div class="default-form baoxiao-form">
        <strong>【会议费报销申请】</strong>
        <span><em>*</em>会议名称</span><div class="r"><?= $form->field($model, 'name')->textInput() ?></div><br class="clr">
        <span><em>*</em>开会时间</span><div class="r">
            <?= $form->field($model, 'kh_time')->textInput(['class'=>'q date']) ?>
            <script type="text/javascript">
                Calendar.setup({
                    weekNumbers: true,
                    inputField : "meet-kh_time",
                    trigger    : "meet-kh_time",
                    dateFormat: "%Y-%m-%d",
                    showTime: true,
                    minuteStep: 1,
                    onSelect   : function() {this.hide();}
                });
            </script></div>
        <br class="clr">

        <span>外地代表数/人</span><div class="r"><?= $form->field($model, 'wddbs')->textInput() ?></div><br class="clr">
        <span>本地代表数/人</span><div class="r"><?= $form->field($model, 'bddbs')->textInput() ?></div><br class="clr">
        <span>工作人员数/人</span><div class="r"><?= $form->field($model, 'gzrys')->textInput() ?></div><br class="clr">
        <span><em>*</em>参会人员数/人</span><div class="r"><?= $form->field($model, 'chrys')->textInput() ?></div><br class="clr">
        <span class="two"><em>*</em>会期（含报到和离开时间）/天</span><div class="two"><?= $form->field($model, 'hq')->textInput() ?></div><br class="clr">
        <span class="two"><em>*</em>按综合定额标准计算会议费开支控制数/元</span><div class="two"><?= $form->field($model, 'hyzf')->textInput() ?></div><br class="clr">

        <span>住宿费/元</span><div class="r"><?= $form->field($model, 'zsf')->textInput() ?></div><br class="clr">
        <span>伙食费/元</span><div class="r"><?= $form->field($model, 'hsf')->textInput() ?></div><br class="clr">
        <span>会议室租金/元</span><div class="r"><?= $form->field($model, 'hyszj')->textInput() ?></div><br class="clr">
        <span>交通费/元</span><div class="r"><?= $form->field($model, 'jtf')->textInput() ?></div><br class="clr">
        <span>文件印刷费/元</span><div class="r"><?= $form->field($model, 'wjysf')->textInput() ?></div><br class="clr">
        <span>其他支出/元</span><div class="r"><?= $form->field($model, 'qtzc')->textInput() ?></div><br class="clr">
        <span><em>*</em>实际开支/元</span><div class="r"><?= $form->field($model, 'sjkz')->textInput() ?></div><br class="clr">

        <?php $model->bxr_text = Yii::$app->user->identity->name; ?>
        <?php $model->bxr = Yii::$app->user->identity->id; ?>
        <span><em>*</em>报销人</span><div class="r"><?= $form->field($model, 'bxr_text')->textInput(['readonly'=>'true']) ?></div><br class="clr">

        <?php
        $data = Gongchu::getBranchLeader(Yii::$app->user->identity->department);
        $model->zmr = $data[0];
        $model->zmr_text = $data[1];
        ?>
        <span><em>*</em>证明人</span><div class="r"><?= $form->field($model, 'zmr_text')->textInput(['readonly'=>'true']) ?></div><br class="clr">

        <span><em>*</em>管理会计</span><div class="r"><?= $form->field($model, 'glkj_text')->textInput(['readonly'=>'true']) ?></div><br class="clr">

        <?php
        $data = Gongchu::getDeptLeader(1);
        $model->ldsp = $data[0];
        $model->ldsp_text = $data[1];
        ?>
        <span>领导审批</span><div class="r"><?= $form->field($model, 'ldsp_text')->textInput(['readonly'=>'true']) ?></div><br class="clr">

        <?=Html::a(Yii::t('app', '返回'), Yii::$app->urlManager->createUrl(['meet/meet/index']),['class' =>'btn yuqi-return','id'=>'back']);?>
        <?= Html::input('submit','','存档', ['class' => 'btn']) ?>
    </div>
    <div style="width: 0px;height: 0px;display: none">
        <?= $form->field($model, 'bxr')->textInput()->hiddenInput();?>
        <?= $form->field($model, 'zmr')->textInput()->hiddenInput() ?>
        <?= $form->field($model, 'ldsp')->textInput()->hiddenInput() ?>
        <?= $form->field($model, 'glkj')->textInput()->hiddenInput() ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
    $(function(){
        $('#meet-wddbs,#meet-bddbs,#meet-gzrys').on('change',function(){
            var wddbs =  parseFloat($('#meet-wddbs').val() == '' ? 0 : $('#meet-wddbs').val());
            var bddbs =  parseFloat($('#meet-bddbs').val() == '' ? 0 : $('#meet-bddbs').val());
            var gzrys =  parseFloat($('#meet-gzrys').val() == '' ? 0 : $('#meet-gzrys').val());
            var total = wddbs + bddbs + gzrys;
            $("#meet-chrys").val(total);
        })

        $('#meet-zsf,#meet-hsf,#meet-hyszj,#meet-jtf,#meet-wjysf,#meet-qtzc').on('change',function(){
            var zsf =  parseFloat($('#meet-zsf').val() == '' ? 0 : $('#meet-zsf').val());
            var hsf =  parseFloat($('#meet-hsf').val() == '' ? 0 : $('#meet-hsf').val());
            var hyszj =  parseFloat($('#meet-hyszj').val() == '' ? 0 : $('#meet-hyszj').val());
            var jtf =  parseFloat($('#meet-jtf').val() == '' ? 0 : $('#meet-jtf').val());
            var wjysf =  parseFloat($('#meet-wjysf').val() == '' ? 0 : $('#meet-wjysf').val());
            var qtzc =  parseFloat($('#meet-qtzc').val() == '' ? 0 : $('#meet-qtzc').val());
            var total = zsf + hsf + hyszj + jtf + wjysf + qtzc;
            $("#meet-sjkz").val(total);
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

    //证明人start
    var zmr = '<div class="gongchu-ren">';
    <?php
        $getJigouUser = PersonWork::getJigouUser('us.id !='.Yii::$app->user->identity->id);
        if($getJigouUser != false){
        foreach($getJigouUser as $key=>$value){
    ?>
    '<div class="gongchu-ren-list" id="ks1_con">';
    zmr += '<div class="gongchu-ren-ks"><a href="javascript:;" data="ks1"><?= $key; ?></a></div>' +
    '<div class="gongchu-ren-list" id="ks1_con">';
    <?php
         foreach($value as $k=>$v){
    ?>
    zmr += '<label for="ren<?= $k; ?>"><input type="radio" id="ren<?= $k; ?>" name="zmr" value="<?= $k; ?>" attr_name="<?= $v; ?>" /><?= $v; ?></label>';
    <?php
         }
    ?>
    zmr += '<div class="clr"></div></div>';
    <?php }} ?>
    zmr += '</div>';
    //证明人end

    //管理会计start
    var glkj = '<div class="gongchu-ren">';
    <?php
        $getJigouUser = PersonWork::getJigouUser('us.id !='.Yii::$app->user->identity->id);
        if($getJigouUser != false){
        foreach($getJigouUser as $key=>$value){
    ?>
    '<div class="gongchu-ren-list" id="ks1_con">';
    glkj += '<div class="gongchu-ren-ks"><a href="javascript:;" data="ks1"><?= $key; ?></a></div>' +
    '<div class="gongchu-ren-list" id="ks1_con">';
    <?php
         foreach($value as $k=>$v){
    ?>
    glkj += '<label for="ren<?= $k; ?>"><input type="radio" id="ren<?= $k; ?>" name="glkj" value="<?= $k; ?>" attr_name="<?= $v; ?>" /><?= $v; ?></label>';
    <?php
         }
    ?>
    glkj += '<div class="clr"></div></div>';
    <?php }} ?>
    glkj += '</div>';
    //管理会计end

    //领导审批start
    var ldsp = '<div class="gongchu-ren">';
    <?php
        $getJigouUser = PersonWork::getJigouUser('us.id !='.Yii::$app->user->identity->id);
        if($getJigouUser != false){
        foreach($getJigouUser as $key=>$value){
    ?>
    '<div class="gongchu-ren-list" id="ks1_con">';
    ldsp += '<div class="gongchu-ren-ks"><a href="javascript:;" data="ks1"><?= $key; ?></a></div>' +
    '<div class="gongchu-ren-list" id="ks1_con">';
    <?php
         foreach($value as $k=>$v){
    ?>
    ldsp += '<label for="ren<?= $k; ?>"><input type="radio" id="ren<?= $k; ?>" name="ldsp" value="<?= $k; ?>" attr_name="<?= $v; ?>" /><?= $v; ?></label>';
    <?php
         }
    ?>
    ldsp += '<div class="clr"></div></div>';
    <?php }} ?>
    ldsp += '</div>';
    //领导审批end


    seajs.use(['jquery'], function ($) {
        $('.boxer').on('click','#meet-zmr_text', function () {
            d = top.dialog({
                id: 'dialog_spr',
                title: '选择证明人',
                content: zmr,
                width: 550,
                height: 500,
                quickClose: true,
                button: [
                    {
                        value: '确定',
                        callback: function () {
                            var zmr_id = $(':radio[name="zmr"]:checked ').val();
                            var attr_name = $(':radio[name="zmr"]:checked ').attr('attr_name');
                            if(zmr_id == undefined){
                                alert('请填选择证明人人');
                                return false;
                            }
                            if(person_exists('meet-zmr_text',attr_name) == false){
                                alert('选择用户不能重复');
                                return false;
                            }
                            $('#meet-zmr_text').val(attr_name);
                            $('#meet-zmr').val(zmr_id);
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


        $('.boxer').on('click','#meet-glkj_text', function () {
            d = top.dialog({
                id: 'dialog_spr',
                title: '选择管理会计',
                content: glkj ,
                width: 550,
                height: 500,
                quickClose: true,
                button: [
                    {
                        value: '确定',
                        callback: function () {
                            var glkj_id = $(':radio[name="glkj"]:checked ').val();
                            var attr_name = $(':radio[name="glkj"]:checked ').attr('attr_name');
                            if(glkj_id == undefined){
                                alert('请填选择管理会计');
                                return false;
                            }
                            if(person_exists('meet-glkj_text',attr_name) == false){
                                alert('选择用户不能重复');
                                return false;
                            }
                            $('#meet-glkj_text').val(attr_name);
                            $('#meet-glkj').val(glkj_id);
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


        $('.boxer').on('click','#meet-ldsp_text', function () {
            d = top.dialog({
                id: 'dialog_spr',
                title: '选择领导审批',
                content:ldsp,
                width: 550,
                height: 500,
                quickClose: true,
                button: [
                    {
                        value: '确定',
                        callback: function () {
                            var ldsp_id = $(':radio[name="ldsp"]:checked ').val();
                            var attr_name = $(':radio[name="ldsp"]:checked ').attr('attr_name');
                            if(ldsp_id == undefined){
                                alert('请填选择领导审批');
                                return false;
                            }
                            if(person_exists('meet-ldsp_text',attr_name) == false){
                                alert('选择用户不能重复');
                                return false;
                            }
                            $('#meet-ldsp_text').val(attr_name);
                            $('#meet-ldsp').val(ldsp_id);
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
    })


    function person_exists(self_text,name){
        var text = new Array('meet-bxr_text','meet-zmr_text','ravel-glkj_text','meet-ldsp_text');
        for (var i = 0; i < text.length; i++) {
            if(text[i] != self_text){
                if($('#'+text[i]).val() == name){
                    return false;
                }
            }
        }
        return true;
    }

    $('.two > div').addClass('two');
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