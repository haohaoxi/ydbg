<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\VehicleApply */

$this->title = 'Update Vehicle Apply: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vehicle Applies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vehicle-apply-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
