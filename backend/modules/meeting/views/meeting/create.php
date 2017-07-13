<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\meeting\models\Meeting */

$this->title = 'Create Meeting';
$this->params['breadcrumbs'][] = ['label' => 'Meetings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <?= $this->render('_form', [
        'deptUsers'=>$deptUsers,
        'model' => $model,
    ]) ?>
