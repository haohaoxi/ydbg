<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\functions\functions;
?>
<div class="boxer">
    <div class="default-form">
                <?php $form = ActiveForm::begin(
                    [
                        'method' => 'post',
                        'options' => ['class' => '','enctype' => 'multipart/form-data'],
                        'fieldConfig' => [
                            'template' => "{input}",
                            'inputOptions' => ['class' => 'q text'],
                        ]
                    ]
                ); ?>
                <input type="hidden" name="role_id" value="<?= $role_id; ?>"/>
                <strong>【权限管理】</strong>
                <span style="width: 718px;font-weight: normal">
                <input type="checkbox" class="c" name="checkAll"/><label for="">全选/全不选</label>
                </span><br class="clr" />
        <?php
        if(count($menu) >0 ){
            foreach($menu as $key=>$value){
                ?>
                <span style="width: 718px;font-weight: normal">
                <input type="checkbox" class="c" name="p_ids[]" value="<?= $value['id']; ?>" parent_id="<?= $value['parent_id']; ?>" <?php if(in_array($value['id'],$RoleMenu)){ echo "checked"; }; ?>/><label for=""><?= $value['fullname']; ?></label>
                </span>
                <br class="clr" />
            <?php }} ?>

            <?= Html::input('submit','','存档', ['class' => 'btn']) ?>
            <?= Html::input('button','','返回', ['class' => 'btn','onclick'=>'javascript:history.go(-1);']) ?>
        <br class="clr">
        <?php ActiveForm::end(); ?>
    </div>
</div>



    <script type="text/javascript">
        jQuery(function($){
            $(".home").click(function(){
                window.top.location.reload();
            });

            $(":checkbox[name='checkAll']").bind('click',function(){
                $(":checkbox[name='p_ids[]']").prop("checked",this.checked);
            });

            function checkPid(parent_id,checked){
                $(":checkbox[value='"+parent_id+"']").each(function(){
                    $(this).prop("checked",checked);
                    if($(this).attr('parent_id') != 0){
                        checkPid($(this).attr('parent_id'),checked)
                    }
                });
            }

            function checkCid(id,checked){
                $(":checkbox[parent_id='"+id+"']").each(function(){
                    $(this).prop("checked",checked);
                    if($(":checkbox[parent_id='"+$(this).attr('value')+"']").length > 0){
                        checkCid($(this).attr('value'),checked);
                    }
                })
            }

            $(":checkbox[name='p_ids[]']").click(function(){
                var parent_id = $(this).attr('parent_id');
                var id = $(this).attr('value');
                if(parent_id != 0 && ($(":checkbox[parent_id='"+$(this).attr('value')+"']").length == 0) ){ //最子集元素
                    if(this.checked == true){
                        checkPid(parent_id,this.checked);
                    }else{
                        if($(":checkbox[parent_id='"+parent_id+"']:checked").length < 1){
                        //    $(":checkbox[value='"+parent_id+"']").prop("checked",this.checked);
                        }
                    }
                }else if(parent_id != 0 && ($(":checkbox[parent_id='"+$(this).attr('value')+"']").length > 0)){ //中级元素
                    if(this.checked == true) checkPid(parent_id,this.checked);
                    checkCid($(this).attr('value'),this.checked);
                }else{ //最顶级元素
                    checkCid(id,this.checked)
                }
            });
        });

</script>