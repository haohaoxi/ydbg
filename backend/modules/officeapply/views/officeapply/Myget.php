<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \backend\modules\user\models\User;
use \backend\modules\deptcontact\models\DeptContact;
use \backend\modules\officeapply\models\OfficeApply;
$user_id = Yii::$app->user->identity->id;
?>
<?=Html::cssFile('@web/css/ydbg/inside.css')?>
<div class="boxer">
    <?php echo $this->render('_search_myget', ['model' => $searchModel]); ?>
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
                ['label'=>'办公用品名称','attribute'=>'apply_office_name','headerOptions' => ['width' => '10%'],'value'=>function($data){
                    return $data['apply_office_name'];
                }],
                ['label'=>'申请人','attribute'=>'apply_mee_id','headerOptions' => ['width' => '10%'],'value'=>function($data){
                    $data = User::getNames($data['apply_mee_id']);
                    if(!isset($data[0]['name'])) return '未知人员';
                    return $data[0]['name'];
                }],
                ['label'=>'科室','attribute'=>'apply_department','headerOptions' => ['width' => '10%'],'value'=>function($data){
                    $data = DeptContact::getDeptOne($data['apply_department']);
                    if(!isset($data[0]['name'])) return '未知人员';
                    return $data['dept_name'];
                }],
                ['label'=>'申请日期','attribute'=>'apply_sq_time','headerOptions' => ['width' => '10%']],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'headerOptions' => ['width' => '12%'],
                    'template' => '{lingqu}',
                    'buttons' => [
                        'lingqu' => function ($url, $model, $key) {
                            if($model->apply_lq_status == '未领取'){
                                return Html::a('领取', Yii::$app->urlManager->createUrl(['officeapply/officeapply/lingqu','id'=>$model->apply_id]), [
                                    'title' => Yii::t('yii', '领取'),
                                    'data-confirm' => Yii::t('yii', '确定领取?'),
                                    'data-pjax' => '0',
                                ]);
                            }else{
                                return '<a style="text-decoration: none;color: #cccccc">已领取</a>';
                            }
                        }
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