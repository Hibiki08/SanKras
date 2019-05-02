<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\BadRequestHttpException;
use yii\web\HttpException;
use app\models\Blog;
use app\models\BlogCat;
use yii\data\Pagination;
use app\models\forms\EditNewsForm;
use yii\web\UploadedFile;
use app\components\ImageResize;
use yii\helpers\Url;
use yii\web\Response;
use app\components\Translate;

class NodeController extends AdminController {

    public function actionIndex() {
        $blog = new Blog();
        $news = $blog->findByColumn(['cat_id' => 4], '', ['date' => SORT_DESC], false);

        $pager = new Pagination(['totalCount' => $news->count(), 'pageSize' => Blog::NEWS_SIZE]);
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
            $form->setOldUrl($model->url);
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $form->preview = UploadedFile::getInstance($form, 'preview');

                    if ($form->upload(Blog::IMG_FOLDER_NEWS, $form->preview)) {
                        if ($id && !empty($model->preview)) {
                            $path = Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . 'blog/node/';
                            file_exists($path . $model->preview) ? unlink($path . $model->preview) : false;
                            file_exists($path . 'mini_' . $model->preview) ? unlink($path . 'mini_' . $model->preview) : false;
                            file_exists($path . 'prev_' . $model->preview) ? unlink($path . 'prev_' . $model->preview) : false;
                        }
                        $resize = new ImageResize($form->preview->name, Blog::IMG_FOLDER_NEWS, Blog::IMG_FOLDER_NEWS, 172, '', 'mini');
                        $resize->resize();
                        $resize = new ImageResize($form->preview->name, Blog::IMG_FOLDER_NEWS, Blog::IMG_FOLDER_NEWS, 370, '', 'prev');
                        $resize->resize();
                    }

                    $translate = new Translate();

                    $model->title = Yii::$app->request->post('EditNewsForm')['title'];
                    $model->url = Yii::$app->request->post('EditNewsForm')['url'];
                    $model->text = Yii::$app->request->post('EditNewsForm')['text'];
                    $model->preview = empty($form->preview->name) ? empty(Yii::$app->request->post('EditNewsForm')['hidden']) ? null : Yii::$app->request->post('EditNewsForm')['hidden'] : $translate->translate($form->preview->name);
                    $model->cat_id = 4;
                    $model->active = isset(Yii::$app->request->post('EditNewsForm')['active']) ? 1 : 0;
                    if (isset($id)) {
                        $date = $model->date;
                        $model->date = $date;
                    }
                    $model->save();
                    $id = $id ? $id : Yii::$app->db->lastInsertID;

                    Yii::$app->getResponse()->redirect(Url::toRoute(['node/edit', 'id' => $id]));
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
                $prevName = $new->preview;
                $new->preview = null;
                if ($res = $new->update()) {
                    $path = Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . Blog::IMG_FOLDER_NEWS;
                    file_exists($path . $prevName) ? unlink($path . $prevName) : false;
                    file_exists($path . 'mini_' . $prevName) ? unlink($path . 'mini_' . $prevName) : false;
                    file_exists($path . 'prev_' . $prevName) ? unlink($path . 'prev_' . $prevName) : false;
                    $response = true;
                }
                if ($res) {
                    $response = true;
                }
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'status' => $response,
            ];
        } else {
            throw new BadRequestHttpException('Ajax only');
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
        } else {
            throw new BadRequestHttpException('Ajax only');
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
        } else {
            throw new BadRequestHttpException('Ajax only');
        }
        Yii::$app->end();
    }

}