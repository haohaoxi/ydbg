<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\chuchai\models\Chuchai */

$this->title = 'Create Chuchai';
$this->params['breadcrumbs'][] = ['label' => 'Chuchais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <?= $this->render('_form', [
        'deptUsers'=>$deptUsers,
        'deptAuditors'=>$deptAuditors,
        'model' => $model,
    ]) ?>

