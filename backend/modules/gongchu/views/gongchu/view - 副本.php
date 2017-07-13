<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\gongchu\models\Gongchu */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gongchus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boxer" id="boxer-zh">
    <div class="default-form">
        <strong>【公出详情】</strong>
    <?= DetailView::widget([
        'model' => $model,
        'template' =>"<span><em>*</em>{label}</span><div><input type='text' class='q' value='{value}'/></div><br class='clr' />",
        'attributes' => [
            'dept',
            'gc_ren',
            'gc_count',
            'gc_time',
            'end_time',
            'gc_place',
            'ygwc:ntext',
            'jb_ren',
            'dept_leader',
//            ['attribute'=>'dept_leader','value'=>$model->dept_leader],
            'yuan_leader',
        ],
    ]) ?>
    <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>
</div>
    </div>
