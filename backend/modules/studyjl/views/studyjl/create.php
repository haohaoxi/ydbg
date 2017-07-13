<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\studyjl\models\Studyjl */

$this->title = 'Create Studyjl';
$this->params['breadcrumbs'][] = ['label' => 'Studyjls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="studyjl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
