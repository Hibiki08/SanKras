<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\components\Translate;

class EditNewsForm extends Model {

    public $title;
    public $text;
    public $preview;
    public $hidden;
    public $active;

    public function rules() {
        return [
            [['preview'], 'file', 'extensions' => 'jpg, jpeg, gif, png', 'skipOnEmpty' => true],
            [['title', 'text'], 'required'],
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