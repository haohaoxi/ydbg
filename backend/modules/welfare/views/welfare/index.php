<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \backend\modules\deptcontact\models\DeptContact;
use \backend\modules\user\models\User;
use \backend\modules\welfare\models\welfare;
use backend\modules\welfareapply\models\WelfareApply;
$user_id = Yii::$app->user->identity->id;
?>
<?=Html::cssFile('@web/css/ydbg/inside.css')?>
<div class="boxer">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="default-table baoxiao-table fuli-table">
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
                    ['class' => 'yii\grid\SerialColumn','header'=>'序号','headerOptions' => ['width' => '5%']],
                    ['attribute'=>'welfare_name','headerOptions' => ['width' => '20%'],'value'=>function($data){
                        return $data['welfare_name'];
                    }],
                    ['label'=>'申请开始时间','attribute'=>'welfare_start_time','headerOptions' => ['width' => '20%']],
                    ['label'=>'申请结束时间','attribute'=>'welfare_end_time','headerOptions' => ['width' => '20%']],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => '操作',
                        'headerOptions' => ['width' => '12%'],
                        'template' => '{sq} {view} {update} {delete}',
                        'buttons' => [
                            'sq' => function ($url, $model, $key) {
                                if($data = WelfareApply::hasApply($model->welfare_id)){
                                    return '<a style="text-decoration: none;color: #cccccc">已申请</a>';
                                }else{
                                    if($model->welfare_end_time !=''){
                                        if(strtotime($model->welfare_end_time) < time()){//过期
                                            return '<a style="text-decoration: none;color: #cccccc">已过期</a>';
                                        }else{
                                            return Html::a('申请', Yii::$app->urlManager->createUrl(['welfare/welfare/sq','id'=>$model->welfare_id]), [
                                                'title' => Yii::t('yii', '申请'),
                                                'data-pjax' => '0',
                                            ]);
                                        }
                                    }else{
                                        return Html::a('申请', Yii::$app->urlManager->createUrl(['welfare/welfare/sq','id'=>$model->welfare_id]), [
                                            'title' => Yii::t('yii', '申请'),
                                            'data-pjax' => '0',
                                        ]);
                                    }
                                }
                            },
                            'view' => function ($url, $model, $key) {
                                return Html::a('查看', Yii::$app->urlManager->createUrl(['welfare/welfare/view','id'=>$model->welfare_id]), [
                                    'title' => Yii::t('yii', '查看'),
                                    'data-pjax' => '0',
                                ]);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a('修改', Yii::$app->urlManager->createUrl(['welfare/welfare/update','id'=>$model->welfare_id]), [
                                    'title' => Yii::t('yii', '修改'),
                                    'data-pjax' => '0',
                                ]);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('删除', Yii::$app->urlManager->createUrl(['welfare/welfare/delete','id'=>$model->welfare_id]), [
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