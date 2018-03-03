<?php

namespace app\models;

use Yii;
use app\components\AbstractModel;

class Blog extends AbstractModel {

    const IMG_FOLDER_NEWS = 'blog/news/';
    const IMG_FOLDER_ART = 'blog/articles/';
    const NEWS_SIZE = 9;
    const ART_SIZE = 9;

    public static function tableName() {
        return 'sk_blog';
    }

    public function getCategory() {
        return $this->hasOne(BlogCat::className(), ['id' => 'cat_id'])
            ->joinWith('parentCat')
            ->alias('category');
    }

    public function getAllCat($where = false, $order = ['id' => SORT_ASC], $request = true) {
        $query = Blog::find()
            ->joinWith('category')
            ->orderBy($order)
            ->alias('blog');
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