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
        '/css/hibiki.slider.css',
        'css/style.css',
        'css/media.css',
        'css/fonts.css',
    ];
    public $js = [
        'js/jquery-2.1.4.min.js',
        'js/jquery-ui.min.js',
        'js/smoothscroll.js',
        'js/maskedinput.js',
        '/js/hibiki.slider.js',
        'js/script.js',
    ];
    public $depends = [
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}
