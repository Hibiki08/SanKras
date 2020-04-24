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

    protected function unlinkFiles($path, $fileName, array $prefixLis) {
        $fileNameParts = explode('.', $fileName);
        $nameWithoutType = $fileNameParts[0];
        if (file_exists($path . $fileName)) {
            unlink($path . $fileName);
        }
        if (file_exists($path . $nameWithoutType . '.webp')) {
            unlink($path . $nameWithoutType . '.webp');
        }

        foreach ($prefixLis as $prefix) {
            if (file_exists($path . $prefix . $fileName)) {
                unlink($path . $prefix . $fileName);
            }
            if (file_exists($path . $prefix . $nameWithoutType . '.webp')) {
                unlink($path . $prefix . $nameWithoutType . '.webp');
            }
        }
    }
}