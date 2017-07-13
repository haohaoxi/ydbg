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
class JsdtAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
        'css/jsdt/common.css',
        'css/jsdt/common1.css',
        'css/jsdt/style.css',
        'css/jsdt/style1.css',
        'css/jsdt/style2.css',
    ];
    public $js = [
        'js/jsdt/jquery.min.js',
        'js/jsdt/common.js',
        'js/jsdt/getdate.js',
        'js/jsdt/jquery.placeholder.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
