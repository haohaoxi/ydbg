<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\studytk\models\Studytk */

$this->title = 'Update Studytk: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Studytks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="studytk-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
