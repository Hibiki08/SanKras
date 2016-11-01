<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class BaseForm extends Model {

    public $name;
    public $phone;
    public $email;

    public function rules() {
        return [
            [['email'], 'email', 'required'],
        ];
    }

}