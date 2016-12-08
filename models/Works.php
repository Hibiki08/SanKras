<?php

namespace app\models;

use Yii;
use app\components\AbstractModel;

class Works extends AbstractModel {

    const IMG_FOLDER = 'works/';

    public static function tableName() {
        return 'sk_works';
    }

    public function getCategory() {
        return $this->hasOne(WorksCat::className(), ['id' => 'cat_id'])->alias('cat');
    }

    public function getAllCat($where = false, $order = ['id' => SORT_ASC], $request = true) {
        $query = Works::find()
            ->joinWith('category')
            ->orderBy($order)
            ->alias('works');
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