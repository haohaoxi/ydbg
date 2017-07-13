<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\VehicleApply */

$this->title = 'Create Vehicle Apply';
$this->params['breadcrumbs'][] = ['label' => 'Vehicle Applies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehicle-apply-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
