<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\gongchu\models\Gongchu;

/* @var $this yii\web\View */
/* @var $model backend\modules\gongchu\models\Gongchu */
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
    #gongchu-gc_ren,#gongchu-dept_leader,#gongchu-yuan_leader{
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
<script type="text/javascript" src="/js/popDiv.js"></script>
<div class="boxer" id="boxer-zh">
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
    <?php
    $dept=Yii::$app->user->identity->department;
    $username=Yii::$app->user->identity->name;
    $userId=Yii::$app->user->id;
    $deptName=Gongchu::getDeptNameById($dept);
    $deptLeader=Gongchu::getDeptLeader($dept);//根据部门号找到部门负责人
    $branchLeader=Gongchu::getBranchLeader($dept);//根据部门号找到院领导

    ?>
    <strong>【公出申请】</strong>
    <span><em>*</em>科（室、局）</span>
    <?= $form->field($model, 'dept')->textInput(['disabled'=>true,'value'=>$deptName,'name'=>'deptname']) ?><br class="clr" />
    <span><em>*</em>公出人</span>
    <?= $form->field($model, 'gc_ren')->textInput(['maxlength' => true,'onclick'=>'showDiv("gongchuren","move_ren")','name'=>'gongchurens']) ?><br class="clr" />
    <span><em>*</em>公出人数</span>
    <?= $form->field($model, 'gc_count')->textInput([]) ?><br class="clr" />
    <span><em>*</em>公出时间</span>
    <?= $form->field($model, 'gc_time')->textInput(['readonly'=>'true','class'=>'q date']) ?><br class="clr" />
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "gongchu-gc_time",
            trigger    : "gongchu-gc_time",
            dateFormat: "%Y-%m-%d %H:%M",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();judgeTime();}
        });
    </script>
    <span><em>*</em>结束时间</span>
    <?= $form->field($model, 'end_time')->textInput(['readonly'=>'true','class'=>'q date']) ?><br class="clr" />
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "gongchu-end_time",
            trigger    : "gongchu-end_time",
            dateFormat: "%Y-%m-%d %H:%M",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();judgeTime();}
        });
    </script>
    <span>公出地点</span>
    <?= $form->field($model, 'gc_place')->textInput(['maxlength' => true]) ?><br class="clr" />
    <span class="tall"><em>*</em>因公外出</span>
    <?= $form->field($model, 'ygwc',['options'=>['class'=>'tall']])->textarea(['rows' => 3]) ?><br class="clr" />
    <span><em>*</em>经办人</span>
    <?= $form->field($model, 'jb_ren')->textInput(['disabled'=>true,'value'=>$username]) ?><br class="clr" />

    <?php if($deptLeader[0]!=$userId&&$userId!=$branchLeader[0]){ ?>
        <span><em>*</em>科室领导</span>
    <?= $form->field($model, 'dept_leader')->textInput(['value'=>$deptLeader[1],'onclick'=>'showDiv("dept","move_dept")','name'=>'dept_leader']) ?><br class="clr" />
        <span><em>*</em>院领导</span>
    <?= $form->field($model, 'yuan_leader')->textInput(['value'=>$branchLeader[1],'onclick'=>'showDiv("yuan","move_yuan")','name'=>'yuan_leader']) ?><br class="clr" />

    <?php }elseif($deptLeader[0]==$userId&&$userId!=$branchLeader[0]){ ?>
        <span><em>*</em>院领导</span>
        <?= $form->field($model, 'yuan_leader')->textInput(['value'=>$branchLeader[1],'onclick'=>'showDiv("yuan","move_yuan")','name'=>'yuan_leader']) ?><br class="clr" />
    <?php }elseif($userId==$branchLeader[0]){ ?>
<!--        /**院领导一栏显示检察长姓名*/-->
        <span><em>*</em>院领导</span>
        <?= $form->field($model, 'jcz')->textInput(['onclick'=>'showDiv("jcz","move_jcz")','name'=>'jcz_leader']) ?><br class="clr" />
    <?php } ?>

        <?=Html::a(Yii::t('app', '返回'), Yii::$app->urlManager->createUrl(['gongchu/gongchu/index']),['class' =>'btn yuqi-return','id'=>'back']);?>
        <?= Html::input('submit','','存档', ['class' => 'btn']) ?>
    <br class="clr" />
    <div style="display: none">
        <?= $form->field($model, 'dept')->hiddenInput(['value'=>$dept])->span('') ?>
        <?= $form->field($model, 'gc_ren')->hiddenInput(['id'=>'hidden_gc_ren'])->span('') ?>
        <?= $form->field($model, 'jb_ren')->hiddenInput(['value'=>$userId])->span('') ?>
        <?= $form->field($model, 'dept_leader')->hiddenInput(['value'=>$deptLeader[0],'id'=>'hidden_dept_leader'])->span('') ?>
        <?= $form->field($model, 'dept_audit')->hiddenInput(['value'=>0])->span('') ?>

        <?= $form->field($model, 'yuan_leader')->hiddenInput(['value'=>$branchLeader[0],'id'=>'hidden_yuan_leader'])->span('') ?>

        <?= $form->field($model, 'yuan_audit')->hiddenInput(['value'=>0])->span('')  ?>
        <?= $form->field($model, 'jcz')->hiddenInput(['id'=>'hidden_jcz']) ?>
        <?= $form->field($model, 'jcz_audit')->hiddenInput(['value'=>0])->span('')  ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>

