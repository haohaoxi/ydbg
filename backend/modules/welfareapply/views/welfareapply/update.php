<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\welfareapply\models\Welfareapply */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Welfareapply',
]) . ' ' . $model->welfare_apply_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Welfareapplies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->welfare_apply_id, 'url' => ['view', 'id' => $model->welfare_apply_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="welfareapply-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
