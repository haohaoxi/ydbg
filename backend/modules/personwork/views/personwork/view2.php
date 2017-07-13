<?php
use yii\helpers\Html;
use backend\modules\personworkworkflow\models\PersonWorkWorkflow;
use \backend\modules\user\models\User;
?>

<div class="boxer">
    <div class="user-add">
        <div class="default-table user-add-table">
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tbody><tr>
                    <th colspan="2">【工作详情】</th>
                </tr>
                <tr>
                    <td><i></i>发起时间</td>
                    <td><?= $model->p_c_time; ?></td>
                </tr>
                <tr>
                    <td><i></i>主题</td>
                    <td><?= $model->p_title; ?></td>
                </tr>
                <tr>
                    <td><i></i>工作开始时间</td>
                    <td><?= $model->p_s_time; ?></td>
                </tr>
                <tr>
                    <td><i></i>工作结束时间</td>
                    <td><?= $model->p_e_time; ?></td>
                </tr>
                <tr>
                    <td><i></i>优先级</td>
                    <td><?= $model->p_level; ?></td>
                </tr>
                <tr>
                    <td><i></i>受理人</td>
                    <td><?= $model->p_y_slr_text; ?></td>
                </tr>
                <tr>
                    <td><i></i>详情</td>
                    <td><?= $model->p_details; ?></td>
                </tr>
                <tr>
                    <td><i></i>审批详情</td>
                    <td>
                        <?php if(count($data = PersonWorkWorkflow::getSp($model->p_id)) >0 ){ ?>
                            <?php foreach($data as $key=> $value){ ?>
                                <?php $user = User::getNames($value['w_person_id']); ?>
                                <?= ++$key ?>、&nbsp;&nbsp;&nbsp;<?= $user[0]['name'] ?>(<?= $value['w_e_status']!='无' ? $value['w_e_status']: $value['w_s_status'];  ?>)&nbsp;&nbsp;&nbsp;<?= $value['w_e_status']!='无' ? $value['w_e_time']: $value['w_s_time'];  ?><br>
                            <?php } ?>
                        <?php }else{ ?>
                            无审批人
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td><i></i>受理详情</td>
                    <td>
                        <?php if(count($data = PersonWorkWorkflow::getSl($model->p_id)) >0 ){ ?>
                        <?php foreach($data as $key=> $value){ ?>
                            <?php $user = User::getNames($value['w_person_id']); ?>
                            <?= ++$key ?>、&nbsp;&nbsp;&nbsp;<?= $user[0]['name'] ?>(<?= $value['w_e_status']!='无' ? $value['w_e_status']: $value['w_s_status'];  ?>)&nbsp;&nbsp;&nbsp;<?= $value['w_e_status']!='无' ? $value['w_e_time']: $value['w_s_time'];  ?><br>
                        <?php } ?>
                        <?php }else{ ?>
                            无受理人
                        <?php } ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <br class="clr">
        <?php $menutype = intval($_GET['menutype']); ?>
        <?php if($_GET['menutype']==1){ ?>
            <?php if(Yii::$app->controller->action->id == 'sp'){ ?>

            <?= Html::input('button','','返回', ['class' => 'but','onclick'=>'javascript:history.go(-1);']) ?>
            <?= Html::a('驳回',Yii::$app->urlManager->createUrl(['personwork/personwork/spbh','id'=>$model->p_id,'menutype'=>$menutype,'w_type'=>'普通']), ['class' => 'but']) ?>
            <?= Html::a('同意',Yii::$app->urlManager->createUrl(['personwork/personwork/spty','id'=>$model->p_id,'menutype'=>$menutype,'w_type'=>'普通']), ['class' => 'but','onclick'=>'return confirm("是否同意该审批？");']) ?>

            <?php }elseif(Yii::$app->controller->action->id == 'sl'){ ?>

                <?= Html::input('button','','返回', ['class' => 'but','onclick'=>'javascript:history.go(-1);']) ?>
                <?= Html::a('代办',Yii::$app->urlManager->createUrl(['personwork/personwork/sldb','id'=>$model->p_id,'menutype'=>$menutype,'w_type'=>'普通']), ['class' => 'but']) ?>
                <?= Html::a('退办',Yii::$app->urlManager->createUrl(['personwork/personwork/sltb','id'=>$model->p_id,'menutype'=>$menutype,'w_type'=>'普通']), ['class' => 'but']) ?>
                <?= Html::a('完成',Yii::$app->urlManager->createUrl(['personwork/personwork/slwc','id'=>$model->p_id,'menutype'=>$menutype,'w_type'=>'普通']), ['class' => 'but','onclick'=>'return confirm("是否完成本次工作？");']) ?>

            <?php } ?>

        <?php }elseif($_GET['menutype']==2){ ?>

            <?= Html::input('button','','返回', ['class' => 'but','onclick'=>'javascript:history.go(-1);']) ?>
            <?= Html::a('退办',Yii::$app->urlManager->createUrl(['personwork/personwork/sltb','id'=>$model->p_id,'menutype'=>$menutype,'w_type'=>'代办']), ['class' => 'but']) ?>
            <?= Html::a('完成',Yii::$app->urlManager->createUrl(['personwork/personwork/slwc','id'=>$model->p_id,'menutype'=>$menutype,'w_type'=>'代办']), ['class' => 'but','onclick'=>'return confirm("是否完成本次工作？");']) ?>

        <?php }elseif($_GET['menutype']==5){ ?>
        <?= Html::input('button','','返回', ['class' => 'but','onclick'=>'javascript:history.go(-1);']) ?>
        <?php } ?>
    </div>
</div>
