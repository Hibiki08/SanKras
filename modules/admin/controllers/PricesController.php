<?php

namespace app\modules\admin\controllers;

use app\models\PricesInPage;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\HttpException;
use app\models\Prices;
use app\models\PricesCat;
use app\components\ImageResize;
use yii\web\UploadedFile;
use app\models\forms\EditPricesForm;
use yii\helpers\Url;
use yii\web\Response;
use yii\data\Pagination;
use app\models\Services;

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

    /**
     * @return string
     * @throws Exception
     * @throws HttpException
     */
    public function actionEdit() {
        $id = Yii::$app->request->getQueryParam('id') ? Yii::$app->request->getQueryParam('id') : null;

        $form = new EditPricesForm();
        $cat = new PricesCat();
        $options = new Prices();
        $services = new Services();
        $priceInPage = new PricesInPage();

        $parentCat = [];
        $pagePlace = [];
        $checkedItems = [];

        $pages = $services->getAll();
        if (!empty($pages)) {
            $pagePlace[0] = 'Нет';
            foreach ($pages as $item) {
                $pagePlace[$item['id']] = $item['title'];
            }
        }

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

        $model = $id ? $options->getOne(['t.id' => $id]) : new Prices();
        $maxSort = $options->find()->max('sort');

        $errors = [];
        if ($model->page) {
            $checkedItems = ArrayHelper::map($model->page, 'page_id', 'page_id');
        } else {
            array_unshift($checkedItems, 0);
        }
        if ($form->load(Yii::$app->request->post()) && $form->validate()
            && (isset(Yii::$app->request->post()['PricesInPage'])
                ? $priceInPage->load(Yii::$app->request->post()) && $priceInPage->validate()
                : true)) {
            $form->image = UploadedFile::getInstance($form, 'image');
            if (!$id) {
                if (!$form->image) {
                    $errors['emptyImage'] = 'Не выбрано изображение!';
                }
            }

            if ($form->upload(Prices::IMG_FOLDER)) {
                $resize = new ImageResize($form->image->name, Prices::IMG_FOLDER, Prices::IMG_FOLDER, 200, '', 'admin');
                $resize->resize();
            }
            if (!empty($form->image)) {
                $model->image = "/images/".Prices::IMG_FOLDER.$form->image->name;
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->title = $form->title;
                $model->price = $form->price;
                $model->unit = $form->unit;
                $model->cat_id = $form->cat_id;
                if (is_null($id)) {
                    $model->sort = $maxSort + 1;
                }
                $model->active = isset(Yii::$app->request->post('EditPricesForm')['active']) ? 1 : 0;
                $model->save();

                $id = $id ? $id : Yii::$app->db->lastInsertID;
                $pages = $form->page;
                if (!empty($pages)) {
                    $i = 0;
                    $priceInPage->deleteAll(['price_id' => $id]);
                    $data = [];
                    if ($pages[0] != 0) {
                        foreach ($pages as $page) {
                            $data[$i]['price_id'] = $id;
                            $data[$i]['page_id'] = $page;
                            $i++;
                        }
                        $priceInPage->insertData(PricesInPage::tableName(), $data);
                    }
                }

                if ($priceInPage->sort) {
                    foreach ($priceInPage->sort as $pageId => $order) {
                        /** @var PricesInPage $priceInPageOrder */
                        $priceInPageOrder = PricesInPage::find()->where([
                            'price_id' => $id,
                            'page_id' => $pageId,
                        ])->one();
                        if ($priceInPageOrder) {
                            $priceInPageOrder->order = $order;
                            $priceInPageOrder->save(false);

                        }
                    }
                }
                $transaction->commit();
                Yii::$app->getResponse()->redirect(Url::toRoute(['prices/edit', 'id' => $id]));
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        } else {
//            var_dump($priceInPage->getErrors());
//            var_dump($form->getErrors());
//            die;
        }

        return $this->render('edit', [
            'edit' => $form,
            'errors' => $errors,
            'categories' => $parentCat,
            'model' => $model,
            'pagePlace' => $pagePlace,
            'checkedItems' => $checkedItems,
            'priceInPage' => $model->page,
        ]);
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

    /**
     * @param $id
     * @return array
     * @throws BadRequestHttpException
     */
    public function actionDeletePreview($id) {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $price = Prices::findOne($id);
            if ($price) {
                $prevName = $price->image;
                $price->image = null;

                if ($price->save()) {
                    $path = Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage']
                        . Prices::IMG_FOLDER;
                    $this->unlinkFiles($path, $prevName, ['admin_']);
                    $response = true;
                }
            } else {
                throw new BadRequestHttpException('Услуга не найдена');
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'status' => $response,
            ];
        } else {
            throw new BadRequestHttpException('Ajax only');
        }
    }

}