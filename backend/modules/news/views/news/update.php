<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\News */

$this->title = 'Update News: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="boxer">
<div class="news-update">

    <?= $this->render('_form', [
        'model' => $model,
        'name' => $name,
    ]) ?>

</div>
</div>
