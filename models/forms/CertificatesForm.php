<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\components\Translate;

class CertificatesForm extends Model {

    public $img;

    public function rules() {
        return [
            [['img'], 'file', 'extensions' => 'jpg, jpeg, gif, png', 'skipOnEmpty' => true],
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