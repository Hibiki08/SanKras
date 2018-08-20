<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class EditPricesForm extends Model {

    public $title;
    public $price;
    public $unit;
    public $cat_id;
    public $page;
    public $active;

    public function rules() {
        return [
            [['title', 'price', 'unit', 'cat_id'], 'required'],
            [['title', 'unit', 'price'], 'filter', 'filter' => 'trim'],
            [['price'], 'number'],
        ];
    }

    public function attributeLabels(){
        return [
            'title' => 'Название',
            'price' => 'Цена',
            'unit' => 'Единица',
            'key_page' => 'Страница отображения'
        ];
    }

}