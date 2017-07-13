<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\xxjxgl\models\Xxjxgl */
/* @var $form yii\widgets\ActiveForm */
$content = json_decode($model->title_content);
?>
<link href="css/ydbg/common.css" type="text/css" rel="stylesheet" />
<link href="css/ydbg/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/ydbg/jquery.min.js"></script>
<script type="text/javascript" src="js/ydbg/common.js"></script>
<script type="text/javascript" src="js/ydbg/getdate.js"></script>
<script type="text/javascript" src="js/ydbg/jquery.placeholder.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ydbg/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ydbg/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ydbg/ueditor/lang/zh-cn/zh-cn.js"></script>
<div class="boxer" style="position: relative; zoom: 1;">
    <div class="study-table-view">
        <div class="xuexi-view">
            <strong>【新增案件案例】</strong>

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
            <span class="tie"><em>*</em>案件案例详情</span>
            <div class="study-r">
                <?php echo  $form->field($model, 'title')->textInput(['maxlength' => true,'class'=>'q','disabled'=>'disabled'])->label("") ?>
            </div><br class="clr" />
            <span class="tie">附件</span><div  class="uploads study-r">
                <?php if($model->fujian !=""){?>
                <?= Html::a($model->fujian,Yii::$app->urlManager->createUrl(['/xxjxgl/xxjxgl/down','id'=>$model->id]),
                        ['style'=>'color:blue;padding-top:40px;display:block;']) ?>
                <?php }else {?>
                    <?= "<span style='padding-top: 30px'>无数据</span>"?>
                <?php }?>
            </div>
            <br class="clr" />
            <span class="tie  study-tall">正文</span>
            <div  class="study-r study-tall_r">
                <div class="content">
                    <?php echo  $form->field($model, 'content')->textarea(['maxlength' => true,'id'=>'editor'])->label("") ?>
                </div>
            </div>
            <br class="clr" />
            <span class="tie">相关法律法规</span><div style="overflow: scroll"  class="uploads study-r">
                <?= Html::a($model->title_content,Yii::$app->urlManager->createUrl(['/xxjxgl/xxjxgl/downfiles','id'=>$model->id]),['style'=>'color:blue;display:block;padding:1px']); ?>
            </div>
            <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>
            <br class="clr">
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
    <script type="text/javascript">
        jQuery(function($){
            $(".news-show-r").on("click","a.upload",function(){
                $("input#upload").click();
            });
        });
        var ue = UE.getEditor('editor',{
            initialFrameWidth:'100%',
            initialFrameHeight:187,
            autoHeightEnabled:false
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
    //富文本框不可编辑
    setTimeout(function(){
        setDis();
    },2000);

    function setDis(){
        UE.getEditor('editor').setDisabled('fullscreen');
    }
</script>