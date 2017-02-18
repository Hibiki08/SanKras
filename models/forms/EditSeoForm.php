<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class EditSeoForm extends Model {

    public $title;
    public $short_text;
    public $full_text;
    public $block_key;
    public $active;

    public function rules() {
        return [
            [['title', 'block_key', 'short_text', 'full_text'], 'required'],
            [['title', 'block_key'], 'filter', 'filter' => 'trim'],
            [['title'], 'string', 'max' => 255],
            [['short_text'], 'string', 'max' => 500],
            [['full_text'], 'string'],
            [['block_key'], 'string', 'max' => 50],
            [['block_key'], 'unique', 'targetClass' => 'app\models\Seo', 'targetAttribute' => 'block_key'],
        ];
    }

    public function attributeLabels(){
        return [
            'title' => 'Заголовок',
            'short_text' => 'Короткий текст',
            'full_text' => 'Полный текст',
            'block_key' => 'Уникальный ключ',
            'active' => 'Активность',
        ];
    }

}