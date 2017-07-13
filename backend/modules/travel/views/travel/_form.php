<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\functions\functions;
use \backend\modules\deptcontact\models\DeptContact;
use \yii\helpers\ArrayHelper;
use \backend\modules\gongchu\models\Gongchu;
use \backend\modules\personwork\models\PersonWork;
?>
<div class="boxer" id="boxer-zh">
        <?php $form = ActiveForm::begin(
            [
                'action'=>Yii::$app->urlManager->createUrl(['travel/travel/create']),
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

    <div class="tk-add">
        <ul>
            <li class="th">【差旅费报销申请】</li>
            <li><span>报销单位</span>
                <div class="r">
                    <?php $model->department = Yii::$app->user->identity->department; ?>
                    <?= $form->field($model, 'department')->dropDownList(ArrayHelper::map(DeptContact::getDept(),'id','dept_name'),['prompt'=>'--选择机构--','style'=>'width:150px;'])->span('') ?>
                </div>
                <br class="clr">
            </li>
            <li><span><i>*</i>开始时间</span><div class="r">
                    <?= $form->field($model, 's_time')->textInput(['class'=>'q date']) ?>
                    <script type="text/javascript">
                        cal_s = Calendar.setup({
                            weekNumbers: true,
                            inputField : "travel-s_time",
                            trigger    : "travel-s_time",
                            dateFormat: "%Y-%m-%d",
                            showTime: true,
                            minuteStep: 1,
                            onSelect   : function() {
                                if (!/^(\d{4})(\d{2})(\d{2})$/.test(this.selection.get())) {
                                    alert("日期格式不正确!");
                                    $('#personworksearch-p_s_time_s').val('');
                                    return false
                                }

                                var date = Calendar.intToDate(this.selection.get());
                                cal_e.args.min = date;
                                cal_e.redraw();
                                this.hide();
                            }
                        });
                    </script></div>
                <br class="clr">
            </li>
            <li><span><i>*</i>结束时间</span>
                <div class="r">
                    <?= $form->field($model, 'e_time')->textInput(['class'=>'q date']) ?>
                    <script type="text/javascript">
                        cal_e = Calendar.setup({
                            weekNumbers: true,
                            inputField : "travel-e_time",
                            trigger    : "travel-e_time",
                            dateFormat: "%Y-%m-%d",
                            showTime: true,
                            minuteStep: 1,
                            onSelect   : function() {
                                if (!/^(\d{4})(\d{2})(\d{2})$/.test(this.selection.get())) {
                                    alert("日期格式不正确!");
                                    $('#personworksearch-p_s_time_e').val('');
                                    return false
                                }
                                var date = Calendar.intToDate(this.selection.get());
                                cal_s.args.max = date;
                                cal_s.redraw();
                                this.hide();
                            }
                        });
                    </script>
                </div>
                <br class="clr">
            </li>
            <li><span><i>*</i>地点</span><div class="r"><?= $form->field($model, 'dd')->textInput(['maxlength' => true]) ?></div><br class="clr">
            </li>
            <li><span><i>*</i>事由</span><div class="r"><?= $form->field($model, 'sy')->textInput(['maxlength' => true]) ?></div><br class="clr">
            </li>
            <li class="li-feiyong"><span>车船费</span>
                <div class="r">
                    <div class="zs">
                        <span>张数</span>
                        <span>金额/元</span>
                    </div>
                    <div class="price">
                        <?= $form->field($model, 'ccf_zs')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'ccf_je')->textInput(['maxlength' => true]) ?>
                    </div>
                </div><br class="clr">
            </li>
            <li class="li-feiyong"><span>住宿费</span>
                <div class="r">
                    <div class="zs">
                        <span>张数</span>
                        <span>金额/元</span>
                    </div>
                    <div class="price">
                        <?= $form->field($model, 'zsf_zs')->textInput() ?>
                        <?= $form->field($model, 'zsf_je')->textInput() ?>
                    </div>
                </div><br class="clr">
            </li>
            <li class="li-feiyong"><span>伙食补贴</span>
                <div class="r">
                    <div class="zs">
                        <span>张数</span>
                        <span>金额/元</span>
                    </div>
                    <div class="price">
                        <?= $form->field($model, 'hsbt_zs')->textInput() ?>
                        <?= $form->field($model, 'hsbt_je')->textInput() ?>
                    </div>
                </div><br class="clr">
            </li>
            <li><span>公杂费 / 元</span><div class="r"><?= $form->field($model, 'gzf')->textInput() ?></div><br class="clr">
            </li>

            <li><span><i>*</i>合计 / 元</span><div class="r"><?= $form->field($model, 'gj')->textInput() ?></div><br class="clr">
            </li>
            <?php $model->bxr_text = Yii::$app->user->identity->name; ?>
            <?php $model->bxr = Yii::$app->user->identity->id; ?>
            <li><span><i>*</i>报销人</span><div class="r"><?= $form->field($model, 'bxr_text')->textInput(['readonly'=>'true']) ?></div><br class="clr">
            </li>
            <?php
            $data = Gongchu::getBranchLeader(Yii::$app->user->identity->department);
            $model->zmr = $data[0];
            $model->zmr_text = $data[1];
            ?>
            <li><span><i>*</i>证明人</span><div class="r"><?= $form->field($model, 'zmr_text')->textInput(['readonly'=>'true']) ?></div><br class="clr">
            </li>
            <li><span><i>*</i>管理会计</span><div class="r"><?= $form->field($model, 'glkj_text')->textInput(['readonly'=>'true']) ?></div><br class="clr">
            </li>
            <?php
            $data = Gongchu::getDeptLeader(1);
            $model->ldsp = $data[0];
            $model->ldsp_text = $data[1];
            ?>
            <li><span><i>*</i>领导审批</span><div class="r"><?= $form->field($model, 'ldsp_text')->textInput(['readonly'=>'true']) ?></div><br class="clr">
            </li>
        </ul>
        <div class="btn">
            <?=Html::a(Yii::t('app', '返回'), Yii::$app->urlManager->createUrl(['travel/travel/index']),['class' =>'anniu','id'=>'back']);?>
            <?= Html::input('submit','','存档', ['class' => 'anniu']) ?>
        </div>
    </div>
    <div style="width: 0px;height: 0px;;display: none">
        <?= $form->field($model, 'bxr')->textInput()->hiddenInput();?>
        <?= $form->field($model, 'zmr')->textInput()->hiddenInput() ?>
        <?= $form->field($model, 'ldsp')->textInput()->hiddenInput() ?>
        <?= $form->field($model, 'glkj')->textInput()->hiddenInput() ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
    $(function(){
        $('#travel-ccf_zs,#travel-ccf_je,#travel-zsf_zs,#travel-zsf_je,#travel-hsbt_zs,#travel-hsbt_je,#travel-gzf').on('change',function(){
            var ccf_zs =  parseFloat($('#travel-ccf_zs').val() == '' ? 1 : $('#travel-ccf_zs').val());
            var ccf_je =  parseFloat($('#travel-ccf_je').val() == '' ? 0 : $('#travel-ccf_je').val());
            var zsf_zs =  parseFloat($('#travel-zsf_zs').val() == '' ? 1 : $('#travel-zsf_zs').val());
            var zsf_je =  parseFloat($('#travel-zsf_je').val() == '' ? 0 : $('#travel-zsf_je').val());
            var hsbt_zs =  parseFloat($('#travel-hsbt_zs').val() == '' ? 1 : $('#travel-hsbt_zs').val());
            var hsbt_je =  parseFloat($('#travel-hsbt_je').val() == '' ? 0 : $('#travel-hsbt_je').val());
            var gzf =  parseFloat($('#travel-gzf').val() == '' ? 0 : $('#travel-gzf').val());
            var total = (ccf_je) + (zsf_je) + (hsbt_je) + gzf;
            $("#travel-gj").val(total);
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
        $('.boxer').on('click','#travel-zmr_text', function () {
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
                            if(person_exists('travel-zmr_text',attr_name) == false){
                                alert('选择用户不能重复');
                                return false;
                            }
                            $('#travel-zmr_text').val(attr_name);
                            $('#travel-zmr').val(zmr_id);
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


        $('.boxer').on('click','#travel-glkj_text', function () {
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
                            if(person_exists('travel-glkj_text',attr_name) == false){
                                alert('选择用户不能重复');
                                return false;
                            }
                            $('#travel-glkj_text').val(attr_name);
                            $('#travel-glkj').val(glkj_id);
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


        $('.boxer').on('click','#travel-ldsp_text', function () {
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
                            if(person_exists('travel-ldsp_text',attr_name) == false){
                                alert('选择用户不能重复');
                                return false;
                            }
                            $('#travel-ldsp_text').val(attr_name);
                            $('#travel-ldsp').val(ldsp_id);
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
        var text = new Array('travel-bxr_text','travel-zmr_text','ravel-glkj_text','travel-ldsp_text');
        for (var i = 0; i < text.length; i++) {
            if(text[i] != self_text){
                if($('#'+text[i]).val() == name){
                    return false;
                }
            }
        }
        return true;
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