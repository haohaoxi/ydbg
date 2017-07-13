<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\gongchu\models\Gongchu;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\gongchu\models\AuditSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gongchus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boxer">
    <?php echo $this->render('_search', ['model' => $searchModel,'depts'=> $depts]); ?>

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
                ['attribute'=>'jb_ren','value'=>function($model){
                    return Gongchu::getUserNamesByIds($model->jb_ren);
                }],
                ['attribute'=>'yuan_audit','value'=>function($model){
                    if($model->dept_leader==$model->yuan_leader && ($model->dept_audit==2||$model->yuan_audit==2)){//如果部门审核驳回，则申请人看到的是驳回
                      $model->yuan_audit=2;
                    }elseif(Yii::$app->user->id==$model->dept_leader && Yii::$app->user->id!=$model->yuan_leader){
                        $model->yuan_audit=$model->dept_audit;
                    }elseif(Yii::$app->user->id==$model->yuan_leader && Yii::$app->user->id==$model->jcz){
                        $model->yuan_audit=$model->jcz_audit;
                    }elseif(Yii::$app->user->id==$model->jcz){
                        $model->yuan_audit=$model->jcz_audit;
                    }
                    return Gongchu::getStatusByIdInAudit($model->yuan_audit);
                }],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'headerOptions' => ['width' => '15%'],
                    'template' => '{view} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            if($model->dept_leader==Yii::$app->user->id && $model->dept_audit==0){
                                return Html::a('审批', Yii::$app->urlManager->createUrl(['/gongchu/audit/update','id'=>$model->id,'type'=>'dept']), [
                                    'title' => Yii::t('yii', '审批'),
                                    'class' => '',
                                    'data-pjax' => '0',
                                ]);
                            }elseif($model->yuan_leader==Yii::$app->user->id && $model->yuan_audit==0){
                                return Html::a('审批', Yii::$app->urlManager->createUrl(['/gongchu/audit/update','id'=>$model->id,'type'=>'yuan']), [
                                    'title' => Yii::t('yii', '审批'),
                                    'class' => '',
                                    'data-pjax' => '0',
                                ]);
                            }elseif($model->jcz==Yii::$app->user->id && $model->jcz_audit==0){
                                return Html::a('审批', Yii::$app->urlManager->createUrl(['/gongchu/audit/update','id'=>$model->id,'type'=>'jcz']), [
                                    'title' => Yii::t('yii', '审批'),
                                    'class' => '',
                                    'data-pjax' => '0',
                                ]);
                            }else{//其他状态查看
                                return Html::a('查看', Yii::$app->urlManager->createUrl(['/gongchu/audit/view','id'=>$model->id]), [
                                    'title' => Yii::t('yii', '查看'),
                                    'class' => '',
                                    'data-pjax' => '0',
                                ]);
                            }
                        },
                        'delete' => function ($url, $model, $key) {
                            if($model->dept_leader==Yii::$app->user->id && $model->dept_audit!=0 && $model->yuan_leader!=Yii::$app->user->id){
                                //部门人员审核过的，可以删除
                                return Html::a('删除', Yii::$app->urlManager->createUrl(['/gongchu/audit/delete','id'=>$model->id,'type'=>'dept']), [
                                    'title' => Yii::t('yii', '删除'),
                                    'data-confirm' => Yii::t('yii', '确定删除?'),
                                    'class' => '',
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ]);
                            }elseif($model->yuan_leader==Yii::$app->user->id && $model->yuan_audit!=0 && $model->jcz!=Yii::$app->user->id){
                                //院级审核过的，可以删除
                                return Html::a('删除', Yii::$app->urlManager->createUrl(['/gongchu/audit/delete','id'=>$model->id,'type'=>'yuan']), [
                                    'title' => Yii::t('yii', '删除'),
                                    'data-confirm' => Yii::t('yii', '确定删除?'),
                                    'class' => '',
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ]);
                            }elseif($model->jcz==Yii::$app->user->id && $model->jcz_audit!=0){
                                //院级审核过的，可以删除
                                return Html::a('删除', Yii::$app->urlManager->createUrl(['/gongchu/audit/delete','id'=>$model->id,'type'=>'jcz']), [
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
