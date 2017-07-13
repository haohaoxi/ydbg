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
class JqueryUiAsset extends AssetBundle
{

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
        'js/mhjcy/jquery-ui-1.11.4/jquery-ui.css',
    ];
    public $js = [
        'js/mhjcy/jquery-ui-1.11.4/jquery-ui.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
