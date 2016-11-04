<?php

namespace app\assets;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
    ];
    public $depends = [
        'app\assets\OtherAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
    public $jsOptions = [

    ];

}
