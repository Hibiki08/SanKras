<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\HttpException;
use app\models\WorksCat;
use app\models\forms\EditWorksSectionForm;
use yii\helpers\Url;
use yii\web\Response;

class WorksSectionController extends AdminController {

    public function actionIndex() {

        $cat = new WorksCat();
        $categories = $cat->getAll();

        return $this->render('index', [
            'categories' => $categories
        ]);
    }

    public function actionEdit() {
        $id = Yii::$app->request->getQueryParam('id') ? Yii::$app->request->getQueryParam('id') : null;

        $form = new EditWorksSectionForm();
        $cat = new WorksCat();
        $categories = $cat->findByColumn(['parent_id' => null]);

        $parentCat[0] = 'нет';
        foreach ($categories as $item) {
            $parentCat[$item->id] = $item->title;
        }

        $model = $id ? $cat->findOne(['id' => $id]) : new WorksCat();
        $parent_id = Yii::$app->request->post('EditWorksSectionForm')['parent_id'];

        if (!empty($model)) {
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $model->title = Yii::$app->request->post('EditWorksSectionForm')['title'];
                $model->description = Yii::$app->request->post('EditWorksSectionForm')['description'];
                $model->parent_id = $parent_id == 0 ? null : $parent_id;
                $model->active = isset(Yii::$app->request->post('EditSlidesForm')['active']) ? 1 : 0;
                $model->save();
                $id = $id ? $id : Yii::$app->db->lastInsertID;
                Yii::$app->getResponse()->redirect(Url::toRoute(['works-section/edit', 'id' => $id]));
            }

            return $this->render('edit', [
                'edit' => $form,
                'categories' => $parentCat,
                'model' => $model
            ]);
        } else {
            throw new HttpException(404 ,'Такой страницы нет!');
        }
    }

    public function actionActive() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $id = (int)Yii::$app->request->getQueryParams()['id'];
            $value = (int)Yii::$app->request->getQueryParams()['value'];

            $cat = WorksCat::findOne($id);
            $cat->active = $value;
            if ($cat->update() !== false) {
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

            $cat = WorksCat::findOne($id);
            if ($cat->delete() !== false) {
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