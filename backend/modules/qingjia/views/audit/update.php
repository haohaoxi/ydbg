<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\qingjia\models\Qingjia */

$this->title = 'Update Qingjia: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Qingjias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('_form', [
    'model' => $model,
    'type'=>$_GET['type'],
]) ?>
