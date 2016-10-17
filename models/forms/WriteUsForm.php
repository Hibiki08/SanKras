<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\components\Translate;

class WriteUsForm extends Model {

    public $name;
    public $phone;
    public $email;
    public $message;

    public function rules() {
        return [
            [['name', 'phone', 'email', 'message'], 'filter', 'filter' => 'trim'],
            [['name', 'email', 'message'], 'required'],
            [['email'], 'email'],
        ];
    }

}