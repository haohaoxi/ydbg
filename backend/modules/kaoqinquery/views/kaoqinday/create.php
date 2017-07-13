<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\kaoqinquery\models\KaoqinDay */

$this->title = 'Create Kaoqin Day';
$this->params['breadcrumbs'][] = ['label' => 'Kaoqin Days', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
