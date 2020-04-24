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

class NewsController extends AdminController {

    const GET_ACCESS_DENIED = [
        'index',
    ];

    const POST_ACCESS_DENIED = [
        'index',
        'edit',
        'active'
    ];

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (in_array($action->id, self::GET_ACCESS_DENIED)) {
                unset($_GET['module']);
                if (!empty(Yii::$app->request->get())) {
                    throw new HttpException(404, 'Такой страницы нет!');
                    Yii::$app->end();
                }
            }

            if (in_array($action->id, self::POST_ACCESS_DENIED)) {
                if (!empty(Yii::$app->request->post())) {
                    throw new HttpException(404, 'Такой страницы нет!');
                    Yii::$app->end();
                }
            }
        }

        return true;
    }

    public function actionIndex() {
        $blog = new Blog();
        $news = $blog->findByColumn(['cat_id' => BlogCat::NEWS_ID], '', ['date' => SORT_DESC], false);

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
        $id = Yii::$app->request->getQueryParam('id') ? (int)Yii::$app->request->getQueryParam('id') : null;

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
                            $path = Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . Blog::IMG_FOLDER_NEWS;
                            $this->unlinkFiles($path, $model->preview, ['mini_', 'prev_']);
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
                    $model->cat_id = BlogCat::NEWS_ID;
                    $model->active = isset(Yii::$app->request->post('EditNewsForm')['active']) ? 1 : 0;
                    if (isset($id)) {
                        $date = $model->date;
                        $model->date = $date;
                    }
                    $model->save();
                    $id = $id ? $id : Yii::$app->db->lastInsertID;

                    Yii::$app->getResponse()->redirect(Url::toRoute(['news/edit', 'id' => $id]));
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
                    $this->unlinkFiles($path, $prevName, ['mini_', 'prev_']);
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