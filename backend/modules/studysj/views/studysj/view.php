
<div class="boxer" style="position: relative; zoom: 1;">
    <div class="study-sj-view">
        <div class="tname">
            <span>试卷一</span>
            <span>出卷人：<?= $user;?></span>
        </div>
        <ul>
            <li class="th"><span class="xh">序号 </span><span class="tmm">题目名</span><span class="lx">题目类型</span></li>
            <?php if($studytk[0] != null){?>
            <?php $i=1; foreach($studytk as $key=>$vo){?>
            <li><span class="xh"><?=$i++?></span><span class="tmm"><input type="text" value="<?=$vo[0]['name']?>"  readonly=""></span><span class="lx">
                    <input type="text" value="<?=$vo[0]['type'] = 1 ? '单选题' :''?>"  readonly=""></span></li>
            <?php }?>
            <?php }else{?>
                <li><span class="xh"></span><span class="tmm"><input type="text" value=""  readonly=""></span><span class="lx">
                    <input type="text" value=""  readonly=""></span></li>
            <?php }?>
        </ul>
    </div>
<!--    <div class="default-page">-->
<!--        <ul class="pagination">-->
<!--            <li class="first"><a href="/Lawyer/lawyer-appointment/index?menuid=9&amp;page=1&amp;per-page=1" data-page="0">首页</a></li>-->
<!--            <li class="prev"><a href="/Lawyer/lawyer-appointment/index?menuid=9&amp;page=9&amp;per-page=1" data-page="8">上一页</a></li>-->
<!--            <li><a href="/Lawyer/lawyer-appointment/index?menuid=9&amp;page=3&amp;per-page=1" data-page="2">3</a></li>-->
<!--            <li><a href="/Lawyer/lawyer-appointment/index?menuid=9&amp;page=4&amp;per-page=1" data-page="3">4</a></li>-->
<!--            <li><a href="/Lawyer/lawyer-appointment/index?menuid=9&amp;page=5&amp;per-page=1" data-page="4">5</a></li>-->
<!--            <li><a href="/Lawyer/lawyer-appointment/index?menuid=9&amp;page=6&amp;per-page=1" data-page="5">6</a></li>-->
<!--            <li><a href="/Lawyer/lawyer-appointment/index?menuid=9&amp;page=7&amp;per-page=1" data-page="6">7</a></li>-->
<!--            <li><a href="/Lawyer/lawyer-appointment/index?menuid=9&amp;page=8&amp;per-page=1" data-page="7">8</a></li>-->
<!--            <li><a href="/Lawyer/lawyer-appointment/index?menuid=9&amp;page=9&amp;per-page=1" data-page="8">9</a></li>-->
<!--            <li class="active"><a href="/Lawyer/lawyer-appointment/index?menuid=9&amp;page=10&amp;per-page=1" data-page="9">10</a></li>-->
<!--            <li><a href="/Lawyer/lawyer-appointment/index?menuid=9&amp;page=11&amp;per-page=1" data-page="10">11</a></li>-->
<!--            <li><a href="/Lawyer/lawyer-appointment/index?menuid=9&amp;page=12&amp;per-page=1" data-page="11">12</a></li>-->
<!--            <li class="next"><a href="/Lawyer/lawyer-appointment/index?menuid=9&amp;page=11&amp;per-page=1" data-page="10">下一页</a></li>-->
<!--            <li class="last"><a href="/Lawyer/lawyer-appointment/index?menuid=9&amp;page=12&amp;per-page=1" data-page="11">末页</a></li>-->
<!--        </ul>-->
<!--    </div>-->
    <div class="sj-view-back">
        <a href="/index.php?r=studysj%2Fstudysj%2Findex">返回</a>
    </div>
</div>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\studysj\models\Studysj */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Studysjs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="studysj-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'mechanism',
            'standard',
            'start_time',
            'end_time',
            'status',
            'user',
            'offen',
            'questions',
        ],
    ]) ?>

</div>
