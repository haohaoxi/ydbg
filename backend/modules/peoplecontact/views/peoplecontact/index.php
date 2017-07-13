<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\peoplecontact\models\PeopleContact;
use backend\functions\functions;
use backend\modules\position\models\Position;
?>
<div class="boxer">

    <?php  echo $this->render('_search', [
        'model' => $searchModel,
        'list'=>$list,
    ]); ?>
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
            'username',
            ['attribute'=>'dept_id','headerOptions' => ['width' => '12%'],'value'=>function($model){
                $dept_id = PeopleContact::getDeptId($model['id']);
                return PeopleContact::getdeptname($dept_id);
            }],
            ['attribute'=>'position','headerOptions' => ['width' => '12%'],'value'=>function($model){
                if(!$model->position) return false;
                $posi_id = PeopleContact::getPositionId($model['id']);
                return Position::getZhiwu($posi_id);
            }],
            'telphone',
             'wxone',
             'wxtwo',
             'inline',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'headerOptions' => ['width' => '15%'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('查看', Yii::$app->urlManager->createUrl(['peoplecontact/peoplecontact/update','id'=>$model->id,'look_type'=>'view']), [
                            'title' => Yii::t('yii', '查看'),
                            'class' => '',
                            'data-pjax' => '0',
                        ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('修改', Yii::$app->urlManager->createUrl(['peoplecontact/peoplecontact/update','id'=>$model->id]), [
                            'title' => Yii::t('yii', '修改'),
                            'class' => '',
                            'data-pjax' => '0',
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', Yii::$app->urlManager->createUrl(['peoplecontact/peoplecontact/delete','id'=>$model->id]), [
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
