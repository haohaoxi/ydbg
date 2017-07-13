<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use \backend\modules\deptcontact\models\DeptContact;
?>
<?=Html::cssFile('@web/css/ydbg/inside.css')?>
<div class="boxer" style="width: 1673px; height: 325px;">
    <div class="default-form baoxiao-form">
           <strong>【维修费报销详情】</strong>  
            <?php
            $data = DeptContact::getDeptOne($model->department);
            ?>
            <span>报销单位</span>
            <div>
                <input type="text" value="<?= $data['dept_name'] ?>" class="q view" readonly="">
            </div>
            <br class="clr">
            
            <span>报销申请时间</span>
            <div class="r">
                    <input type="text" class="q date time view"  value="<?= $model->time ?>" readonly="" />
            </div>
            <br class="clr">

            <span>维修申请时间</span>
            <div class="r">
                <input type="text" class="q date time view"  value="<?= $model->wx_time ?>" readonly="" />
            </div>
            <br class="clr">

            <span>车牌号</span>
            <div class="r">
                <input type="text" class="q date time view"  value="<?= $model->cph ?>" readonly="" />
            </div>
            <br class="clr">

            <span>维修内容及配件项目</span>
            <div class="r">
                <input type="text" class="q date time view"  value="<?= $model->wxnr ?>" readonly="" />
            </div>
            <br class="clr">

            <span>金额/元</span>
            <div class="r">
                <input type="text" class="q date time view"  value="<?= $model->jine ?>" readonly="" />
            </div>
            <br class="clr">

            <span>备注</span>
            <div class="r">
                <input type="text" class="q date time view"  value="<?= $model->remark ?>" readonly="" />
            </div>
            <br class="clr">

            <span><em>*</em>证明人</span>
                <div>
                    <?php
                    $str = $model->zmr_text;
                    if($model->zmr_rs == 0){
                        $str .=  '（审批中）';
                    }elseif($model->zmr_rs==1){
                        $str .=  '（同意）';
                    }elseif($model->zmr_rs == 2){
                        $str .=  '（驳回）原因:('.$model->zmr_detail.')';
                    }
                    $str .= $model->zmr_time;
                    ?>
                    <input type="text" value="<?= $str; ?>" class="q  do view" readonly="">
                </div>
                <br class="clr">
            

            <span><em>*</em>管理会计</span>
                <div>
                    <?php
                    $str = $model->glkj_text;
                    if($model->glkj_rs == 0){
                        $str .=  '（审批中）';
                    }elseif($model->glkj_rs==1){
                        $str .=  '（同意）';
                    }elseif($model->glkj_rs == 2){
                        $str .=  '（驳回）原因:('.$model->glkj_detail.')';
                    }
                    $str .= $model->glkj_time;
                    ?>
                    <input type="text" value="<?= $str; ?>" class="q  do view" readonly="">
                </div>
                <br class="clr">
            

            <span><em>*</em>领导审批</span>
                <div>
                    <?php
                    $str = $model->ldsp_text;
                    if($model->ldsp_rs == 0){
                        $str .=  '（审批中）';
                    }elseif($model->ldsp_rs==1){
                        $str .=  '（同意）';
                    }elseif($model->ldsp_rs == 2){
                        $str .=  '（驳回）原因:('.$model->ldsp_detail.')&nbsp;&nbsp;&nbsp;&nbsp; ';
                    }
                    $str .= $model->ldsp_time;
                    ?>
                    <input type="text" value="<?= $str; ?>" class="q  do view" readonly="">
                </div>
                <br class="clr">
            
            <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>

            <?php if(Yii::$app->controller->action->id == 'shenpi'){ ?>
                <?= Html::a('驳回','javascript:;', ['class' => 'btn btn_bh']) ?>
                <?= Html::a('同意',Yii::$app->urlManager->createUrl(['carwx/carwx/spty','id'=>$model->id]), ['class' => 'btn','onclick'=>'return confirm("是否同意该审批？");']) ?>
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
                            $.get("<?= Yii::$app->urlManager->createUrl(['carwx/carwx/spbh','id'=>$model->id]); ?>", {cancel_details: cancel_details}, function (data) {
                                if (typeof data != "object") {
                                    var obj = eval('(' + data + ')');
                                }
                                if (obj.status == 'success') {
                                    alert(obj.msg);
                                    window.location.href = '<?= Yii::$app->urlManager->createUrl(['carwx/carwx/record']); ?>';
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