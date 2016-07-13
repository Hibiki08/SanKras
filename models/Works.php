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
        return $this->hasOne(WorksCat::className(), ['id' => 'cat_id'])->alias('sub_cat');
    }

    public function getAllCategory() {
        return $this->hasOne(WorksCat::className(), ['id' => 'parent_id'])
            ->via('category')
            ->alias('parent_cat');
    }

    public function getAllCat($order = ['id' => SORT_ASC], $request = true) {
        $query = Works::find()
            ->joinWith('allCategory')
            ->orderBy($order)
            ->alias('works');

        if ($request) {
            return $query->all();
        } else {
            return $query;
        }
    }

}