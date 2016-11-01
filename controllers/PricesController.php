<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Prices;

class PricesController extends Controller {

    public function actionIndex() {
            $prices = new Prices();
            $prices = $prices->getAllCat(['t.active' => 1, 'category.active' => 1], ['t.sort' => SORT_ASC]);
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
//                $price->category->parentCat['id'] =  $price->category->parentCat['id'];
//                $parent_link = $price->category->parentCat['link'];

//                $pricesArr[$price->category->parentCat['id']]['title'] = $price->category->parentCat['title'];
//                $pricesArr[$price->category->parentCat['id']]['link'] = $price->category->parentCat['link'];
//                $pricesArr[$price->category->parentCat['id']]['sub'][$price->category['id']] = $price->category->parentCat['link'];
//                $pricesArr[$price->category->parentCat['id']][$price->category['title']][$price['id']]['title'] = $price->title;
//                $pricesArr[$price->category->parentCat['id']][$price->category['title']][$price['id']]['price_id'] = $price->id;
//                $pricesArr[$price->category->parentCat['id']][$price->category['title']][$price['id']]['price'] = $price->price;
//                $pricesArr[$price->category->parentCat['id']][$price->category['title']][$price['id']]['unit'] = $price->unit;
//                $pricesArr[$price->category->parentCat['id']][$price->category['title']][$price['id']]['cat_id'] = $price->category['title'];
//                $pricesArr[$price->category->parentCat['id']][$price->category['title']][$price['id']]['cat_title'] = $price->category['title'];
//                $pricesArr[$price->category->parentCat['id']][$price->category['title']][$price['id']]['parent_link'] = $parent_link;
//                $pricesArr[$price->category->parentCat['id']][$price->category['title']][$price['id']]['link'] = $price->category['link'];
//                $pricesArr[$price->category->parentCat['id']][$price->category['title']][$price['id']]['parent_cat_id'] = isset($price->category->parentCat['id']) ? $price->category->parentCat['id'] : null;
//                $pricesArr[$price->category->parentCat['id']][$price->category['title']][$price['id']]['parent_cat_title'] = isset($price->category->parentCat['id']) ? $price->category->parentCat['id'] : null;

//                if ($price->category->parentCat['id'] == null) {
//                    $catsArr[$price->category['title']]['title'] = $price->category['title'];
//                    $catsArr[$price->category['title']]['link'] = $price->category['link'];
//                } else {
                $catsArr[$cat_id]['title'] = $cat_title;
                $catsArr[$cat_id]['link'] = $cat_link;
                $catsArr[$cat_id]['sub'][$sub_id]['title'] = $sub_title;
                $catsArr[$cat_id]['sub'][$sub_id]['link'] = $sub_link;
//                }
            }

//        var_dump($catsArr[1]);die;

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