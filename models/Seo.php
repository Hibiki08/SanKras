<?php

namespace app\models;

use Yii;
use app\components\AbstractModel;

class Seo extends AbstractModel {

    public $key;

    public static function tableName() {
        return 'sk_seo';
    }

    public function getAll($where = false, $order = ['id' => SORT_ASC], $request = 'all') {
        $query = $this::find()
            ->orderBy($order)
            ->alias('seo');
        if ($where) {
            $query->where($where);
        }

        if ($request) {
            if ($request == 'all') {
                return $query->all();
            }
            if ($request == 'one') {
                return $query->one();
            }
        } else {
            return $query;
        }
    }

}