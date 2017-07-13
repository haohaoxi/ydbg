<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\xxjxgl\models\XxjxglSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Xxjxgls';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="boxer">
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="default-table user-table">
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
            ['class' => 'yii\grid\SerialColumn','header'=>'序号','headerOptions' => ['width' => '7%']],
            ['label'=>'案件案例标题','attribute'=>'title','headerOptions' => ['width' => '20%'],'value'=>function($data){
    return mb_strwidth($data['title'], 'utf8')>40 ?  mb_strimwidth($data['title'], 0, 40, '...', 'utf8'):$data['title'];}],
            ['label'=>'相关法律法规','attribute'=>'title_content','format'=>'html','headerOptions' => ['width' => '20%']],
            ['label'=>'发布人','attribute'=>'name','headerOptions' => ['width' => '8%']],
            ['label'=>'发布日期','attribute'=>'xx_date','headerOptions' => ['width' => '20%']],
            ['class' => 'yii\grid\ActionColumn',
            'header' => '操作',
                'headerOptions' =>['width' => '12%'],
                'template' => '{view} {update} {delete} {deletes}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('修改', Yii::$app->urlManager->createUrl(['xxjxgl/xxjxgl/update','id'=>$model->id]), [
                            'title' => Yii::t('yii', '修改'),
                            'class' => '',
                            'data-pjax' => '0',
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', Yii::$app->urlManager->createUrl(['xxjxgl/xxjxgl/delete','id'=>$model->id]), [
                            'title' => Yii::t('yii', '删除'),
                            'data-confirm' => Yii::t('yii', '确定删除?'),
                            'class' => '',
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    },
                    'view' => function ($url, $model, $key) {
                        return Html::a('查看', Yii::$app->urlManager->createUrl(['xxjxgl/xxjxgl/view','id'=>$model->id]), [
                            'title' => Yii::t('yii', '修改密码'),
                            'data-pjax' => '0',
                        ]);
                    },
                    'deletes' => function($url,$model,$key){
                        return Html::a('显示',Yii::$app->urlManager->createUrl(['xxjxgl/xxjxgl/view','id'=>$model->id]),[
                            'title' => Yii::t('yii','显示'),
                            'data-confirm' => Yii::t('yii','确定显示'),
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
</div>
<script>
    $(function(){
        $("#text").hide();
    })
</script>

