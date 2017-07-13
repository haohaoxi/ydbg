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
            'action'=>Yii::$app->urlManager->createUrl(['office/office/cgtj']),
            'method' => 'post',
            'options' => ['class' => ''],
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'fieldConfig' => [
                'template' => "{input}{error}",//D:\wamp2\www\jsdt\vendor\yiisoft\yii2\helpers\BaseHtml.php 1222L
                'inputOptions' => ['class' => 'q'],
                'errorOptions'=>['class' => 'tishi']
            ]
        ]
    ); ?>
    <?php
    $model->apply_mee_text = Yii::$app->user->identity->username;
    $model->apply_mee_id = Yii::$app->user->identity->id;
    $data = DeptContact::getDeptOne(Yii::$app->user->identity->department);
    $model->apply_department = $data['dept_name'];
    $xzk = Gongchu::getDeptLeader(Yii::$app->user->identity->department);
    $model->apply_pack_id = $xzk[0];
    $model->apply_pack_text = $xzk[1];
    $jcz = Gongchu::getBranchLeader(Yii::$app->user->identity->department);
    $model->apply_genneral_id = $jcz[0];
    $model->apply_genneral_text = $jcz[1];
    ?>
    <div class="default-form baoxiao-form">
        <strong>【办公用品采购申请】</strong>
        <span>申请人</span>
        <div class="r">
            <?= $form->field($model, 'apply_mee_text')->textInput([' readonly'=>'']) ?>
        </div>
        <br class="clr">

        <span>科室</span>
        <div class="r">
            <?= $form->field($model, 'apply_department',['enableClientValidation'=>false])->textInput([' readonly'=>'']) ?>
        </div>
        <br class="clr">

        <span><em>*</em>办公用品名称</span>
        <div class="r">
            <?= $form->field($model, 'apply_office_name')->textInput() ?>
        </div>
        <br class="clr">

        <span><em>*</em>数量</span>
        <div class="r">
            <?= $form->field($model, 'apply_num')->textInput() ?>
        </div>
        <br class="clr">

        <span><em>*</em>预计单价/元</span>
        <div class="r">
            <?= $form->field($model, 'apply_price')->textInput() ?>
        </div>
        <br class="clr">

        <span><em>*</em>预计金额/元</span>
        <div class="r">
            <?= $form->field($model, 'apply_money')->textInput() ?>
        </div>
        <br class="clr">

        <span>备注</span>
        <div class="r">
            <?= $form->field($model, 'apply_remarks')->textInput() ?>
        </div>
        <br class="clr">

        <span><em>*</em>行装科意见</span>
        <div class="r">
            <?= $form->field($model, 'apply_pack_text')->textInput() ?>
        </div>
        <br class="clr">

        <span>检察长意见</span>
        <div class="r">
            <?= $form->field($model, 'apply_genneral_text')->textInput() ?>
        </div>
        <br class="clr">

        <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>
        <?= Html::input('submit','','提交', ['class' => 'btn','onclick'=>'return confirm("是否提交？");']) ?>

    </div>
    <div style="width: 0px;height: 0px;display: none">
        <?= $form->field($model, 'apply_mee_id')->hiddenInput() ?>
        <?= $form->field($model, 'apply_pack_id')->hiddenInput() ?>
        <?= $form->field($model, 'apply_genneral_id')->hiddenInput() ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
    $(function(){
        $('#officeapply-apply_num,#officeapply-apply_price').on('change',function(){
            var num =  parseFloat($('#officeapply-apply_num').val() == '' ? 0 : $('#officeapply-apply_num').val());
            var price =  parseFloat($('#officeapply-apply_price').val() == '' ? 0 : $('#officeapply-apply_price').val());
            var total = (price * num);
            $("#officeapply-apply_money").val(total);
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
        $('.boxer').on('click','#officeapply-apply_pack_text', function () {
            $('#officeapply-apply_pack_text').val('');
            $('#officeapply-apply_pack_id').val('');
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
                            $('#officeapply-apply_pack_id').val(xzk);
                            $('#officeapply-apply_pack_text').val($(':radio[name="xzk"]:checked ').attr('attr_name'));
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



        $('.boxer').on('click','#officeapply-apply_genneral_text', function () {
            $('#officeapply-apply_genneral_id').val('');
            $('#officeapply-apply_genneral_text').val('');
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
                            $('#officeapply-apply_genneral_id').val(xzk);
                            $('#officeapply-apply_genneral_text').val($(':radio[name="jcz"]:checked ').attr('attr_name'));
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
    });

</script>
