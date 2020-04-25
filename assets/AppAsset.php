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
        'css/add-style.min.css?r9',
        'css/style.css?r106',
        'css/media.css?r31',
        'css/fonts.css?r3',
    ];
    public $js = [
        'js/maskedinput.js?r3',
        '/js/hibiki.slider.js?r3',
        '/lib/lazysizes/lazysizes.min.js',
    ];
    public $depends = [
        'app\assets\OtherAsset',
    ];
    public $jsOptions = [

    ];

}
