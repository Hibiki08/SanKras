<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class AdminController extends Controller {

    const PAGE_SIZE = 10;

    public function init() {
        if (!\Yii::$app->user->can('AdminPanel')) {
            return false;
        }
    }

    public function actionIndex() {
        return $this->render('index');
    }
}