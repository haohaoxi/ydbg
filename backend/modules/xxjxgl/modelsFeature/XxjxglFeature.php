<?php
namespace backend\modules\xxjxgl\modelsFeature;

use backend\modules\xxjxgl\models\Xxjxgl;

class XxjxglFeature extends Xxjxgl
{
    public function rname($obj){
        $ext = $obj->getExtension();
        $fileName = time().'_'.rand(1,999).'.'.$ext;
        return $fileName;
    }

}














?>