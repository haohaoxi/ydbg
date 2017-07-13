<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\qingjia\models\Qingjia */

$this->title = 'Create Qingjia';
$this->params['breadcrumbs'][] = ['label' => 'Qingjias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qingjia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
