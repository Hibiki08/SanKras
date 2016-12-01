<?php

namespace app\models;

use Yii;
use app\components\AbstractModel;

class BlogCat extends AbstractModel {

    const NEWS_ID = 1;
    const ART_ID = 2;

    public function getParentCat() {
        return $this->hasOne(BlogCat::className(), ['id' => 'parent_id'])->alias('sub_cat');
    }

}