<div id="gongchuren" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_ren"><!--移动弹出层-->
        <div class="gongchu-ren">
            <div class="title_ren">公出人员：<span id="checkedGongchu"></span></div>
            <?php $i=0; ?>
            <?php foreach($deptUsers as $deptk=>$deptv): ?>
                <?php $i++ ?>
                <div class="gongchu-ren-ks"><a href="javascript:;" data="ks<?=$i;?>"><?=$deptk ?></a></div>
                <div class="gongchu-ren-list" id="ks<?=$i;?>_con">
                    <?php foreach($deptv as $k=>$v):?>
                    <label for="ren1" style="width: 80px"><input type="checkbox" value="<?=$k ?>" name="gongchu" onclick="addGongchuren(this,this.nextSibling.nodeValue);"><?=$v ?></label>
                    <?php endforeach ?>
                    <div class="clr"></div>
                </div>
            <?php endforeach ?>
            <div class="btn1">
                <input type="button" value="确定" onclick="select_person('gongchuren')"/>
                <input type="button" value="关闭" onclick="closeDiv('gongchuren');" />
            </div>
        </div>
    </div>
</div>

<div id="dept" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_dept"><!--移动弹出层-->
        <div class="gongchu-ren">
            <div class="title_ren">科室领导：<span id="checkedDept"></span></div>
            <?php $i=100; ?>
            <?php foreach($deptAuditors as $deptk=>$deptv): ?>
                <?php $i++ ?>
                <div class="gongchu-ren-ks"><a href="javascript:;" data="ks<?=$i;?>"><?=$deptk ?></a></div>
                <div class="gongchu-ren-list" id="ks<?=$i;?>_con">
                    <?php foreach($deptv as $k=>$v):?>
                        <label for="ren1" style="width: 80px"><input type="radio" value="<?=$k ?>" name="dept" onclick="addDept(this,this.nextSibling.nodeValue);"><?=$v ?></label>
                    <?php endforeach ?>
                    <div class="clr"></div>
                </div>
            <?php endforeach ?>
            <div class="btn1" >
                <input type="button" value="确定" onclick="select_person('dept')"/>
                <input type="button" value="关闭" onclick="closeDiv('dept');" />
            </div>
        </div>
    </div>
</div>

<div id="yuan" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_yuan"><!--移动弹出层-->
        <div class="gongchu-ren">
            <div class="title_ren">分管领导：<span id="checkedYuan"></span></div>
            <?php $i=200; ?>
            <?php foreach($deptAuditors as $deptk=>$deptv): ?>
                <?php $i++ ?>
                <div class="gongchu-ren-ks"><a href="javascript:;" data="ks<?=$i;?>"><?=$deptk ?></a></div>
                <div class="gongchu-ren-list" id="ks<?=$i;?>_con">
                    <?php foreach($deptv as $k=>$v):?>
                        <label for="ren1" style="width: 80px"><input type="radio" value="<?=$k ?>" name="dept" onclick="addYuan(this,this.nextSibling.nodeValue);"><?=$v ?></label>
                    <?php endforeach ?>
                    <div class="clr"></div>
                </div>
            <?php endforeach ?>
            <div class="btn1" >
                <input type="button" value="确定" onclick="select_person('yuan')"/>
                <input type="button" value="关闭" onclick="closeDiv('yuan');" />
            </div>
        </div>
    </div>
