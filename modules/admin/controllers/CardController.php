<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Requests;
use yii\data\Pagination;

class CardController extends AdminController {

    public function actionIndex() {
        $requests = new Requests();
        $quey = $requests->findByColumn(['type_id' => 1], '', ['date' => SORT_DESC], false);

        $pager = new Pagination(['totalCount' => $quey->count(), 'pageSize' => self::PAGE_SIZE]);
        $pager->pageSizeParam = false;

        $requests = $quey->offset($pager->offset)
            ->limit($pager->limit)
            ->all();


        return $this->render('index', [
            'requests' => $requests
        ]);
    }

}