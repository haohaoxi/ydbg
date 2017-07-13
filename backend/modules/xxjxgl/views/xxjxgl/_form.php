<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\xxjxgl\models\Xxjxgl */
/* @var $form yii\widgets\ActiveForm */
$content = json_decode($model->title_content);
?>
<style>
  .has-error #xxjxgl-title_content .help-block{
         margin-top:100px;
     }
  .help-block{
      float: left;
  }
    .field-xxjxgl-title_content{
        margin-top: 25px;
    }

</style>
<link href="css/ydbg/common.css" type="text/css" rel="stylesheet" />
<link href="css/ydbg/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/ydbg/jquery.min.js"></script>
<script type="text/javascript" src="js/ydbg/common.js"></script>
<script type="text/javascript" src="js/ydbg/getdate.js"></script>
<script type="text/javascript" src="js/ydbg/jquery.placeholder.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ydbg/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ydbg/ueditor/ueditor.all.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ydbg/ueditor/lang/zh-cn/zh-cn.js"></script>
<div class="boxer" style="position: relative; zoom: 1;">
    <div class="study-table-view">
        <div class="xuexi-view">
            <strong>【新增案件案例】</strong>
        <?php $form = ActiveForm::begin([
//            'action' =>'index.php?r=xxjxgl%2Fxxjxgl%2Fcreate',
            'method'=>'post',
            'options'=>['enctype'=>'multipart/form-data'],
        ]); ?>
            <span class="tie"><em>*</em>案件案例标题</span>
            <div class="study-r">
                <?php echo  $form->field($model, 'title')->textInput(['maxlength' => true,'class'=>'q','style'=>'margin-top:33px'])->label("") ?>
            </div><br class="clr" />
            <span class="tie">附件</span><div  class="uploads study-r">
                <em style="color: lightslategrey">(只允许上传doc pdf,docx,txt文件)</em>
                <?php echo $form->field($model, 'fujian')->fileInput(['class'=>'upload' ,
                    'style'=>'float:left;margin-top:15px;margin-left:10px;',
                        'onchange'=>'onUploadFileChange(this);','contentEditable'=>'false','class'=>'input-file'])->label('') ?>
                <span id="fujian" style="line-height: 60px;margin-left: 275px;color: #ff5151" onclick="bbb(text.value);">删除</span>
            </div>

            <br class="clr" />
            <span class="tie  study-tall">正文</span>
            <div  class="study-r study-tall_r">
                <div class="content">
                    <?php echo  $form->field($model, 'content')->textarea(['maxlength' => true,'id'=>'editor'])->label("") ?>
                </div>
            </div>
            <br class="clr" />
            <span class="tie"><em>*</em>相关法律法规</span>
            <div style=""  class="uploads study-r" >
                <em style="color: lightslategrey;"></em>
                    <?= $form->field($model, 'title_content')->fileInput(['maxlength' => true,'onchange'=>'onUploadFileChange(this);','contentEditable'=>'false'])->label("");?>
                    <span id="content" style="margin-top: -20px;display:block;margin-left: 500px;color: #ff5151" onclick="bbb(text.value);">删除</span>
                <div id="div2"></div>
            </div><br class="clr" />
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
    <script>
        $(function(){
           $("#fujian").click(function(){
               var obj = document.getElementById('xxjxgl-fujian') ;
               obj.outerHTML=obj.outerHTML;
           })
        });
        $(function(){
            $("#content").click(function(){
                var obj = document.getElementById('xxjxgl-title_content') ;
                obj.outerHTML=obj.outerHTML;
            })
        });

    </script>
    <script type="text/javascript">
        jQuery(function($){
            $(".news-show-r").on("click","a.upload",function(){
                $("input#upload").click();
            });
        });
        var ue = UE.getEditor('editor',{
            initialFrameWidth:'100%',
            initialFrameHeight:225,
            autoHeightEnabled:false
        });

//        _editor = UE.getEditor('title_content');
//        _editor.ready(function () {
//            //设置编辑器不可用
//            //_editor.setDisabled();
//            //隐藏编辑器，因为不会用到这个编辑器实例，所以要隐藏
//            _editor.hide();
//            //侦听图片上传
//            _editor.addListener('beforeInsertImage', function (t, arg) {
//            });
//            _editor.addListener('afterInsertImage', function (t, arg) {
//
//               // $("#div2").append(arg[0].url);
//            });
//            //侦听文件上传，取上传文件列表中第一个上传的文件的路径
//            _editor.addListener('afterUpfile', function (t, arg) {
//                for(var i=0;i<arg.length;i++){
//                    document.getElementById('div2').innerHTML+="<input style='border:none;width: 360px' " +
//                        "type='text' name='Xxjxgl[title_content][]' value='"+arg[i].url+"'/><br/>";
//                }
//            })
//        });

        $('#btn').click(function(){
           // var myImage = _editor.getDialog("insertimage");
           var myImage = _editor.getDialog("attachment");
            myImage.open();
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

    <script>
        $(function(){
            $(".btn-success").click(function(){
                var content = $("#xxjxgl-title_content").val();
                if(content == ''){
                    alert('相关法律法规不能为空！');
                    return false;
                }
            })
        })
    </script>