<?php

namespace app\controllers;

use Yii;
use yii\web\View;
use yii\web\Controller;
use app\models\forms\LoginForm;
use app\models\forms\WriteUsForm;
use yii\helpers\Url;
use app\models\Requests;
use yii\helpers\Html;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\Works;

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
        $works = Works::find()->where(['active' => 1])->orderBy('id')->limit(3)->all();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $adviceName = Yii::$app->request->post('adviceName');
            $advicePhone = Yii::$app->request->post('advicePhone');

            if ($advicePhone && $adviceName) {
                $status = false;
                $request = new Requests();
                $request->name = $adviceName;
                $request->phone = $advicePhone;
                $request->type_id = 3;
                $request->save();

                $status = Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->system->get('email'))
                    ->setTo(Yii::$app->system->get('email'))
                    ->setSubject('Заявка на консультацию мастера')
                    ->setHtmlBody('Заявка на консультацию мастера.<br>Имя: ' . $adviceName .'<br>Телефон: ' . $advicePhone)
                    ->send();

                return [
                    'status' => $status,
                ];
            }

            $callPhone = Yii::$app->request->post('callPhone');
            $callPhone = trim(Html::encode($callPhone));

            if ($callPhone) {
                $status = false;
                    $request = new Requests();
                    $request->phone = $callPhone;
                    $request->type_id = 4;
                    $request->save();

                    $status = Yii::$app->mailer->compose()
                        ->setFrom(Yii::$app->system->get('email'))
                        ->setTo(Yii::$app->system->get('email'))
                        ->setSubject('Заявка на обратный звонок')
                        ->setTextBody('Нужно перезвонить по номеру: ' . $callPhone)
                        ->send();

                    return [
                        'status' => $status,
                    ];
            }

            $cardMail = Yii::$app->request->post('cardMail');
            $cardMail = trim(Html::encode($cardMail));

            if ($cardMail) {
                $status = false;
                $request = new Requests();
                $request->email = $cardMail;
                $request->type_id = 1;
                $request->save();

                $status = Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->system->get('email'))
                    ->setTo(Yii::$app->system->get('email'))
                    ->setSubject('Получение дисконтной карты')
                    ->setHtmlBody('Заявка на получение дисконтной карты от: ' . $cardMail)
                    ->send();

                $homeUrl = Yii::$app->params['params']['host'];
                $adminEmail = Yii::$app->system->get('email');
                $adminPhone = Yii::$app->system->get('phone');
                $adminSkype = Yii::$app->system->get('skype');

                $status = Yii::$app->mailer->compose('discount', [
                    'homeUrl' => $homeUrl,
                    'adminEmail' => $adminEmail,
                    'adminPhone' => $adminPhone,
                    'adminSkype' => $adminSkype,
                ])
                    ->setFrom(Yii::$app->system->get('email'))
                    ->setTo($cardMail)
                    ->setSubject('Получить дисконтную карту')
                    ->attach('files/Blank_discount_card.docx')
                    ->send();

                return [
                    'status' => $status,
                ];
            }

            $masterName = Yii::$app->request->post('masterName');
            $masterPhone = Yii::$app->request->post('masterPhone');
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
                    ->setFrom(Yii::$app->system->get('email'))
                    ->setTo(Yii::$app->system->get('email'))
                    ->setSubject('Вызов мастера')
                    ->setHtmlBody('Заявка на вызов мастера.<br>Имя: ' . $masterName .'<br>Телефон: ' . $masterPhone)
                    ->send();

                return [
                    'status' => $status,
                ];
            }
        }
        return $this->render('index', [
            'works' => $works
        ]);
    }

    public function actionContacts() {
        $this->view->registerJsFile('/js/map.js', ['position' => View::POS_HEAD]);
        $form = new WriteUsForm();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $validate = ActiveForm::validate($form);
            if ($validate) {
                $writeName = Yii::$app->request->post('writeUsName');
                $writePhone = Yii::$app->request->post('writeUsPhone');
                $writeEmail = Yii::$app->request->post('writeUsEmail');
                $writeMessage = Yii::$app->request->post('writeUsMessage');

                $validate = Yii::$app->mailer->compose()
                    ->setFrom($writeEmail)
                    ->setTo(Yii::$app->system->get('email'))
                    ->setSubject('Сообщение со страницы "Контакты"')
                    ->setHtmlBody('Имя: ' . $writeName . '<br>Телефон: ' . $writePhone . '<br>Email: ' . $writeEmail . '<br>Сообщение: ' . $writeMessage)
                    ->send();

                return [
                    'status' => $validate
                ];
            }
        }

        return $this->render('contacts', [
            'write' => $form
        ]);
    }

    public function actionRates() {
        return $this->render('rates', [
//            'write' => $form
        ]);
    }

}
