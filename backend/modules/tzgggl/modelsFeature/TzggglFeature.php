<?php
namespace backend\modules\tzgggl\modelsFeature;

use backend\modules\tzgggl\models\Announcement;

class TzggglFeature extends Announcement
{
    public function rname($obj){
        $ext = $obj->getExtension();
        $fileName = time().'_'.rand(1,999).'.'.$ext;
//        print_r($fileName);die;
        return $fileName;
    }
}
?>