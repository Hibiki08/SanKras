<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\HttpException;
use app\models\Team;
use yii\data\Pagination;
use app\models\forms\EditTeamForm;
use yii\web\UploadedFile;
use app\components\ImageResize;
use yii\helpers\Url;
use yii\web\Response;
use app\components\Translate;


class TeamController extends AdminController {

    public function actionIndex() {
        $team = Team::find();

        $pager = new Pagination(['totalCount' => $team->count(), 'pageSize' => self::PAGE_SIZE]);
        $pager->pageSizeParam = false;
        $team = $team->offset($pager->offset)
            ->limit($pager->limit)
            ->all();

        return $this->render('index', [
            'team' => $team,
            'pager' => $pager
        ]);
    }

    public function actionEdit() {
        $id = Yii::$app->request->getQueryParam('id') ? Yii::$app->request->getQueryParam('id') : null;
        $errors = [];

        $team = new Team();
        $model = $id ? $team->findOne($id) : new Team();

        if (!empty($model)) {
            $form = new EditTeamForm();
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $form->img = UploadedFile::getInstance($form, 'img');

                $img = !empty(Yii::$app->request->post('EditTeamForm')['hidden']) ?
                    Yii::$app->request->post('EditTeamForm')['hidden'] : false;

                if ((is_null($form->img) && !$img) || (!$id && !$form->img->name)) {
                    $errors['emptyImage'] = 'Не выбрано превью!';
                }

                if (empty($errors)) {
                    $teamItem = [];
                    $translate = new Translate();

                    $items = explode(';', $form->text);
                    foreach ($items as $item) {
                        if (!empty($item)) {
                            $teamItem[] = trim($item);
                        } else {
                            continue;
                        }
                    }
                    $teamItem = implode(";\n", $teamItem);

                    $model->name = trim($form->name);
                    $model->post = trim($form->post);
                    $model->img = !empty($form->img->name) ? $translate->translate($form->img->name) : Yii::$app->request->post('EditTeamForm')['hidden'];;
                    $model->text = $teamItem;
                    $model->active = isset(Yii::$app->request->post('EditTeamForm')['active']) ? 1 : 0;
                    $model->save();
                    $id = $id ? $id : Yii::$app->db->lastInsertID;

                    $path = Team::IMG_FOLDER . 'team(' . $id . ')/';
                    $create = file_exists(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path) ? true : mkdir(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path);
                    if ($create) {
                        if ($form->upload($path, $form->img)) {
                            $resizeMini = new ImageResize($form->img->name, $path, $path, 205, '', 'team');
                            $resizeMini->resize();
                        }
                    }

                    Yii::$app->getResponse()->redirect(Url::toRoute(['team/edit', 'id' => $id]));
                }
            }
        } else {
            throw new HttpException(404 ,'Такой страницы нет!');
        }

        return $this->render('edit', [
            'edit' => $form,
            'model' => $model,
            'errors' => $errors,
        ]);
    }

    public function actionActive() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $id = (int)Yii::$app->request->getQueryParams()['id'];
            $value = (int)Yii::$app->request->getQueryParams()['value'];

            $team = Team::findOne($id);
            $team->active = $value;
            if ($team->update() !== false) {
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

            $team = Team::findOne($id);
            $path = Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . Team::IMG_FOLDER . 'team(' . $id . ')/';
            if ($team->delete() !== false) {
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