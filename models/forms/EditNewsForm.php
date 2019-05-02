<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\components\Translate;

class EditNewsForm extends Model {

    public $title;
    public $url;
    public $text;
    public $preview;
    public $category;
    public $hidden;
    public $active;
    public $old_url;

    public function rules() {
        return [
            [['preview'], 'file', 'extensions' => 'jpg, jpeg, gif, png', 'skipOnEmpty' => true, 'maxSize' => 1048576],
            [['title','url', 'text'], 'required'],
            ['url', 'unique','targetClass'=>'\app\models\Blog','message'=>Yii::t('app','The value of this field must be unique.'),'when' => function ($form, $attribute) {return $form->$attribute !== $this->old_url;            }],
            ['url', 'match', 'pattern' => '/^[-a-zA-Z0-9]+$/i','message'=>Yii::t('app','The value can contain only Latin letters and numbers and the hyphen character.')],
            ['category', 'default', 'value' => null],
        ];
    }
    
    public function setOldUrl($value) {
        return $this->old_url = $value;
    }

    public function upload($path, $image) {
        if (isset($image->name) && !is_null($image->name)) {
            $translate = new Translate();
            $image->name = $translate->translate($image->name);
            if ($image->saveAs(Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $path . $image->name)) {
                return true;
            }
        }
        return false;
    }

    public function attributeLabels(){
        return [
            'title' => 'Название',
            'text' => 'Текст',
            'preview' => 'Превью',
            'category' => 'Раздел',
        ];
    }

}