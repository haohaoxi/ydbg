<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MhjcyAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
        'css/mhjcy/common.css',
        'css/mhjcy/system.css',
        'css/mhjcy/dialog.css',
        'css/mhjcy/chengxv.css',
    ];
    public $js = [
        'js/mhjcy/jquery.min.js',
        'js/mhjcy/jquery.placeholder.js',
        'js/mhjcy/dialog.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
