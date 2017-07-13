<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\chuchai\models\Chuchai */

$this->title = 'Create Chuchai';
$this->params['breadcrumbs'][] = ['label' => 'Chuchais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chuchai-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
