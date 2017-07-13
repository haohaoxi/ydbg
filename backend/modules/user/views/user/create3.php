<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use \backend\modules\role\models\Role;
use \backend\functions\functions;
use backend\functions\api;
?>
<?=Html::cssFile('@web/css/ydbg/person.css')?>
<div class="boxer">
    <div class="default-form">
        <strong>【新建账号】</strong>
        <span>账号</span><div><input type="text" class="q" placeholder="" /></div><br class="clr" />
        <span>工号</span><div><input type="text" class="q" placeholder="" /></div><br class="clr" />
        <span>人员编号</span><div><input type="text" class="q" placeholder="" /></div><br class="clr" />
        <span>所属机构</span><div class="spec"><select><option></option></select></div><br class="clr" />
        <span>行政职务</span><div class="spec"><select><option></option></select></div><br class="clr" />
        <span>角色</span><div><input type="text" class="q" placeholder="" /></div><br class="clr" />
        <span>密码</span><div><input type="text" class="q" placeholder="" /></div><br class="clr" />
        <?= Html::input('reset','','重置', ['class' => 'btn']) ?>
        <?= Html::input('submit','','存档', ['class' => 'btn']) ?>
        <br class="clr" />

    </div>
</div>