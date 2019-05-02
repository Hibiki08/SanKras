<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class WriteUsForm extends Model {

    public $name;
    public $phone;
    public $email;
    public $message;
    public $agree;

    public function rules() {
        return [
            [['name', 'phone', 'email', 'message'], 'filter', 'filter' => 'trim'],
            [['name', 'email', 'message','agree'], 'required'],
            [['email'], 'email'],
        ];
    }

    public function attributeLabels(){
        return [
            'photo' => 'Фото',
            'name' => 'Имя',
            'email' => 'Email',
            'message' => 'Сообщение',
        ];
    }

}