<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\personworkworkflow\models\Personworkworkflow */

$this->title = Yii::t('app', 'Create Personworkworkflow');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personworkworkflows'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personworkworkflow-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
