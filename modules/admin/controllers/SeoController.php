<?php
namespace app\modules\admin\controllers;

use app\models\Seo;
use yii\data\Pagination;
use Yii;
use app\models\forms\EditSeoForm;
use yii\helpers\Url;
use yii\web\HttpException;
use yii\web\Response;

class SeoController extends AdminController {

    public function actionIndex() {
        $seoBlocks = new Seo();
        $quey = $seoBlocks->getAll(false, $order = ['id' => SORT_DESC], false);

        $pager = new Pagination(['totalCount' => $quey->count(), 'pageSize' => self::PAGE_SIZE]);
        $pager->pageSizeParam = false;

        $requests = $quey->offset($pager->offset)
            ->limit($pager->limit)
            ->all();


        return $this->render('index', [
            'seoBlocks' => $requests
        ]);
    }

    public function actionEdit() {
        $id = Yii::$app->request->getQueryParam('id') ? Yii::$app->request->getQueryParam('id') : null;

        $errors = [];

        $form = new EditSeoForm();
        $seo = new Seo();
        $model = $id ? $seo->findOne(['id' => $id]) : new Seo();

        if (!empty($model)) {
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {

                if (empty($errors)) {
                    $model->title = $form->title;
                    $model->short_text = $form->short_text;
                    $model->full_text = $form->full_text;
                    $model->active = isset(Yii::$app->request->post('EditSeoForm')['active']) ? 1 : 0;
                    if (!empty($id)) {
                        $model->block_key = strtoupper($form->block_key);
                        $model->update();
                    } else {
                        $model->block_key = strtoupper($form->block_key);
                        $model->save();
                    }
                    $id = $id ? $id : Yii::$app->db->lastInsertID;

                    Yii::$app->getResponse()->redirect(Url::toRoute(['seo/edit', 'id' => $id]));
                }
            }

            return $this->render('edit', [
                'edit' => $form,
                'model' => $model,
                'errors' => $errors,
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

            $seo = Seo::findOne($id);
            $seo->active = $value;
            if ($seo->update() !== false) {
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

            $seo = new Seo();
            $seo = $seo->findOne($id);
            if ($seo) {
                if ($seo->delete() !== false) {
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