<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class CardForm extends Model {

    public $email;

    public function rules() {
        return [
            [['email'], 'email', 'required'],
        ];
    }

}