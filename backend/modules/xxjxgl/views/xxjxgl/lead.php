<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<style>
    h3{text-align: center}
    .file{text-align: center}
    .but{text-align: center}
</style>
<div>
    <h3>导入excel文件</h3>
    <div class="arrest-cases-index">

        <?php $form = ActiveForm::begin([
            'action' =>'index.php?r=xxjxgl%2Fxxjxgl%2Flead',
            'method'=>'post',
            'options'=>['enctype'=>'multipart/form-data'],
        ]); ?>

        <div class="file">

            <?= $form->field($model, 'fujian')->fileInput(['id'=>'upload'])->span('上传文件：') ?><br>

            <span>只允许上传(doc、pdf格式，10M内)类型文件</span>
        </div>

        <div class="but">
            <br>
            <?= Html::input('submit','dosubmit','确定',['class' =>'btn btn-success' ,'id'=>'sub' ]) ?>
            <?= Html::input('button','','关闭',['class'=> 'btn btn-success','onclick'=>'javascript:window.close()'])?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>