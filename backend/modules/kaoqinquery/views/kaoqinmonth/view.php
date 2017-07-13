<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\kaoqinquery\models\KaoqinMonth */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kaoqin Months', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kaoqin-month-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'deptname',
            'worker_no',
            'card_no',
            'username',
            'kq_time',
            'ycq_hours',
            'ycq_days',
            'scq_hours',
            'scq_days',
            'kg_hours',
            'kg_days',
            'total_workhours',
            'total_workdays',
            'delay_times:datetime',
            'zt_times:datetime',
            'delay_minutes',
            'zt_minutes',
            'shij_days',
            'sick_days',
            'tiaoxiu_days',
            'gc_days',
            'yxnj_days',
        ],
    ]) ?>

</div>
