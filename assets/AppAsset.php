<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/hibiki.slider.css',
        'css/style.css?r1',
        'css/media.css?r1',
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
