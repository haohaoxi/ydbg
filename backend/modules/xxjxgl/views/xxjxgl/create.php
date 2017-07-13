<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\xxjxgl\models\Xxjxgl */

$this->title = 'Create Xxjxgl';
$this->params['breadcrumbs'][] = ['label' => 'Xxjxgls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xxjxgl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
