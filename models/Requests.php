<?php

namespace app\models;

use Yii;
use app\components\AbstractModel;

/**
 * System model
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $date
 * @property string $type_id
 * @property string $processe
 * @property string $text
 * @property string $from_page
 */


class Requests extends AbstractModel {

    const CARD_ID = 1;
    const MASTER_ID = 2;
    const ADVICE_ID = 3;
    const CALLBACK_ID = 4;
    const QUESTION_ID = 5;
    const WRITE_ID = 6;
    const SERVICE_ID = 7;

}