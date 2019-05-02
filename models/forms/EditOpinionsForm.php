<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\components\Translate;

class EditOpinionsForm extends Model {

    public $name;
    public $description;
    public $photo;
    public $text;
    public $active;
    public $hidden;
    public $agree;

    public function rules() {
        return [
            [['name', 'text', 'agree'], 'required'],
            [['photo'], 'file', 'extensions' => 'jpg, jpeg, gif, png', 'skipOnEmpty' => true, 'maxSize' => 1048576],
            [['name', 'description'], 'string', 'max' => 255],
            [['name', 'description', 'text'], 'filter', 'filter' => 'trim'],
        ];
    }

    public function upload($path) {
        if (isset($this->photo->name) && !is_null($this->photo->name)) {
            $translate = new Translate();
            $this->photo->name = $translate->translate($this->photo->name);
            if ($this->photo->saveAs(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . $this->photo->name)) {
                return true;
            }
        }
        return false;
    }

    public function attributeLabels(){
        return [
            'photo' => 'Фото',
            'name' => 'Имя',
            'description' => 'Подробнее',
            'text' => 'Отзыв',
            'active' => 'Активность'
        ];
    }

}