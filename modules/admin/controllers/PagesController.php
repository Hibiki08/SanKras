<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\BadRequestHttpException;
use yii\web\HttpException;
use app\models\Services;
use app\models\ServicesSlides;
use app\models\ServicesProjectdocs;
use app\models\forms\EditServiceForm;
use yii\helpers\Url;
use yii\web\Response;
use yii\data\Pagination;
use yii\web\UploadedFile;
use app\components\ImageResize;
use app\components\Translate;
use yii\bootstrap\ActiveForm;

class PagesController extends AdminController {

    const GET_ACCESS_DENIED = [
        'delete-slide',
    ];

    const POST_ACCESS_DENIED = [
        'index',
        //'edit',
        'sort',
        'delete',
        'active',
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
        $status = false;
        $services = new Services();
        $query = $services->getAllServ(false, 'sk_services.parent_id, sk_services.sort ASC, ISNULL(sk_services.sort),  sk_services.id ASC', false);

        $parentId = Yii::$app->request->getQueryParam('parent_id') ? (int)Yii::$app->request->getQueryParam('parent_id') : false;

        if ($parentId) {
            $items = $services->filter($query, ['sk_services.parent_id' => $parentId]);
        } else {
            $items = $services->filter($query, []);
        }

        $parentCat = [];
        
        $categories = $services->getAllForMenu(false, 'sk_services.parent_id, sk_services.sort ASC, ISNULL(sk_services.sort),  sk_services.id ASC');
        foreach ($categories as $item) {
                $parentCat[$item['id']] = $item['title'];
            if (isset($item['sub_cat']) && is_array($item['sub_cat'])) {
                foreach ($item['sub_cat'] as $val) {
                    if (isset($val['sub_cat']) && is_array($val['sub_cat'])) {
                        $parentCat[$val['id']] = $val['title'];
                    }

                }
            }
        }

        $pager = new Pagination(['totalCount' => $items->count(), 'pageSize' => self::PAGE_SIZE]);
        $pager->pageSizeParam = false;

        $services = $items->offset($pager->offset)
            ->limit($pager->limit)
            ->all();

        return $this->render('index', [
            'services' => $services,
            'categories' => $parentCat,
            'pager' => $pager,
            'parentId' => $parentId,
        ]);
    }

