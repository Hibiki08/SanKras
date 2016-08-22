<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Requests;
use yii\data\Pagination;
use yii\web\Response;

class MasterController extends AdminController {

    public function actionIndex() {
        $requests = new Requests();
        $quey = $requests->findByColumn(['type_id' => 2], '', ['date' => SORT_DESC], false);

        $pager = new Pagination(['totalCount' => $quey->count(), 'pageSize' => self::PAGE_SIZE]);
        $pager->pageSizeParam = false;

        $requests = $quey->offset($pager->offset)
            ->limit($pager->limit)
            ->all();


        return $this->render('index', [
            'requests' => $requests
        ]);
    }

    public function actionProcesse() {
        if (Yii::$app->request->isAjax) {
            $response = false;

            $id = (int)Yii::$app->request->getQueryParams()['id'];
            $value = (int)Yii::$app->request->getQueryParams()['value'];

            $requests = Requests::findOne($id);
            $requests->processe = $value;
            if ($requests->update() !== false) {
                $response = true;
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'status' => $response,
            ];
        }
        Yii::$app->end();
    }

}