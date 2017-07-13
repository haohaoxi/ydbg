<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\studysj\models\Studysj */

$this->title = 'Update Studysj: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Studysjs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="studysj-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
