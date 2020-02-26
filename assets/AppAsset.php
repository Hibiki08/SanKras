<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/hibiki.slider.css?r3',
        'css/style.css?r96',
        'css/add-style.min.css?r8',
        'css/style.css?r103',
        'css/media.css?r31',
        'css/fonts.css?r3',
    ];
    public $js = [
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
