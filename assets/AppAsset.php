<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'third/twbs/css/bootstrap.min.css',
        'third/twbs-material/dist/css/material.min.css',
        'third/twbs-material/dist/css/ripples.min.css',
        'third/twbs-material/dist/css/roboto.min.css',
        'css/main.css',
        'css/twbs-addons.css',
    ];
    public $js = [
        'js/jquery-2.1.4.min.js',
        'third/twbs/js/bootstrap.min.js',
        'third/twbs-material/dist/js/material.min.js',
        'third/twbs-material/dist/js/ripples.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
