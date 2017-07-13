<?php
namespace backend\modules\news\modelsFeature;

use backend\modules\news\models\News;

class NewsFeature extends News
{
    public function rname($obj){
        $ext = $obj->getExtension();
        $fileName = time().'_'.rand(1,999).'.'.$ext;
        return $fileName;
    }
}

?>