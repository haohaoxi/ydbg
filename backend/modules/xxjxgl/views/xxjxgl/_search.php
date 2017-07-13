<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\functions\api;
?>
    <div class="default-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => ''],
        'fieldConfig' => [
            'template' => "{span}{input}{error}",
            'inputOptions' => ['class' => 'q'],
        ]
    ]); ?>
<!--        <span>案件案例</span><input type="text" class="q" />-->
<!--        <span>发布日期	</span>-->
    <?= $form->field($model, 'title')->textInput()->span('案件案例') ?>
    <?= $form->field($model, 'adate')->textInput(array('readonly'=>'true','class' =>'q date'))->span('发布时间') ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "xxjxglsearch-adate",
            trigger    : "xxjxglsearch-adate",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
    <?= $form->field($model, 'sdate')->textInput(array('readonly'=>'true','class' =>'q date'))->span('-')?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "xxjxglsearch-sdate",
            trigger    : "xxjxglsearch-sdate",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
    </script>
        <a href="/index.php?r=xxjxgl%2Fxxjxgl%2Fcreate" class="btn">新增案件案例</a>
        <input type="button" value="重置" class="btn" />
        <input type="submit" value="查询" class="btn" />
        <div class="clr"></div>
    <?php ActiveForm::end(); ?>

        <div class="clr"></div>
</div>
<script>
    $(":button").click(function(){
        $("#xxjxglsearch-adate").attr("value","");
        $("#xxjxglsearch-sdate").attr("value","");
        $("#xxjxglsearch-title").attr("value","");
    })
</script>
<script>
    $(function(){
        $(":submit").click(function(){
            var search_adate = $("#xxjxglsearch-adate").val();
            var start=new Date(search_adate.replace("-", "/").replace("-", "/"));
            var search_sdate=$("#xxjxglsearch-sdate").val();
            var end=new Date(search_sdate.replace("-", "/").replace("-", "/"));
            if(end<start){
                alert("结束时间必须大于开始时间");
                return false
            };
        })
    })
</script>

