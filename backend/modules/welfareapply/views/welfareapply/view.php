<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\modules\gongchu\models\Gongchu;
use \backend\modules\personwork\models\PersonWork;
use \backend\modules\user\models\User;
$data = Gongchu::getLeader(Yii::$app->user->identity->department);
$first =  current($data);
$aciton = Yii::$app->controller->action->id;
?>
<?=Html::cssFile('@web/css/ydbg/inside.css')?>
<div class="boxer" >
    <div class="default-form baoxiao-form">
        <strong>【福利详情】</strong>
        <span>福利名称</span>
        <div>
            <input type="text" value="<?= $model_welfare->welfare_name ?>" class="q view" readonly="">
        </div>
        <br class="clr">

        <span>福利类型</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model_welfare->welfare_type ?>" readonly="" />
        </div>
        <br class="clr">

        <span>申请开始时间</span>
        <div class="r">
            <input type="text" class="q date time view"  value="<?= $model_welfare->welfare_start_time ?>" readonly="" />
        </div>
        <br class="clr">

        <span>申请结束时间</span>
        <div class="r">
            <input type="text" class="q date time view"  value="<?= $model_welfare->welfare_end_time ?>" readonly="" />
        </div>
        <br class="clr">

        <span>适用机构</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model_welfare->welfare_part_name ?>" readonly="" />
        </div>
        <br class="clr">

        <span>福利明细</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model_welfare->welfare_detail ?>" readonly="" />
        </div>
        <span><em>*</em>审批人</span>
        <div class="r">
            <?php
            $welfare_sp_id = User::getNames($model->welfare_sp_id);
            $status = '('.$model->welfare_apply_pack_status.')' ;
            if($model->welfare_apply_pack_status == '驳回'){
                $status .= '&nbsp;&nbsp;&nbsp;&nbsp;'.$model->welfare_apply_pack_cancel_detail.'&nbsp;&nbsp;&nbsp;&nbsp;'.$model->welfare_apply_pack_time;
            }elseif($model->welfare_apply_pack_status == '同意'){
                $status .= '&nbsp;&nbsp;&nbsp;&nbsp;'.$model->welfare_apply_pack_time;
            }
            ?>


            <input type="text" class="q view" name="welfare_sp_text" id="welfare_sp_text" value="<?= $welfare_sp_id[0]['name'] ?><?= $status ?>"/>
        </div>
        <br class="clr">
        <br class="clr">
        <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>
        <?php if($aciton == 'sp'){ ?>
            <?= Html::a('驳回','javascript:;', ['class' => 'btn btn_bh']) ?>
            <?= Html::a('同意',Yii::$app->urlManager->createUrl(['welfareapply/welfareapply/spty','id'=>$model->welfare_apply_id]), ['class' => 'btn','onclick'=>'return confirm("是否同意该审批？");']) ?>
        <?php } ?>
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
        $('.boxer').on('click', 'a.btn_bh', function () {
            d = top.dialog({
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
                            $.get("<?= Yii::$app->urlManager->createUrl(['welfareapply/welfareapply/spbh','id'=>$model->welfare_apply_id]); ?>", {cancel_details: cancel_details}, function (data) {
                                if (typeof data != "object") {
                                    var obj = eval('(' + data + ')');
                                }
                                if (obj.status == 'success') {
                                    alert(obj.msg);
                                    window.location.href = '<?= Yii::$app->urlManager->createUrl(['welfareapply/welfareapply/record']); ?>';
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
            d.showModal();
            return false;
        });
    });

</script>