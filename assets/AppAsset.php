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
        'css/main.css',
        'third/twbs-material/dist/css/material.min.css',
        'third/twbs-material/dist/css/ripples.min.css',
        'third/twbs-material/dist/css/roboto.min.css',
    ];
    public $js = [
        'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',
        'third/twbs/js/bootstrap.min.js',
        'third/twbs-material/dist/js/material.min.js',
        'third/twbs-material/dist/js/ripples.min.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
