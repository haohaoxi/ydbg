<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \backend\modules\deptcontact\models\DeptContact;
use \backend\modules\user\models\User;
use \backend\modules\office\models\office;
use backend\modules\officeapply\models\OfficeApply;
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
                ['label'=>'办公用品名称','attribute'=>'office_name','headerOptions' => ['width' => '20%']],
                ['label'=>'库存数量','attribute'=>'office_num','headerOptions' => ['width' => '10%']],
                ['label'=>'预计单价/元','attribute'=>'office_price','headerOptions' => ['width' => '10%']],
                ['label'=>'申请开始时间','attribute'=>'office_start_time','headerOptions' => ['width' => '10%']],
                ['label'=>'申请结束时间','attribute'=>'office_end_time','headerOptions' => ['width' => '10%']],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'headerOptions' => ['width' => '12%'],
                    'template' => '{sq} {view} {update} {delete}',
                    'buttons' => [
                        'sq' => function ($url, $model, $key) {
                            if($data = OfficeApply::hasApply($model->office_id)){
                                return '<a style="text-decoration: none;color: #cccccc">已申请</a>';
                            }else{
                                    if($model->office_end_time !='' && strtotime($model->office_end_time) < time()){//过期
                                        return '<a style="text-decoration: none;color: #cccccc">已过期</a>';
                                    }else{
                                        return Html::a('申请', Yii::$app->urlManager->createUrl(['office/office/sq','id'=>$model->office_id]), [
                                            'title' => Yii::t('yii', '申请'),
                                            'data-pjax' => '0',
                                        ]);
                                    }
                            }
                        },
                        'view' => function ($url, $model, $key) {
                            return Html::a('查看', Yii::$app->urlManager->createUrl(['office/office/view','id'=>$model->office_id]), [
                                'title' => Yii::t('yii', '查看'),
                                'data-pjax' => '0',
                            ]);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('修改', Yii::$app->urlManager->createUrl(['office/office/update','id'=>$model->office_id]), [
                                'title' => Yii::t('yii', '修改'),
                                'data-pjax' => '0',
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('删除', Yii::$app->urlManager->createUrl(['office/office/delete','id'=>$model->office_id]), [
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