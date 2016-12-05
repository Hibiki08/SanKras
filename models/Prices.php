<?php

namespace app\models;

use Yii;
use app\components\AbstractModel;
use app\models\PricesCat;

class Prices extends AbstractModel {

    const PAGE_WATER = 'Водоснабжение';
    const PAGE_HEAT = 'Отопление';
    const PAGE_SEW = 'Канализация';
    const PAGE_SAN = 'Санфаянс';
    const PAGE_AUTO = 'Автополив';

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