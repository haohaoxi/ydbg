<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\studysj\models\Studysj */

$this->title = 'Create Studysj';
$this->params['breadcrumbs'][] = ['label' => 'Studysjs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="studysj-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
