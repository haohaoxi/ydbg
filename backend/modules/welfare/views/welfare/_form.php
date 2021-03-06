<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\modules\welfare\models\Welfare;
?>
<?=Html::cssFile('@web/css/ydbg/inside.css')?>
<div class="boxer" id="boxer-zh">
    <?php $form = ActiveForm::begin(
        [
            'action'=>Yii::$app->urlManager->createUrl(['welfare/welfare/create']),
            'method' => 'post',
            'options' => ['class' => ''],
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'fieldConfig' => [
                'template' => "{input}{error}",//D:\wamp2\www\jsdt\vendor\yiisoft\yii2\helpers\BaseHtml.php 1222L
                'inputOptions' => ['class' => 'q'],
                'errorOptions'=>['class' => 'tishi'],

            ]
        ]
    ); ?>

    <div class="default-form baoxiao-form">
        <strong>【新增福利】</strong>
        <span><em>*</em>福利名称</span><div class="r"><?= $form->field($model, 'welfare_name')->textInput() ?></div><br class="clr">
        <span>福利类型</span><div class="r"><?= $form->field($model, 'welfare_type')->textInput() ?></div><br class="clr">
        <span><em>*</em>申请开始时间</span><div class="r">
            <?= $form->field($model, 'welfare_start_time')->textInput(['class'=>'q date']) ?>
            <script type="text/javascript">
                Calendar.setup({
                    weekNumbers: true,
                    inputField : "welfare-welfare_start_time",
                    trigger    : "welfare-welfare_start_time",
                    dateFormat: "%Y-%m-%d",
                    showTime: true,
                    minuteStep: 1,
                    onSelect   : function() {this.hide();}
                });
            </script></div>
        <br class="clr">
        <span>申请结束时间</span><div class="r">
            <?= $form->field($model, 'welfare_end_time')->textInput(['class'=>'q date']) ?>
            <script type="text/javascript">
                Calendar.setup({
                    weekNumbers: true,
                    inputField : "welfare-welfare_end_time",
                    trigger    : "welfare-welfare_end_time",
                    dateFormat: "%Y-%m-%d",
                    showTime: true,
                    minuteStep: 1,
                    onSelect   : function() {this.hide();}
                });
            </script></div>
        <br class="clr">
        <?php
        if($jigou != false){
            $id='';
            $name='';
        foreach($jigou as $key=>$value){
            $id = $id.$key.',';
            $name =$name.$value.',';
        }
        $ids=substr($id,-strlen($id),-1);
        $names=substr($name,-strlen($name),-1);
        }
        ?>
        <span style="height: 80px"><em>*</em>适用机构</span><div class="r" style="height: 80px"><?= $form->field($model, 'welfare_part_name')->textarea(['value'=>$names]) ?></div><br class="clr">
        <span><em>*</em>福利明细</span><div class="r"><?= $form->field($model, 'welfare_detail')->textInput() ?></div><br class="clr">
        <?=Html::a(Yii::t('app', '返回'), Yii::$app->urlManager->createUrl(['welfare/welfare/index']),['class' =>'btn yuqi-return','id'=>'back']);?>
        <?= Html::input('submit','','存档', ['class' => 'btn']) ?>
    </div>
    <div style="width: 0px;height: 0px;display: none">
        <?= $form->field($model, 'welfare_part_id')->textInput()->hiddenInput(['value'=>$ids]);?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script src="js/ydbg/artDialog/lib/sea.js"></script>
<script>
    seajs.config({
        alias: {
            "jquery": "jquery-1.10.2.js"
        }
    });
</script>
<script>
    seajs.use(['./js/ydbg/artDialog/src/dialog-plus'], function (dialog) {
        window.dialog = dialog;
    });
</script>

<script>
    window.console = window.console || {log:function () {}}

    //试用机构start
    var jigou = '<div>';
    <?php
        $getJigou = Welfare::getJigou();
        if($getJigou != false){
        foreach($getJigou as $key=>$value){
    ?>
    jigou += '<label for="ren<?= $value['id']; ?>"><input type="checkbox" id="ren<?= $value['id']; ?>" name="jigou[]" value="<?= $value['id']; ?>" attr_name="<?= $value['dept_name']; ?>" /><?= $value['dept_name']; ?></label>';
    <?php
         }
         }
    ?>
    jigou += '</div>';
    //试用机构end


    seajs.use(['jquery'], function ($) {
        $('.boxer').on('click','#welfare-welfare_part_name', function () {
            $('#welfare-welfare_part_name').val('');
            $('#welfare-welfare_part_id').val('');
            d = top.dialog({
                id: '',
                title: '选择机构',
                content: jigou,
                width: 550,
                height: 200,
                quickClose: true,
                button: [
                    {
                        value: '确定',
                        callback: function () {
                            var jigou_value =[];
                            var jigou_text_value =[];
                            $(':checkbox[name="jigou[]"]:checked').each(function(){
                                jigou_value.push($(this).val());
                                jigou_text_value.push($(this).attr('attr_name'));
                            });
                            if(jigou_value.length == 0){
                                alert('请选择机构');
                                return false;
                            }
                            $('#welfare-welfare_part_name').val(jigou_text_value);
                            $('#welfare-welfare_part_id').val(jigou_value);
                        }
                    }
                ],
                onshow: function () {
                    console.log('onshow');
                },
                oniframeload: function () {
                    console.log('oniframeload');
                },
                onclose: function () {
                    if (this.returnValue) {
                        /*这个地方是当弹框关闭的时候，可以获取从弹框返回的值，可用来刷新页面*/
                        //location.reload();
                    }
                },
                onremove: function () {
                    console.log('onremove');
                }
            });
            d.showModal();
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