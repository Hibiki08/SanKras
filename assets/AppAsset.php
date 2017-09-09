<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/hibiki.slider.css?r3',
        'css/style.css?r91',
        'css/add-style.min.css?r4',
        'css/media.css?r31',
        'css/fonts.css?r3',
//        'lib/PgwSlider/pgwslider.min.css',
//        'lib/Prokrutka/jquery.mCustomScrollbar.css',
    ];
    public $js = [
        'js/smoothscroll.js?r3',
        'js/maskedinput.js?r3',
        '/js/hibiki.slider.js?r3',
//        'lib/Prokrutka/jquery.mCustomScrollbar.concat.min.js',
    ];
    public $depends = [
        'app\assets\OtherAsset',
//        'yii\bootstrap\BootstrapPluginAsset',
    ];
    public $jsOptions = [

    ];

}
