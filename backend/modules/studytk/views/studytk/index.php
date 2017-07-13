<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\studytk\models\StudytkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
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
            ['class' => 'yii\grid\SerialColumn','header'=>'序号'],
//            'id',
            'name',
            'users',
            'time',
//            'tions',
            // 'daan',
            // 'jiexi:ntext',
            // 'type',

            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'headerOptions' =>['width' => '12%'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('修改', Yii::$app->urlManager->createUrl(['studytk/studytk/update','id'=>$model->id]), [
                            'title' => Yii::t('yii', '修改'),
                            'class' => '',
                            'data-pjax' => '0',
                        ]);
                    },

                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', Yii::$app->urlManager->createUrl(['studytk/studytk/delete','id'=>$model->id]), [
                            'title' => Yii::t('yii', '删除'),
                            'data-confirm' => Yii::t('yii', '确定删除?'),
                            'class' => '',
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    },
                    'view' => function ($url, $model, $key) {
                        return Html::a('查看', Yii::$app->urlManager->createUrl(['studytk/studytk/view','id'=>$model->id]), [
                            'title' => Yii::t('yii', '修改密码'),
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
