<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\gongchu\models\Gongchu;

/* @var $this yii\web\View */
/* @var $model backend\modules\chuchai\models\Chuchai */
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
    #chuchai-cc_ren,#chuchai-dept_leader,#chuchai-branch_leader,#chuchai-chief{
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
    $branchLeader=Gongchu::getBranchLeader($dept);//根据部门号找到院领导/分管领导
    $jcz=Gongchu::getDeptLeader(1);//获取检察长，默认院领导负责人为检察长
    ?>
    <strong>【出差申请】</strong>
    <span><em>*</em>科（室、局）</span>
    <?= $form->field($model, 'dept')->textInput(['disabled'=>true,'value'=>$deptName,'name'=>'deptname']) ?>
    <span><em>*</em>出差人员</span>
    <?= $form->field($model, 'cc_ren')->textInput(['maxlength' => true,'onclick'=>'showDiv("chuchairen","move_ren")','name'=>'chuchairens'])?>
    <span><em>*</em>出差人数</span>
    <?= $form->field($model, 'cc_count')->textInput() ?>
    <span><em>*</em>出差时间</span>
    <?= $form->field($model, 'cc_date')->textInput(['readonly'=>'true','class'=>'q date']) ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "chuchai-cc_date",
            trigger    : "chuchai-cc_date",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();judgeTime();}
        });
    </script>
    <span><em>*</em>结束时间</span>
    <?= $form->field($model, 'end_date')->textInput(['readonly'=>'true','class'=>'q date']) ?>
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "chuchai-end_date",
            trigger    : "chuchai-end_date",
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();judgeTime();}
        });
    </script>
    <span><em>*</em>出差地点</span>
    <?= $form->field($model, 'cc_place')->textInput(['maxlength' => true]) ?>
    <span class="tall"><em>*</em>出差任务</span>
    <?= $form->field($model, 'cc_task',['options'=>['class'=>'tall']])->textarea(['rows' => 3]) ?>
    <span><em>*</em>乘坐交通工具</span>
    <?= $form->field($model, 'cc_transporation')->textInput(['maxlength' => true]) ?>

    <?php if($deptLeader[0]!=$userId&&$userId!=$branchLeader[0]){ ?>
        <span><em>*</em>科室负责人意见</span>
        <?= $form->field($model, 'dept_leader')->textInput(['value'=>$deptLeader[1],'onclick'=>'showDiv("dept","move_dept")','name'=>'dept_leader']) ?>
        <span><em>*</em>分管领导意见</span>
        <?= $form->field($model, 'branch_leader')->textInput(['value'=>$branchLeader[1],'onclick'=>'showDiv("branch","move_branch")','name'=>'branch_leader']) ?>
        <span><em>*</em>检察长审批</span>
        <?= $form->field($model, 'chief')->textInput(['value'=>$jcz[1],'onclick'=>'showDiv("chiefs","move_chiefs")','name'=>'chief']) ?>

    <?php }elseif($deptLeader[0]==$userId&&$userId!=$branchLeader[0]){ ?>
        <span><em>*</em>分管领导意见</span>
        <?= $form->field($model, 'branch_leader')->textInput(['value'=>$branchLeader[1],'onclick'=>'showDiv("branch","move_branch")','name'=>'branch_leader']) ?>
        <span><em>*</em>检察长审批</span>
        <?= $form->field($model, 'chief')->textInput(['value'=>$jcz[1],'onclick'=>'showDiv("chiefs","move_chiefs")','name'=>'chief']) ?>
    <?php }elseif($userId==$branchLeader[0]){ ?>
        <span><em>*</em>检察长审批</span>
        <?= $form->field($model, 'chief')->textInput(['value'=>$jcz[1],'onclick'=>'showDiv("chiefs","move_chiefs")','name'=>'chief']) ?>
    <?php } ?>

        <?=Html::a(Yii::t('app', '返回'), Yii::$app->urlManager->createUrl(['chuchai/chuchai/index']),['class' =>'btn yuqi-return','id'=>'back']);?>
        <?= Html::input('submit','','提交', ['class' => 'btn']) ?>
