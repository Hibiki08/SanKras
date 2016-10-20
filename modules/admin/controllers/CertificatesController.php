<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Certificates;
use app\components\ImageResize;
use app\models\forms\CertificatesForm;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\helpers\Url;

class CertificatesController extends AdminController {

    public function actionIndex() {
        $certificates = new Certificates();
        $certificates = $certificates->find()->orderBy('sort')->all();

        $form = new CertificatesForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $form->img = UploadedFile::getInstance($form, 'img');
            if (!$form->img->name) {
                $errors['emptyImage'] = 'Не выбрано изображение!';
            }

            if (empty($errors)) {
                if ($form->upload(Certificates::IMG_FOLDER)) {
                    $resize = new ImageResize($form->img->name, Certificates::IMG_FOLDER, Certificates::IMG_FOLDER, 210, '', 'mini');
                    $resize->resize();
                    $model = new Certificates();
                    $model->img = $form->img->name;
                    $model->save();
                    Yii::$app->getResponse()->redirect(Url::toRoute(['certificates/index']));
                }
            }
        }

        return $this->render('index', [
            'certificates' => $certificates,
            'edit' => $form,
        ]);
    }

    public function actionActive() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $id = (int)Yii::$app->request->getQueryParams()['id'];
            $value = (int)Yii::$app->request->getQueryParams()['value'];

            $certificates = Certificates::findOne($id);
            $certificates->active = $value;
            if ($certificates->update() !== false) {
                $response = true;
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'status' => $response,
            ];
        }
        Yii::$app->end();
    }

    public function actionDelete() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $id = (int)Yii::$app->request->getQueryParams()['id'];

            $certificates = new Certificates;
            $certificates = $certificates->findOne($id);
        if ($certificates) {
                $image = $certificates->img;
                if ($certificates->delete() !== false) {
                    unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . Certificates::IMG_FOLDER . 'mini_' . $image);
                    unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . Certificates::IMG_FOLDER . $image);
                    $response = true;
                }
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'status' => $response,
            ];
        }
        Yii::$app->end();
    }

    public function actionSort() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $data = Yii::$app->request->getQueryParams()['data'];

            $certificates = new Certificates;
            $certificates->updateData('sk_certificates', 'sort', $data, 'id');

            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'status' => true,
            ];
        }
        Yii::$app->end();
    }

}