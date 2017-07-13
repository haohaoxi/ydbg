<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\VehicleApply */

$this->title = 'Update Vehicle Apply: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vehicle Applies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('_form', [
    'model' => $model,
    'type'=>$_GET['type'],
]) ?>
