<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\kaoqinquery\models\KaoqinMonth */

$this->title = 'Create Kaoqin Month';
$this->params['breadcrumbs'][] = ['label' => 'Kaoqin Months', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

