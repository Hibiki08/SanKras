<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\BadRequestHttpException;
use yii\web\HttpException;
use app\models\Works;
use app\models\WorksCat;
use app\models\WorksSlides;
use app\models\forms\EditWorksForm;
use yii\helpers\Url;
use yii\web\Response;
use yii\data\Pagination;
use yii\web\UploadedFile;
use app\components\ImageResize;
use app\components\Translate;

class WorksController extends AdminController {

    public function actionIndex() {
        $status = false;
        $works = new Works();
        $query = $works->getAllCat(false, '(case when works.sort = 0 then 1 else 0 end), works.sort ASC, works.id DESC', false);

        $cat = new WorksCat();
        $subCat = [];

        $catId = Yii::$app->request->getQueryParam('cat_id') ? Yii::$app->request->getQueryParam('cat_id') : false;

        if ($catId) {
            $items = $works->filter($query, ['cat_id' => $catId]);
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
        ]);
    }

    public function actionEdit() {
        $id = Yii::$app->request->getQueryParam('id') ? Yii::$app->request->getQueryParam('id') : null;

        $errors = [];

        $form = new EditWorksForm();
        $works = new Works();
        $worksCat = new WorksCat();
        $image = new WorksSlides();
        $slides = $id ? $image->findAll(['work_id' => $id]) : new WorksSlides();
        $model = $id ? $works->getAllCat(['works.id' => $id])[0] : new Works();

        if (!empty($model)) {
            $form->setOldUrl($model->url);
            $categories = $worksCat->findAll(['parent_id' => null]);
            foreach ($categories as $item) {
                $parentCat[$item->id] = $item->title;
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
                    $previewItems = [];
                    $workItems = [];

                    $items = explode(';', $form->preview_items);
                    foreach ($items as $item) {
                        if (!empty($item)) {
                            $previewItems[] = trim($item);
                        } else {
                            continue;
                        }
                    }
                    $previewItems = implode(";\n", $previewItems);

                    $items = explode(';', $form->work_items);
                    foreach ($items as $item) {
                        if (!empty($item)) {
                            $workItems[] = trim($item);
                        } else {
                            continue;
                        }
                    }
                    $workItems = implode(";\n", $workItems);

                    $translate = new Translate();

                    $newsPrev = !is_null($model->preview) ? $model->preview : false;

                    $model->title = $form->title;
                    $model->url = $form->url;
                    $model->text = $form->text;
                    $model->cat_id = $form->cat_id;
                    $model->year = $form->year;
                    $model->area = $form->area;
                    $model->cost_install = $form->cost_install;
                    $model->cost_material = $form->cost_material;
                    $model->time = !empty($form->time) ? $form->time : null;
                    $model->video = !empty($form->video) ? $form->video : null;
                    $model->preview_items = $previewItems;
                    $model->work_items = $workItems;
                    $model->preview = !empty($form->preview->name) ? $translate->translate($form->preview->name) : Yii::$app->request->post('EditWorksForm')['hidden'];
                    $model->active = isset(Yii::$app->request->post('EditWorksForm')['active']) ? 1 : 0;
                    $model->sort = !empty($form->sort) ? $form->sort : 0;
                    $model->save();
                    $id = $id ? $id : Yii::$app->db->lastInsertID;

                    $path = Works::IMG_FOLDER . 'work(' . $id . ')/';
                    $create = file_exists(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path) ? true: mkdir(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path);

                    if ($create) {
                        if ($form->upload($path, $form->preview)) {
                            if ($id && $newsPrev) {
                                $path = Works::IMG_FOLDER . 'work(' . $model->id . ')/';
                                unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . $newsPrev);
                                unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . 'mini_prev_' . $newsPrev);
                                unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . 'prev_' . $newsPrev);
                            }
                            $resizeAdminPrev = new ImageResize($form->preview->name, $path, $path, 172, '', 'mini_prev');
                            $resizeAdminPrev->resize();
                            $resizePrev = new ImageResize($form->preview->name, $path, $path, 370, '', 'prev');
                            $resizePrev->resize();
                        }

                        if (!empty($form->slides)) {
                            $images = [];
                            $i = 0;
                            foreach ($form->slides as $slide) {
                                if ($form->upload($path, $slide)) {
                                    $resizeAdminPrev = new ImageResize($slide->name, $path, $path, 172, '', 'mini');
                                    $resizeAdminPrev->resize();
                                    $resizeSlider = new ImageResize($slide->name, $path, $path, 225, '', 'mini_slider');
                                    $resizeSlider->resize();

                                    $images[$i]['slide'] = $slide->name;
                                    $images[$i]['work_id'] = $id;
                                    ++$i;
                                }
                            }

                            $image->insertData(WorksSlides::tableName(), $images);
                        }
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
        } else {
            throw new HttpException(404 ,'Такой страницы нет!');
        }
    }

    public function actionSort() {
        if (Yii::$app->request->isAjax) {
            $response = false;
            $id = (int)Yii::$app->request->getQueryParams()['id'];
            $value = (int)Yii::$app->request->getQueryParams()['value'];

            $works = Works::findOne($id);
            $works->sort = !empty($value) ? $value : 0;
            if ($works->update() !== false) {
                $response = true;
            }
        } else {
            throw new BadRequestHttpException('Ajax only');
        }
        Yii::$app->end();
    }

    public function actionDeleteSlide() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $work_id = (int)Yii::$app->request->getQueryParams()['workId'];
            $slide_id = (int)Yii::$app->request->getQueryParams()['slideId'];

            if ($work_id) {
                $work = Works::findOne($work_id);
                $prevName = $work->preview;
                $path = Works::IMG_FOLDER . 'work(' . $work_id . ')/';
                $work->preview = null;
                $work->active = 0;
                if ($work->update()) {
                    unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . $prevName);
                    unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . 'mini_prev_' . $prevName);
                    unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . 'prev_' . $prevName);
                    $response = true;
                }
            }
            if ($slide_id) {
                $slide = WorksSlides::findOne($slide_id);
                $path = Works::IMG_FOLDER . 'work(' . $slide->work_id . ')/';
                $slideName = $slide->slide;
                if ($slide->delete() !== false) {
                    unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . $slideName);
                    unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . 'mini_' . $slideName);
                    unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . 'mini_slider_' . $slideName);
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

            $slides = Works::findOne($id);
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

            $work = Works::findOne($id);
            $path = Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . Works::IMG_FOLDER . 'work(' . $id . ')/';
            if ($res = $work->delete() !== false) {
                if ($res) {
                    $response = WorksSlides::deleteAll(['work_id' => $id]);
                    if ($objs = glob($path . "/*")) {
                        foreach($objs as $obj) {
                            unlink($obj);
                        }
                        rmdir($path);
                    }
                    if ($response || $response == 0) {
                        $response = !is_dir($path) ? true : false;
                    }
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