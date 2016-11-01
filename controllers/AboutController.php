<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Opinions;
use yii\data\Pagination;
use app\models\forms\EditOpinionsForm;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

class AboutController extends Controller {

    const PAGE_SIZE = 7;

    public function init(){
        parent::init();
        Yii::$app->cache->flush();
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionOpinions() {
        session_start();
        $opinions = Opinions::find()->orderBy(['id' => SORT_DESC])->where(['active' => 1]);
        $pager = new Pagination(['totalCount' => $opinions->count(), 'pageSize' => self::PAGE_SIZE]);
        $pager->pageSizeParam = false;

        $opinions = $opinions->offset($pager->offset)
            ->limit($pager->limit)
            ->all();

        $form = new EditOpinionsForm();
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $model = new Opinions();
                $form->photo = UploadedFile::getInstance($form, 'photo');

                $model->name = strip_tags(trim($form->name));
                $model->description = strip_tags(trim($form->description));
                $model->photo = isset($form->photo->name) ? $form->photo->name : null;
                $model->text = strip_tags(trim($form->text));
                $model->active = 0;
                $model->save();

            if (isset($form->photo->name)) {
                $id = Yii::$app->db->lastInsertID;

                $path = Opinions::IMG_FOLDER . 'opinion(' . $id . ')/';
                $create = file_exists(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path) ? true: mkdir(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path);
                if ($create) {
                    $form->upload($path, $form->photo);
                }
            }

            $session->set('success', true);
            Yii::$app->getResponse()->redirect(Url::toRoute(['about/opinions']));
            return false;
        }

        return $this->render('opinions', [
            'session' => $session,
            'opinions' => $opinions,
            'pager' => $pager,
            'opins' => $form,
        ]);
    }

}