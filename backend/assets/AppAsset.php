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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
        'css/jwt/common.css',
        'css/jwt/style.css',
        'css/jwt/dialog.css',
        'css/site.css',
    ];
    public $js = [
        'js/jwt/jquery.min.js',
        'js/jwt/jquery.placeholder.js',
        'js/jwt/nkUtils.min.js',
        'js/jsdt/highcharts.js',
        'js/popDiv.js',
        'js/jwt/getdate.js',
        'js/jwt/calendar/calendar.js',
        'js/jwt/calendar/lang/en.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
