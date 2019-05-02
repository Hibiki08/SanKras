<?php

namespace app\controllers;

use Yii;
use yii\filters\AjaxFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\widgets\ActiveForm;
use app\models\forms\BaseForm;
use yii\web\Response;
use app\models\Requests;
use yii\helpers\Html;
use app\models\Prices;
use app\models\Services;
use app\models\ServicesSlides;
use yii\web\HttpException;
use yii\web\View;

class PageController extends Controller {

    public $key;

    public function actionIndex($key = '', $action = '') {
        $this->view->registerCssFile('/lib/flexslider/flexslider.css');
        $this->view->registerJsFile('/lib/flexslider/flexslider.js');
        $this->view->registerCssFile('/lib/fancyBox-18d1712/source/jquery.fancybox.css');
        $this->view->registerJsFile('/lib/fancyBox-18d1712/lib/jquery.mousewheel-3.0.6.pack.js');
        $this->view->registerJsFile('/lib/fancyBox-18d1712/source/jquery.fancybox.pack.js');
        
        $link = !empty($key) ? $key : $this->key;
        $form = new BaseForm();
        
            $o = new Services();
            $options = $o->getOneServ($link, true);
            if($action){$parent = $o->getOneServ($action, true);}else{$parent = false;}
            $options->videos = $options->videos?json_decode($options->videos):array();
            $options->videos = array_map(function ($v,$n){
              $u = parse_url($v); parse_str($u['query'], $v);
              return [$n,@$v['v']?$v['v']:end(explode('/',$u['path']))];
            },array_keys((array)$options->videos),array_values((array)$options->videos));
//         die(var_dump($_GET));
        unset($_GET['action']);
        unset($_GET['key']);
        if(!empty($_GET)){
          throw new HttpException(404 ,'Такой страницы нет!');
          Yii::$app->end();
        }
        if (!empty($options)) {
            return $this->render('/site/pages', [
                'letter' => $form,
                'options' => $options,
                'parent' => $parent
            ]);
        } else {
            throw new HttpException(404 ,'Такой страницы нет!');
        }
    }

    public function actionOrderService() {
        $form = new BaseForm();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $validate = ActiveForm::validate($form);
            if ($validate) {
                $status = false;
                $request = new Requests();

                $questionName = trim(Html::encode(Yii::$app->request->post('questionName')));
                $questionPhone = trim(Html::encode(Yii::$app->request->post('questionPhone')));
                $pageTitle = trim(Html::encode(Yii::$app->request->post('pageTitle')));

                $request->name = $questionName;
                $request->phone = $questionPhone;
                $request->from_page = $pageTitle;
                $request->type_id = Requests::SERVICE_ID;
                $request->save();

                $status = Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->system->get('email'))
                    ->setTo('sankras.pro@yandex.ru')
                    ->setSubject('Заказать услугу')
                    ->setHtmlBody('Запрос с формы "Заказать услугу".<br><b>Имя:</b> ' . $questionName .'<br><b>Телефон:</b> ' . $questionPhone .'<br><b>Со страницы:</b> ' . $pageTitle)
                    ->send();

                return [
                    'status' => $status,
                ];
            }
        } else {
            throw new BadRequestHttpException('Ajax only');
        }

        return $this->render('/site/pages', [
            'question' => $form
        ]);
    }

    public function actionQuestion() {
        $form = new BaseForm();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $validate = ActiveForm::validate($form);
            if ($validate) {
                $status = false;
                $request = new Requests();

                $questionName = trim(Html::encode(Yii::$app->request->post('questionName')));
                $questionPhone = trim(Html::encode(Yii::$app->request->post('questionPhone')));
                $pageTitle = trim(Html::encode(Yii::$app->request->post('pageTitle')));

                $request->name = $questionName;
                $request->phone = $questionPhone;
                $request->from_page = $pageTitle;
                $request->type_id = Requests::QUESTION_ID;
                $request->save();

                $status = Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->system->get('email'))
                    ->setTo('sankras.pro@yandex.ru')
                    ->setSubject('Вопрос мастеру')
                    ->setHtmlBody('Вопрос мастеру.<br><b>Имя:</b> ' . $questionName .'<br><b>Телефон:</b> ' . $questionPhone .'<br><b>Со страницы:</b> ' . $pageTitle)
                    ->send();

                return [
                    'status' => $status,
                ];
            }
        } else {
            throw new BadRequestHttpException('Ajax only');
        }

        return $this->render('/site/pages', [
            'question' => $form
        ]);
    }
    
}