<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \backend\modules\user\models\User;
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
                ['attribute'=>'welfare_name','headerOptions' => ['width' => '10%'],'value'=>function($data){
                    return $data['welfare_name'];
                }],
                ['label'=>'申请人','attribute'=>'welfare_apply_mee_id','headerOptions' => ['width' => '10%'],'value'=>function($data){
                    $data = User::getNames($data['welfare_apply_mee_id']);
                    if(!isset($data[0]['name'])) return '未知人员';
                    return $data[0]['name'];
                }],
                ['label'=>'申请日期','attribute'=>'welfare_sq_time','headerOptions' => ['width' => '10%']],
                ['label'=>'领取日期','attribute'=>'welfare_lq_time','headerOptions' => ['width' => '10%']],
                ['label'=>'状态','attribute'=>'welfare_apply_pack_status','headerOptions' => ['width' => '10%']],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'headerOptions' => ['width' => '12%'],
                    'template' => '{view} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('查看', Yii::$app->urlManager->createUrl(['welfareapply/welfareapply/view','id'=>$model->welfare_apply_id]), [
                                'title' => Yii::t('yii', '查看'),
                                'data-pjax' => '0',
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            if($model->welfare_apply_pack_status == '审批中'){
                                return '<a style="text-decoration: none;color: #cccccc">删除</a>';
                            }else{
                                return Html::a('删除', Yii::$app->urlManager->createUrl(['welfareapply/welfareapply/delete','id'=>$model->welfare_apply_id]), [
                                    'title' => Yii::t('yii', '删除'),
                                    'data-confirm' => Yii::t('yii', '确定删除?'),
                                    'class' => '',
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ]);
                            }
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