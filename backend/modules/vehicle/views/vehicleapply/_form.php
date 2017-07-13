<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\gongchu\models\Gongchu;
/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\VehicleApply */
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
    #vehicleapply-v_user,#vehicleapply-dept_leader,#vehicleapply-branch_leader{
        cursor: pointer;
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
//    $jcz=Gongchu::getDeptLeader(1);//获取检察长，默认院领导负责人为检察长
    ?>

        <strong>【用车申请】</strong>
        <span><em>*</em>车牌号</span>
        <?= $form->field($model, 'v_license')->textInput(['readonly' => true,'maxlength' => true]) ?>

        <span><em>*</em>科室</span>
        <?= $form->field($model, 'dept')->textInput(['readonly' => true,'value'=>$deptName,'name'=>''])?>

        <span><em>*</em>用车人</span>
        <?= $form->field($model, 'v_user')->textInput(['readonly' => true,'value'=>$username,'onclick'=>'showDiv("user","move_user")','name'=>'']) ?>

        <span><em>*</em>驾驶员</span>
        <?= $form->field($model, 'driver')->textInput(['maxlength' => true]) ?>
        <span><em>*</em>用车时间</span>
        <?= $form->field($model, 'use_time')->textInput(['maxlength' => true]) ?>
        <script type="text/javascript">
            Calendar.setup({
                weekNumbers: true,
                inputField : "vehicleapply-use_time",
                trigger    : "vehicleapply-use_time",
                dateFormat: "%Y-%m-%d %H:%M",
                showTime: true,
                minuteStep: 1,
                onSelect   : function() {this.hide();}
            });
        </script>
        <span><em>*</em>去向</span>
        <?= $form->field($model, 'quxiang')->textInput(['maxlength' => true])?>

        <span><em>*</em>用车事由</span>
        <?= $form->field($model, 'reason')->textInput([]) ?>

        <?php if($deptLeader[0]!=$userId && $userId!=$branchLeader[0]){ ?>
            <span><em>*</em>科室负责人</span>
            <?= $form->field($model, 'dept_leader')->textInput(['maxlength' => true,'value'=>$deptLeader[1],'onclick'=>'showDiv("dept","move_dept")','name'=>'']) ?>
            <span><em>*</em>分管领导</span>
            <?= $form->field($model, 'branch_leader')->textInput(['value'=>$branchLeader[1],'onclick'=>'showDiv("branch","move_branch")','name'=>''])?>
        <?php }elseif($deptLeader[0]==$userId){ ?>
            <span><em>*</em>分管领导</span>
            <?= $form->field($model, 'branch_leader')->textInput(['value'=>$branchLeader[1],'onclick'=>'showDiv("branch","move_branch")','name'=>''])?><br class="clr" />
        <?php }else{ ?>
            <span><em>*</em>分管领导</span>
            <?= $form->field($model, 'branch_leader')->textInput(['value'=>$branchLeader[1],'onclick'=>'showDiv("branch","move_branch")','name'=>''])?><br class="clr" />
        <?php } ?>

        <div style="display: none">
            <?= $form->field($model, 'dept_audit')->hiddenInput(['value'=>0])?>
            <?= $form->field($model, 'branch_leader')->hiddenInput(['value'=>$branchLeader[0],'id'=>'hidden_branch_leader']) ?>
            <?= $form->field($model, 'dept_leader')->hiddenInput(['value'=>$deptLeader[0],'id'=>'hidden_dept_leader'])?>
            <?= $form->field($model, 'branch_audit')->hiddenInput(['value'=>0]) ?>
            <?= $form->field($model, 'v_user')->hiddenInput(['value'=>$userId,'id'=>'hidden_v_user']) ?>
            <?= $form->field($model, 'dept')->hiddenInput(['value'=>$dept]) ?>
        </div>

            <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>
            <?= Html::input('submit','','提交', ['class' => 'btn']) ?>
        <br class="clr">

        <?php ActiveForm::end(); ?>
    </div>

</div>
<div id="user" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_user"><!--移动弹出层-->
        <div class="gongchu-ren">
            <div class="title_ren">用车人：<span id="checkedUser"></span></div>
            <?php $i=0; ?>
            <?php foreach($deptUsers as $deptk=>$deptv): ?>
                <?php $i++ ?>
                <div class="gongchu-ren-ks"><a href="javascript:;" data="ks<?=$i;?>"><?=$deptk ?></a></div>
                <div class="gongchu-ren-list" id="ks<?=$i;?>_con">
                    <?php foreach($deptv as $k=>$v):?>
                        <label for="ren1" style="width: 80px"><input type="checkbox" value="<?=$k ?>" name="users" onclick="addUser(this,this.nextSibling.nodeValue);"><?=$v ?></label>
                    <?php endforeach ?>
                    <div class="clr"></div>
                </div>
            <?php endforeach ?>
            <div class="btn1" >
                <input type="button" value="确定" onclick="select_person('user')"/>
                <input type="button" value="关闭" onclick="closeDiv('user');" />
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
<script type="text/javascript">
    var str='';
    var user=document.getElementById("checkedUser");
    function addUser(obj,val){
        if(obj.checked==true){
            str+=val+',';
        }else{
            str=user.innerText.replace(val+',','');
        }
        user.innerText =str;
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

    function select_person(type){
        //type确定是当前页那个弹出层，
        if(type=='user'){
            var radiObj = document.getElementsByName("users");//复选框
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
                alert('请选择用车人');return false;
            }
            //赋值给父页面某元素
            document.getElementById("vehicleapply-v_user").value=name;
            document.getElementById("hidden_v_user").value=id;
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
            document.getElementById("vehicleapply-dept_leader").value=leader_name;
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
            document.getElementById("vehicleapply-branch_leader").value=leader_name;
            document.getElementById("hidden_branch_leader").value=leader_id;
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
