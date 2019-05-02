<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class BaseForm extends Model {

    public $name;
    public $phone;
    public $email;
    public $text;
    public $hidden;
    public $agree;

    public function rules() {
        return [
            [['email'], 'email'],
            [['email', 'phone', 'name', 'text','agree'], 'required'],
            ['phone', 'match', 'pattern' => '^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$']
        ];
    }

    public function attributeLabels() {
        return [
            'phone' => 'Телефон',
            'name' => 'Имя',
            'email' => 'Email',
            'text' => 'Сообщение'
        ];
    }

}