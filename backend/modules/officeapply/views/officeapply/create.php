<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\officeapply\models\Officeapply */

$this->title = Yii::t('app', 'Create Officeapply');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Officeapplies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="officeapply-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
