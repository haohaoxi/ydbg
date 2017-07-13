<?php
use yii\helpers\Html;
use yii\grid\GridView;
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
        <a href="<?= Yii::$app->urlManager->createUrl(['menu/menu/create']) ?>" class="roles-search">新增菜单</a>
            <br class="clr">
         <div class="default-table">
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tbody>
            <tr>
                <th width="20%">菜单名称</th>
                <th width="10%">模块</th>
                <th width="10%">控制器</th>
                <th width="10%">方法</th>
                <th width="10%">参数</th>
                <th width="10%">排序</th>
                <th width="10%">菜单是否显示</th>
                <th width="10%">是否允许操作</th>
                <th width="20%">操作</th>
            </tr>
            <?php
            if(count($data) >0 ){
                foreach($data as $key=>$value){
                    ?>
                    <tr>
                        <td style="text-align: left"><?= $value['fullname']; ?></td>
                        <td><?= $value['module']; ?></td>
                        <td><?= $value['controller']; ?></td>
                        <td><?= $value['action']; ?></td>
                        <td><?= $value['menutype']; ?></td>
                        <td><?= $value['order']; ?></td>
                        <td><?= functions::get_status_html($value['is_show']); ?></td>
                        <td><?= functions::get_status_html($value['is_run']); ?></td>
                        <td>
                                <a href="<?= Yii::$app->urlManager->createUrl(['menu/menu/update','id'=>$value['id']]) ?>" class="">编辑</a>&nbsp;&nbsp;
                                <a onclick="return confirm('是否确认删除？');" href="<?= Yii::$app->urlManager->createUrl(['menu/menu/delete','id'=>$value['id']]) ?>" class="">删除</a>&nbsp;&nbsp;
                        </td>
                    </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</div>