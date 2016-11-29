<?php

namespace app\models;

use Yii;
use app\components\AbstractModel;

class Opinions extends AbstractModel {

    const IMG_FOLDER = 'opinions/';
    const PAGE_SIZE = 7;

    public static function tableName() {
        return 'sk_opinions';
    }

}