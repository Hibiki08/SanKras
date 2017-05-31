<?php

namespace app\models;

use app\components\AbstractModel;

class ServicesSlides extends AbstractModel {

    const IMG_FOLDER = 'sliders/pages/';

    public static function tableName() {
        return 'sk_services_slides';
    }

}