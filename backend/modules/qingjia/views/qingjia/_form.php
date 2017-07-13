<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\gongchu\models\Gongchu;
use backend\modules\position\models\Position;

/* @var $this yii\web\View */
/* @var $model backend\modules\qingjia\models\Qingjia */
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
    #qingjia-dept_leader,#qingjia-branch_leader,#qingjia-zzc{
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
<div class="boxer">
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
    $position=Yii::$app->user->identity->position;
    $positionName=Position::getZhiwu($position);
    $userId=Yii::$app->user->id;
    $deptName=Gongchu::getDeptNameById($dept);
    $deptLeader=Gongchu::getDeptLeader($dept);//根据部门号找到部门负责人
    $branchLeader=Gongchu::getBranchLeader($dept);//根据部门号找到院领导
    $zzc=Gongchu::getDeptLeader(3);//获取政治处部门负责人
    $jcz=Gongchu::getDeptLeader(1);//获取检察长，默认院领导负责人为检察长
    ?>
    <strong>【请假申请】</strong>
    <span><em>*</em>请(休)假人</span>
    <?= $form->field($model, 'qj_ren')->textInput(['value'=>$username,'name'=>'qingjiaren','readonly'=>true]) ?><br class="clr" />
    <span><em>*</em>所属机构</span>
    <?= $form->field($model, 'dept')->textInput(['readonly'=>true,'value'=>$deptName,'name'=>'deptname']) ?><br class="clr" />
    <span><em>*</em>行政职务</span>
    <?= $form->field($model, 'position')->textInput(['value'=>$positionName,'name'=>'','readonly'=>true]) ?><br class="clr" />
    <span><em>*</em>请假类型</span>
    <?= $form->field($model, 'qj_type')->dropDownList($qingjiaType,['prompt'=>'--选择请假类型--','style'=>'margin-top:6px']) ?><br class="clr" />
    <span><em>*</em>请假时间</span>
    <?= $form->field($model, 'qj_time')->textInput(['readonly'=>'true','class'=>'q date']) ?><br class="clr" />
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "qingjia-qj_time",
            trigger    : "qingjia-qj_time",
            dateFormat: "%Y-%m-%d %H:%M",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();getQingjiaDays();}//获取请假天数}
        });
    </script>
    <span><em>*</em>结束时间</span>
    <?= $form->field($model, 'end_time')->textInput(['readonly'=>'true','class'=>'q date']) ?><br class="clr" />
    <script type="text/javascript">
        Calendar.setup({
            weekNumbers: true,
            inputField : "qingjia-end_time",
            trigger    : "qingjia-end_time",
            dateFormat: "%Y-%m-%d %H:%M",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();getQingjiaDays();}//获取请假天数
        });
    </script>
    <span><em>*</em>请假时长/天</span>
    <?= $form->field($model, 'qj_day')->textInput(['readonly'=>true]) ?><br class="clr" />
    <span class="tall"><em>*</em>请假原因</span>
    <?= $form->field($model, 'qj_reason',['options'=>['class'=>'tall']])->textarea(['rows' => 3]) ?><br class="clr" />
        <?php if($deptLeader[0]!=$userId&&$userId!=$branchLeader[0]){ ?>
    <span><em>*</em>科室领导意见</span>
    <?= $form->field($model, 'dept_leader')->textInput(['value'=>$deptLeader[1],'name'=>'','readonly'=>true,'onclick'=>'showDiv("dept","move_dept")']) ?><br class="clr" />
    <span><em>*</em>分管领导意见</span>
    <?= $form->field($model, 'branch_leader')->textInput(['value'=>$branchLeader[1],'name'=>'','readonly'=>true,'onclick'=>'showDiv("branch","move_branch")']) ?><br class="clr" />
    <span><em>*</em>政治处意见</span>
    <?= $form->field($model, 'zzc')->textInput(['value'=>$zzc[1],'name'=>'','readonly'=>true,'onclick'=>'showDiv("zzc","move_zzc")']) ?><br class="clr" />
    <span id='jcz_span' style='color:#cccccc'>检察长意见</span>
    <?= $form->field($model, 'jcz')->textInput(['name'=>'','value'=>$jcz[1],'disabled'=>true,'onclick'=>'showDiv("jcz","move_jcz")']) ?><br class="clr" />
        <?php }elseif($deptLeader[0]==$userId&&$userId!=$branchLeader[0]){ ?>
            <span><em>*</em>分管领导意见</span>
            <?= $form->field($model, 'branch_leader')->textInput(['value'=>$branchLeader[1],'name'=>'','readonly'=>true,'onclick'=>'showDiv("branch","move_branch")']) ?><br class="clr" />
            <span><em>*</em>政治处意见</span>
            <?= $form->field($model, 'zzc')->textInput(['value'=>$zzc[1],'name'=>'','readonly'=>true,'onclick'=>'showDiv("zzc","move_zzc")']) ?><br class="clr" />
            <span id='jcz_span' style='color:#cccccc'>检察长意见</span>
            <?= $form->field($model, 'jcz')->textInput(['name'=>'','value'=>$jcz[1],'disabled'=>true,'onclick'=>'showDiv("jcz","move_jcz")']) ?><br class="clr" />
        <?php }elseif($userId==$branchLeader[0]){ ?>
            <span><em>*</em>政治处意见</span>
            <?= $form->field($model, 'zzc')->textInput(['value'=>$zzc[1],'name'=>'','readonly'=>true,'onclick'=>'showDiv("zzc","move_zzc")']) ?><br class="clr" />
            <span id='jcz_span' style='color:#cccccc'>检察长意见</span>
            <?= $form->field($model, 'jcz')->textInput(['name'=>'','value'=>$jcz[1],'disabled'=>true,'onclick'=>'showDiv("jcz","move_jcz")']) ?><br class="clr" />
        <?php }elseif($userId==$zzc[0]){ ?>
            <span id='jcz_span'>检察长意见</span>
            <?= $form->field($model, 'jcz')->textInput(['value'=>$jcz[1],'name'=>'','onclick'=>'showDiv("jcz","move_jcz")']) ?><br class="clr" />
        <?php } ?>


        <?= Html::input('submit','','提交', ['class' => 'btn']) ?>
        <?=Html::a(Yii::t('app', '返回'), Yii::$app->urlManager->createUrl(['qingjia/qingjia/index']),['class' =>'btn yuqi-return','id'=>'back']);?>

        <div style="display: none">
        <?= $form->field($model, 'qj_ren')->hiddenInput(['value'=>$userId])?>
        <?= $form->field($model, 'dept')->hiddenInput(['value'=>$dept])?>
        <?= $form->field($model, 'position')->hiddenInput(['value'=>$position])?>
        <?= $form->field($model, 'dept_leader')->hiddenInput(['value'=>$deptLeader[0],'id'=>'hidden_dept_leader']) ?>
        <?= $form->field($model, 'dept_audit')->hiddenInput(['value'=>0]) ?>
        <?= $form->field($model, 'branch_audit')->hiddenInput(['value'=>0]) ?>
        <?= $form->field($model, 'branch_leader')->hiddenInput(['value'=>$branchLeader[0],'id'=>'hidden_branch_leader']) ?>
        <?= $form->field($model, 'zzc')->hiddenInput(['value'=>$zzc[0],'id'=>'hidden_zzc']) ?>
        <?= $form->field($model, 'zzc_audit')->hiddenInput(['value'=>0]) ?>
        <?= $form->field($model, 'jcz')->hiddenInput(['id'=>'hidden_jcz','value'=>$jcz[0],'disabled'=>true]) ?>
        <?= $form->field($model, 'jcz_audit')->hiddenInput(['value'=>0,'id'=>'hidden_jcz_audit']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
<div id="dept" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_dept"><!--移动弹出层-->
        <div class="gongchu-ren">
            <div class="title_ren">科室负责人：<span id="checkedDept"></span></div>
            <?php $i=0; ?>
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
            <?php $i=100; ?>
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
<div id="zzc" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_zzc"><!--移动弹出层-->
        <div class="gongchu-ren">
            <div class="title_ren">政治处：<span id="checkedZzc"></span></div>
            <?php $i=200; ?>
            <?php foreach($deptAuditors as $deptk=>$deptv): ?>
                <?php $i++ ?>
                <div class="gongchu-ren-ks"><a href="javascript:;" data="ks<?=$i;?>"><?=$deptk ?></a></div>
                <div class="gongchu-ren-list" id="ks<?=$i;?>_con">
                    <?php foreach($deptv as $k=>$v):?>
                        <label for="ren1" style="width: 80px"><input type="radio" value="<?=$k ?>" name="dept" onclick="addZzc(this,this.nextSibling.nodeValue);"><?=$v ?></label>
                    <?php endforeach ?>
                    <div class="clr"></div>
                </div>
            <?php endforeach ?>
            <div class="btn1" >
                <input type="button" value="确定" onclick="select_person('zzc')"/>
                <input type="button" value="关闭" onclick="closeDiv('zzc');" />
            </div>
        </div>
    </div>
</div>
<div id="jcz" style="display:none; position:absolute; z-index:1000;background: #ffffff;border: 1px solid #cccccc">
    <div id="move_jcz"><!--移动弹出层-->
        <div class="gongchu-ren">
            <div class="title_ren">检察长：<span id="checkedJcz"></span></div>
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
    function getQingjiaDays(){
        var qjtime=$("#qingjia-qj_time").val();
        var endtime=$("#qingjia-end_time").val();
        var h1=qjtime.substring(qjtime.indexOf(' ')+1,qjtime.indexOf(':'));//小时数
        var h2=endtime.substring(endtime.indexOf(' ')+1,endtime.indexOf(':'));//小时数
        var xiaoshu=0.5;//分数 如0.5
        qjtime1 = qjtime.replace(/\-/gi,"/");
        endtime1 = endtime.replace(/\-/gi,"/");
        var time1 = new Date(qjtime1).getTime();
        var time2 = new Date(endtime1).getTime();
        if(time1>time2){
            alert('开始时间不能大于结束时间');
            $("#qingjia-end_time").val('');
            $("#qingjia-qj_day").val('');//清空请假天数
            return false;
        }else if(time1==time2){
            if((h1>=12 && h2>=12) || (h1<12 && h2<12)) {//同是下午
                xiaoshu=0.5;
            }else{
                xiaoshu=1;
            }
            $("#qingjia-qj_day").val(xiaoshu);//相等，计算为请假半天
        }else if(qjtime!='' && endtime!=''){
            if((h1>=12 && h2>=12) || (h1<12 && h2<12)) {//同是下午
                xiaoshu=0.5;
            }else{
                xiaoshu=1;
            }
            var cha=time2-time1;
            var days=Math.floor(cha/1000/60/60/24)+xiaoshu;
            $("#qingjia-qj_day").val(days);//计算请假天数
            if(days>=3){
                $("#jcz_span").css("color",'');
                $("#qingjia-jcz").attr("disabled",false);//小于3天 检察长一栏灰掉
                $("#hidden_jcz_audit").attr("disabled",false);
                $("#hidden_jcz").attr("disabled",false);
                $("#qingjia-jcz").attr("cursor","pointer");
            }else{
                $("#jcz_span").css("color",'#cccccc');
                $("#qingjia-jcz").attr("disabled",true);//小于3天 检察长一栏灰掉
                $("#hidden_jcz_audit").attr("disabled",true);
                $("#hidden_jcz").attr("disabled",true);
                $("#qingjia-jcz").attr("cursor","");
            }
        }
    }
</script>
<script type="text/javascript">
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
    var BranchChecked=document.getElementById("checkedBranch");
    function addBranch(obj,val){
        if(obj.checked==true){
            branch=val;
        }else{
            branch=BranchChecked.innerText.replace(val,'');
        }
        BranchChecked.innerText =branch;
    }
    var zzc='';
    var ZzcChecked = document.getElementById("checkedZzc");
    function addZzc(obj,val){
        if(obj.checked==true){
            zzc=val;
        }else{
            zzc=ZzcChecked.innerText.replace(val,'');
        }
        ZzcChecked.innerText =zzc;
    }
    var jcz='';
    var JczChecked = document.getElementById("checkedJcz");
    function addJcz(obj,val){
        if(obj.checked==true){
            jcz=val;
        }else{
            jcz=JczChecked.innerText.replace(val,'');
        }
        JczChecked.innerText =jcz;
    }
    function select_person(type){
        //type确定是当前页那个弹出层，
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
                alert('请选择人员');return false;
            }
            document.getElementById("qingjia-dept_leader").value=leader_name;
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
                alert('请选择人员');return false;
            }
            document.getElementById("qingjia-branch_leader").value=leader_name;
            document.getElementById("hidden_branch_leader").value=leader_id;
        }
        if(type=='zzc'){
            var radiObj = document.getElementsByName("dept");
            for(var i=0;i<radiObj.length;i++)
            {
                if(radiObj[i].checked) {
                    var leader_id = radiObj[i].value;
                    var leader_name=radiObj[i].nextSibling.nodeValue;
                }
            }
            if(leader_id==undefined){
                alert('请选择人员');return false;
            }
            document.getElementById("qingjia-zzc").value=leader_name;
            document.getElementById("hidden_zzc").value=leader_id;
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
                alert('请选择人员');return false;
            }
            document.getElementById("qingjia-jcz").value=leader_name;
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
