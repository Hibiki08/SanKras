<?php
namespace app\assets;

use yii\web\AssetBundle;

class PrintAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/print.css',
    ];
    public $js = [
        'js/jquery-2.1.4.min.js',
    ];
    public $depends = [

    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}
