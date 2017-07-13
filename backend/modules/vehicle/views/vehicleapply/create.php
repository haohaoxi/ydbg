<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\VehicleApply */

$this->title = 'Create Vehicle Apply';
$this->params['breadcrumbs'][] = ['label' => 'Vehicle Applies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <?= $this->render('_form', [
        'deptUsers'=>$deptUsers,
        'deptAuditors'=>$deptAuditors,
        'model' => $model,
    ]) ?>

