<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\News */

$this->title = 'Create News';
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boxer" style="width: 1700px; height: 711px;">
<div class="news-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
