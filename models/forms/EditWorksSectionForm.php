<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class EditWorksSectionForm extends Model {

    public $title;
    public $description;
    public $parent_id;
    public $active;

    public function rules() {
        return [
            [['title'], 'required'],
        ];
    }

}