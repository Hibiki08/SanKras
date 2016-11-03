<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\components\Translate;

class EditTeamForm extends Model {

    public $name;
    public $post;
    public $img;
    public $text;
    public $active;
    public $hidden;

    public function rules() {
        return [
            [['name', 'post', 'text'], 'required'],
            [['img'], 'file', 'extensions' => 'jpg, jpeg, gif, png', 'skipOnEmpty' => true],
            ['name', 'string', 'max' => 100],
            ['post', 'string', 'max' => 255],
            ['text', '\app\components\ItemsValidations', 'params' => ['max' => 32, 'count' => 6], 'skipOnEmpty' => false]
        ];
    }

    public function upload($path) {
        if (isset($this->img->name) && !is_null($this->img->name)) {
            $translate = new Translate();
            $this->img->name = $translate->translate($this->img->name);
            if ($this->img->saveAs(Yii::$app->basePath . '/web' .  Yii::$app->params['params']['pathToImage'] . $path . $this->img->name)) {
                return true;
            }
        }
        return false;
    }

}