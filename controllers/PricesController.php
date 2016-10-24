<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Prices;

class PricesController extends Controller {

    public function actionIndex() {
            $prices = new Prices();
            $prices = $prices->getAllCat(['t.active' => 1], ['t.sort' => SORT_ASC]);
            $pricesArr = [];
            $catsArr = [];
            foreach ($prices as $price) {
                $catId = isset($price->category->parentCat['id']) ? $price->category->parentCat['id'] : $price->category['id'];
                $parent_link = isset($price->category->parentCat['id']) ? $price->category->parentCat['link'] : null;

                $pricesArr[$catId][$price['id']]['title'] = $price->title;
                $pricesArr[$catId][$price['id']]['price_id'] = $price->id;
                $pricesArr[$catId][$price['id']]['price'] = $price->price;
                $pricesArr[$catId][$price['id']]['unit'] = $price->unit;
                $pricesArr[$catId][$price['id']]['cat_id'] = $price->category['id'];
                $pricesArr[$catId][$price['id']]['cat_title'] = $price->category['title'];
                $pricesArr[$catId][$price['id']]['parent_link'] = $parent_link;
                $pricesArr[$catId][$price['id']]['link'] = $price->category['link'];
                $pricesArr[$catId][$price['id']]['parent_cat_id'] = isset($price->category->parentCat['id']) ? $price->category->parentCat['id'] : null;
                $pricesArr[$catId][$price['id']]['parent_cat_title'] = isset($price->category->parentCat['title']) ? $price->category->parentCat['title'] : null;

                if ($price->category->parentCat['id'] == null) {
                    $catsArr[$price->category['id']]['title'] = $price->category['title'];
                    $catsArr[$price->category['id']]['link'] = $price->category['link'];
                } else {
                    $catsArr[$price->category->parentCat['id']]['title'] = $price->category->parentCat['title'];
                    $catsArr[$price->category->parentCat['id']]['parent_link'] = $price->category->parentCat['link'];
                    $catsArr[$price->category->parentCat['id']]['link'] = $price->category['link'];
                    $catsArr[$price->category->parentCat['id']][$price->category['id']]['title'] = $price->category['title'];
                    $catsArr[$price->category->parentCat['id']][$price->category['id']]['link'] = $price->category['link'];
                }
            }

            return $this->render('index', [
                'prices' => $pricesArr,
                'pricesCat' => $catsArr
            ]);
        }

    public function actionPrint() {
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
        return $this->render('rates');
    }

}