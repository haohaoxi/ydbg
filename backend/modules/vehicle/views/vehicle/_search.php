<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\VehicleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="default-search car-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'fieldConfig' => [
            'template' => "{span}{input}{error}",
        ]
    ]); ?>

    <?= $form->field($model, 'v_type')->dropDownList($vehicles,['prompt'=>'选择车辆类型'])->span('车辆分类') ?>

    <input class="btn search" type="submit" value="查询" id="chaxun">
    <input class="btn" type="button" value="重置">
    <?= Html::a('批量导出', ['export'], ['class' => 'btn']) ?>
    <?= Html::a('批量导入', ['import'], ['class' => 'btn']) ?>
    <?= Html::a('新增车辆', ['create'], ['class' => 'btn']) ?>
    <div class="clr"></div>
    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    /* 重置筛选条件 */
    $(":button").click(function(){
        $("select:first option:first").attr("selected",true);//重置为默认
    })
</script>