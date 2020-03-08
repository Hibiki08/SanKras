<?php

namespace app\models;

use app\components\AbstractModel;

class ServicesProjectdocs extends AbstractModel {

    const IMG_FOLDER = 'projectdocs/';

    public static function tableName() {
        return 'sk_services_projectdocs';
    }

}