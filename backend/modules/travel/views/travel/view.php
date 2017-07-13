<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use \backend\modules\deptcontact\models\DeptContact;
?>
<div class="boxer" id="boxer-zh">
    <div class="tk-add">
        <ul>
            <li class="th">【差旅费审批详情】</li>
            <?php
            $data = DeptContact::getDeptOne($model->department);
            ?>
            <li><span>报销单位</span><div class="r"><input type="text" value="<?= $data['dept_name'] ?>" class="q view" readonly=""></div><br class="clr">
            </li>
            <li><span><i>*</i>报销申请时间</span><div class="r">
                    <input type="text" class="q date time view" id="start_time" value="<?= $model->time ?>" readonly="" />
                </div>
                <br class="clr">
            </li>
            <li><span><i>*</i>开始时间</span>
                <div class="r">
                    <input type="text" class="q date view" id="start_times"  value="<?= $model->s_time ?>" readonly=""/>
                </div>
                <br class="clr">
            </li>
            <li><span><i>*</i>结束时间</span>
                <div class="r">
                    <input type="text" class="q date view" id="end_times"  value="<?= $model->e_time ?>" readonly=""/>
                </div>
                <br class="clr">
            </li>
            <li><span><i>*</i>地点</span><div class="r"><input type="text" value="<?= $model->dd ?>" class="q view"readonly=""></div><br class="clr">
            </li>
            <li><span><i>*</i>事由</span><div class="r"><input type="text" value="<?= $model->sy ?>" class="q view" readonly=""></div><br class="clr">
            </li>
            <li class="li-feiyong"><span>车船费</span>
                <div class="r">
                    <div class="zs">
                        <span>张数</span>
                        <span>金额/元</span>
                    </div>
                    <div class="price">
                        <input type="text" value="<?= $model->ccf_zs ?>" class="q view" readonly="">
                        <input type="text" value="<?= $model->ccf_je ?>" class="q view" readonly="">
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
                        <input type="text" value="<?= $model->zsf_zs ?>" class="q view" readonly="">
                        <input type="text" value="<?= $model->zsf_je ?>" class="q view" readonly="">
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
                        <input type="text" value="<?= $model->hsbt_zs ?>" class="q view" readonly="">
                        <input type="text" value="<?= $model->hsbt_je ?>" class="q view" readonly="">
                    </div>
                </div><br class="clr">
            </li>
            <li><span>公杂费 / 元</span><div class="r"><input type="text" value="<?= $model->gzf ?>" class="q view" readonly=""></div><br class="clr">
            </li>

            <li><span>合计 / 元</span><div class="r"><input type="text" value="<?= $model->gj ?>" class="q view" readonly=""></div><br class="clr">
            </li>
            <li><span><em>*</em>报销人</span><div class="r"><input type="text" value="<?= $model->bxr_text ?>" class="q view" readonly=""></div><br class="clr">
            </li>

            <li><span><em>*</em>证明人</span>
                <div class="r">
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
            </li>

            <li><span><em>*</em>管理会计</span>
                <div class="r">
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
            </li>

            <li><span><em>*</em>领导审批</span>
                <div class="r">
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
            </li>
        </ul>
        <div class="btn">
            <?= Html::input('button','','返回', ['class' => 'anniu','onclick'=>'javascript:history.go(-1);']) ?>

            <?php if(Yii::$app->controller->action->id == 'shenpi'){ ?>
                <?= Html::a('驳回','javascript:;', ['class' => 'anniu btn_bh']) ?>
                <?= Html::a('同意',Yii::$app->urlManager->createUrl(['travel/travel/spty','id'=>$model->id]), ['class' => 'anniu','onclick'=>'return confirm("是否同意该审批？");']) ?>
            <?php } ?>
        </div>
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
                            $.get("<?= Yii::$app->urlManager->createUrl(['travel/travel/spbh','id'=>$model->id]); ?>", {cancel_details: cancel_details}, function (data) {
                                if (typeof data != "object") {
                                    var obj = eval('(' + data + ')');
                                }
                                if (obj.status == 'success') {
                                    alert(obj.msg);
                                    window.location.href = '<?= Yii::$app->urlManager->createUrl(['travel/travel/record']); ?>';
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