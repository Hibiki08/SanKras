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
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $callPhone = Yii::$app->request->get('callPhone');
            $callPhone = trim(Html::encode($callPhone));

            if ($callPhone) {
                $status = false;
                    $request = new Requests();
                    $request->phone = $callPhone;
                    $request->type_id = 4;
                    $request->save();

                    $status = Yii::$app->mailer->compose()
                        ->setFrom(Yii::$app->params['adminEmail'])
                        ->setTo(Yii::$app->params['adminEmail'])
                        ->setSubject('Заявка на обратный звонок')
                        ->setTextBody('Нужно перезвонить по номеру: ' . $callPhone)
                        ->setHtmlBody('<b>HTML content</b>')
                        ->send();

                    return [
                        'status' => $status,
                    ];
            }

            $cardMail = Yii::$app->request->get('cardMail');
            $cardMail = trim(Html::encode($cardMail));

            if ($cardMail) {
                $status = false;
                $there = Requests::findOne(['email' => $cardMail, 'type_id' => 1]);
                if (empty($there)) {
                    $request = new Requests();
                    $request->email = $cardMail;
                    $request->type_id = 1;
                    $request->save();

                    $status = Yii::$app->mailer->compose()
                        ->setFrom(Yii::$app->params['adminEmail'])
                        ->setTo($cardMail)
                        ->setSubject('Получить дисконтную карту')
                        ->setTextBody('Вам будет оформлена дисконтная карта!')
                        ->setHtmlBody('<b>HTML content</b>')
                        ->attach('images/blog/articles/edit_icon.png')
                        ->send();

                    return [
                        'status' => $status,
                    ];
                }
            }

            $masterName = Yii::$app->request->get('masterName');
            $masterPhone = Yii::$app->request->get('masterPhone');
            $masterName = trim(Html::encode($masterName));
            $masterPhone = trim(Html::encode($masterPhone));

            if ($masterName) {
                $status = false;
                $request = new Requests();
                $request->name = $masterName;
                $request->phone = $masterPhone;
                $request->type_id = 2;
                $request->save();

                $status = Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['adminEmail'])
                    ->setTo(Yii::$app->params['adminEmail'])
                    ->setSubject('Вызов мастера')
                    ->setTextBody('Заявка на вызов мастера.<br>Имя: ' . $masterName .'<br>Телефон: ' . $masterPhone)
                    ->setHtmlBody('<b>HTML content</b>')
                    ->send();

                return [
                    'status' => $status,
                ];
            }

            $callbackName = Yii::$app->request->get('callbackName');
            $callbackPhone = Yii::$app->request->get('callbackPhone');
            $callbackMessage = Yii::$app->request->get('callbackMessage');
            $callbackName = trim(Html::encode($callbackName));
            $callbackPhone = trim(Html::encode($callbackPhone));
            $callbackMessage = trim(Html::encode($callbackMessage));

            if ($callbackName) {
                $status = false;
                $request = new Requests();
                $request->name = $callbackName;
                $request->phone = $callbackPhone;
                $request->text = $callbackMessage;
                $request->type_id = 3;
                $request->save();

                $status = Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['adminEmail'])
                    ->setTo(Yii::$app->params['adminEmail'])
                    ->setSubject('Заявка на консультацию')
                    ->setTextBody('Заявка на консультацию.<br>Имя: ' . $callbackName . '<br>Телефон: ' . $callbackPhone . '<br>Сообщение: ' . $callbackMessage)
                    ->setHtmlBody('<b>HTML content</b>')
                    ->send();

                return [
                    'status' => $status,
                ];
            }
        }
        return $this->render('index');
    }

}
