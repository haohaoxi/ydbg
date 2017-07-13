<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\welfareapply\models\Welfareapply */

$this->title = Yii::t('app', 'Create Welfareapply');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Welfareapplies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="welfareapply-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
