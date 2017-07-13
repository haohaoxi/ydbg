<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\studysj\models\StudysjSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Studysjs';
$this->params['breadcrumbs'][] = $this->title;

?>
<link href="css/ydbg/inside.css" type="text/css" rel="stylesheet" />
<div class="boxer">
<div class="studysj-index">
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="default-table user-table study-table">
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
            'name',
            'start_time',
             'end_time',
            ['attribute'=>'status','format'=>'html' ,'headerOptions' => ['width' => '7%'],'filter'=>false,'value'=>function($data,$searchModel)
            {
                $start_time = strtotime($data['start_time']);
                $end_time = strtotime($data['end_time']);
                $datas =strtotime(date("Y-m-d",time()));
                if($start_time > $datas){
                    $data['status'] = 0;
                }else if ($start_time <= $datas && $end_time >= $datas ){
                    $data['status'] = 1;
                }else if ( $end_time < $datas ){
                    $data['status'] = 2;
                }else if($start_time <=$datas){
                    $data['status'] = 1;
                }
                \backend\modules\studysj\models\Studysj::updateAll(['status'=>$data['status']],['id'=>$data['id']]);
                if($data['status']==0){
                   return '<span class="wei">未开始</span>';
                }
                elseif($data['status']==1){
                    return '<span class="do">进行中</span>';
                }else{
                    return '<span class="end">已结束</span>';
                }

            }],
             'user',
            // 'offen',
            // 'questions',
            // 'p_id',

            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'headerOptions' =>['width' => '12%'],
                'template' => '{view} {delete}',
                'buttons' => [

                    'delete' => function ($url, $model, $key) {
                        if($model->status !==1){
                        return Html::a('删除', Yii::$app->urlManager->createUrl(['studysj/studysj/delete','id'=>$model->id]), [
                            'title' => Yii::t('yii', '删除'),
                            'data-confirm' => Yii::t('yii', '确定删除?'),
                            'class' => '',
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                        }else{
                         return Html::a("删除", null,[
                            'title'=> Yii::t('yii','删除'),
                             'style'=>'color:#cccccc;text-decoration:none',
                         ]);
                        }
                    },

                    'view' => function ($url, $model, $key) {
                        return Html::a('查看', Yii::$app->urlManager->createUrl(['studysj/studysj/view','id'=>$model->id]), [
                            'title' => Yii::t('yii', '查看'),
                            'data-pjax' => '0',
                        ]);
                    },
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
</div>

