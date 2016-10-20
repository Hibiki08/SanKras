<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\components\Translate;

class EditSlidesForm extends Model {

    public $text;
    public $link;
    public $image;
    public $sort;
    public $active;
    public $hidden;

    public function rules() {
        return [
            [['image'], 'file', 'extensions' => 'jpg, jpeg, gif, png', 'skipOnEmpty' => true],
            [['sort'], 'integer'],
            [['link', 'text'], 'filter', 'filter' => 'trim'],
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
            'image' => 'Слайд',
        ];
    }

}