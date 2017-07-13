<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\studyjl\models\Studyjl */

$this->title = 'Update Studyjl: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Studyjls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="studyjl-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
