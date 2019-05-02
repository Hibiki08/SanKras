<?php

namespace app\modules\admin\controllers;

use app\models\BlogCat;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\HttpException;
use app\models\Blog;
use yii\data\Pagination;
use app\models\forms\EditNewsForm;
use yii\web\UploadedFile;
use app\components\ImageResize;
use yii\helpers\Url;
use yii\web\Response;

class ArticlesController extends NewsController {

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
        $articles = $blog->getAllCat('category.parent_id = ' . BlogCat::ART_ID . ' OR blog.cat_id = ' . BlogCat::ART_ID, ['date' => SORT_DESC], false);

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
        $id = Yii::$app->request->getQueryParam('id') ? (int)Yii::$app->request->getQueryParam('id') : null;

        $errors = [];

        $form = new EditNewsForm();
        $blog = new Blog();
        $model = $id ? $blog->findOne(['id' => $id]) : new Blog();

        $cat = new BlogCat();
        $parentCat[0] = 'Нет';
        $categories = $cat->find()->where('parent_id IS NOT NULL')->all();
        foreach ($categories as $item) {
            $parentCat[$item->id] = $item->description;
        }

        if (!empty($model)) {
            $form->setOldUrl($model->url);
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $form->preview = UploadedFile::getInstance($form, 'preview');

                if (empty($errors)) {
                    if ($form->upload(Blog::IMG_FOLDER_ART, $form->preview)) {
                        if ($id && !empty($model->preview)) {
                            $path = Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . Blog::IMG_FOLDER_ART;
                            file_exists($path . $model->preview) ? unlink($path . $model->preview) : false;
                            file_exists($path . 'mini_' .$model->preview) ? unlink($path . 'mini_' . $model->preview) : false;
                            file_exists($path . 'prev_' . $model->preview) ? unlink($path . 'prev_' . $model->preview) : false;
                        }
                        $resize = new ImageResize($form->preview->name, Blog::IMG_FOLDER_ART, Blog::IMG_FOLDER_ART, 172, '', 'mini');
                        $resize->resize();
                        $resize = new ImageResize($form->preview->name, Blog::IMG_FOLDER_ART, Blog::IMG_FOLDER_ART, 370, '', 'prev');
                        $resize->resize();
                    }
                    $model->title = Yii::$app->request->post('EditNewsForm')['title'];
                    $model->url = Yii::$app->request->post('EditNewsForm')['url'];
                    $model->text = Yii::$app->request->post('EditNewsForm')['text'];
                    $model->preview = empty($form->preview->name) ? empty(Yii::$app->request->post('EditNewsForm')['hidden']) ? null : Yii::$app->request->post('EditNewsForm')['hidden'] : $form->preview->name;
                    $model->cat_id = $form->category != 0 ? $form->category : BlogCat::ART_ID;
                    $model->active = isset(Yii::$app->request->post('EditNewsForm')['active']) ? 1 : 0;
                    if (isset($id)) {
                        $date = $model->date;
                        $model->date = $date;
                    }
                    $model->save();
                    $id = $id ? $id : Yii::$app->db->lastInsertID;

                    Yii::$app->getResponse()->redirect(Url::toRoute(['articles/edit', 'id' => $id]));
                }
            }

            return $this->render('edit', [
                'edit' => $form,
                'model' => $model,
                'errors' => $errors,
                'categories' => $parentCat,
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
                $prevName = $article->preview;
                $article->preview = null;
                if ($res = $article->update()) {
                    $path = Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . Blog::IMG_FOLDER_ART;
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

}