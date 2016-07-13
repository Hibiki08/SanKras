<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\forms\LoginForm;
use yii\helpers\Url;
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

//        $userRole = Yii::$app->authManager->getRole('admin');
//        Yii::$app->authManager->assign($userRole, $user->getId());
//        $i = new User();
//        $i->username = 'sankras444';
//        $i->password_hash = sha1('4nBXC6IeeWAFnk%rmg');
//        $i->email = 'sankras.pro@rambler.ru';
//        $i->save();
        return $this->render('index');
    }

}
