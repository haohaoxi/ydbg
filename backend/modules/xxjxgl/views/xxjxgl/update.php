<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\xxjxgl\models\Xxjxgl */

$this->title = 'Update Xxjxgl: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Xxjxgls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="xxjxgl-update">
    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>
