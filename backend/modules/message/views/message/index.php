<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \backend\modules\user\models\User;
use \backend\modules\message\models\message;
?>
<?=Html::cssFile('@web/css/ydbg/add.css')?>
<div class="message-box">
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
                ['class' => 'yii\grid\SerialColumn','header'=>'序号','headerOptions' => ['width' => '5%']],
                ['label'=>'消息类型','attribute'=>'type','headerOptions' => ['width' => '20%']],
                ['label'=>'消息内容','attribute'=>'contet','headerOptions' => ['width' => '30%']],
                ['label'=>'发送人','attribute'=>'fsr','headerOptions' => ['width' => '10%'],'value'=>function($data){
                    if($data['fsr'] == '') return '未知人员';
                    $name = User::getNames($data['fsr']);
                    if(!isset($name[0]['name'])) return '未知人员';
                    return $name[0]['name'];
                }],
                ['label'=>'发送时间','attribute'=>'time','headerOptions' => ['width' => '10%']],
                ['label'=>'状态','attribute'=>'is_reader','headerOptions' => ['width' => '10%'],'format' => 'html','value'=>function($data){
                   if($data['is_reader'] == '未读'){
                       return "<font color='red'>未读</font>";
                   }else{
                       return "<font color='green'>已读</font>";
                   }
                }],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'headerOptions' => ['width' => '12%'],
                    'template' => '{view} {delete} {yd}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            $url = json_decode($model->url,1);
                            $url['m_id'] = $model->id;
                            return Html::a('查看', Yii::$app->urlManager->createUrl($url), [
                                'title' => Yii::t('yii', '查看'),
                                'data-pjax' => '0',
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('删除', Yii::$app->urlManager->createUrl(['message/message/delete','id'=>$model->id]), [
                                'title' => Yii::t('yii', '删除'),
                                'data-confirm' => Yii::t('yii', '确定删除?'),
                                'class' => '',
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ]);
                        },
                        'yd' => function ($url, $model, $key) {
                            if($model->is_reader == '未读'){
                                return Html::a('设为已读', Yii::$app->urlManager->createUrl(['message/message/yd','id'=>$model->id]), [
                                    'title' => Yii::t('yii', '设为已读'),
                                    'data-confirm' => Yii::t('yii', '确定设为已读?'),
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