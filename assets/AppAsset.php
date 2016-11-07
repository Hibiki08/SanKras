<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/hibiki.slider.css?r3',
        'css/style.css?r7',
        'css/media.css?r5',
        'css/fonts.css?r3',
    ];
    public $js = [
        'js/smoothscroll.js?r3',
        'js/maskedinput.js?r3',
        '/js/hibiki.slider.js?r3',
    ];
    public $depends = [
        'app\assets\OtherAsset',
//        'yii\bootstrap\BootstrapPluginAsset',
    ];
    public $jsOptions = [

    ];

}
