<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \backend\modules\user\models\RoleUser;
use \backend\modules\role\models\Role;
use \backend\modules\deptcontact\models\DeptContact;
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
                ['class' => 'yii\grid\SerialColumn','headerOptions' => ['width' => '5%'],'header' => '序号' ],
                ['attribute'=>'username','headerOptions' => ['width' => '10%']],
                ['attribute'=>'name','headerOptions' => ['width' => '10%']],
                ['attribute'=>'role_id','headerOptions' => ['width' => '10%'],'value'=>function($data){
                    $role_id = RoleUser::getRoleId($data['id']);/*根据用户id获取角色id*/
                    $role_name = Role::getRoleName($role_id);/*根据角色id获取角色名称*/
                    return $role_name;
                }],
                ['attribute'=>'department','headerOptions' => ['width' => '10%'],'value'=>function($data){
                    $data = DeptContact::getDeptOne($data['department']);
                    return $data['dept_name'];
                }],

                ['attribute'=>'created_at','headerOptions' => ['width' => '10%'],'value'=>function($data){
                    return date('Y-m-d',$data['created_at']);
                }],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'headerOptions' => ['width' => '12%'],
                    'template' => '{update} {update-pwd} {delete}',
                    'buttons' => [
                        'update' => function ($url, $model, $key) {
                            return Html::a('修改', Yii::$app->urlManager->createUrl(['user/user/update','id'=>$model->id]), [
                                'title' => Yii::t('yii', '修改'),
                                'class' => '',
                                'data-pjax' => '0',
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('删除', Yii::$app->urlManager->createUrl(['user/user/delete','id'=>$model->id]), [
                                'title' => Yii::t('yii', '删除'),
                                'data-confirm' => Yii::t('yii', '确定删除?'),
                                'class' => '',
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ]);
                        },
                        'update-pwd' => function ($url, $model, $key) {
                            return Html::a('修改密码', Yii::$app->urlManager->createUrl(['user/user/update-pwd','id'=>$model->id]), [
                                'title' => Yii::t('yii', '修改密码'),
                                'data-pjax' => '0',
                            ]);
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