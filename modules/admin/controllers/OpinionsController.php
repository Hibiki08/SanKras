<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\HttpException;
use app\models\Opinions;
use yii\data\Pagination;
use app\models\forms\EditOpinionsForm;
use yii\web\UploadedFile;
use app\components\ImageResize;
use yii\helpers\Url;
use yii\web\Response;
use app\components\Translate;


class OpinionsController extends AdminController {

    public function actionIndex() {
        $opinions = Opinions::find()->orderBy(['id' => SORT_DESC]);

        $pager = new Pagination(['totalCount' => $opinions->count(), 'pageSize' => self::PAGE_SIZE]);
        $pager->pageSizeParam = false;

        $opinions = $opinions->offset($pager->offset)
            ->limit($pager->limit)
            ->all();

        return $this->render('index', [
            'opinions' => $opinions,
            'pager' => $pager
        ]);
    }

    public function actionEdit() {
        $this->view->registerCssFile('/lib/fancyBox-18d1712/source/jquery.fancybox.css');
        $this->view->registerJsFile('/lib/fancyBox-18d1712/lib/jquery.mousewheel-3.0.6.pack.js');
        $this->view->registerJsFile('/lib/fancyBox-18d1712/source/jquery.fancybox.pack.js');

        $id = Yii::$app->request->getQueryParam('id') ? Yii::$app->request->getQueryParam('id') : null;

        $opinions = new Opinions();
        $model = $id ? $opinions->findOne($id) : new Opinions();

        if (!empty($model)) {
            $form = new EditOpinionsForm();
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $form->photo = UploadedFile::getInstance($form, 'photo');

                $translate = new Translate();

                $model->name = trim($form->name);
                $model->description = trim($form->description);
                $model->photo = !empty($form->photo->name) ? $translate->translate($form->photo->name) : Yii::$app->request->post('EditOpinionsForm')['hidden'];
                $model->text = trim($form->text);
                $model->active = isset(Yii::$app->request->post('EditOpinionsForm')['active']) ? 1 : 0;
                $model->save();
                $id = $id ? $id : Yii::$app->db->lastInsertID;

                $path = Opinions::IMG_FOLDER . 'opinion(' . $id . ')/';
                $create = file_exists(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path) ? true: mkdir(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path);
                if ($create) {
                    if ($form->upload($path, $form->photo)) {
                        $resizeMini = new ImageResize($form->photo->name, $path, $path, 135, '', 'mini');
                        $resizeMini->resize();
                    }
                }
                Yii::$app->getResponse()->redirect(Url::toRoute(['opinions/edit', 'id' => $id]));
            }
        } else {
            throw new HttpException(404 ,'Такой страницы нет!');
        }

        return $this->render('edit', [
            'edit' => $form,
            'model' => $model
        ]);
    }

    public function actionActive() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $id = (int)Yii::$app->request->getQueryParams()['id'];
            $value = (int)Yii::$app->request->getQueryParams()['value'];

            $opinion = Opinions::findOne($id);
            $opinion->active = $value;
            if ($opinion->update() !== false) {
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

            $opinion = Opinions::findOne($id);
            $path = Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . Opinions::IMG_FOLDER . 'opinion(' . $id . ')/';
            if ($opinion->delete() !== false) {
                if ($objs = glob($path . "/*")) {
                    foreach($objs as $obj) {
                        unlink($obj);
                    }
                    rmdir($path);
                }
                $response = true;
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'status' => $response,
            ];
        }
        Yii::$app->end();
    }

}