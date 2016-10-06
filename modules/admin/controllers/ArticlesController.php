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

class ArticlesController extends NewsController {

    public function actionIndex() {
        $blog = new Blog();
        $articles = $blog->findByColumn(['cat_id' => 2], '', ['date' => SORT_DESC], false);

        $pager = new Pagination(['totalCount' => $articles->count(), 'pageSize' => self::PAGE_SIZE]);
        $pager->pageSizeParam = false;

        $articles = $articles->offset($pager->offset)
            ->limit($pager->limit)
            ->all();

        return $this->render('index', [
            'articles' => $articles,
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
                    if ($form->upload(Blog::IMG_FOLDER_ART, $form->preview)) {
                        $resize = new ImageResize($form->preview->name, Blog::IMG_FOLDER_ART, Blog::IMG_FOLDER_ART, 172, '', 'mini');
                        $resize->resize();
                    }
                    $model->title = Yii::$app->request->post('EditNewsForm')['title'];
                    $model->text = Yii::$app->request->post('EditNewsForm')['text'];
                    $model->preview = empty($form->preview->name) ? empty(Yii::$app->request->post('EditNewsForm')['hidden']) ? null : Yii::$app->request->post('EditNewsForm')['hidden'] : $form->preview->name;
                    $model->cat_id = 2;
                    $model->active = isset(Yii::$app->request->post('EditNewsForm')['active']) ? 1 : 0;
                    $model->save();
                    $id = $id ? $id : Yii::$app->db->lastInsertID;

                    Yii::$app->getResponse()->redirect(Url::toRoute(['articles/edit', 'id' => $id]));
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

            $article_id = (int)Yii::$app->request->getQueryParams()['articleId'];

            if ($article_id) {
                $article = Blog::findOne($article_id);
                $article->preview = null;
                $res = $article->update();
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

}