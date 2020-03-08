<?php

namespace app\modules\admin\controllers;

use app\models\PricesInPage;
use Yii;
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

    public function actionEdit() {
        $id = Yii::$app->request->getQueryParam('id') ? Yii::$app->request->getQueryParam('id') : null;

        $form = new EditPricesForm();
        $cat = new PricesCat();
        $options = new Prices();
        $services = new Services();
        $priceInPage = new PricesInPage();

        $parentCat = [];
        $pagePlace = [];
        $pagee = [];

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

        if (!empty($model)) {
            foreach ($model->page as $item) {
                $pagee[$item['page_id']] = ['selected ' => true];
            }
            if (empty($pagee)) {
                $pagee[0] = ['selected ' => true];
            }
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $form->image = UploadedFile::getInstance($form, 'image');
                if (!$id) {
                    if (!$form->image->name) {
                        $errors['emptyImage'] = 'Не выбрано изображение!';
                    }
                }
				
                if (empty($errors)) {
                    if ($form->upload(Prices::IMG_FOLDER)) {
                        $resize = new ImageResize($form->image->name, Prices::IMG_FOLDER, Prices::IMG_FOLDER, 200, '', 'admin');
                        $resize->resize();
                    }
                    $model->image = !empty($form->image->name) ? "/images/".Prices::IMG_FOLDER.$form->image->name : Yii::$app->request->post('EditPricesForm')['hidden'];
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
					$pages = Yii::$app->request->post('EditPricesForm')['page'];
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
					Yii::$app->getResponse()->redirect(Url::toRoute(['prices/edit', 'id' => $id]));
				}
            }

            return $this->render('edit', [
                'edit' => $form,
                'errors' => $errors,
                'categories' => $parentCat,
                'model' => $model,
                'pagePlace' => $pagePlace,
                'page' => $pagee
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