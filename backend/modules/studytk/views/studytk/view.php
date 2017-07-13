<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\xxjxgl\models\Xxjxgl */
/* @var $form yii\widgets\ActiveForm */
$tions = json_decode($model->tions,1);
?>
<div class="boxer">
                <?php $form = ActiveForm::begin([
                    'method'=>'post',
                    'options'=>['enctype'=>'multipart/form-data'],
                    'fieldConfig' => [
                        'template' => "{input}{error}",
                    ]
                ]); ?>
                    <div class="tk-add">
                        <ul>
                            <li class="th">【查看考题】</li>
                            <li><span>题型</span><div class="r">
                                    <?= $form->field($model, 'type')->dropDownList(['1'=>'单选题','2'=>'多选题','3'=>'文字题'],['placeholder'=>'','disabled'=>true   ]) ?>
                                </div>
                                <br class="clr">
                            </li>
                            <li class="li-area"><span><i>*</i>题目</span><div class="r"> <?= $form->field($model, 'name')->textarea(['maxlength' => true,'class'=>'area','readOnly'=>true]) ?></div>
                                <br class="clr">
                            </li>
                            <li  class="li-radio"><span><i>*</i>选项</span>
                                <div class="r">
                                    <?php for($i=65;$i<69;$i++){?>
                                        <label for="daan" style="float: left;margin-right: 5px">
                                            <input type="radio" name="daan" disabled="disabled" class="rad" value="<?= chr($i);?>"
                                            <?= $model->daan == chr($i) ? 'checked="checked"': '1'; ?>"><?= chr($i);?>
                                        </label>
                                        <input style="float: left;width: 680px" type="text" disabled="disabled" name="tions[<?= chr($i);?>]"
                                               value="<?= isset($tions[chr($i)]) ? $tions[chr($i)] :''; ?>">
                                        <br class="clr"/>
                                    <?php }?>

                                </div>
                                <br class="clr">
                            </li>
                            <li class="li-area"><span><i>*</i>解析</span><div class="r">
                                    <?= $form->field($model, 'jiexi')->textarea(['maxlength' => true,'class'=>'area','readOnly'=>true]) ?></div>
                                <br class="clr">
                            </li>
                        </ul>
                        <div class="btn">
                            <a href="/index.php?r=studytk%2Fstudytk%2Findex">返回</a>
                        </div>
                    </div>
                </div>
