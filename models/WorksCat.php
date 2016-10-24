<?php

namespace app\models;

use app\components\AbstractModel;

class WorksCat extends AbstractModel {

//    public function getCategory() {
//        return $this->hasOne(WorksCat::className(), ['id' => 'parent_id'])->alias('sub_cat');
//    }
//
//    public function getAllCat($where = false, $request = true, $order = ['id' => SORT_ASC]) {
//        $query = WorksCat::find()
//            ->joinWith('category')
//            ->orderBy($order)
//            ->alias('cat');
//
//        if ($where) {
//            $query = $this->filter($query, $where);
//        }
//
//        if ($request) {
//            return $query->all();
//        } else {
//            return $query;
//        }
//    }

}