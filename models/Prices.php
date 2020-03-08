<?php

namespace app\models;

use Yii;
use app\components\AbstractModel;
use app\models\PricesCat;

class Prices extends AbstractModel {

    const IMG_FOLDER = 'prices/';

    public function getCategory() {
        return $this->hasOne(PricesCat::className(), ['id' => 'cat_id'])
            ->joinWith('parentCat')
            ->alias('category');
    }

    public function getPage() {
        return $this->hasMany(PricesInPage::className(), ['price_id' => 'id'])
            ->joinWith('services')
            ->alias('page');
    }
    
    public function getOne($where = false, $order = ['id' => SORT_ASC], $request = true) {
        $query = Prices::find()
            ->joinWith('page')
            ->joinWith('category')
            ->orderBy($order)
            ->alias('t');

        if ($where) {
            $query->where($where);
        }

        if ($request) {
            return $query->one();
        } else {
            return $query;
        }
    }

    public function getAllCat($where = false, $order = ['id' => SORT_ASC], $request = true) {
        $query = Prices::find()
            ->joinWith('category')
            ->joinWith('page')
            ->orderBy($order)
            ->alias('t');

        if ($where) {
            $query->where($where);
        }

        if ($request) {
            return $query->all();
        } else {
            return $query;
        }
    }

}