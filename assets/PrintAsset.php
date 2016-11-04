<?php
namespace app\assets;

use yii\web\AssetBundle;

class PrintAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/print.css?r3',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];

}
