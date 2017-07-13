<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\gongchu\models\Gongchu */

$this->title = 'Create Gongchu';
$this->params['breadcrumbs'][] = ['label' => 'Gongchus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'deptUsers'=>$deptUsers,
        'deptAuditors'=>$deptAuditors,
        'model' => $model,
    ]) ?>
