<?php

namespace app\models;

use app\components\AbstractModel;

/**
 * This is the model class for table "{{%sk_services_slides}}".
 *
 * @property integer $id
 * @property string $slide
 * @property string $text
 * @property string $description
 * @property integer $serv_id
 * @property integer $sort
 *
 */
class ServicesSlides extends AbstractModel {

    const IMG_FOLDER = 'sliders/pages/';

    public static function tableName() {
        return 'sk_services_slides';
    }
}