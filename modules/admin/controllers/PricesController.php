<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\HttpException;
use app\models\Prices;
use app\models\PricesCat;
use app\models\forms\EditPricesForm;
use yii\helpers\Url;
use yii\web\Response;
use yii\data\Pagination;

class PricesController extends AdminController {

    public function actionIndex() {
        $status = false;
        $options = new Prices();
        $query = $options->getAllCat(false, ['t.sort' => SORT_ASC], false);

        $cat = new PricesCat();
        $subCat = [];

        $catId = Yii::$app->request->getQueryParam('cat_id') ? Yii::$app->request->getQueryParam('cat_id') : false;
        $subId = Yii::$app->request->getQueryParam('sub_id') ? Yii::$app->request->getQueryParam('sub_id') : false;

        if ($catId) {
            $items = $cat->findByColumn([['parent_id' => $catId], ['active' => 1]], 'and');
            foreach ($items as $item) {
                $subCat[$item->id] = $item->title;
            }
            $status = true;
        }

        if ($subId) {
            $items = $options->filter($query, ['cat_id' => $subId]);
            $options = $items->all();
            $pager = null;
        } else {
            $items = $options->filter($query, []);
            $pager = new Pagination(['totalCount' => $items->count(), 'pageSize' => self::PAGE_SIZE]);
            $pager->pageSizeParam = false;

            $options = $items->offset($pager->offset)
                ->limit($pager->limit)
                ->all();
        }

        $categories = $cat->findByColumn(['parent_id' => null]);
        foreach ($categories as $item) {
            $parentCat[$item->id] = $item->title;
        }

        if (Yii::$app->request->isAjax && !Yii::$app->request->isPjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'status' => $status,
                'subCat' => $subCat
            ];
        }

        return $this->render('index', [
            'options' => $options,
            'categories' => $parentCat,
            'subCat' => $subCat,
            'pager' => $pager,
            'catId' => $catId,
            'subId' => $subId
        ]);
    }

    public function actionEdit() {
        $id = Yii::$app->request->getQueryParam('id') ? Yii::$app->request->getQueryParam('id') : null;

        $form = new EditPricesForm();
        $cat = new PricesCat();
        $options = new Prices();
        $keyPage = [
            0 => 'Нет',
            'PAGE_WATER' => Prices::PAGE_WATER,
            'PAGE_HEAT' => Prices::PAGE_HEAT,
            'PAGE_SEW' => Prices::PAGE_SEW,
            'PAGE_SAN' => Prices::PAGE_SAN,
            'PAGE_AUTO' => Prices::PAGE_AUTO
        ];

        $categories = $cat->getAllCat(false, true, ['cat.id' => SORT_ASC]);

        foreach ($categories as $item) {
            if (isset($item->parentCat->id)) {
                if ($item->parent_id == $item->parentCat->id) {
                    $parentCat[$item->parentCat->title][$item->id] = $item->title;
                }
            }
            if ($item->title == 'Демонтаж') {
                $parentCat[$item->id] = $item->title;
            }
        }

        $model = $id ? $options->findOne(['id' => $id]) : new Prices();
        $maxSort = $options->find()->max('sort');

        if (!empty($model)) {
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $model->title = $form->title;
                $model->price = $form->price;
                $model->unit = $form->unit;
                $model->cat_id = $form->cat_id;
                $model->key_page = $form->key_page != '0' ? $form->key_page : null;

                if (is_null($id)) {
                    $model->sort = $maxSort + 1;
                }
                $model->active = isset(Yii::$app->request->post('EditPricesForm')['active']) ? 1 : 0;
                $model->save();
                $id = $id ? $id : Yii::$app->db->lastInsertID;
                Yii::$app->getResponse()->redirect(Url::toRoute(['prices/edit', 'id' => $id]));
            }

            return $this->render('edit', [
                'edit' => $form,
                'categories' => $parentCat,
                'model' => $model,
                'keyPage' => $keyPage
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

            $slides = Prices::findOne($id);
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

    public function actionSort() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $data = Yii::$app->request->getQueryParams()['data'];

            $categories = new Prices();
            $categories->updateData('sk_prices', 'sort', $data, 'id');

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

            $slides = Prices::findOne($id);
            if ($slides->delete() !== false) {
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