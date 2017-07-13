<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<link href="css/ydbg/common.css" type="text/css" rel="stylesheet" />
<link href="css/ydbg/style.css" type="text/css" rel="stylesheet" />
<link href="css/ydbg/add.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/ydbg/jquery.min.js"></script>
<script type="text/javascript" src="js/ydbg/common.js"></script>
<script type="text/javascript" src="js/ydbg/getdate.js"></script>
<script type="text/javascript" src="js/ydbg/jquery.placeholder.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ydbg/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ydbg/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ydbg/ueditor/lang/zh-cn/zh-cn.js"></script>

<div id="boxer" style="position: relative; zoom: 1;">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <div class="news-show">
        <?php if (empty($_GET['look'])){?>
            <div class="news-show-top">【新增院内新闻】</div>
        <?php }elseif(empty($_GET['look_type'])){?>
            <div class="news-show-top">【修改院内新闻】</div>
        <?php }else{?>
            <div class="news-show-top">【院内新闻详情】</div>
        <?php }?>
        <div class="news-show-l"><em>*</em>新闻标题</div><div class="news-show-r"><?= $form->field($model, 'title')->textInput(['maxlength' => true ,'class' => 'title'])->label('') ?></div>
        <div class="clr"></div>
        <div class="news-show-l">附件</div>
        <div class="news-show-r">
            <?php if(empty($_GET['look_type'])){?>
                <?php echo $form->field($model, 'attachment')->fileInput(['contentEditable'=>'false','class'=>'upload', 'style'=>'float:left;margin-top:15px;margin-left:10px;','onchange'=>'onUploadFileChange(this);'])->label('') ?>
                <em style="float: left;line-height: 50px">(DOC,PDF格式)</em>
                <input type="file" class="hid" id="upload" />
                <?php  if(!$model->isNewRecord):?>
                    <span style="float:left;text-align: right;line-height: 50px;margin-left: 20px;"><?=$model->attachment?></span>
                <?php endif;?>
            <?php }else{?>
                <?= Html::a($model->attachment,Yii::$app->urlManager->createUrl(['/news/news/down','id'=>$model->id]),['style'=>'color:blue;float:left;margin-top:15px;margin-left:5px']) ?>
            <?php }?>
        </div>
        <div class="clr"></div>
        <div class="news-show-l news-show-tall">正文</div><div class="news-show-r news-show-r-tall">
            <?= $form->field($model, 'content')->textarea(['maxlength' => true , 'id' => 'editor'])->label('') ?>
        </div>
        <div class="clr"></div>
    </div>
    <?php if(empty($_GET['look_type'])){?>
        <div class="news-show-btn">
            <?= Html::a('返回',['index'],['style' => 'margin-left:500px;','id'=>'back'])?>
            <?= Html::input('submit','dosubmit',Yii::t('app','保存'),['style' => 'float：left;margin-left:30px']) ?>
        </div>
    <?php }else{?>
        <div class="news-show-btn">
            <?= Html::a('返回',['index'])?>
        </div>
    <?php }?>
    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    jQuery(function($){
        $(".news-show-r").on("click","a.upload",function(){
            $("input#upload").click();
        });
    });
    var ue = UE.getEditor('editor',{
        initialFrameWidth:'100%',
        initialFrameHeight:275,
        autoHeightEnabled:false   //自适应
    });
</script>

<script>
    function downloadFile(url) {
        try{
            window.document.execCommand('saveas','','www.ydbg.com'+url);
            window.close();
        }catch(e){

        }
    }
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
