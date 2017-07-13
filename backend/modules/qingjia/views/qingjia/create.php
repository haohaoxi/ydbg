<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\qingjia\models\Qingjia */

$this->title = 'Create Qingjia';
$this->params['breadcrumbs'][] = ['label' => 'Qingjias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <?= $this->render('_form', [
    'deptUsers'=>$deptUsers,
    'deptAuditors'=>$deptAuditors,
        'qingjiaType'=>$qingjiaType,
        'model' => $model,
    ]) ?>
