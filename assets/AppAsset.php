<?php

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
        'js/smoothscroll.js',
        'js/maskedinput.js',
        '/js/hibiki.slider.js',
    ];
    public $depends = [
        'app\assets\OtherAsset'
    ];
    public $jsOptions = [

    ];
}
