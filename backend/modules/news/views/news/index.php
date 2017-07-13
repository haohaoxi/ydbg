<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\news\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boxer">
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="default-table user-table">

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
            ['class' => 'yii\grid\SerialColumn','header'=>'序号','headerOptions'=>['width'=>'5%']],
            ['attribute'=>'title','header'=>'新闻标题','headerOptions' => ['width' => '45%'],],
            ['attribute'=>'pubdate','header'=>'发布时间','headerOptions' => ['width' => '25%'],],
            ['attribute'=>'author','header'=>'发布人','headerOptions' => ['width' => '10%'],],
            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'headerOptions' => ['width' => '15%'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('查看', Yii::$app->urlManager->createUrl(['news/news/update','id'=>$model->id ,'look_type'=>'view']), [
                            'title' => Yii::t('yii', '查看'),
                            'class' => '',
                            'data-pjax' => '0',
                        ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('修改', Yii::$app->urlManager->createUrl(['news/news/update','id'=>$model->id , 'look' => 'update']), [
                            'title' => Yii::t('yii', '修改'),
                            'class' => '',
                            'data-pjax' => '0',
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', Yii::$app->urlManager->createUrl(['news/news/delete','id'=>$model->id]), [
                            'title' => Yii::t('yii', '删除'),
                            'data-confirm' => Yii::t('yii', '确定删除?'),
                            'class' => '',
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    },
                ],
            ],
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
