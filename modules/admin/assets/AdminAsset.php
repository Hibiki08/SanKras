<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\admin\assets;

use Yii;
use yii\web\AssetBundle;
use yii\web\View;

class AdminAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = ['position' => View::POS_HEAD];

    public $css = [
        'lib/jquery-ui-1.12.0/jquery-ui.css',
        'css/admin.css',
    ];
    public $js = [
        'lib/jquery-ui-1.12.0/jquery-ui.js',
        'js/admin.js?r1',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\JqueryAsset'
    ];

    public function init() {
        Yii::setAlias('admin', '/modules/admin/assets/');
        parent::init();
    }
}
