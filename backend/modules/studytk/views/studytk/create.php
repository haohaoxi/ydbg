<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\studytk\models\Studytk */

$this->title = 'Create Studytk';
$this->params['breadcrumbs'][] = ['label' => 'Studytks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="studytk-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
