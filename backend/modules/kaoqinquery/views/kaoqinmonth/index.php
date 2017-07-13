<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\kaoqinquery\models\KaoqinmonthSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kaoqin Months';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boxer">
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="default-table">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{items}",
        'filterPosition'=>false,
        'options' => ['class' => ''],/*外部div样式*/
        'tableOptions' => ['width' => '100%','border'=>"0",'cellspacing'=>"1",'cellpadding'=>"0"],/*整体table样式*/
        'filterRowOptions'=> ['class' => ''],/*tr 头部样式*/
        'filterErrorSummaryOptions'=> ['class' => ''],
        'filterErrorOptions'=> ['class' => ''],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header' => '序号','headerOptions' => ['width' => '5%'] ],
            'deptname',
            'worker_no',
            'card_no',
            'username',
             'kq_time',
             'ycq_hours',
             'ycq_days',
             'scq_hours',
             'scq_days',
             'kg_hours',
             'kg_days',
             'total_workhours',
             'total_workdays',
             'delay_times',
             'zt_times',
             'delay_minutes',
             'zt_minutes',
             'shij_days',
             'sick_days',
             'tiaoxiu_days',
             'gc_days',
             'yxnj_days',
        ],
    ]); ?>
    </div>
    <div class="default-page">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{pager}",
            'pager' => array(
                'firstPageCssClass'=>'first',
                'lastPageCssClass'=>'last',
                'prevPageCssClass'=>'prev',
                'nextPageCssClass'=>'next',
                'activePageCssClass'=>'active',
                'disabledPageCssClass'=>'',
                'nextPageLabel'=>'下一页',
                'prevPageLabel'=>'上一页',
                'firstPageLabel'=>'首页',
                'lastPageLabel'=>'末页',
                'hideOnSinglePage'=>true,
                'options'=>['class' => 'pagination']
            ),
        ]) ?>
    </div>
</div>
