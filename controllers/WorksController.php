<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Works;
use app\models\WorksCat;
use yii\data\Pagination;
use app\models\WorksSlides;
use yii\helpers\Url;
use yii\web\HttpException;

class WorksController extends Controller {

    const PAGE_SIZE = 9;

    public function actionIndex() {
        $works = new Works();
        $worksCat = new WorksCat();
        $query = $works->getAllCat(['works.active' => 1], ['works.id' => SORT_DESC], false);

        $group = Yii::$app->request->getQueryParam('group') ? Yii::$app->request->getQueryParam('group') : false;
        $items = $works->filter($query, []);

        switch ($group) {
            case 'all';
                $items = $works->filter($query, []);
                break;
            case 'house';
                $cat = $worksCat->findOne(['key' => 'house']);
                if (!empty($cat)) {
                    $items = $works->filter($query, ['works.cat_id' => $cat->id, 'works.active' => 1]);
                }
                break;
            case 'flat';
                $cat = $worksCat->findOne(['key' => 'flat']);
                if (!empty($cat)) {
                    $items = $works->filter($query, ['works.cat_id' => $cat->id, 'works.active' => 1]);
                }
                break;
        }

        $pager = new Pagination(['totalCount' => $items->count(), 'pageSize' => self::PAGE_SIZE]);
        $pager->pageSizeParam = false;

        $works = $items->offset($pager->offset)
            ->limit($pager->limit)
            ->all();

        return $this->render('index', [
            'works' => $works,
            'pager' => $pager,
        ]);
    }

    public function actionSingle() {
        $this->view->registerCssFile('/lib/PgwSlider/pgwslider.min.css');
        $this->view->registerCssFile('/lib/Prokrutka/jquery.mCustomScrollbar.css');
        $this->view->registerJsFile('/lib/Prokrutka/jquery.mCustomScrollbar.concat.min.js');
        $this->view->registerJsFile('/lib/PgwSlider/pgwslider.min.js');

        $id = !empty(Yii::$app->request->getQueryParam('id')) ? Yii::$app->request->getQueryParam('id') : false;

        if ($id) {
            $work = Works::findOne(['id' => $id, 'active' => 1]);
            if (!$work) {
                throw new HttpException(404 ,'Такой страницы нет!');
            }
            $images = WorksSlides::findAll(['work_id' => $id]);
            $prev = Works::find()->where('id > ' . $id . ' AND active = 1')->orderBy(['id' => SORT_ASC])->limit(1)->one();
            $prev = !is_null($prev) ? $prev->id : Works::find()->where('active = 1 AND id != ' . $id)->orderBy(['id' => SORT_DESC])->limit(1)->min('id');

            $next = Works::find()->where('id < ' . $id . ' AND active = 1')->orderBy(['id' => SORT_DESC])->limit(1)->one();
            $next = !is_null($next) ? $next->id : Works::find()->where('active = 1 AND id != ' . $id)->orderBy(['id' => SORT_DESC])->limit(1)->max('id');

            $other = Works::find()->where('active = 1')->orderBy(['id' => SORT_DESC]);
            $pager = new Pagination(['totalCount' => $other->count(), 'pageSize' => 3]);
            $pager->pageSizeParam = false;
            $other = $other->offset($pager->offset)
                ->limit($pager->limit)
                ->all();
        } else {
            Yii::$app->getResponse()->redirect(Url::toRoute('works/'));
            return false;
        }

        return $this->render('single', [
            'work' => $work,
            'images' => $images,
            'prev' => $prev,
            'next' => $next,
            'other' => $other,
            'pager' => $pager
        ]);
    }

    public function actionVideo() {
        $videos = Works::find()->where('active = 1 AND video IS NOT NULL')->orderBy(['id' => SORT_DESC]);
        $pager = new Pagination(['totalCount' => $videos->count(), 'pageSize' => self::PAGE_SIZE]);
        $pager->pageSizeParam = false;

        $videos = $videos->offset($pager->offset)
            ->limit($pager->limit)
            ->all();

        return $this->render('video', [
            'videos' => $videos,
            'pager' => $pager
        ]);
    }

}