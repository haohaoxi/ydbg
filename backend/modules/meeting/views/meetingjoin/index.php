<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\gongchu\models\Gongchu;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\meeting\models\MeetingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Meetings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boxer">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
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
                'subject',
                ['attribute'=>'start_time','format' => 'html','value'=>function($model){
                    $currT=strtotime(date('Y-m-d H:i:s',time()));
                    $startT=strtotime($model->start_time);
                    $endT=strtotime($model->end_time);
                    if($startT>$currT){
                        return substr($model->start_time,0,-3).' (未开始)';
                    }elseif($currT>$endT){
                        return substr($model->start_time,0,-3).' <font color="#cccccc">(已结束)</font>';
                    }else{
                        return substr($model->start_time,0,-3).' (进行中)';
                    }
                }],
                'place',
                'join_rens',
//                ['attribute'=>'join_ren','value'=>function($model){
//                        return Gongchu::getUserNamesByIds($model->join_ren);
//                }],
                ['attribute'=>'status','value'=>function($model){
                    return $model->status==1?'已查阅':'未查阅';
                }],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'headerOptions' => ['width' => '15%'],
                    'template' => '{view} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('查看', Yii::$app->urlManager->createUrl(['/meeting/meetingjoin/view','id'=>$model->id]), [
                                'title' => Yii::t('yii', '查看'),
                                'class' => '',
                                'data-pjax' => '0',
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            $currT=strtotime(date('Y-m-d H:i:s',time()));
                            $endT=strtotime($model->end_time);
                            if($currT > $endT){
                                return Html::a('删除', Yii::$app->urlManager->createUrl(['/meeting/meetingjoin/delete','id'=>$model->id]), [
                                    'title' => Yii::t('yii', '删除'),
                                    'data-confirm' => Yii::t('yii', '确定删除?'),
                                    'class' => '',
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ]);
                            }else{//其他状态不能删除
                                return Html::a('删除',null,[
                                    'title' => Yii::t('yii', '删除'),
                                    'style' => 'color:#cccccc;text-decoration:none',
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
