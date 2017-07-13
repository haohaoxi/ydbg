<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\deptcontact\models\Deptcontact */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Deptcontact',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Deptcontacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="deptcontact-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>