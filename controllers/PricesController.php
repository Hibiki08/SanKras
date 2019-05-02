<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Prices;
use app\components\Cache;
use yii\helpers\Url;
use yii\web\HttpException;


class PricesController extends Controller {

    use Cache;

    const GET_ACCESS_DENIED = [
        'index',
        'rates'
    ];

    public function init() {
        parent::init(); // TODO: Change the autogenerated stub
        $this->myInit();
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (in_array($action->id, self::GET_ACCESS_DENIED)) {
                if (!empty(Yii::$app->request->get())) {
                    throw new HttpException(404, 'Такой страницы нет!');
                    Yii::$app->end();
                }
            }
        }

        return true;
    }

    public function actionIndex() {
            $this->view->registerLinkTag(['rel' => 'canonical', 'href' => Url::to(['/prices'], true)]);
            $prices = new Prices();
            $prices = $prices->getAllCat(['t.active' => 1, 'category.active' => 1], ['category.sort' => SORT_ASC, 't.sort' => SORT_ASC]);
            $pricesArr = [];
            $catsArr = [];
            foreach ($prices as $price) {
                $cat_id = $price->category->parentCat['id'];
                $cat_title = $price->category->parentCat['title'];
                $cat_link = $price->category->parentCat['link'];
                $sub_id = $price->category['id'];
                $sub_title = $price->category['title'];
                $sub_link = $price->category['link'];
                $price_id = $price->id;
                
                $pricesArr[$cat_id]['title'] = $cat_title;
                $pricesArr[$cat_id]['link'] = $cat_link;
                $pricesArr[$cat_id]['sub'][$sub_id]['title'] = $sub_title;
                $pricesArr[$cat_id]['sub'][$sub_id]['link'] = $sub_link;
                $pricesArr[$cat_id]['sub'][$sub_id]['sub'][$price_id]['title'] = $price->title;
                $pricesArr[$cat_id]['sub'][$sub_id]['sub'][$price_id]['price_id'] = $price->id;
                $pricesArr[$cat_id]['sub'][$sub_id]['sub'][$price_id]['price'] = $price->price;
                $pricesArr[$cat_id]['sub'][$sub_id]['sub'][$price_id]['unit'] = $price->unit;;
                $catsArr[$cat_id]['title'] = $cat_title;
                $catsArr[$cat_id]['link'] = $cat_link;
                $catsArr[$cat_id]['sub'][$sub_id]['title'] = $sub_title;
                $catsArr[$cat_id]['sub'][$sub_id]['link'] = $sub_link;
            }
            return $this->render('index', [
                'prices' => $pricesArr,
                'pricesCat' => $catsArr
            ]);
        }

    public function actionPrint() {
        $this->view->registerMetaTag([
            'name' => 'robots',
            'content' => 'noindex, follow'
        ]);
        $data = [];
        $table_data = [];
        if (!empty($_COOKIE['data_print'])) {
            $data = json_decode($_COOKIE['data_print']);
            $table_data = null;
            foreach ($data as $price) {
                $table_data[$price->id]['id'] = $price->id;
                $table_data[$price->id]['table-number'] = $price->tableNumber;
            }
            $prices = Prices::findAll(array_keys($table_data));
            $table_data['cost'] = 0;
            foreach ($prices as $price) {
                $table_data[$price->id]['price'] = $price->price;
                $table_data[$price->id]['title'] = $price->title;
                $table_data[$price->id]['unit'] = $price->unit;
                $cost = (int)$price->price * (int)$table_data[$price->id]['table-number'];
                $table_data[$price->id]['cost'] = $cost;
                $table_data['cost'] += $cost;
            }
        }

        $this->layout = 'print';
        return $this->render('print', [
            'data' => $table_data,
        ]);
    }

    public function actionRates() {
        $this->view->registerLinkTag(['rel' => 'canonical', 'href' => Url::to(['prices/rates'], true)]);
        $this->view->registerMetaTag([
            'name' => 'robots',
            'content' => 'noindex, follow'
        ]);
        return $this->render('rates');
    }

}