<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            ['class' => 'yii\grid\SerialColumn','header'=>'序号'],
            'time',
            ['attribute'=>'dwbh','headerOptions' => ['width' => '4%']],
            ['attribute'=>'number','headerOptions' => ['width' => '4%']],
            ['attribute'=>'name','headerOptions' => ['width' => '4%']],
            'yfgz',
            'zwdjgz',
             'jbgz',
             'jcgz',
             'gjhljt',
             'jxjt',
             'gzjt',
             'shbt',
             'gwjt',
             'zwjt',
             'dqjt',
             'kqj',
             'hyxjt',
             'tzbt',
             'blgz',
             'fdgz',
             'qtyf',
             'ycxbk',
             'dkje',
             'zfgjj',
             'ylaobxj',
             'sybxj',
             'ylbxj',
             'grsds',
             'sdf',
             'fz',
             'qtdk',
             'sfgz'
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