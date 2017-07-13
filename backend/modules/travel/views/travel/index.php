<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \backend\modules\deptcontact\models\DeptContact;
use \backend\modules\user\models\User;
use \backend\modules\travel\models\Travel;
$user_id = Yii::$app->user->identity->id;
?>
<div class="boxer">
    <?php echo $this->render('_search', ['model' => $searchModel,'type'=>$type]); ?>
    <div class="default-table">

    <?php
        if($type == 1){
    ?>
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
            ['label'=>'报销类型','attribute'=>'department','headerOptions' => ['width' => '10%'],'value'=>function(){
                return '差旅费报销';
            }],
            ['attribute'=>'department','headerOptions' => ['width' => '10%'],'value'=>function($data){
                $data = DeptContact::getDeptOne($data['department']);
                return $data['dept_name'];
            }],
            'time',
            'gj',
            ['attribute'=>'bxr','headerOptions' => ['width' => '10%'],'value'=>function($data){
                $data = User::getNames($data['bxr']);
                if(!isset($data[0]['name'])) return '未知人员';
                return $data[0]['name'];
            }],
            ['label'=>'状态','attribute'=>'zmr_rs','headerOptions' => ['width' => '10%'],'value'=>function($data){
                if($data['zmr_rs'] == 2 || $data['glkj_rs'] == 2 || $data['ldsp_rs'] == 2){
                    return '驳回';
                }
                if($data['zmr_rs'] == 1 && $data['glkj_rs'] == 1 && $data['ldsp_rs'] == 1){
                    return '同意';
                }
                return '审批中';
            }],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'headerOptions' => ['width' => '12%'],
                'template' => '{view} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('查看', Yii::$app->urlManager->createUrl(['travel/travel/view','id'=>$model->id]), [
                            'title' => Yii::t('yii', '查看'),
                            'data-pjax' => '0',
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        if(($model->zmr_rs == 2 || $model->glkj_rs == 2 || $model->ldsp_rs == 2) || ($model->zmr_rs == 1 && $model->glkj_rs == 1 && $model->ldsp_rs == 1)){
                            return Html::a('删除', Yii::$app->urlManager->createUrl(['travel/travel/delete','id'=>$model->id]), [
                                'title' => Yii::t('yii', '删除'),
                                'data-confirm' => Yii::t('yii', '确定删除?'),
                                'class' => '',
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ]);
                        }else{
                            return '<a style="text-decoration: none;color: #cccccc">删除</a>';
                        }
                    },
                ],
            ],
        ],
    ]); ?>

    <?php }elseif($type == 2){ ?>

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
                    ['label'=>'报销类型','attribute'=>'department','headerOptions' => ['width' => '10%'],'value'=>function(){
                        return '差旅费报销';
                    }],
                    ['attribute'=>'department','headerOptions' => ['width' => '10%'],'value'=>function($data){
                        $data = DeptContact::getDeptOne($data['department']);
                        return $data['dept_name'];
                    }],
                    'time',
                    'gj',
                    ['attribute'=>'bxr','headerOptions' => ['width' => '10%'],'value'=>function($data){
                        $data = User::getNames($data['bxr']);
                        if(!isset($data[0]['name'])) return '未知人员';
                        return $data[0]['name'];
                    }],
                    ['label'=>'状态','attribute'=>'zmr_rs','headerOptions' => ['width' => '10%'],'value'=>function($data){
                        $data = Travel::getDqStatus($data->id,Yii::$app->user->identity->id);
                        return $data['rs_text'];
                    }],
                    ['label'=>'当前权限','attribute'=>'bxr','headerOptions' => ['width' => '10%'],'value'=>function($data){
                        $data = Travel::getDqStatus($data->id,Yii::$app->user->identity->id);
                        return $data['sf'];
                    }],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => '操作',
                        'headerOptions' => ['width' => '12%'],
                        'template' => '{shenpi} {delete}',
                        'buttons' => [
                            'shenpi' => function ($url, $model, $key) {
                                $data = Travel::getDqStatus($model->id,Yii::$app->user->identity->id);
                                if($data['rs'] == 1 || $data['rs'] == 2){
                                    return Html::a('查看', Yii::$app->urlManager->createUrl(['travel/travel/spck','id'=>$model->id]), [
                                        'title' => Yii::t('yii', '查看'),
                                        'data-pjax' => '0',
                                    ]);
                                }else{
                                    return Html::a('审批', Yii::$app->urlManager->createUrl(['travel/travel/shenpi','id'=>$model->id]), [
                                        'title' => Yii::t('yii', '审批'),
                                        'data-pjax' => '0',
                                    ]);
                                }
                            },
                            'delete' => function ($url, $model, $key) {
                                $data = Travel::getDqStatus($model->id,Yii::$app->user->identity->id);
                                if($data['rs'] == 1 || $data['rs'] == 2){
                                    return Html::a('删除', Yii::$app->urlManager->createUrl(['travel/travel/spdelete','id'=>$model->id]), [
                                        'title' => Yii::t('yii', '删除'),
                                        'data-confirm' => Yii::t('yii', '确定删除?'),
                                        'class' => '',
                                        'data-method' => 'post',
                                        'data-pjax' => '0',
                                    ]);
                                }else{
                                    return '<a style="text-decoration: none;color: #cccccc">删除</a>';
                                }
                            },
                        ],
                    ],
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