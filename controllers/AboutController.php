<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Opinions;
use yii\data\Pagination;
use app\models\forms\EditOpinionsForm;
use yii\web\UploadedFile;

class AboutController extends Controller {

    const PAGE_SIZE = 3;

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionOpinions() {
        $opinions = Opinions::find()->orderBy(['id' => SORT_DESC])->where(['active' => 1]);
        $pager = new Pagination(['totalCount' => $opinions->count(), 'pageSize' => self::PAGE_SIZE]);
        $pager->pageSizeParam = false;

        $opinions = $opinions->offset($pager->offset)
            ->limit($pager->limit)
            ->all();

        $form = new EditOpinionsForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $model = new Opinions();
            $form->photo = UploadedFile::getInstance($form, 'photo');

            $model->name = trim($form->name);
            $model->description = trim($form->description);
            $model->photo = !empty($form->photo->name) ? $form->photo->name : Yii::$app->request->post('EditOpinionsForm')['hidden'];
            $model->text = trim($form->text);
            $model->active = isset(Yii::$app->request->post('EditOpinionsForm')['active']) ? 1 : 0;
            $model->save();

            $path = Opinions::IMG_FOLDER . 'opinion(' . $id . ')/';
            $create = file_exists(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path) ? true: mkdir(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path);
            if ($create) {
                if ($form->upload($path, $form->photo)) {
                    $resizeMini = new ImageResize($form->photo->name, $path, $path, 135, '', 'mini');
                    $resizeMini->resize();
                }
            }
            Yii::$app->getResponse()->redirect(Url::toRoute(['opinions/edit', 'id' => $id]));
        }

        return $this->render('opinions', [
            'opinions' => $opinions,
            'pager' => $pager,
            'opins' => $form
        ]);
    }

}