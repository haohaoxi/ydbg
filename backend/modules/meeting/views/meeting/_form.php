<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\meeting\models\Meeting */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    .btn1{
        margin-left: 200px;
    }
    .btn1 input{
        display: inline;
        width: 60px;
        height: 28px;
        border: 0px;
        background: #6d9be2;
        text-align: center;
        line-height: 30px;
        color: #fff;
        font-size: 14px;
        margin: 0px 5px;
        overflow: hidden;
        cursor: pointer;
        margin-top: 10px;

    }
    #meeting-hosts,#meeting-join_ren{
        cursor: pointer;
    }
    .title_ren{
        cursor: default;
        font-weight: bold;
        line-height: 1.42857;
        margin: 0;
        min-height: 16.4286px;
        overflow: hidden;
        padding: 15px;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .gongchu-ren{
        SCROLLBAR-FACE-COLOR: #ddd;
        SCROLLBAR-HIGHLIGHT-COLOR: #fff;
        SCROLLBAR-SHADOW-COLOR: #ffffff;
        SCROLLBAR-3DLIGHT-COLOR: #ffffff;
        SCROLLBAR-ARROW-COLOR: #ff9966;
        SCROLLBAR-DARKSHADOW-COLOR: #ffffff;
    }
</style>
<div class="boxer" id="boxer-zh" style="position: relative; zoom: 1;">
    <div class="default-form">
        <?php $form = ActiveForm::begin([
            'options' => ['class' => '','enctype' => 'multipart/form-data'],
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'fieldConfig' => [
                'template' => "{input}{error}",
                'inputOptions' => ['class' => 'q'],
                'errorOptions'=>['class' => 'tishi'],
            ]
        ]); ?>
        <strong>【发起会议】</strong>
        <span><em>*</em>会议主题</span>
    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
        <span><em>*</em>会议开始时间</span>
    <?= $form->field($model, 'start_time')->textInput(['readonly'=>'true','class'=>'q date']) ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "meeting-start_time",
            trigger    : "meeting-start_time",
            dateFormat: "%Y-%m-%d %H:%M",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();judgeTime();}
        });
    </script>
        <span><em>*</em>会议结束时间</span>
    <?= $form->field($model, 'end_time')->textInput(['readonly'=>'true','class'=>'q date']) ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "meeting-end_time",
            trigger    : "meeting-end_time",
            dateFormat: "%Y-%m-%d %H:%M",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();judgeTime();}
        });
    </script>
        <span><em>*</em>会议地点</span>
    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>
        <span><em>*</em>会议主持</span>
    <?= $form->field($model, 'hosts')->textInput(['maxlength' => true,'onclick'=>'showDiv("hosts","move_host")','name'=>'join_hosts']) ?>
        <span><em>*</em>参加人员</span>
        <?= $form->field($model, 'join_ren')->textInput(['maxlength' => true,'onclick'=>'showDiv("joinren","move_ren")','name'=>'join_rens']) ?>
        <span class="tall">会议议程</span>
    <?= $form->field($model, 'agenda',['options'=>['class'=>'tall']])->textarea(['rows' => 3]) ?>
        <span class="tall">会务安排</span>
    <?= $form->field($model, 'arrangement',['options'=>['class'=>'tall']])->textarea(['rows' => 3]) ?>
        <span>附件</span>
    <?= $form->field($model, 'attachment')->fileInput(['onchange'=>'onUploadFileChange(this);','contentEditable'=>'false']) ?>

        <?=Html::a(Yii::t('app', '返回'), Yii::$app->urlManager->createUrl(['meeting/meeting/index']),['class' =>'btn yuqi-return','id'=>'back']);?>
        <?= Html::input('submit','','发送', ['class' => 'btn']) ?>
        <br class="clr">
<div style="display: none">
    <?= $form->field($model, 'join_ren')->hiddenInput(['maxlength' => true,'id'=>'hidden_joinren'])->span('') ?>
    <?= $form->field($model, 'hosts')->hiddenInput(['maxlength' => true,'id'=>'hidden_hosts'])->span('') ?>
</div>
    <?php ActiveForm::end(); ?>
</div>
</div>
<div id="hosts" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_host"><!--移动弹出层-->
        <div class="gongchu-ren">
            <div class="title_ren">会议主持：<span id="checkedHost"></span></div>
            <?php $i=0; ?>
            <?php foreach($deptUsers as $deptk=>$deptv): ?>
                <?php $i++ ?>
                <div class="gongchu-ren-ks"><a href="javascript:;" data="ks<?=$i;?>"><?=$deptk ?></a></div>
                <div class="gongchu-ren-list" id="ks<?=$i;?>_con">
                    <?php foreach($deptv as $k=>$v):?>
                        <label for="ren1" style="width: 80px"><input type="checkbox" value="<?=$k ?>" name="ren" onclick="addHost(this,this.nextSibling.nodeValue);"><?=$v ?></label>
                    <?php endforeach ?>
                    <div class="clr"></div>
                </div>
            <?php endforeach ?>
            <div class="btn1" >
                <input type="button" value="确定" onclick="select_person('hosts')"/>
                <input type="button" value="关闭" onclick="closeDiv('hosts');" />
            </div>
        </div>
    </div>
