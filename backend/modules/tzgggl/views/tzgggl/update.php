<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\tzgggl\models\Announcement */

$this->title = 'Update Announcement: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Announcements', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="boxer">
    <div class="announcement-update">
        <?= $this->render('_form', [
            'model' => $model,
            'name' => $name,
        ]) ?>

    </div>
</div>
