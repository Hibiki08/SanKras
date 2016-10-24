<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\components\Translate;

class EditWorksForm extends Model {

    public $title;
    public $text;
    public $preview;
    public $preview_text;
    public $cat_id;
    public $preview_items;
    public $work_items;
    public $video;
    public $year;
    public $area;
    public $cost_install;
    public $cost_material;
    public $time;
    public $slides;
    public $slide;
    public $active;
    public $hidden;

    public function rules() {
        return [
            [['title', 'text', 'cat_id', 'preview_items', 'work_items', 'year', 'area', 'cost_install', 'cost_material'], 'required'],
            [['preview'], 'file', 'extensions' => 'jpg, jpeg, gif, png', 'skipOnEmpty' => true],
            [['slides'], 'file', 'extensions' => 'jpg, jpeg, gif, png', 'maxFiles' => 10, 'skipOnEmpty' => true],
            ['title', 'string', 'max' => 50],
            ['video', 'match', 'pattern' => '/youtube.com\/embed/i'],
            ['year', 'string', 'max' => 4],
            [['area', 'cost_install', 'cost_material'], 'double'],
            [['title', 'text', 'cat_id', 'preview_items', 'work_items', 'year', 'area', 'cost_install', 'cost_material', 'video'], 'filter','filter'=>'trim'],
            [['preview_items'], 'validateItems', 'params' => ['max' => 50, 'count' => 4], 'skipOnEmpty' => false],
            [['work_items'], 'validateItems', 'params' => ['max' => 50], 'skipOnEmpty' => false],
            [['time'], 'string']
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['items'] = ['preview_items', 'work_items'];
        return $scenarios;
    }

    public function validateItems($attribute, $params) {
        $error = false;
        $itemsArray = explode(',', $this->$attribute);
        if (isset($params['max'])) {
            foreach ($itemsArray as $item) {
                if (iconv_strlen($item = trim($item), 'UTF-8') > 45) {
                    $error = 'Длина пункта "' . $item . '" больше ' . $params['max'] . ' символов!';
                    $this->addError($attribute, $error);
                }
            }
        }
        if (isset($params['count'])) {
            if (count($itemsArray) > $params['count']) {
                $error = 'Пунктов не должно быть больше ' . $params['count'] . '!';
                $this->addError($attribute, $error);
            }
        }
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

    public function attributeLabels() {
        return [
            'title' => 'Название',
            'text' => 'Текст',
            'preview' => 'Превью',
            'preview_text' => 'Текст для превью',
            'cat_id' => 'Раздел',
            'preview_items' => 'Пункты превью',
            'work_items' => 'Пункты работы',
            'video' => 'Видео',
            'year' => 'Год выполнения',
            'area' => 'Площадь помещения',
            'cost_install' => 'Ст-ть монтажа',
            'cost_material' => 'Ст-ть материала',
            'slides' => 'Слайды',
            'slide' => 'Слайд',
            'active' => 'Активность',
        ];
    }

}