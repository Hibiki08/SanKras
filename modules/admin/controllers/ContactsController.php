<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\HttpException;
use app\models\System;
use app\models\forms\EditContactsForm;
use yii\helpers\Url;
use yii\helpers\Html;

class ContactsController extends AdminController {

    public function actionIndex() {
        $contacts = new System();
        $contacts = $contacts->find()->all();

        return $this->render('index', [
            'contacts' => $contacts
        ]);
    }

    public function actionEdit() {
        $id = Yii::$app->request->getQueryParam('id') ? Yii::$app->request->getQueryParam('id') : null;

        $errors = [];
        $model = new System();
        $model = $model->findOne($id);

        if (!empty($model)) {
            $form = new EditContactsForm();

            if ($form->load(Yii::$app->request->post()) && $form->validate()) {

                if (empty($errors)) {
                    $model->description = trim(Html::encode(Yii::$app->request->post('EditContactsForm')['description']));
                    $model->value = !empty(trim(Html::encode(Yii::$app->request->post('EditContactsForm')['value']))) ? trim(Html::encode(Yii::$app->request->post('EditContactsForm')['value'])) : null;
                    $model->save();
                    $id = $id ? $id : Yii::$app->db->lastInsertID;

                    Yii::$app->getResponse()->redirect(Url::toRoute(['contacts/edit', 'id' => $id]));
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

}