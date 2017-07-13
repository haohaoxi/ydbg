<?php
use yii\helpers\Html;
use yii\grid\GridView;
use backend\functions\functions;
use yii\widgets\ActiveForm;

$this->title = 'menu';
$this->params['breadcrumbs'][] = $this->title;
?>
<link href="/css/jsdt/common.css" type="text/css" rel="stylesheet" />
<link href="/css/jsdt/style.css" type="text/css" rel="stylesheet" />
<link href="/css/jsdt/common1.css" type="text/css" rel="stylesheet" />
<link href="/css/jsdt/style1.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/js/jsdt/jquery.min.js"></script>
<script type="text/javascript" src="/js/jsdt/common.js"></script>
<script type="text/javascript" src="/js/jsdt/getdate.js"></script>
<script type="text/javascript" src="/js/jsdt/jquery.placeholder.js"></script>
<div class="boxer">
<div style="width: 50%" class="default-table aj-table">
    <?php $form = ActiveForm::begin(); ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td></td>
            <td class="aj_tle">父级菜单：&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
                <?= html_entity_decode($form->field($model, 'parent_id')->dropDownList($list,['class'=>'q disabled' , 'style' => 'width:153px;height:30px;float:left'])->label("")); ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td class="aj_tle">菜单名称:&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class'=>'q disabled','style' => 'float:left'])->label("") ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td class="aj_tle">模块:&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
                <?= $form->field($model, 'module')->textInput(['maxlength' => true,'class'=>'q disabled','style' => 'float:left'])->label("") ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td class="aj_tle">控制器:&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
                <?= $form->field($model, 'controller')->textInput(['maxlength' => true,'class'=>'q disabled','style' => 'float:left'])->label("") ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td class="aj_tle">方法:&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
                <?= $form->field($model, 'action')->textInput(['maxlength' => true,'class'=>'q disabled','style' => 'float:left'])->label("") ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td class="aj_tle">参数:&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
                <?= $form->field($model, 'menutype')->textInput(['maxlength' => true,'class'=>'q disabled','style' => 'float:left'])->label("") ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td class="aj_tle">样式:&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
                <?= $form->field($model, 'class')->textInput(['maxlength' => true,'class'=>'q disabled','style' => 'float:left'])->label("") ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td class="aj_tle">是否显示:&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
                <?= $form->field($model, 'is_show')->dropDownList(functions::get_status(),['class'=>'q disabled' , 'style' => 'width:153px;height:30px;float:left'])->label(""); ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td class="aj_tle" style="width:">是否允许操作:&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
                <?= $form->field($model, 'is_run')->dropDownList(functions::get_status(),['class'=>'q disabled' , 'style' => 'width:153px;height:30px;float:left'])->label(""); ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td class="aj_tle">排序:&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
                <?= $form->field($model, 'order')->textInput(['class'=>'q disabled','style' => 'float:left'])->label("") ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <input type="submit" class="aj_page" value="提交" style ="float: left"/><br class="clr" />
            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>
</div>
</div>