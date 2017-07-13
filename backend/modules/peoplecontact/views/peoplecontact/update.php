<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\peoplecontact\models\PeopleContact */

$this->title = 'Update People Contact: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'People Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="people-contact-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list'=>$list,
    ]) ?>

</div>
