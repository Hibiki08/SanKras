<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class EditContactsForm extends Model {

    public $description;
    public $value;

    public function rules() {
        return [
            [['description'], 'string', 'max' => 100],
            [['value'], 'string', 'max' => 500],
        ];
    }

}