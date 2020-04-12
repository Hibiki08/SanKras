<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/hibiki.slider.css?r3',
        '/lib/perfect-scrollbar/css/perfect-scrollbar.css',
        '/lib/lazy-load/dist/jquery.lazyloadxt.fadein.css',
        'css/add-style.min.css?r8',
        'css/style.css?r104',
        'css/media.css?r31',
        'css/fonts.css?r3',
    ];
    public $js = [
        'js/maskedinput.js?r3',
        '/js/hibiki.slider.js?r3',
        '/lib/lazy-load/src/jquery.lazyloadxt.js',
        '/lib/lazysizes/lazysizes.min.js',
    ];
    public $depends = [
        'app\assets\OtherAsset',
    ];
    public $jsOptions = [

    ];

}