<div style="display: none">
    <?= $form->field($model, 'dept')->hiddenInput(['value'=>$dept])->span('');?>
    <?= $form->field($model, 'cc_ren')->hiddenInput(['id'=>'hidden_cc_ren'])->span('') ?>
    <?= $form->field($model, 'apply_ren')->hiddenInput(['value'=>$userId])->span('') ?>
    <?= $form->field($model, 'apply_time')->hiddenInput(['value'=>date('Y-m-d H:i:s',time())])->span('') ?>
    <?= $form->field($model, 'dept_leader')->hiddenInput(['value'=>$deptLeader[0],'id'=>'hidden_dept_leader'])->span('') ?>
    <?= $form->field($model, 'dept_audit')->hiddenInput(['value'=>0])->span('') ?>
    <?= $form->field($model, 'branch_leader')->hiddenInput(['value'=>$branchLeader[0],'id'=>'hidden_branch_leader'])->span('') ?>
    <?= $form->field($model, 'branch_audit')->hiddenInput(['value'=>0])->span('')  ?>
    <?= $form->field($model, 'chief')->hiddenInput(['value'=>$jcz[0],'id'=>'hidden_chief'])->span('') ?>
    <?= $form->field($model, 'chief_audit')->hiddenInput(['value'=>0])->span('')  ?>
</div>
    <?php ActiveForm::end(); ?>
</div>
</div>

<div id="chuchairen" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_ren"><!--移动弹出层-->
        <div class="gongchu-ren">
            <div class="title_ren">出差人员：<span id="checkedChuchai"></span></div>
            <?php $i=0; ?>
            <?php foreach($deptUsers as $deptk=>$deptv): ?>
                <?php $i++ ?>
                <div class="gongchu-ren-ks"><a href="javascript:;" data="ks<?=$i;?>"><?=$deptk ?></a></div>
                <div class="gongchu-ren-list" id="ks<?=$i;?>_con">
                    <?php foreach($deptv as $k=>$v):?>
                        <label for="ren1" style="width: 80px"><input type="checkbox" value="<?=$k ?>" name="chuchai" onclick="addChuchai(this,this.nextSibling.nodeValue);"><?=$v ?></label>
                    <?php endforeach ?>
                    <div class="clr"></div>
                </div>
            <?php endforeach ?>
            <div class="btn1" >
                <input type="button" value="确定" onclick="select_person('chuchairen')"/>
                <input type="button" value="关闭" onclick="closeDiv('chuchairen');" />
            </div>
        </div>
    </div>
</div>
<div id="dept" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_dept"><!--移动弹出层-->
        <div class="gongchu-ren">
            <div class="title_ren">科室负责人：<span id="checkedDept"></span></div>
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
<div id="branch" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_branch"><!--移动弹出层-->
        <div class="gongchu-ren">
            <div class="title_ren">分管领导：<span id="checkedBranch"></span></div>
            <?php $i=200; ?>
            <?php foreach($deptAuditors as $deptk=>$deptv): ?>
                <?php $i++ ?>
                <div class="gongchu-ren-ks"><a href="javascript:;" data="ks<?=$i;?>"><?=$deptk ?></a></div>
                <div class="gongchu-ren-list" id="ks<?=$i;?>_con">
                    <?php foreach($deptv as $k=>$v):?>
                        <label for="ren1" style="width: 80px"><input type="radio" value="<?=$k ?>" name="dept" onclick="addBranch(this,this.nextSibling.nodeValue);"><?=$v ?></label>
                    <?php endforeach ?>
                    <div class="clr"></div>
                </div>
            <?php endforeach ?>
            <div class="btn1" >
                <input type="button" value="确定" onclick="select_person('branch')"/>
                <input type="button" value="关闭" onclick="closeDiv('branch');" />
            </div>
        </div>
    </div>
