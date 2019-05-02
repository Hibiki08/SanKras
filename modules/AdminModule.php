<?php

namespace app\modules;

use Yii;
use yii\filters\AccessControl;
use yii\base\Module;

class AdminModule extends Module {

    public $controllerNamespace = 'app\modules\admin\controllers';

    public function beforeAction($action) {

        if (!parent::beforeAction($action)) {
            return false;
        }

        if (!Yii::$app->user->isGuest) {
            return true;
        }
        else
        {
            Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl());
            //для перестраховки вернем false
            return false;//ну совсем пичаль-тоска
        }
    }

    public function init() {
        $this->setViewPath(Yii::$app->basePath . '/modules/admin/views');
        $this->layout = "main.php";
        parent::init();
    }

}