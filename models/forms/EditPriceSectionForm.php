<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class EditPriceSectionForm extends Model {

    public $title;
    public $link;
    public $parent_id;
    public $active;

    public function rules() {
        return [
            [['title', 'link'], 'required'],
            [['title', 'link'], 'filter', 'filter' => 'trim'],
            ['link', 'match', 'pattern' => '/^[a-z0-9]+$/', 'message' => 'Допускаются только латинские символы и цифры!'],
        ];
    }

    public function attributeLabels(){
        return [
            'title' => 'Название',
            'link' => 'Ссылка',
        ];
    }

}