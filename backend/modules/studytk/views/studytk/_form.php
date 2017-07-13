<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\xxjxgl\models\Xxjxgl */
/* @var $form yii\widgets\ActiveForm */
$tions = json_decode($model->tions,1);

?>
<style>
    .btn-success{
        display: inline-block;
        background: #2d4887;
        color: #fff;
        border: 1px solid #2d4887;
        width: 60px;
        margin: 0 10px;
        height: 26px;
        line-height: 24px;
    }
    .btn-primary{
        display: inline-block;
        background: #2d4887;
        color: #fff;
        border: 1px solid #2d4887;
        width: 60px;
        margin: 0 10px;
        height: 26px;
        line-height: 24px;
        float: left;
    }
    .btn-success{
        float: left;
        cursor: pointer;
    }

</style>
<?php $form = ActiveForm::begin([
    'method'=>'post',
    'options'=>['enctype'=>'multipart/form-data'],
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'fieldConfig' => [
        'template' => "{input}{error}",
        'inputOptions' => ['class' => ''],
        'errorOptions'=>['class' => 'tishi'],
    ]
]); ?>
<div class="boxer">
    <div class="tk-add">
        <ul>
            <?php if($model->isNewRecord){?>
            <li class="th">【新增考题】</li>
            <?php }else{?>
                <li class="th">【修改考题】</li>
            <?php }?>
            <li><span>题型</span><div class="r">
                    <?= $form->field($model, 'type')->dropDownList(['1'=>'单选题'],['placeholder'=>'']) ?>
                </div>
                <br class="clr">
            </li>
            <li class="li-area">
                <span><i>*</i>题目</span>
                <div class="r">
                    <?= $form->field($model, 'name')->textarea(['maxlength' => true,'class'=>'area']) ?>
                </div>
                <br class="clr">
            </li>
            <li  class="li-radio"><span><i>*</i>选项</span>
                <div class="r">
                    <?php for($i=65;$i<69;$i++){?>
                    <label for="daan" style="float: left;margin-right: 5px">
                        <input type="radio" name="daan"  class="rad" value="<?= chr($i);?>"
                        <?= $model->daan == chr($i) ? 'checked="checked"': '1'; ?>"><?= chr($i);?>
                    </label>
                    <input style="float: left;width: 680px;height: 20px;" id="tions[<?= chr($i);?>]" type="text" name="tions[<?= chr($i);?>]"
                           value="<?= isset($tions[chr($i)]) ? $tions[chr($i)] :''; ?>">
                    <br class="clr"/>
                    <?php }?>

                </div>
                <br class="clr">
            </li>
            <li class="li-area">
                <span><i>*</i>解析</span>
                <div class="r">
                    <?= $form->field($model, 'jiexi')->textarea(['maxlength' => true,'class'=>'area']) ?>
                </div>
                <br class="clr">
            </li>
        </ul>
        <div class="btn">
            <?= Html::a('返回',['index'],['style'=>'float: left;margin-left: 35%','id'=>'back'])?>
            <?= Html::submitButton($model->isNewRecord ? '添加' : '提交',['class' => $model->isNewRecord ? 'btn-success' : 'btn-primary','id'=>'button']) ?>
            <br class="clr"/>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<script>
    $(function(){
        $("#button ").click(function(){

            var  chkObjs = document.getElementsByName("daan");
            var IValuec=document.getElementById("tions[C]").value;
            var IValued=document.getElementById("tions[D]").value;
            for(var i=0;i<chkObjs.length;i++){
                if(chkObjs[i].checked){
                    if(IValuec == "" && chkObjs[2].checked){
                        alert("当前选中的不能为空");
                        return false;
                    }else if(IValued == "" && chkObjs[3].checked){
                        alert("当前选中的不能为空");
                        return false;
                    }
                }
            }
            var InputValue=document.getElementById("tions[A]").value;
            var IValue=document.getElementById("tions[B]").value;

            //去除空格
            InputValue = InputValue.replace(/[ ]/g,"");
            IValue = IValue.replace(/[ ]/g,"");


            if(InputValue==""){
                alert("A选项不能为空");
                return false;
            }else if(IValue ==""){
                alert("B选项不能为空");
                return false;
            }

            if(InputValue.length>150 || IValue.length>150 ||  IValuec.length>150 || IValued.length>150){
                alert("问题字符不能超过150！");
                return false;
            }

        })
    })
</script>

<!--确认放弃数据-->
<script type="text/javascript">
    $(function(){
        $("#back").click(function(){
            if(window.confirm('是否返回表单？')){
                return true;
            }else{
                return false;
            }
        })
    })
</script>

