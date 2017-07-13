<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\vehicle\models\VehicleType;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\vehicle\models\VehicleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vehicles';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="boxer">
    <?php echo $this->render('_search', ['model' => $searchModel,'vehicles'=>$vehicles]); ?>
    <div class="default-table">
        <?php $form = ActiveForm::begin([
            'action' => ['revehicle'],
            'method' => 'post',
        ]); ?>
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
                'v_usage',
                'dept',
                'v_license',
                 'regist_no',
                 ['attribute'=>'v_type','value'=>function($model){
                      return VehicleType::getVehicleNameById($model->v_type);
                 }],
                'xinghao',
                 'count',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'headerOptions' => ['width' => '15%'],
                    'template' => '{view} {apply} {delete} {revehicle}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('查看', Yii::$app->urlManager->createUrl(['/vehicle/vehicle/view','id'=>$model->id]), [
                                'title' => Yii::t('yii', '查看'),
                                'class' => '',
                                'data-pjax' => '0',
                            ]);
                        },
                        'apply' => function ($url, $model, $key) {
                            if($model->count!=0){
                                return Html::a('申请', Yii::$app->urlManager->createUrl(['/vehicle/vehicleapply/create','id'=>$model->id]), [
                                    'title' => Yii::t('yii', '申请'),
                                    'class' => '',
                                    'data-pjax' => '0',
                                ]);
                            }else{
                                return Html::a('申请',null,[
                                    'title' => Yii::t('yii', '申请'),
                                    'style' => 'color:#cccccc;text-decoration:none',
                                ]);
                            }

                        },
                        'delete' => function ($url, $model, $key) {
                            if($model->count!=0){
                                return Html::a('删除', Yii::$app->urlManager->createUrl(['/vehicle/vehicle/delete','id'=>$model->id]), [
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
                        'revehicle' => function ($url, $model, $key) {
                            if($model->count!=0){
                                return Html::a('还车',null,[
                                    'title' => Yii::t('yii', '还车'),
                                    'style' => 'color:#cccccc;text-decoration:none',
                                ]);
                            }else{
                                return Html::a('还车','#', [
                                    'title' => Yii::t('yii', '还车'),
//                                    'data-confirm' => Yii::t('yii', $model->xinghao.' 是否已还回车库?'),
                                    'onclick'=>'reVehicle("'.$model->xinghao.'",'.$model->id.')',
                                    'class' => '',
                                    'data-pjax' => '0',
                                ]);
                            }

                        },
                    ],
                ],
            ],
        ]); ?>
        <input type="hidden" name="revehicle" id="revehicle"/>
        <input type="hidden" name="vehicleid" id="vehicleid"/>
        <?php ActiveForm::end(); ?>
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
<script type="text/javascript">
    function reVehicle(xinghao,id){
        if(confirm(xinghao+' 是否已还回车库?')){
            $("#revehicle").val(1);
            $("#vehicleid").val(id);
            $("#w1").submit();
        }
    }
</script>