    public function actionEdit() {
        $id = Yii::$app->request->getQueryParam('id') ? (int)Yii::$app->request->getQueryParam('id') : null;

        $errors = [];

        $form = new EditServiceForm();

        $services = new Services();
        $image = new ServicesSlides();
        $slides = $id ? ServicesSlides::findAll(['serv_id' => $id]) : new ServicesSlides();
        $ServicesProjectdocs = new ServicesProjectdocs();
        $projectdocs = $id ? ServicesProjectdocs::findAll(['serv_id' => $id]) : new ServicesProjectdocs();
        $model = $id ? $services->getAllServ(['sk_services.id' => $id])[0] : new Services();

        if (!empty($model)) {
            $form->setOldAttribute($model->link);
            $categories = $services->getAllForMenu(false, false);
            $parentCat[0] = 'Нет';

            foreach ($categories as $item) {
                $parentCat[$item['id']] = $item['title'];
                if (isset($item['sub_cat']) && is_array($item['sub_cat'])) {
                    foreach ($item['sub_cat'] as $val) {
                        if (isset($val['sub_cat']) && is_array($val['sub_cat'])) {
                            $parentCat[$val['id']] = $val['title'];
                        }

                    }
                }
            }

            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $form->slides = UploadedFile::getInstances($form, 'slides');
                $form->projectdocs = UploadedFile::getInstances($form, 'projectdocs');
                $form->image = UploadedFile::getInstance($form, 'image');

                if (empty($errors)) {
                    $translate = new Translate();

                    $newsPrev = !is_null($model->image) ? $model->image : false;

                    $model->link = mb_strtolower($form->link);
                    $model->title = $form->title;
                    $model->title_menu = $form->title_menu;
                    $model->parent_id = $form->parent_id ? $form->parent_id : null;
                    $model->form_title = $form->form_title;
                    $model->tag_title = $form->tag_title;
                    $model->tag_keywords = $form->tag_keywords;
                    $model->tag_description = $form->tag_description;
                    $model->prev_field = $form->prev_field;
                    $model->gallery_title = $form->gallery_title;
                    $model->main_text = $form->main_text;
                    $model->videos_show = $_POST['EditServiceForm']['videos_show']?1:0;
                    $model->videos = !empty($_POST['EditServiceForm']['videos']) ? strip_tags(json_encode($_POST['EditServiceForm']['videos'])) : NULL;
                    $model->videos_name = !empty($_POST['EditServiceForm']['videos_name']) ? strip_tags(json_encode($_POST['EditServiceForm']['videos_name'])) : NULL;
                    $model->work_text = $form->work_text;
                    $model->price_title = $form->price_title;
                    $model->table_ex = isset(Yii::$app->request->post('EditServiceForm')['table_ex']) ? 1 : 0;
                    $model->package_ex = isset(Yii::$app->request->post('EditServiceForm')['package_ex']) ? 1 : 0;
                    $model->packages = $form->packages;
                    $model->projectdocs_title = $form->projectdocs_title;
                    $model->projectdocs_active = isset(Yii::$app->request->post('EditServiceForm')['projectdocs_active']) ? 1 : 0;
                    if (!empty($form->image->name)) {
                        $model->image = $translate->translate($form->image->name);
                    }
//                    $model->image = !empty($form->image->name) ? $translate->translate($form->image->name) : '';
                    $model->video = $form->video;
                    $model->img_video = $form->img_video;
                    $model->benefits = isset(Yii::$app->request->post('EditServiceForm')['benefits']) ? 1 : 0;
                    $model->active = isset(Yii::$app->request->post('EditServiceForm')['active']) ? 1 : 0;
                    $model->save();
                    $id = $id ? $id : Yii::$app->db->lastInsertID;

                    if (!is_null($form->image)) {
                        $path = Services::IMG_FOLDER . 'page(' . $id . ')/';
                        $create = file_exists(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path) ? true: mkdir(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path);

                        if ($create) {
                            if ($form->upload($path, $form->image)) {
                                if ($id && $newsPrev) {
                                    $path = Services::IMG_FOLDER . 'page(' . $model->id . ')/';
                                }
                                $resizeAdminPrev = new ImageResize($form->image->name, $path, $path, 172, '', 'mini_prev');
                                $resizeAdminPrev->resize();
                                $resizePrev = new ImageResize($form->image->name, $path, $path, 520, '', 'prev');
                                $resizePrev->resize();
                            }
                        }
                    }
                    if (!empty($form->slides)) {
                        $path = ServicesSlides::IMG_FOLDER . 'page(' . $id . ')/';
                        $create = file_exists(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path) ? true: mkdir(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path);

                        if ($create) {
                                $images = [];
                                $i = 0;
                                foreach ($form->slides as $slide) {
                                    if ($form->upload($path, $slide)) {
                                        $resizeAdminPrev = new ImageResize($slide->name, $path, $path, 172, '', 'mini');
                                        $resizeAdminPrev->resize();
                                        $resizeSlider = new ImageResize($slide->name, $path, $path, 250, '', 'mini_slider');
                                        $resizeSlider->resize();

                                        $images[$i]['slide'] = $slide->name;
                                        $images[$i]['serv_id'] = $id;
                                        ++$i;
                                    }
                                }

                                $image->insertData(ServicesSlides::tableName(), $images);
                        }
                    }

                    $data = isset(Yii::$app->request->post('EditServiceForm')['slide_text']) ? Yii::$app->request->post('EditServiceForm')['slide_text'] : false;
                    if ($data) {
                        $image->updateData(ServicesSlides::tableName(), 'text', $data, 'id');
                    }
                    $data = isset(Yii::$app->request->post('EditServiceForm')['slide_description']) ? Yii::$app->request->post('EditServiceForm')['slide_description'] : false;
                    if ($data) {
                        $image->updateData(ServicesSlides::tableName(), 'description', $data, 'id');
                    }
					
                    if (!empty($form->projectdocs)) {
                        $path = ServicesProjectdocs::IMG_FOLDER . 'page(' . $id . ')/';
                        $create = file_exists(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path) ? true: mkdir(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path);

                        if ($create) {
                                $images = [];
                                $i = 0;
                                foreach ($form->projectdocs as $doc) {
                                    if ($form->upload($path, $doc)) {
                                        $resizeAdminPrev = new ImageResize($doc->name, $path, $path, 172, '', 'mini');
                                        $resizeAdminPrev->resize();
                                        $resizeSlider = new ImageResize($doc->name, $path, $path, 250, '', 'mini_slider');
                                        $resizeSlider->resize();

                                        $images[$i]['image'] = $doc->name;
                                        $images[$i]['serv_id'] = $id;
                                        ++$i;
                                    }
                                }

                                $ServicesProjectdocs->insertData(ServicesProjectdocs::tableName(), $images);
                        }
                    }

                    $data = isset(Yii::$app->request->post('EditServiceForm')['projectdocs_name']) ? Yii::$app->request->post('EditServiceForm')['projectdocs_name'] : false;
                    if ($data) {
                        $ServicesProjectdocs->updateData(ServicesProjectdocs::tableName(), 'name', $data, 'id');
                    }
                    $data = isset(Yii::$app->request->post('EditServiceForm')['projectdocs_description']) ? Yii::$app->request->post('EditServiceForm')['projectdocs_description'] : false;
                    if ($data) {
                        $ServicesProjectdocs->updateData(ServicesProjectdocs::tableName(), 'description', $data, 'id');
                    }

                    Yii::$app->getResponse()->redirect(Url::toRoute(['pages/edit', 'id' => $id]));
                }
            }

            return $this->render('edit', [
                'edit' => $form,
                'errors' => $errors,
                'model' => $model,
                'categories' => $parentCat,
                'slides' => $slides,
                'projectdocs' => $projectdocs
            ]);
        } else {
            throw new HttpException(404 ,'Такой страницы нет!');
        }
    }

    public function actionSort() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $data = Yii::$app->request->getQueryParams()['data'];

            $categories = new Services();
            $categories->updateData(Services::tableName(), 'sort', $data, 'id');

            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'status' => true,
            ];
        } else {
            throw new BadRequestHttpException('Ajax only');
        }
        Yii::$app->end();
    }

    public function actionDeleteSlide() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $slide_id = (int)Yii::$app->request->post('slideId');

            if ($slide_id) {
                $slide = ServicesSlides::findOne($slide_id);
                if (!empty($slide)) {
                    $path = ServicesSlides::IMG_FOLDER . 'page(' . $slide->serv_id . ')/';
                    $slideName = $slide->slide;
                    if ($slide->delete() !== false) {
                        unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . $slideName);
                        unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . 'mini_' . $slideName);
                        unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . 'mini_slider_' . $slideName);
                        $response = true;
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

    public function actionDeleteDoc() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $docId = (int)Yii::$app->request->post('docId');

            if ($docId) {
                $doc = ServicesProjectdocs::findOne($docId);
                if (!empty($doc)) {
                    $path = ServicesProjectdocs::IMG_FOLDER . 'page(' . $doc->serv_id . ')/';
                    $docName = $doc->image;
                    if ($doc->delete() !== false) {
                        unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . $docName);
                        unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . 'mini_' . $docName);
                        unlink(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . 'mini_slider_' . $docName);
                        $response = true;
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

    public function actionActive() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $id = (int)Yii::$app->request->getQueryParams()['id'];
            $value = (int)Yii::$app->request->getQueryParams()['value'];

            $slides = Services::findOne($id);
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

            $work = Services::findOne($id);
            $path = Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . Services::IMG_FOLDER . 'page(' . $id . ')/';
            if ($res = $work->delete() !== false) {
                if ($res) {
                    $response = ServicesSlides::deleteAll(['serv_id' => $id]);
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