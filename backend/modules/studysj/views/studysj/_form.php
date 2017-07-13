<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\studytk\models\Studytk;

/* @var $this yii\web\View */
/* @var $model backend\modules\studysj\models\Studysj */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .cxx{
        height: 30px;
        width: 760px;
        background: #8fb8f6;
        color: #fff;
    }
    .study-sj-add li span {
        float: left;
        font-size: 14px;
        margin: 0 20px 0 10px;
        line-height: 26px;
    }
    .study-sj-add{
        border: 1px solid #e6e6e6;
        width: 760px;
        height: 418px;
    }
    .bbtn{
        width:60px;border:1px solid #eee;background:#2d4887;color:#fff!important;
        text-align: center;
        height: 25px;
        line-height: 25px;
        margin-top: 50px;

    }
    #button{
        width:60px!important;border:1px solid #eee;background:#2d4887;color:#fff!important;
        text-align: center;
        height: 25px;
        text-align: center;
        line-height: 25px;
        margin-left: 30px;
        margin-top: 50px;
        border: none;
    }
    .btn{

    }

</style>
<div class="boxer">
    <div class="study-sj-add">
    <?php $form = ActiveForm::begin(
        [
            'action' => ['create'],
            'method' => 'post',
            'options' => ['class' => ''],
            'fieldConfig' => [
                'template' => "{input}{error}",
                'inputOptions' => ['class' => 'q'],
            ]
        ]
    ); ?>
        <div>
            <ul>
                <li class="cxx" style="margin-top: 0px">【创建试卷】</li>
                <li>
                    <span><i>*</i>试卷名称</span>
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class'=>'q','style'=>'width:500px']) ?>
                </li>
                <li>
                    <span><i>*</i>考试机构</span>
                    <?= $form->field($model, 'mechanism')->textInput(['class'=>'q','style'=>'width:500px','readonly'=>'true']) ?>
                </li>
                <li>
                    <span><i>*</i>合格标准</span>
                    <?= $form->field($model, 'standard')->dropDownList(['10%'=>'10%','20%'=>'20%','30%'=>'30%','40%'=>'40%','50%'=>'50%','60%'=>'60%','70%'=>'70%','80%'=>'80%','90%'=>'90%','100%'=>'100%'],['placeholder'=>'','id'=>'']) ?>正确率
                </li>
                <li>
                    <span><i>*</i>考试时间</span>
                    <?= $form->field($model, 'start_time')->textInput(['class'=>'q date','style'=>'background-position:115px 0px;width:120px','readonly'=>'true']) ?>
                    <script type="text/javascript">
                        Calendar.setup({
                            weekNumbers: true,
                            inputField : "studysj-start_time",
                            trigger    : "studysj-start_time",
                            dateFormat: "%Y-%m-%d ",
                            showTime: true,
                            minuteStep: 1,
                            onSelect   : function() {this.hide();}
                        });
                    </script>
                    <span>至</span>
                    <?= $form->field($model, 'end_time')->textInput(['class'=>'q date','id'=>'end_time','style'=>'width:120px;background-position:115px 0px','readonly'=>'true']) ?>
                    <script type="text/javascript">
                        Calendar.setup({
                            weekNumbers: true,
                            inputField : "end_time",
                            trigger    : "end_time",
                            dateFormat: "%Y-%m-%d",
                            showTime: true,
                            minuteStep: 1,
                            onSelect   : function() {this.hide();}
                        });
                    </script>
                </li>
                <li><span><i>*</i>考试时常</span>
                    <?= $form->field($model, 'offen')->textInput(['maxlength' =>false,'class'=>'q']) ?>分钟
                </li>
                <li>
                    <span><i>*</i>考试题数</span>
                    <?= $form->field($model, 'questions')->textInput(['class'=>'q']) ?>道（题库题目总数为<?=Studytk::find()->count();?>道）
                </li>



            </ul>
            <div class="btn">
                <?=Html::a('返回',['index'],['class'=>'bbtn','style'=>'float: left;margin-left: 15%;margin-left:300px'])?>
                <?= Html::submitButton($model->isNewRecord ? '提交' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id' => 'button']) ?>
            </div>
        </div>

    </div>
    <?php ActiveForm::end(); ?>

</div>
<script>
    $(function(){
        $(":submit").click(function(){
           var start_time = $("#studysj-start_time").val();
            var start=new Date(start_time.replace("-", "/").replace("-", "/"));
            var endTime=$("#end_time").val();
            var end=new Date(endTime.replace("-", "/").replace("-", "/"));
            if(end<start){
                alert("结束时间必须大于开始时间");
                return false
            };
        })
    })
</script>
<script>
    $(function(){
        $(':submit').click(function(){
            var timeday = $("#studysj-offen").val();
            if(!isNaN(timeday) && timeday<0){
                alert('考试时常必须是正整数!');
                return false;
            }
        })

    })
</script>
<script>
    $(function(){
        $(':submit').click(function(){
            var timedays = $("#studysj-questions").val();
            if(!isNaN(timedays) && timedays<0){
                alert('考试题数必须是正整数!');
                return false;
            }
        })

    })
</script>
<script>
    $(function(){
        $(":submit").click(function(){
            var ques = $("input[name='Studysj[questions]']").val();
            var aaa = <?= Studytk::find()->count();?>;
            if(ques>aaa){
                alert("考试题数不能大于"+aaa+'道');
                 return false;
            }

        })
    })
</script>
<script>
    $(function(){
        $(":submit").click(function(){

        })
    })
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
function box(){
    $(function(){
        $(":checkbox[name='box']").bind('click',function(){
            $(':checkbox[name="p_spr[]"]').prop("checked",this.checked);
        });
    });
}
    window.console = window.console || {log:function () {}}
    var fzr = '<div>';
    var fgld = '<div>';
    fzr = '<input type="checkbox" name="box" id="box" value="全院" onclick="box();">全院'+'</br>';
    <?php
    $getJigouUser = \backend\modules\personwork\models\PersonWork::getDept();
    foreach($getJigouUser as $k=>$v){?>
    fzr += '<label for="ren"><input type="checkbox" id="ren" name="p_spr[]" value="<?= $v; ?>" attr_name="" /><?= $v; ?></label>';
    fgld += '<label for="ren"><input type="checkbox" id="ren" name="p_spr[]" value="<?= $v; ?>" attr_name="" /><?= $v; ?></label>';
<?php } ?>

    fzr += '</div>';
    fgld += '</div>';
    seajs.use(['jquery'], function ($) {
        $('.boxer').on('click','#studysj-mechanism', function () {
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
//                            var fzr = $(':checkbox[name="p_spr"]:checked ').val();
                            var strSel = '';
                            $("[name='p_spr[]']:checked").each(function(index, element) {
                                strSel += $(this).val() + ",";
                            });
                            if (fzr == undefined) {
                                alert('请选择负责人1');
                                return false;
                            }
                            $(':input[name="Studysj[mechanism]"]').val($(':checkbox[name="p_spr"]:checked ').attr('attr_name'));
                            $('#studysj-mechanism').val(strSel)
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
        });
</script>

<!--确认放弃数据-->
<script type="text/javascript">
    $(function(){
        $(".bbtn").click(function(){
            if(window.confirm('是否返回表单？')){
                return true;
            }else{
                return false;
            }
        })
    })
</script>

