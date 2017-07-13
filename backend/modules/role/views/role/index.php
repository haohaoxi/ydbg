<?php
use yii\helpers\Html;
use backend\functions\functions;
?>
<?=Html::cssFile('@web/css/ydbg/add.css')?>
<style>
    .default-table tr th {
        height: 38px;
        background: #ecf1f7;
        font-size: 14px;
        font-weight: normal;
    }
</style>
<div class="boxer">
    <a href="<?= Yii::$app->urlManager->createUrl(['role/role/create']) ?>" class="roles-search">新增角色</a>
    <br class="clr">
    <div class="default-table">
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tbody>
            <tr>
                <th width="10%">序号</th>
                <th width="10%">角色名称</th>
                <th width="10%">角色描述</th>
                <th width="10%">创建日期</th>
                <th width="10%">操作</th>
            </tr>
            <?php
            if(count($data) >0 ){
                foreach($data as $key=>$value){
                    ?>
                    <tr>
                        <td><?= $key+1; ?></td>
                        <td><?= $value['name']; ?></td>
                        <td><?= $value['descript']; ?></td>
                        <td><?= $value['time']; ?></td>
                        <td class="operation">
                                <a href="<?= Yii::$app->urlManager->createUrl(['role/role/update','id'=>$value['id']]) ?>" class="">修改</a>&nbsp;&nbsp;
                                <?php $user_num = functions::findUser($value['id']); ?>
                                <?php if($value['id']==1 || $value['id'] == 2){  //1 超级管理员 2 行专科?>

                                <a style="text-decoration: none;color: #cccccc">删除</a>&nbsp;&nbsp;
                                <?php }else if ($user_num > 0){ ?>
                                <a onclick="javascript:alert('该角色下有<?=functions::findUser($value['id'])?>个帐号，您无法删除该角色信息！');return false;"; href="" class="">删除</a>&nbsp;&nbsp;
                                <?php }else{ ?>
                                <a onclick="return confirm('您好，确认要删除该角色吗？');" href="<?= Yii::$app->urlManager->createUrl(['role/role/delete','id'=>$value['id']]) ?>" class="">删除</a>&nbsp;&nbsp;
                                <?php } ?>

                    <?php if($value['id']==1){ ?>
                        <a style="text-decoration: none;color: #cccccc">权限分配</a>&nbsp;&nbsp;
                    <?php }else{ ?>
                        <a href="<?= Yii::$app->urlManager->createUrl(['role/role/permissions','id'=>$value['id']]) ?>" class="">权限分配</a>&nbsp;&nbsp;
                    <?php } ?>

                        </td>
                    </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</div>