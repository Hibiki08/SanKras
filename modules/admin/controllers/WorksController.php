<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Works;
use app\models\WorksCat;
use app\models\WorksSlides;
use app\models\forms\EditWorksForm;
use yii\helpers\Url;
use yii\web\Response;
use yii\data\Pagination;
use yii\web\UploadedFile;
use app\components\ImageResize;

class WorksController extends AdminController {

    public function actionIndex() {
        $status = false;
        $works = new Works();
        $query = $works->getAllCat(['works.id' => SORT_ASC], false);

        $cat = new WorksCat();
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
            $items = $works->filter($query, ['cat_id' => $subId]);
        } else {
            $items = $works->filter($query, []);
        }

        $categories = $cat->findByColumn(['parent_id' => null]);
        foreach ($categories as $item) {
            $parentCat[$item->id] = $item->title;
        }

        $pager = new Pagination(['totalCount' => $items->count(), 'pageSize' => self::PAGE_SIZE]);
        $pager->pageSizeParam = false;

        $works = $items->offset($pager->offset)
            ->limit($pager->limit)
            ->all();

        if (Yii::$app->request->isAjax && !Yii::$app->request->isPjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'status' => $status,
                'subCat' => $subCat
            ];
        }

        return $this->render('index', [
            'works' => $works,
            'categories' => $parentCat,
            'subCat' => $subCat,
            'pager' => $pager,
            'catId' => $catId,
            'subId' => $subId
        ]);
    }

    public function actionEdit() {
        $id = Yii::$app->request->getQueryParam('id') ? Yii::$app->request->getQueryParam('id') : null;

        $errors = [];

        $form = new EditWorksForm();
        $works = new Works();
        $worksCat = new WorksCat();
        $image = new WorksSlides();
        $slides = $id ? $image->findByColumn(['work_id' => $id]) : new WorksSlides();
        $model = $id ? $works->findByColumn(['id' => $id])[0] : new Works();

        $categories = $worksCat->getAllCat('cat.parent_id IS NOT NULL', true, ['cat.id' => SORT_ASC]);
        foreach ($categories as $item) {
            if ($item->parent_id == $item->category->id) {
                $parentCat[$item->category->title][$item->id] = $item->title;
            }
        }

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $form->slides = UploadedFile::getInstances($form, 'slides');
            $form->preview = UploadedFile::getInstance($form, 'preview');

            $preview = !empty(Yii::$app->request->post('EditWorksForm')['hidden']) ?
                Yii::$app->request->post('EditWorksForm')['hidden'] : false;

            if ((is_null($form->preview) && !$preview) || (!$id && !$form->preview->name)) {
                $errors['emptyImage'] = 'Не выбрано превью!';
            }

            if (empty($errors)) {
                if ($form->upload(Works::IMG_FOLDER, $form->preview)) {
                    $resize = new ImageResize($form->preview->name, Works::IMG_FOLDER, Works::IMG_FOLDER, 172, '', 'mini');
                    $resize->resize();
                }
                $model->title = Yii::$app->request->post('EditWorksForm')['title'];
                $model->text = Yii::$app->request->post('EditWorksForm')['text'];
                $model->place = Yii::$app->request->post('EditWorksForm')['place'];
                $model->preview = !empty($form->preview->name) ? $form->preview->name : Yii::$app->request->post('EditWorksForm')['hidden'];
                $model->preview_text = isset(Yii::$app->request->post('EditWorksForm')['preview_text']) ?
                    Yii::$app->request->post('EditWorksForm')['preview_text'] : null;
                $model->cat_id = Yii::$app->request->post('EditWorksForm')['cat_id'];
                $model->active = isset(Yii::$app->request->post('EditWorksForm')['active']) ? 1 : 0;
                $model->save();
                $id = $id ? $id : Yii::$app->db->lastInsertID;

                if (!empty($form->slides)) {
                    $images = [];
                    $i = 0;
                    foreach ($form->slides as $slide) {
                        if ($form->upload(Works::IMG_FOLDER, $slide)) {
                            $resize = new ImageResize($slide->name, Works::IMG_FOLDER, Works::IMG_FOLDER, 172, '', 'mini');
                            $resize->resize();

                            $images[$i]['slide'] = $slide->name;
                            $images[$i]['work_id'] = $id;
                            ++$i;
                        }
                    }

                    $image->insertData(WorksSlides::tableName(), $images);
                }

                if (isset(Yii::$app->request->post('EditWorksForm')['slide'])) {
                    $data = Yii::$app->request->post('EditWorksForm')['slide'];
                    $image->updateData(WorksSlides::tableName(), 'text', $data, 'id');
                }

                Yii::$app->getResponse()->redirect(Url::toRoute(['works/edit', 'id' => $id]));
            }
        }

        return $this->render('edit', [
            'edit' => $form,
            'errors' => $errors,
            'model' => $model,
            'categories' => $parentCat,
            'slides' => $slides
        ]);
    }

    public function actionDeleteSlide() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $work_id = (int)Yii::$app->request->getQueryParams()['workId'];
            $slide_id = (int)Yii::$app->request->getQueryParams()['slideId'];

            if ($work_id) {
                $work = Works::findOne($work_id);
                $work->preview = null;
                $work->active = 0;
                $res = $work->update();
                if ($res) {
                    $response = true;
                }
            }
            if ($slide_id) {
                $slide = WorksSlides::findOne($slide_id);
                if ($slide->delete() !== false) {
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

            $slides = Works::findOne($id);
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

            $slides = Works::findOne($id);
            if ($slides->delete() !== false) {
                $slide = WorksSlides::findAll(['work_id' => $id]);
                if ($slide) {
                    WorksSlides::deleteAll(['work_id' => $id]);
                }
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