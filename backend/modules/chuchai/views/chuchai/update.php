<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\chuchai\models\Chuchai */

$this->title = 'Update Chuchai: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Chuchais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chuchai-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
