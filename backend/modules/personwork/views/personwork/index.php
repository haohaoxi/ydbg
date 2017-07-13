<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \backend\modules\user\models\RoleUser;
use \backend\modules\role\models\Role;
use \backend\functions\functions;
use \backend\modules\user\models\User;
?>
<?=Html::cssFile('@web/css/ydbg/person.css')?>
<div class="boxer">
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="default-table person-table">
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
                    ['class' => 'yii\grid\SerialColumn','header'=>'序号'],
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
                    ['label'=>'工作状态','attribute' =>'w_s_status','headerOptions' => ['width' => '12%'],'format' => 'html','value'=>function($data){
                        return '<span class="red">'.$data['personWorkWorkflow']['w_s_status'].'</span>';
                    }],
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
                    ['class' => 'yii\grid\SerialColumn','header'=>'序号'],
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
                    ['class' => 'yii\grid\SerialColumn','header'=>'序号'],
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
                    ['label'=>'工作状态','attribute' =>'w_e_status','headerOptions' => ['width' => '12%'],'format' => 'html','value'=>function($data){
                        $color = in_array($data['personWorkWorkflow']['w_e_status'],['退办','代办']) ? 'red' : 'blue';
                        return '<span class="'.$color.'">'.$data['personWorkWorkflow']['w_e_status'].'</span>';
                    }],
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
                                return Html::a('删除', Yii::$app->urlManager->createUrl(['personwork/personwork/deletefalse','id'=>$model->personWorkWorkflow->w_id,'menutype'=>intval($_GET['menutype'])]), [
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
                    ['class' => 'yii\grid\SerialColumn','header'=>'序号'],
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
                    ['label'=>'工作状态','attribute' =>'w_s_status','headerOptions' => ['width' => '12%'],'format' => 'html','value'=>function($data){
                        return '<span class="red">逾期</span>';
                    }],
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
                    ['class' => 'yii\grid\SerialColumn','header'=>'序号'],
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
                                if($model->p_e_time > date('Y-m-d H:i:s',time())){
                                //if($model->personWorkWorkflow->w_e_time != '' || $model->p_e_time < date('Y-m-d H:i:s',time())){
                                    return '<a style="text-decoration: none;color: #cccccc">删除</a>';
                                }else{
                                    return Html::a('删除', Yii::$app->urlManager->createUrl(['personwork/personwork/delete','id'=>$model->p_id,'menutype'=>intval($_GET['menutype'])]), [
                                        'title' => Yii::t('yii', '删除'),
                                        'data-confirm' => Yii::t('yii', '确定删除?'),
                                        'class' => '',
                                        'data-method' => 'post',
                                        'data-pjax' => '0',
                                    ]);
                                }
                            },
                        ],
                    ]
                ],
            ]); ?>
        <?php } ?>
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

