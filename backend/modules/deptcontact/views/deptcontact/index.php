<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\functions\functions;
?>
<div class="boxer">
    <div class="default-table">
        <div class="jg-top">
            <span>福州市闽侯县人民检察院</span>
            <?= Html::a(Yii::t('app', '<i></i>新增机构'), ['create'], ['class' => '']) ?>

        </div>
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
                ['attribute'=>'dept_name','headerOptions' => ['width' => '20%']],
                ['attribute'=>'dept_type','headerOptions' => ['width' => '20%']],
                ['attribute'=>'principal_text','headerOptions' => ['width' => '10%']],
                ['attribute'=>'branch_leader_text','headerOptions' => ['width' => '10%']],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'headerOptions' => ['width' => '15%'],
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('查看', Yii::$app->urlManager->createUrl(['deptcontact/deptcontact/update','id'=>$model->id,'look_type'=>'view']), [
                                'title' => Yii::t('yii', '查看'),
                                'class' => '',
                                'data-pjax' => '0',
                            ]);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('修改', Yii::$app->urlManager->createUrl(['deptcontact/deptcontact/update','id'=>$model->id]), [
                                'title' => Yii::t('yii', '修改'),
                                'class' => '',
                                'data-pjax' => '0',
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            $user_num = functions::findPeople($model['id']);
                            if($user_num >0) {
                                return Html::a('删除', Yii::$app->urlManager->createUrl(['deptcontact/deptcontact/delete','id'=>$model->id,'num'=>$user_num]), [
                                    'title' => Yii::t('yii', '删除'),
                                    'class' => '',
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ]);
                                    }
                                else{
                                    return Html::a('删除', Yii::$app->urlManager->createUrl(['deptcontact/deptcontact/delete','id'=>$model->id,'num'=>0]), [
                                        'title' => Yii::t('yii', '删除'),
                                        'data-confirm' => Yii::t('yii', '确定要删除该机构所有信息吗?'),
                                        'class' => '',
                                        'data-method' => 'post',
                                        'data-pjax' => '0',
                                    ]);
                                    }
                            }
                    ],
                ],
            ],
        ]); ?>
    </div>
    <div class="default-page  xinqi-page">
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
