<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\personworkworkflow\models\PersonworkworkflowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Personworkworkflows');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personworkworkflow-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Personworkworkflow'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'w_p_id',
            'w_person_id',
            'w_s_time',
            'w_e_time',
            // 'w_s_status',
            // 'w_e_status',
            // 'w_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
