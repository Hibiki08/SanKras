<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\forms\LoginForm;
use app\models\forms\CardForm;
use yii\helpers\Url;
use app\models\Requests;
use yii\helpers\Html;
use yii\web\Response;
//use app\models\ContactForm;

class SiteController extends Controller {
//    public function behaviors() {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['logout'],
//                'rules' => [
//                    [
//                        'actions' => ['admin'],
//                        'allow' => true,
//                        'roles' => ['admin'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
//        ];
//    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
            return Yii::$app->getResponse()->redirect(Url::toRoute(['/admin']));
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionIndex() {
        Yii::$app->mailer->compose()
            ->setFrom('devilcatt@rambler.ru')
            ->setTo('devilcatt1@gmail.com')
            ->setSubject('Получить дисконтную карту')
            ->setTextBody('Вам будет оформлена дисконтная карта!')
            ->setHtmlBody('<b>HTML content</b>')
            ->attach('images/blog/articles/edit_icon.png')
            ->send();
        if (Yii::$app->request->isAjax) {
            $status = false;
            $form = new CardForm();
            Yii::$app->response->format = Response::FORMAT_JSON;
            $email = Yii::$app->request->get('email');
            $email = trim(Html::encode($email));

            $there = Requests::findOne(['email' => $email]);
            if (empty($there)) {
//                $request = new Requests();
//                $request->email = $email;
//                $request->type_id = 1;
//                $request->save();

                $status = Yii::$app->mailer->compose()
                    ->setFrom('devilcatt@rambler.ru')
                    ->setTo($email)
                    ->setSubject('Получить дисконтную карту')
                    ->setTextBody('Вам будет оформлена дисконтная карта!')
                    ->setHtmlBody('<b>HTML content</b>')
                    ->attach('/images/blog/articles/edit_icon.png')
                    ->send();

                return [
                    'status' => $status,
                ];
            }
        }
        return $this->render('index');
    }

}
