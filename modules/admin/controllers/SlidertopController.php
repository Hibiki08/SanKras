<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\HttpException;
use app\models\Slides;
use app\components\ImageResize;
use app\models\forms\EditSlidesForm;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\web\Response;
use app\modules\admin\controllers\AdminController;
use yii\helpers\Html;

class SlidertopController extends AdminController {

    public function actionIndex() {

        $slides = new Slides();
        $slides = $slides->findByColumn(['type_id' => 1], '', ['sort' => SORT_ASC]);

        return $this->render('index', [
            'slides' => $slides,
        ]);
    }

    public function actionEdit() {
        $id = Yii::$app->request->getQueryParam('id') ? Yii::$app->request->getQueryParam('id') : null;

        $errors = [];

        $form = new EditSlidesForm();
        $slides = new Slides();
        $model = $id ? $slides->findOne(['id' => $id]) : new Slides();

        if (!empty($model)) {
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $form->image = UploadedFile::getInstance($form, 'image');
                if (!$id) {
                    if (!$form->image->name) {
                        $errors['emptyImage'] = 'Не выбрано изображение!';
                    }
                }

                if (empty($errors)) {
                    if ($form->upload(Slides::IMG_FOLDER_SLIDER_TOP)) {
                        $resize = new ImageResize($form->image->name, Slides::IMG_FOLDER_SLIDER_TOP, Slides::IMG_FOLDER_SLIDER_TOP, 200, '', 'admin');
                        $resize->resize();
                    }
                    $model->text = Yii::$app->request->post('EditSlidesForm')['text'];
                    $model->type_id = 1;
                    $model->image = !empty($form->image->name) ? $form->image->name : Yii::$app->request->post('EditSlidesForm')['hidden'];
                    $model->link = Yii::$app->request->post('EditSlidesForm')['link'];
                    $model->sort = Yii::$app->request->post('EditSlidesForm')['sort'];
                    $model->active = isset(Yii::$app->request->post('EditSlidesForm')['active']) ? 1 : 0;
                    $model->save();
                    $id = $id ? $id : Yii::$app->db->lastInsertID;
                    Yii::$app->getResponse()->redirect(Url::toRoute(['slidertop/edit', 'id' => $id]));
                }
            }

            return $this->render('edit', [
                'edit' => $form,
                'errors' => $errors,
                'model' => $model
            ]);
        } else {
            throw new HttpException(404 ,'Такой страницы нет!');
        }
    }

    public function actionSort() {
        if (Yii::$app->request->isAjax) {
            $response = false;
            $id = (int)Yii::$app->request->getQueryParams()['id'];
            $value = (int)Yii::$app->request->getQueryParams()['value'];

            $slides = Slides::findOne($id);
            $slides->sort = $value;
            if ($slides->update() !== false) {
                $response = true;
            }
        }
        Yii::$app->end();
    }

    public function actionActive() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $id = (int)Yii::$app->request->getQueryParams()['id'];
            $value = (int)Yii::$app->request->getQueryParams()['value'];

            $slides = Slides::findOne($id);
            $slides->active = $value;
            if ($slides->update() !== false) {
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

            $slides = Slides::findOne($id);
            if ($slides) {
                $image = $slides->image;
                if ($slides->delete() !== false) {
                    unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . Slides::IMG_FOLDER_SLIDER_TOP . 'admin_' . $image);
                    unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . Slides::IMG_FOLDER_SLIDER_TOP . $image);
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

}