</div>
<div id="chiefs" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_chiefs"><!--移动弹出层-->
        <div class="gongchu-ren">
            <div class="title_ren">检察长：<span id="checkedChiefs"></span></div>
            <?php $i=300; ?>
            <?php foreach($deptAuditors as $deptk=>$deptv): ?>
                <?php $i++ ?>
                <div class="gongchu-ren-ks"><a href="javascript:;" data="ks<?=$i;?>"><?=$deptk ?></a></div>
                <div class="gongchu-ren-list" id="ks<?=$i;?>_con">
                    <?php foreach($deptv as $k=>$v):?>
                        <label for="ren1" style="width: 80px"><input type="radio" value="<?=$k ?>" name="dept" onclick="addChiefs(this,this.nextSibling.nodeValue);"><?=$v ?></label>
                    <?php endforeach ?>
                    <div class="clr"></div>
                </div>
            <?php endforeach ?>
            <div class="btn1" >
                <input type="button" value="确定" onclick="select_person('chiefs')"/>
                <input type="button" value="关闭" onclick="closeDiv('chiefs');" />
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function judgeTime(){
        var qjtime=$("#chuchai-cc_date").val();
        var endtime=$("#chuchai-end_date").val();
        qjtime1 = qjtime.replace(/\-/gi,"/");
        endtime1 = endtime.replace(/\-/gi,"/");
        var time1 = new Date(qjtime1).getTime();
        var time2 = new Date(endtime1).getTime();
        if(time1>time2){
            alert('开始时间不能大于结束时间');
            $("#chuchai-end_date").val('');
            return false;
        }
    }
</script>
<script type="text/javascript">
    var str='';
    var chuchai=document.getElementById("checkedChuchai");
    function addChuchai(obj,val){
        if(obj.checked==true){
            str+=val+',';
        }else{
            str=chuchai.innerText.replace(val+',','');
        }
        chuchai.innerText =str;
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
    var branch='';
    var branchChecked=document.getElementById("checkedBranch");
    function addBranch(obj,val){
        if(obj.checked==true){
            branch=val;
        }else{
            branch=branchChecked.innerText.replace(val,'');
        }
        branchChecked.innerText =branch;
    }

    var chiefs='';
    var checkedChiefs=document.getElementById("checkedChiefs");
    function addChiefs(obj,val){
        if(obj.checked==true){
            chiefs=val;
        }else{
            chiefs=checkedChiefs.innerText.replace(val,'');
        }
        checkedChiefs.innerText =chiefs;
    }

    function select_person(type){
        //type确定是当前页那个弹出层，
        if(type=='chuchairen'){
            var radiObj = document.getElementsByName("chuchai");//复选框
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
                alert('请选择出差人员');return false;
            }
            //赋值给父页面某元素
            document.getElementById("chuchai-cc_ren").value=name;
            document.getElementById("hidden_cc_ren").value=id;
        }
        if(type=='dept'){
            var radiObj = document.getElementsByName("dept");//单选框
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
            document.getElementById("chuchai-dept_leader").value=leader_name;
            document.getElementById("hidden_dept_leader").value=leader_id;
        }
        if(type=='branch'){
            var radiObj = document.getElementsByName("dept");
            for(var i=0;i<radiObj.length;i++)
            {
                if(radiObj[i].checked) {
                    var leader_id = radiObj[i].value;
                    var leader_name=radiObj[i].nextSibling.nodeValue;
                }
            }
            if(leader_id==undefined){
                alert('请选择分管领导');return false;
            }
            document.getElementById("chuchai-branch_leader").value=leader_name;
            document.getElementById("hidden_branch_leader").value=leader_id;
        }
        if(type=='chiefs'){
            var radiObj = document.getElementsByName("dept");
            for(var i=0;i<radiObj.length;i++)
            {
                if(radiObj[i].checked) {
                    var leader_id = radiObj[i].value;
                    var leader_name=radiObj[i].nextSibling.nodeValue;
                }
            }
            if(leader_id==undefined){
                alert('请选择检察长');return false;
            }
            document.getElementById("chuchai-chief").value=leader_name;
            document.getElementById("hidden_chief").value=leader_id;
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