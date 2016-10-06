<?php

namespace app\models;

use Yii;
use app\components\AbstractModel;

/**
 * System model
 *
 * @property integer $id
 * @property string $title
 * @property string $value
 */

class System extends AbstractModel {

    public static function tableName() {
        return 'sk_system';
    }

}