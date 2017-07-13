<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\officeapply\models\Officeapply */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Officeapply',
]) . ' ' . $model->apply_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Officeapplies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->apply_id, 'url' => ['view', 'id' => $model->apply_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="officeapply-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
