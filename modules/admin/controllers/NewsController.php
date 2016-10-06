<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\HttpException;
use app\models\Blog;
use yii\data\Pagination;
use app\models\forms\EditNewsForm;
use yii\web\UploadedFile;
use app\components\ImageResize;
use yii\helpers\Url;
use yii\web\Response;

class NewsController extends AdminController {

    public function actionIndex() {
        $blog = new Blog();
        $news = $blog->findByColumn(['cat_id' => 1], '', ['date' => SORT_DESC], false);

        $pager = new Pagination(['totalCount' => $news->count(), 'pageSize' => self::PAGE_SIZE]);
        $pager->pageSizeParam = false;

        $news = $news->offset($pager->offset)
            ->limit($pager->limit)
            ->all();

        return $this->render('index', [
            'news' => $news,
            'pager' => $pager
        ]);
    }

    public function actionEdit() {
        $id = Yii::$app->request->getQueryParam('id') ? Yii::$app->request->getQueryParam('id') : null;

        $errors = [];

        $form = new EditNewsForm();
        $blog = new Blog();
        $model = $id ? $blog->findOne(['id' => $id]) : new Blog();

        if (!empty($model)) {
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $form->preview = UploadedFile::getInstance($form, 'preview');

                if (empty($errors)) {
                    if ($form->upload(Blog::IMG_FOLDER_NEWS, $form->preview)) {
                        $resize = new ImageResize($form->preview->name, Blog::IMG_FOLDER_NEWS, Blog::IMG_FOLDER_NEWS, 172, '', 'mini');
                        $resize->resize();
                    }
                    $model->title = Yii::$app->request->post('EditNewsForm')['title'];
                    $model->text = Yii::$app->request->post('EditNewsForm')['text'];
                    $model->preview = empty($form->preview->name) ? empty(Yii::$app->request->post('EditNewsForm')['hidden']) ? null : Yii::$app->request->post('EditNewsForm')['hidden'] : $form->preview->name;
                    $model->cat_id = 1;
                    $model->active = isset(Yii::$app->request->post('EditNewsForm')['active']) ? 1 : 0;
                    $model->save();
                    $id = $id ? $id : Yii::$app->db->lastInsertID;

                    Yii::$app->getResponse()->redirect(Url::toRoute(['news/edit', 'id' => $id]));
                }
            }

            return $this->render('edit', [
                'edit' => $form,
                'model' => $model,
                'errors' => $errors
            ]);
        } else {
            throw new HttpException(404 ,'Такой страницы нет!');
        }

    }

    public function actionDeleteSlide() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $new_id = (int)Yii::$app->request->getQueryParams()['newId'];

            if ($new_id) {
                $new = Blog::findOne($new_id);
                $new->preview = null;
                $res = $new->update();
                if ($res) {
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

    public function actionActive() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $id = (int)Yii::$app->request->getQueryParams()['id'];
            $value = (int)Yii::$app->request->getQueryParams()['value'];

            $slides = Blog::findOne($id);
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

            $cat = Blog::findOne($id);
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