</div>
<div id="jcz" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_jcz"><!--移动弹出层-->
        <div class="gongchu-ren">
            <div class="title_ren">院领导：<span id="checkedJcz"></span></div>
            <?php $i=300; ?>
            <?php foreach($deptAuditors as $deptk=>$deptv): ?>
                <?php $i++ ?>
                <div class="gongchu-ren-ks"><a href="javascript:;" data="ks<?=$i;?>"><?=$deptk ?></a></div>
                <div class="gongchu-ren-list" id="ks<?=$i;?>_con">
                    <?php foreach($deptv as $k=>$v):?>
                        <label for="ren1" style="width: 80px"><input type="radio" value="<?=$k ?>" name="dept" onclick="addJcz(this,this.nextSibling.nodeValue);"><?=$v ?></label>
                    <?php endforeach ?>
                    <div class="clr"></div>
                </div>
            <?php endforeach ?>
            <div class="btn1" >
                <input type="button" value="确定" onclick="select_person('jcz')"/>
                <input type="button" value="关闭" onclick="closeDiv('jcz');" />
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function judgeTime(){
        var qjtime=$("#gongchu-gc_time").val();
        var endtime=$("#gongchu-end_time").val();
        qjtime1 = qjtime.replace(/\-/gi,"/");
        endtime1 = endtime.replace(/\-/gi,"/");
        var time1 = new Date(qjtime1).getTime();
        var time2 = new Date(endtime1).getTime();
        if(time1>time2){
            alert('开始时间不能大于结束时间');
            $("#gongchu-end_time").val('');
            return false;
        }
    }
</script>
<script type="text/javascript">
    var str='';
    var gongchu=document.getElementById("checkedGongchu");
    function addGongchuren(obj,val){
        if(obj.checked==true){
            str+=val+',';
        }else{
            str=gongchu.innerText.replace(val+',','');
        }
        gongchu.innerText =str;
    }
    var dept='';
    var deptChecked=document.getElementById("checkedDept");
    function addDept(obj,val){
        if(obj.checked==true){
            dept=val;
        }else{
            dept=deptChecked.innerText.replace(val,'');
        }
        deptChecked.innerText =dept;
    }
    var yuan='';
    var yuanChecked=document.getElementById("checkedYuan");
    function addYuan(obj,val){
        if(obj.checked==true){
            yuan=val;
        }else{
            yuan=yuanChecked.innerText.replace(val,'');
        }
        yuanChecked.innerText =yuan;
    }
    var jcz='';
    var jczChecked=document.getElementById("checkedJcz");
    function addJcz(obj,val){
        if(obj.checked==true){
            jcz=val;
        }else{
            jcz=jczChecked.innerText.replace(val,'');
        }
        jczChecked.innerText =jcz;
    }

    function select_person(type){
        //type确定是当前页那个弹出层，
        if(type=='gongchuren'){
            var radiObj = document.getElementsByName("gongchu");
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
                alert('请选择公出人员');return false;
            }
            //赋值给父页面某元素
            document.getElementById("gongchu-gc_ren").value=name;
            document.getElementById("hidden_gc_ren").value=id;
        }
        if(type=='dept'){
            var radiObj = document.getElementsByName("dept");
            for(var i=0;i<radiObj.length;i++)
            {
                if(radiObj[i].checked) {
                    var leader_id = radiObj[i].value;
                    var leader_name=radiObj[i].nextSibling.nodeValue;
                }
            }
            if(leader_id==undefined){
                alert('请选择科室领导');return false;
            }
            document.getElementById("gongchu-dept_leader").value=leader_name;
            document.getElementById("hidden_dept_leader").value=leader_id;
        }
        if(type=='yuan'){
            var radiObj = document.getElementsByName("dept");
            for(var i=0;i<radiObj.length;i++)
            {
                if(radiObj[i].checked) {
                    var leader_id = radiObj[i].value;
                    var leader_name=radiObj[i].nextSibling.nodeValue;
                }
            }
            if(leader_id==undefined){
                alert('请选择院领导');return false;
            }
            document.getElementById("gongchu-yuan_leader").value=leader_name;
            document.getElementById("hidden_yuan_leader").value=leader_id;
        }
        if(type=='jcz'){
            var radiObj = document.getElementsByName("dept");
            for(var i=0;i<radiObj.length;i++)
            {
                if(radiObj[i].checked) {
                    var leader_id = radiObj[i].value;
                    var leader_name=radiObj[i].nextSibling.nodeValue;
                }
            }
            if(leader_id==undefined){
                alert('请选择院领导');return false;
            }
            document.getElementById("gongchu-jcz").value=leader_name;
            document.getElementById("hidden_jcz").value=leader_id;
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