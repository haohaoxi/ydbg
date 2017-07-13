<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use \backend\modules\deptcontact\models\DeptContact;
?>
<?=Html::cssFile('@web/css/ydbg/inside.css')?>
<div class="boxer">
    <div class="default-form baoxiao-form">
        <strong>【会议费报销详情】</strong>
        <span><em>*</em>会议名称</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->name ?>" readonly="" />
        </div>
        <br class="clr">

        <span><em>*</em>开会时间</span>
        <div class="r">
            <input type="text" class="q date time view"  value="<?= $model->kh_time ?>" readonly="" />
        </div>
        <br class="clr">

        <span>外地代表数/人</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->wddbs ?>" readonly="" />
        </div>
        <br class="clr">

        <span>本地代表数/人</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->bddbs ?>" readonly="" />
        </div>
        <br class="clr">

        <span>工作人员数/人</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->gzrys ?>" readonly="" />
        </div>
        <br class="clr">

        <span><em>*</em>参会人员数/人</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->chrys ?>" readonly="" />
        </div>
        <br class="clr">

        <span class="two"><em>*</em>会期（含报到和离开时间）/天</span>
        <div class="two">
            <input type="text" class="q view"  value="<?= $model->hq ?>" readonly="" />
        </div>
        <br class="clr">

        <span class="two"><em>*</em>按综合定额标准计算会议费开支控制数/元</span>
        <div class="two">
            <input type="text" class="q view"  value="<?= $model->hyzf ?>" readonly="" />
        </div>
        <br class="clr">

        <span>住宿费/元</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->zsf ?>" readonly="" />
        </div>
        <br class="clr">

        <span>伙食费/元</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->hsf ?>" readonly="" />
        </div>
        <br class="clr">

        <span>会议室租金/元</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->hyszj ?>" readonly="" />
        </div>
        <br class="clr">

        <span>交通费/元</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->jtf ?>" readonly="" />
        </div>
        <br class="clr">

        <span>文件印刷费/元</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->wjysf ?>" readonly="" />
        </div>
        <br class="clr">

        <span>其他支出/元</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->qtzc ?>" readonly="" />
        </div>
        <br class="clr">

        <span><em>*</em>实际开支/元</span>
        <div class="r">
            <input type="text" class="q view"  value="<?= $model->sjkz ?>" readonly="" />
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
            <?= Html::a('同意',Yii::$app->urlManager->createUrl(['meet/meet/spty','id'=>$model->id]), ['class' => 'btn','onclick'=>'return confirm("是否同意该审批？");']) ?>
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
                            $.get("<?= Yii::$app->urlManager->createUrl(['meet/meet/spbh','id'=>$model->id]); ?>", {cancel_details: cancel_details}, function (data) {
                                if (typeof data != "object") {
                                    var obj = eval('(' + data + ')');
                                }
                                if (obj.status == 'success') {
                                    alert(obj.msg);
                                    window.location.href = '<?= Yii::$app->urlManager->createUrl(['meet/meet/record']); ?>';
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