<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\kaoqinquery\models\KaoqinMonth */

$this->title = 'Update Kaoqin Month: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kaoqin Months', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kaoqin-month-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
