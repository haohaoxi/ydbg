<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\peoplecontact\models;
use backend\modules\peoplecontact\models\PeopleContact;
use backend\modules\position\models\Position;
?>
<?=Html::cssFile('@web/css/ydbg/add2.css')?>

<div class="staff-search">
    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'options' => ['class' => ''],
    'fieldConfig' => [
        'template' => "{span}{input}{error}",
        'inputOptions' => ['class' => 'q'],
    ]
]); ?>

    <?= $form->field($model, 'dept_id')->dropDownList($list,['prompt'=>'请选择'])->span('所属机构') ?>

    <?= $form->field($model, 'position')->dropDownList(Position::getZhiwu(),['prompt'=>'请选择'])->span('行政职务') ?>

    <?= $form->field($model, 'username')->span('人员姓名')  ?>


    <?= Html::a('批量导入','javascript:openWindow()', ['class' => 'btn'])?>
    <?= Html::a(Yii::t('app', '批量导出'), ['excel'], ['class' => 'btn']) ?>
    <?= Html::a('新增人员', ['create'], ['class' => 'btn']) ?>
    <?= Html::input('submit','','查询', ['class' => 'btn', 'style' => 'float:left']) ?>
    <?= Html::input('button','','重置', ['class' => 'btn','id'=>'butt', 'style' => 'float:left']) ?>


    <?php ActiveForm::end(); ?>
    <div class="clr"></div>

</div>
<script type="text/javascript">
    function openWindow(){
        window.open("index.php?r=peoplecontact/peoplecontact/import","","width=600,height=500,scrollbars=yes,toolbar=no,resizable=no,menubar=no,status=no");
    }
</script>
<script>
    $("#butt").click(function(){
        $("#peoplecontactsearch-username").attr("value","");
        $("#peoplecontactsearch-dept_id option:first").prop("selected", 'selected');
        $("#peoplecontactsearch-position option:first").prop("selected", 'selected');
    })
</script>