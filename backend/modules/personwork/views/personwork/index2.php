<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \backend\modules\user\models\RoleUser;
use \backend\modules\role\models\Role;
use \backend\functions\functions;
use \backend\modules\user\models\User;
?>
<div class="boxer">
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="default-table user-table">

    <?php if($_GET['menutype']==1){ ?>
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
                'p_id',
                'p_title',
                'p_s_time',
                'p_e_time',
                ['attribute'=>'p_level','headerOptions' => ['width' => '12%'],'format' => 'html','value'=>function($data){
                    $p_level = functions::getLevel($data['p_level']);
                    return $p_level == '紧急' ? '<font color="red">'.$p_level.'</font>' : $p_level;
                }],
                ['label'=>'受理人','attribute' =>'p_y_slr','headerOptions' => ['width' => '12%'],'value'=>function($data){
                    return $data['p_y_slr'] == '' ? '' : implode(',',array_column(User::getNames($data['p_y_slr']),'name'));
                }],
                ['label'=>'工作状态','attribute' =>'w_s_status','value'=>'personWorkWorkflow.w_s_status','headerOptions' => ['width' => '12%']],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'headerOptions' => ['width' => '12%'],
                    'template' => '{clsp}',
                    'buttons' => [
                        'clsp' => function ($url, $model, $key) {
                            return Html::a($model->personWorkWorkflow->w_s_status =='未受理' ? '受理' : '审批', Yii::$app->urlManager->createUrl(['personwork/personwork/'.($model->personWorkWorkflow->w_s_status =='未受理' ? 'sl' : 'sp'),'id'=>$model->p_id,'menutype'=>intval($_GET['menutype'])]), [
                                'title' => Yii::t('yii', $model->personWorkWorkflow->w_s_status =='未受理' ? '受理' : '审批'),
                                'class' => '',
                                'data-pjax' => '0',
                            ]);
                        }
                    ],
                ]
            ],
        ]); ?>
    <?php }elseif($_GET['menutype']==2){ ?>

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
            'p_id',
            'p_title',
            'p_s_time',
            'p_e_time',
            ['attribute'=>'p_level','headerOptions' => ['width' => '12%'],'format' => 'html','value'=>function($data){
                $p_level = functions::getLevel($data['p_level']);
                return $p_level == '紧急' ? '<font color="red">'.$p_level.'</font>' : $p_level;
            }],
            ['label'=>'原受理人','attribute' =>'p_y_slr','headerOptions' => ['width' => '12%'],'value'=>function($data){
                return $data['p_y_slr'] == '' ? '' : implode(',',array_column(User::getNames($data['p_y_slr']),'name'));
            }],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'headerOptions' => ['width' => '12%'],
                'template' => '{sl}',
                'buttons' => [
                    'sl' => function ($url, $model, $key) {
                        return Html::a('受理', Yii::$app->urlManager->createUrl(['personwork/personwork/sl','id'=>$model->p_id,'menutype'=>intval($_GET['menutype'])]), [
                            'title' => Yii::t('yii', '受理'),
                            'class' => '',
                            'data-pjax' => '0',
                        ]);
                    }
                ],
            ]
        ],
    ]); ?>

    <?php }elseif($_GET['menutype']==3){ ?>

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
                'p_id',
                'p_title',
                'p_s_time',
                'p_e_time',
                ['attribute'=>'p_level','headerOptions' => ['width' => '12%'],'format' => 'html','value'=>function($data){
                    $p_level = functions::getLevel($data['p_level']);
                    return $p_level == '紧急' ? '<font color="red">'.$p_level.'</font>' : $p_level;
                }],
                ['label'=>'受理人','attribute' =>'p_y_slr','headerOptions' => ['width' => '12%'],'value'=>function($data){
                    return $data['p_y_slr'] == '' ? '' : implode(',',array_column(User::getNames($data['p_y_slr']),'name'));
                }],
                ['label'=>'工作状态','attribute' =>'w_s_status','value'=>'personWorkWorkflow.w_s_status','headerOptions' => ['width' => '12%']],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'headerOptions' => ['width' => '12%'],
                    'template' => '{view}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('查看', Yii::$app->urlManager->createUrl(['personwork/personwork/view','id'=>$model->p_id,'menutype'=>intval($_GET['menutype'])]), [
                                'title' => Yii::t('yii', '查看'),
                                'class' => '',
                                'data-pjax' => '0',
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                                return Html::a('删除', Yii::$app->urlManager->createUrl(['personwork/personwork/delete','id'=>$model->p_id,'menutype'=>intval($_GET['menutype'])]), [
                                    'title' => Yii::t('yii', '删除'),
                                    'data-confirm' => Yii::t('yii', '确定删除?'),
                                    'class' => '',
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ]);
                        },
                    ],
                ]
            ],
        ]); ?>
    <?php }elseif($_GET['menutype']==4){ ?>

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
                'p_id',
                'p_title',
                'p_s_time',
                'p_e_time',
                ['attribute'=>'p_level','headerOptions' => ['width' => '12%'],'format' => 'html','value'=>function($data){
                    $p_level = functions::getLevel($data['p_level']);
                    return $p_level == '紧急' ? '<font color="red">'.$p_level.'</font>' : $p_level;
                }],
                ['label'=>'受理人','attribute' =>'p_y_slr','headerOptions' => ['width' => '12%'],'value'=>function($data){
                    return $data['p_y_slr'] == '' ? '' : implode(',',array_column(User::getNames($data['p_y_slr']),'name'));
                }],
                ['label'=>'工作状态','attribute' =>'w_s_status','value'=>'personWorkWorkflow.w_s_status','headerOptions' => ['width' => '12%']],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'headerOptions' => ['width' => '12%'],
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('查看', Yii::$app->urlManager->createUrl(['personwork/personwork/view','id'=>$model->p_id,'menutype'=>intval($_GET['menutype'])]), [
                                'title' => Yii::t('yii', '查看'),
                                'class' => '',
                                'data-pjax' => '0',
                            ]);
                        },
                    ],
                ]
            ],
        ]); ?>

    <?php }elseif($_GET['menutype']==5){ ?>

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
                'p_id',
                'p_title',
                'p_s_time',
                'p_e_time',
                ['attribute'=>'p_level','headerOptions' => ['width' => '12%'],'format' => 'html','value'=>function($data){
                    $p_level = functions::getLevel($data['p_level']);
                    return $p_level == '紧急' ? '<font color="red">'.$p_level.'</font>' : $p_level;
                }],
                ['label'=>'受理人','attribute' =>'p_y_slr','headerOptions' => ['width' => '12%'],'value'=>function($data){
                    return $data['p_y_slr'] == '' ? '' : implode(',',array_column(User::getNames($data['p_y_slr']),'name'));
                }],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'headerOptions' => ['width' => '12%'],
                    'template' => '{view} {cuiban} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('查看', Yii::$app->urlManager->createUrl(['personwork/personwork/view','id'=>$model->p_id,'menutype'=>intval($_GET['menutype'])]), [
                                'title' => Yii::t('yii', '查看'),
                                'class' => '',
                                'data-pjax' => '0',
                            ]);
                        },
                        'cuiban' => function ($url, $model, $key) {
                            return Html::a('催办', Yii::$app->urlManager->createUrl(['personwork/personwork/cuiban','id'=>$model->p_id,'menutype'=>intval($_GET['menutype'])]), [
                                'title' => Yii::t('yii', '催办'),
                                'data-confirm' => Yii::t('yii', '确定催办?'),
                                'class' => '',
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            if($model->personWorkWorkflow->w_e_time == ''){
                                return Html::a('删除', Yii::$app->urlManager->createUrl(['personwork/personwork/delete','id'=>$model->p_id,'menutype'=>intval($_GET['menutype'])]), [
                                    'title' => Yii::t('yii', '删除'),
                                    'data-confirm' => Yii::t('yii', '确定删除?'),
                                    'class' => '',
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ]);
                            }else{
                                return '删除';
                            }
                        },
                    ],
                ]
            ],
        ]); ?>
    <?php } ?>

    </div>

    <div class="default-page  xinqi-page">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{pager}",
            'pager' => array(
                'firstPageCssClass'=>'',
                'lastPageCssClass'=>'',
                'prevPageCssClass'=>'',
                'nextPageCssClass'=>'',
                'activePageCssClass'=>'on',
                'disabledPageCssClass'=>'',
                'nextPageLabel'=>'下一页',
                'prevPageLabel'=>'上一页',
                'firstPageLabel'=>'首页',
                'lastPageLabel'=>'末页',
                'hideOnSinglePage'=>true,
                'options'=>['class' => 'default-page']
            ),
        ]) ?>
    </div>
</div>

