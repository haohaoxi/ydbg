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
            'action'=>Yii::$app->urlManager->createUrl(['carwx/carwx/create']),
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
            <strong>【维修费报销申请】</strong>
            <span>报销单位</span>
                <div class="r">
                    <?php $model->department = Yii::$app->user->identity->department; ?>
                    <?= $form->field($model, 'department')->dropDownList(ArrayHelper::map(DeptContact::getDept(),'id','dept_name'),['prompt'=>'--选择机构--','style'=>'width:150px;'])->span('') ?>
                </div>
                <br class="clr">
            
            <span><em>*</em>维修时间</span><div class="r">
                    <?= $form->field($model, 'wx_time')->textInput(['class'=>'q date']) ?>
                    <script type="text/javascript">
                        Calendar.setup({
                            weekNumbers: true,
                            inputField : "carwx-wx_time",
                            trigger    : "carwx-wx_time",
                            dateFormat: "%Y-%m-%d",
                            showTime: true,
                            minuteStep: 1,
                            onSelect   : function() {this.hide();}
                        });
                    </script></div>
                <br class="clr">
            
            <span><em>*</em>车牌号</span><div class="r"><?= $form->field($model, 'cph')->textInput() ?></div><br class="clr">
            
            <span><em>*</em>维修内容及配件项目</span><div class="r"><?= $form->field($model, 'wxnr')->textInput() ?></div><br class="clr">
            
            <span><em>*</em>金额/元</span><div class="r"><?= $form->field($model, 'jine')->textInput() ?></div><br class="clr">
            
            <span>备注</span><div class="r"><?= $form->field($model, 'remark')->textInput() ?></div><br class="clr">
            
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

            <?=Html::a(Yii::t('app', '返回'), Yii::$app->urlManager->createUrl(['carwx/carwx/index']),['class' =>'btn yuqi-return','id'=>'back']);?>
            <?= Html::input('submit','','存档', ['class' => 'btn']) ?>
    </div>
    <div style="width: 0px;height: 0px;;display: none">
        <?= $form->field($model, 'bxr')->textInput()->hiddenInput();?>
        <?= $form->field($model, 'zmr')->textInput()->hiddenInput() ?>
        <?= $form->field($model, 'ldsp')->textInput()->hiddenInput() ?>
        <?= $form->field($model, 'glkj')->textInput()->hiddenInput() ?>
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
        $('.boxer').on('click','#carwx-zmr_text', function () {
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
                            if(person_exists('carwx-zmr_text',attr_name) == false){
                                alert('选择用户不能重复');
                                return false;
                            }
                            $('#carwx-zmr_text').val(attr_name);
                            $('#carwx-zmr').val(zmr_id);
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


        $('.boxer').on('click','#carwx-glkj_text', function () {
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
                            if(person_exists('carwx-glkj_text',attr_name) == false){
                                alert('选择用户不能重复');
                                return false;
                            }
                            $('#carwx-glkj_text').val(attr_name);
                            $('#carwx-glkj').val(glkj_id);
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


        $('.boxer').on('click','#carwx-ldsp_text', function () {
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
                            if(person_exists('carwx-ldsp_text',attr_name) == false){
                                alert('选择用户不能重复');
                                return false;
                            }
                            $('#carwx-ldsp_text').val(attr_name);
                            $('#carwx-ldsp').val(ldsp_id);
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
        var text = new Array('carwx-bxr_text','carwx-zmr_text','ravel-glkj_text','carwx-ldsp_text');
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