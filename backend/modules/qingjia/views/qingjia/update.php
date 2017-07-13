<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\qingjia\models\Qingjia */

$this->title = 'Update Qingjia: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Qingjias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="qingjia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