</div>
<div id="joinren" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_ren"><!--移动弹出层-->
        <div class="gongchu-ren">
            <div class="title_ren">参加人员：<span id="checkedJoin"></span></div>
            <?php $i=100; ?>
            <?php foreach($deptUsers as $deptk=>$deptv): ?>
                <?php $i++ ?>
                <div class="gongchu-ren-ks"><a href="javascript:;" data="ks<?=$i;?>"><?=$deptk ?></a></div>
                <div class="gongchu-ren-list" id="ks<?=$i;?>_con">
                    <?php foreach($deptv as $k=>$v):?>
                        <label for="ren1" style="width: 80px"><input type="checkbox" value="<?=$k ?>" name="ren1" onclick="addJoin(this,this.nextSibling.nodeValue);"><?=$v ?></label>
                    <?php endforeach ?>
                    <div class="clr"></div>
                </div>
            <?php endforeach ?>
            <div class="btn1" >
                <input type="button" value="确定" onclick="select_person('joinren')"/>
                <input type="button" value="关闭" onclick="closeDiv('joinren');" />
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/popDiv.js"></script>
<script type="text/javascript">
    function judgeTime(){
        var qjtime=$("#meeting-start_time").val();
        var endtime=$("#meeting-end_time").val();
        qjtime1 = qjtime.replace(/\-/gi,"/");
        endtime1 = endtime.replace(/\-/gi,"/");
        var time1 = new Date(qjtime1).getTime();
        var time2 = new Date(endtime1).getTime();
        if(time1>time2){
            alert('开始时间不能大于结束时间');
            $("#meeting-end_time").val('');
            return false;
        }
    }
</script>
<script type="text/javascript">
    //判断附件大小 附件不超过10M
    function onUploadFileChange(fileInput){
        var filePath = fileInput.value;
        var filesize=0;
        if (fileInput.files && fileInput.files[0]) {
            filesize=fileInput.files[0].size
        } else {
            var image=new Image();
            image.dynsrc=filePath;
            filesize=image.fileSize;
        }
        if(filesize>10*1024*1024){
            alert('请上传10M内附件');
            if (fileInput.outerHTML) {
                fileInput.outerHTML = fileInput.outerHTML;
            } else { // FF(包括3.5)
                fileInput.value = "";
            }
        }
    }
</script>
<script type="text/javascript">
    var str='';
    var host=document.getElementById("checkedHost");
    function addHost(obj,val){
        if(obj.checked==true){
            str+=val+',';
        }else{
            str=host.innerText.replace(val+',','');
        }
        host.innerText =str;
    }
    var str1='';
    var join=document.getElementById("checkedJoin");
    function addJoin(obj,val){
        if(obj.checked==true){
            str1+=val+',';
        }else{
            str1=join.innerText.replace(val+',','');
        }
        join.innerText =str1;
    }

    function select_person(type){
        //type确定是当前页那个弹出层，
        if(type=='hosts'){
            var radiObj = document.getElementsByName("ren");
            var id='';
            var name='';
            for(var i=0;i<radiObj.length;i++)
            {
                if(radiObj[i].checked) {
                    id += radiObj[i].value+',';
                    name += radiObj[i].nextSibling.nodeValue+',';
                }
            }
            if(id==undefined||id==''){
                alert('请选择会议主持');return false;
            }
            //赋值给父页面某元素
            document.getElementById("meeting-hosts").value=name;
            document.getElementById("hidden_hosts").value=id;
        }
        if(type=='joinren'){
            var leader_id='';
            var leader_name='';
            var radiObj = document.getElementsByName("ren1");
            for(var i=0;i<radiObj.length;i++)
            {
                if(radiObj[i].checked) {
                    leader_id += radiObj[i].value+',';
                    leader_name +=radiObj[i].nextSibling.nodeValue+',';
                }
            }
            if(leader_id==undefined||leader_id==''){
                alert('请选择参加人员');return false;
            }
            document.getElementById("meeting-join_ren").value=leader_name;
            document.getElementById("hidden_joinren").value=leader_id;
        }

        closeDiv(type);//关闭当前div
    }

</script>
<script type="text/javascript">
    jQuery(function($){
        $(".gongchu-ren-ks").on("click","a",function(){
            if ($(this).attr("class")) {
                $(this).removeClass();
            } else {
                $(this).addClass("hide");
            }
            if ($("#" + $(this).attr("data") + "_con").is(":hidden")) {
                $("#" + $(this).attr("data") + "_con").show();
            } else {
                $("#" + $(this).attr("data") + "_con").hide();
            }
        });
    });
</script>
<!--确认放弃数据-->
<script type="text/javascript">
    $(function(){
        $("#back").click(function(){
            if(window.confirm('是否放弃所填表单？')){
                return true;
            }else{
                return false;
            }
        })
    })
</script>
