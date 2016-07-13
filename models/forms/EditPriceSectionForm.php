<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class EditPriceSectionForm extends Model {

    public $title;
    public $parent_id;
    public $active;

    public function rules() {
        return [
            [['title'], 'required'],
        ];
    }

}