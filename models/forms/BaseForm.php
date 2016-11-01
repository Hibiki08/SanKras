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
            [['email'], 'email'],
            [['email', 'phone', 'name'], 'required'],
            ['phone', 'match', 'pattern' => '^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$'],
        ];
    }

    public function attributeLabels() {
        return [
            'phone' => 'Телефон',
            'name' => 'Имя',
            'email' => 'Email',
        ];
    }

}