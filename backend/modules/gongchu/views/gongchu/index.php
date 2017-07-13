<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\gongchu\models\Gongchu;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\gongchu\models\GongchuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gongchus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boxer">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
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
                ['attribute'=>'dept','value'=>function($model){
                    return Gongchu::getDeptNameById($model->dept);
                }],
                 ['attribute'=>'gc_ren','value'=>function($model){
                    return Gongchu::getUserNamesByIds($model->gc_ren);
                }],
                'gc_count',
                ['attribute'=>'gc_time','value'=>function($model){
                    return substr($model->gc_time,0,-3);
                }],
                ['attribute'=>'end_time','value'=>function($model){
                    return substr($model->end_time,0,-3);
                }],
                ['attribute'=>'yuan_audit','value'=>function($model){
                    if(!empty($model->jcz)){
                        if($model->dept_audit==2||$model->yuan_audit==2||$model->jcz_audit==2){//如果审核驳回，则申请人看到的是驳回
                            $model->yuan_audit=2;
                        }else{
                            $model->yuan_audit=$model->jcz_audit;
                        }
                    }else{
                        if($model->dept_audit==2){//如果部门审核驳回，则申请人看到的是驳回
                            $model->yuan_audit=2;
                        }
                    }
                    return Gongchu::getStatusById($model->yuan_audit);
                }],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'headerOptions' => ['width' => '15%'],
                    'template' => '{view} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('查看', Yii::$app->urlManager->createUrl(['/gongchu/gongchu/view','id'=>$model->id]), [
                                'title' => Yii::t('yii', '查看'),
                                'class' => '',
                                'data-pjax' => '0',
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            if($model->yuan_audit!=0){
                                return Html::a('删除', Yii::$app->urlManager->createUrl(['/gongchu/gongchu/delete','id'=>$model->id]), [
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

