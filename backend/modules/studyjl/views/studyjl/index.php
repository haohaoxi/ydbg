<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\studytk\models\StudytkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Studytks';
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
                ['class' => 'yii\grid\SerialColumn','header'=>'序号'],
                'name',
                'start_date',
                'username',
                'mechan',
                ['attribute'=>'result','format'=>'html','filter'=>false,'value'=>function($data,$searchModel)
                {
                    if($data['result']==0){
                        return "<h3>不通过</h3>";
                    }else{
                        return "<h3>通过</h3>";
                    }
                }],
//                'result',
                'pate_date',
            ],
        ]); ?>
    </div>
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
