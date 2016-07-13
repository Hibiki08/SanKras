<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\components\Translate;

class EditWorksForm extends Model {

    public $title;
    public $text;
    public $preview;
    public $place;
    public $preview_text;
    public $slides;
    public $slide;
    public $cat_id;
    public $active;
    public $hidden;

    public function rules() {
        return [
            [['preview'], 'file', 'extensions' => 'jpg, jpeg, gif, png', 'skipOnEmpty' => true],
            [['slides'], 'file', 'extensions' => 'jpg, jpeg, gif', 'maxFiles' => 10, 'skipOnEmpty' => true],
            [['title', 'text', 'cat_id'], 'required'],
        ];
    }

    public function upload($path, $image) {
        if (isset($image->name) && !is_null($image->name)) {
            $translate = new Translate();
            $image->name = $translate->translate($image->name);
            if ($image->saveAs(Yii::$app->params['params']['pathToImage'] . $path . $image->name)) {
                return true;
            }
        }
        return false;
    }
}