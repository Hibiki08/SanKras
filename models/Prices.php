<?php

namespace app\models;

use Yii;
use app\components\AbstractModel;
use app\models\PricesCat;

class Prices extends AbstractModel {

    public function getCategory() {
        return $this->hasOne(PricesCat::className(), ['id' => 'cat_id'])
            ->joinWith('parentCat')
            ->alias('category');
    }

    public function getAllCat($where = false, $order = ['id' => SORT_ASC], $request = true) {
        $query = Prices::find()
            ->joinWith('category')
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