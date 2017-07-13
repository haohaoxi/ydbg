<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\wages\models\WagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Wages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Wages'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'time',
            'dwbh',
            'number',
            'name',
            // 'yfgz',
            // 'zwdjgz',
            // 'jbgz',
            // 'jcgz',
            // 'gjhljt',
            // 'jxjt',
            // 'gzjt',
            // 'shbt',
            // 'gwjt',
            // 'zwjt',
            // 'dqjt',
            // 'kqj',
            // 'hyxjt',
            // 'tzbt',
            // 'blgz',
            // 'fdgz',
            // 'qtyf',
            // 'ycxbk',
            // 'dkje',
            // 'zfgjj',
            // 'ylaobxj',
            // 'sybxj',
            // 'ylbxj',
            // 'grsds',
            // 'sdf',
            // 'fz',
            // 'qtdk',
            // 'sfgz',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
