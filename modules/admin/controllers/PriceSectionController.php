<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\HttpException;
use app\models\PricesCat;
use yii\web\Response;
use app\models\forms\EditPriceSectionForm;
use yii\helpers\Url;
use app\modules\admin\controllers\AdminController;

class PriceSectionController extends AdminController {

    public function actionIndex() {
        $cat = new PricesCat();
        $categories = $cat->getAll(['sort' => SORT_ASC]);

        return $this->render('index', [
            'categories' => $categories
        ]);
    }

    public function actionEdit() {
        $id = Yii::$app->request->getQueryParam('id') ? Yii::$app->request->getQueryParam('id') : null;

        $form = new EditPriceSectionForm();
        $cat = new PricesCat();
        $categories = $cat->findAll(['parent_id' => null]);

        $parentCat[0] = 'нет';
        foreach ($categories as $item) {
            $parentCat[$item->id] = $item->title;
        }

        $model = $id ? $cat->findOne(['id' => $id]) : new PricesCat();

        if (!empty($model)) {
            $parent_id = Yii::$app->request->post('EditPriceSectionForm')['parent_id'];

            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $model->title = Yii::$app->request->post('EditPriceSectionForm')['title'];
                $model->parent_id = $parent_id == 0 ? null : $parent_id;
                $model->active = isset(Yii::$app->request->post('EditPriceSectionForm')['active']) ? 1 : 0;
                $model->save();
                $id = $id ? $id : Yii::$app->db->lastInsertID;
                Yii::$app->getResponse()->redirect(Url::toRoute(['price-section/edit', 'id' => $id]));
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

            $cat = PricesCat::findOne($id);
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

    public function actionSort() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $data = Yii::$app->request->getQueryParams()['data'];

            $categories = new PricesCat();
            $categories->updateData('sk_prices_cat', 'sort', $data, 'id');

            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'status' => true,
            ];
        }
        Yii::$app->end();
    }

    public function actionDelete() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $id = (int)Yii::$app->request->getQueryParams()['id'];

            $cat = PricesCat::findOne($id);
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