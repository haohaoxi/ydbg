<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\chuchai\models\Chuchai */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Chuchais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boxer" id="boxer-zh">
    <div class="default-form">
        <strong>【出差详情】</strong>
        <?= DetailView::widget([
            'template' => "<span><em>*</em>{label}</span><div><input type='text' class='q' value='{value}' disabled='disabled' /></div><br class='clr' />",
            'model' => $model,
            'attributes' => [
                'dept',
                'cc_ren:ntext',
                'cc_count',
                'apply_ren',
                'apply_time',
                'cc_date',
                'end_date',
                'cc_place',
                'cc_task:ntext',
                'cc_transporation',
                'dept_leader',
                'branch_leader',
                'chief',
            ],
        ]) ?>
        <?= Html::a('返回','#:;',['class'=>'btn','onclick'=>'goback();']) ?>
    </div>
</div>
<script type="text/javascript">
    function goback(){
        window.location.href='<?= Yii::$app->urlManager->createUrl('chuchai/chuchai/index');?>';
    }
</script>