<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

?>
<?=Html::cssFile('@web/css/ydbg/add2.css')?>
<div class="boxer">
    <div class="jg-add-boxer">
        <?php $form = ActiveForm::begin(
            [
                'method' => 'post',
                'options' => ['class' => '','enctype' => 'multipart/form-data'],
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'fieldConfig' => [
                    'template' => "{input}{error}",
                    'inputOptions' => ['class' => ''],
                    'errorOptions'=>['class' => 'tishi'],
                ]
            ]
        ); ?>
        <span>机构名称</span><?= $form->field($model, 'dept_name')->textInput(['maxlength' => true]) ?><br class="clr"/>
        <span>机构类型</span><?= $form->field($model, 'dept_type')->textInput(['maxlength' => true]) ?><br class="clr"/>
        <span>负责人</span><?= $form->field($model, 'principal_text')->textInput(['maxlength' => true]) ?><br class="clr"/>
        <span>分管领导</span><?= $form->field($model, 'branch_leader_text')->textInput(['maxlength' => true]) ?><br class="clr"/>
        <em>注：不设置机构负责人将对审批流程造成影响</em>
        <?php if(empty($_GET['look_type'])){ ?>
            <?= Html::input('button','','返回', ['class' => 'd','onclick'=>'javascript:history.go(-1);']) ?>
            <?= Html::input('submit','','存档', ['class' => 'd','id'=>'save']) ?>
        <?php }else{ ?>
            <?= Html::input('button','','返回', ['class' => 'd','onclick'=>'javascript:history.go(-1);']) ?>
        <?php } ?>
        <div style="width: 0px;height: 0px;">
            <?= $form->field($model, 'principal')->hiddenInput() ?>
            <?= $form->field($model, 'branch_leader')->hiddenInput() ?>
        </div>
        <?php ActiveForm::end(); ?>
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

    var fzr = '<div class="gongchu-ren">';
    var fgld = '<div class="gongchu-ren">';
    <?php
    $getJigouUser = \backend\modules\personwork\models\PersonWork::getJigouUser();
    if($getJigouUser != false){
    foreach($getJigouUser as $key=>$value){
    ?>

    fzr += '<div class="gongchu-ren-ks"><a href="javascript:;" data="ks1"><?= $key; ?></a></div>' +
        '<div class="gongchu-ren-list" id="ks1_con">';
    fgld += '<div class="gongchu-ren-ks"><a href="javascript:;" data="ks1"><?= $key; ?></a></div>' +
        '<div class="gongchu-ren-list" id="ks1_con">';

    <?php
    foreach($value as $k=>$v){
    ?>
    fzr += '<label for="ren<?= $k; ?>"><input type="radio" id="ren<?= $k; ?>" name="p_spr" value="<?= $k; ?>" attr_name="<?= $v; ?>" /><?= $v; ?></label>';
    fgld += '<label for="ren<?= $k; ?>"><input type="radio" id="ren<?= $k; ?>" name="p_spr" value="<?= $k; ?>" attr_name="<?= $v; ?>" /><?= $v; ?></label>';
    <?php
    }
    ?>

    fzr += '<div class="clr"></div></div>';
    fgld += '<div class="clr"></div></div>';
    <?php }} ?>

    fzr += '</div>';
    fgld += '</div>';

    seajs.use(['jquery'], function ($) {
        $('.boxer').on('click','#deptcontact-principal_text', function () {
            d = top.dialog({
                id: 'dialog_slr',
                title: '选择负责人',
                content: fzr,
                width: 550,
                height: 500,
                quickClose: true,
                button: [
                    {
                        value: '确定',
                        callback: function () {
                            var fzr = $(':radio[name="p_spr"]:checked ').val();
                            if (fzr == undefined) {
                                alert('请选择负责人');
                                return false;
                            }
                            if (fzr.length == 0) {
                                alert('选择负责人');
                                return false;
                            }
                            $(':input[name="DeptContact[principal_text]"]').val($(':radio[name="p_spr"]:checked ').attr('attr_name'));
                            $('#deptcontact-principal').val(fzr)
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
            return false;
        });

        $('.boxer').on('click','#deptcontact-branch_leader_text', function () {
            dd = top.dialog({
                id: 'dialog_slr',
                title: '选择分管领导',
                content: fgld,
                width: 550,
                height: 500,
                quickClose: true,
                button: [
                    {
                        value: '确定',
                        callback: function () {
                            var fgld = $(':radio[name="p_spr"]:checked ').val();
                            if (fgld == undefined) {
                                alert('请选择负责人');
                                return false;
                            }
                            if (fgld.length == 0) {
                                alert('选择负责人');
                                return false;
                            }
                            $(':input[name="DeptContact[branch_leader_text]"]').val($(':radio[name="p_spr"]:checked ').attr('attr_name'));
                            $('#deptcontact-branch_leader').val(fgld)
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
            return false;
        });
    });
</script>
<!--删除领导和分管-->
<script type="text/javascript">
    $(function(){
        $("#save").click(function(){
            var text1 =$('#deptcontact-principal_text').val();
            var text2 =$('#deptcontact-branch_leader_text').val();
           if(text1 == ''){
               $('#deptcontact-principal').val('') ;
           }
            if(text2 == ''){
                $('#deptcontact-branch_leader').val('') ;
            }
        })
    })
</script>