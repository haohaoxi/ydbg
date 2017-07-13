<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\gongchu\models\Gongchu;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\vehicle\models\AuditSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vehicle Applies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boxer">

    <?php  echo $this->render('_search', ['model' => $searchModel,'depts'=> $depts]); ?>
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
                ['attribute'=>'v_user','value'=>function($model){
                    return Gongchu::getUserNamesByIds($model->v_user);
                }],
                'driver',
                ['attribute'=>'use_time','value'=>function($model){
                    return substr($model->use_time,0,-3);
                }],
                ['attribute'=>'return_time','value'=>function($model){
                    return substr($model->return_time,0,-3);
                }],
                'v_license',
                'quxiang',
                ['attribute'=>'branch_audit','value'=>function($model){
                    if($model->dept_leader==$model->branch_leader && ($model->dept_audit==2||$model->branch_audit==2)){//如果部门审核驳回，则申请人看到的是驳回
                        return Gongchu::getStatusByIdInAudit(2);
                    }elseif($model->dept_leader==Yii::$app->user->id && Yii::$app->user->id!=$model->branch_leader){//如果部门审核驳回，则申请人看到的是驳回
                        return Gongchu::getStatusByIdInAudit($model->dept_audit);//部门审核人员看到当前的状态
                    }else{
                        return Gongchu::getStatusByIdInAudit($model->branch_audit);
                    }
                }],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'headerOptions' => ['width' => '15%'],
                    'template' => '{view} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            if($model->dept_leader==Yii::$app->user->id && $model->dept_audit==0){
                                return Html::a('审批', Yii::$app->urlManager->createUrl(['/vehicle/audit/update','id'=>$model->id,'type'=>'dept']), [
                                    'title' => Yii::t('yii', '审批'),
                                    'class' => '',
                                    'data-pjax' => '0',
                                ]);
                            }elseif($model->branch_leader==Yii::$app->user->id && $model->branch_audit==0 && $model->dept_audit==1){
                                return Html::a('审批', Yii::$app->urlManager->createUrl(['/vehicle/audit/update','id'=>$model->id,'type'=>'branch']), [
                                    'title' => Yii::t('yii', '审批'),
                                    'class' => '',
                                    'data-pjax' => '0',
                                ]);
                            }else{//其他状态查看
                                return Html::a('查看', Yii::$app->urlManager->createUrl(['/vehicle/audit/view','id'=>$model->id]), [
                                    'title' => Yii::t('yii', '查看'),
                                    'class' => '',
                                    'data-pjax' => '0',
                                ]);
                            }
                        },
                        'delete' => function ($url, $model, $key) {
                            if($model->dept_leader==Yii::$app->user->id && $model->dept_audit!=0 && $model->branch_leader!=Yii::$app->user->id){
                                //部门人员审核过的，可以删除
                                return Html::a('删除', Yii::$app->urlManager->createUrl(['/vehicle/audit/delete','id'=>$model->id,'type'=>'dept']), [
                                    'title' => Yii::t('yii', '删除'),
                                    'data-confirm' => Yii::t('yii', '确定删除?'),
                                    'class' => '',
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ]);
                            }elseif($model->dept_audit==2){
                                //部门人员审核过的，可以删除
                                return Html::a('删除', Yii::$app->urlManager->createUrl(['/vehicle/audit/delete','id'=>$model->id,'type'=>'dept']), [
                                    'title' => Yii::t('yii', '删除'),
                                    'data-confirm' => Yii::t('yii', '确定删除?'),
                                    'class' => '',
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ]);
                            }elseif($model->branch_leader==Yii::$app->user->id && $model->branch_audit!=0){
                                //院级审核过的，可以删除
                                return Html::a('删除', Yii::$app->urlManager->createUrl(['/vehicle/audit/delete','id'=>$model->id,'type'=>'branch']), [
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
