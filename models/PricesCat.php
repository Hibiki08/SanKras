<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\components\AbstractModel;

class PricesCat extends AbstractModel {

    public function getParentCat() {
        return $this->hasOne(PricesCat::className(), ['id' => 'parent_id'])->alias('sub_cat');
    }

    public function getAllCat($where = false, $request = true, $order = ['id' => SORT_ASC]) {
        $query = PricesCat::find()
            ->joinWith('parentCat')
            ->orderBy($order)
            ->alias('cat');

        if ($where) {
            $query = $this->filter($query, $where);
        }

        if ($request) {
            return $query->all();
        } else {
            return $query;
        }
    }

}