<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\modules\deptcontact\models\DeptContact;
use \yii\helpers\ArrayHelper;
?>
<div class="default-search">
    <?php $form = ActiveForm::begin([
        'action' => [$type==1?'index':'record'],
        'method' => 'get',
        'options' => ['class' => ''],
        'fieldConfig' => [
            'template' => "{span}{input}{error}",
            'inputOptions' => ['class' => 'q'],
        ]
    ]); ?>

    <?php
    if($type == 2){
    ?>
    <span>报销单位	</span>
        <?= $form->field($model, 'department')->dropDownList(ArrayHelper::map(DeptContact::getDept(),'id','dept_name'),['prompt'=>'--选择机构--','style'=>'width:150px;'])->span('') ?>
    <span>报销人	</span>
    <?= $form->field($model, 'bxr_text')->textInput()->span('') ?>
    <?php } ?>
    <span>申请时间	</span>
    <?= $form->field($model, 'time_s')->textInput(array('readonly'=>'true','class' =>'q date'))->span('') ?>
    <script type="text/javascript">
        cal_s = Calendar.setup({
            weekNumbers: true,
            inputField : "travelsearch-time_s",
            trigger    : "travelsearch-time_s",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <span>至</span>
    <?= $form->field($model, 'time_e')->textInput(array('readonly'=>'true','class' =>'q date'))->span('') ?>
    <script type="text/javascript">
        cal_e = Calendar.setup({
            weekNumbers: true,
            inputField : "travelsearch-time_e",
            trigger    : "travelsearch-time_e",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?php
    if($type == 1){
    ?>
        <?= $form->field($model, 'zmr_rs')->dropDownList(['0'=>'审批中','1'=>'同意','2'=>'驳回'],['prompt'=>'--选择状态--','style'=>'width:150px;'])->span('') ?>
    <?php } ?>

    <?php if(Yii::$app->controller->action->id == 'index'){ ?>
    <?= Html::a('报销申请',Yii::$app->urlManager->createUrl(['travel/travel/create']), ['class' => 'btn']) ?>
    <?php } ?>
    <?= Html::input('reset','','重置', ['class' => 'btn']) ?>
    <?= Html::input('submit','','查询', ['class' => 'btn','id'=>'search']) ?>
    <div class="clr"></div>
    <?php ActiveForm::end(); ?>
</div>

<!--给查询时间做出判断-->
<script>
    $(function(){
        $("#search").click(function(){
            var release = $("#travelsearch-time_s").val();
            var modify = $("#travelsearch-time_e").val();
            if(release>modify){
                if(modify!=''){
                    alert('时间格式错误');
                    $("#travelsearch-time_e").val("");
                    return false;
                }
            }
        });
    })
</script>