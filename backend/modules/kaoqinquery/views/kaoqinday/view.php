<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\kaoqinquery\models\KaoqinDay */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kaoqin Days', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kaoqin-day-view">

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
            'username',
            'kq_time',
            'weekday',
            'shangban_type',
            'shuaka_time1',
            'shuaka_time2',
            'yingkq_minutes',
            'yingkq_hours',
            'yingkq_days',
            'shicq_minutes',
            'shicq_hours',
            'shicq_days',
            'kg_minutes',
            'qj_minutes',
            'qj_hours',
        ],
    ]) ?>

</div>
