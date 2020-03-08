<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\components\Translate;

class EditPricesForm extends Model {

    public $title;
    public $image;
    public $price;
    public $unit;
    public $cat_id;
    public $page;
    public $active;

    public function rules() {
        return [
            [['image'], 'file', 'extensions' => 'jpg, jpeg, gif, png', 'skipOnEmpty' => true],
            [['title', 'price', 'unit', 'cat_id'], 'required'],
            [['title', 'unit', 'price'], 'filter', 'filter' => 'trim'],
            [['price'], 'number'],
        ];
    }

    public function upload($path) {
        if (isset($this->image->name) && !is_null($this->image->name)) {
            $translate = new Translate();
            $this->image->name = $translate->translate($this->image->name);
            if ($this->image->saveAs(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . $this->image->name)) {
                return true;
            }
        }
        return false;
    }

    public function attributeLabels(){
        return [
            'title' => 'Название',
            'image' => 'Картинка',
            'price' => 'Цена',
            'unit' => 'Единица',
            'key_page' => 'Страница отображения'
        ];
    }

}