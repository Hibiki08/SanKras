<?php

namespace app\models\forms;

use app\models\Services;
use Yii;
use yii\base\Model;
use app\components\Translate;


class EditServiceForm extends Model {

    public $title;
    public $title_menu;
    public $link;
    public $parent_id;
    public $form_title;
    public $tag_title;
    public $tag_keywords;
    public $tag_description;
    public $prev_field;
    public $gallery_title;
    public $main_text;
    public $work_text;
    public $price_title;
    public $table_ex;
    public $package_ex;
    public $packages;
    public $image;
    public $slides;
    public $slide_text;
    public $video;
    public $videos;
    public $videos_show;
    public $img_video;
    public $benefits;
    public $sort;
    public $active;
    public $old_attribute_val = '';

    public function rules() {
        return [
            ['link', 'unique', 'targetClass' => Services::className(), 'message' =>  'Такой путь уже есть', 'when' => function ($form, $attribute) {
                return $this->$attribute !== $this->old_attribute_val;
            },],
            [['title', 'link', 'parent_id', 'form_title', 'tag_title', 'tag_keywords',
                'tag_description', 'prev_field', 'gallery_title', 'main_text',
                'price_title', 'img_video', 'title_menu'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg, jpeg, gif, png', 'skipOnEmpty' => true],
            [['slides'], 'file', 'extensions' => 'jpg, jpeg, gif, png', 'maxFiles' => 10, 'skipOnEmpty' => true],
            [['title', 'link', 'form_title', 'tag_title', 'tag_keywords', 'tag_description',
                'gallery_title', 'price_title', 'image', 'video'], 'string', 'max' => 255],
            ['video', 'match', 'pattern' => '/youtube.com\/embed/i'],
            ['prev_field', 'string'],
            [['main_text', 'work_text', 'packages'], 'string'],
            [['title', 'link', 'parent_id', 'form_title', 'tag_title', 'tag_keywords',
                'tag_description', 'prev_field', 'gallery_title', 'main_text',
                'price_title', 'img_video', 'main_text', 'work_text', 'packages'], 'filter','filter'=>'trim'],
            [['sort'], 'integer'],
        ];
    }

    public function setOldAttribute($value) {
        return $this->old_attribute_val = $value;
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
            'title' => 'Заголовок страницы',
            'title_menu' => 'Заголовок меню',
            'link' => 'Ссылка на страницу',
            'parent_id' => 'Родительская страница',
            'form_title' => 'Заголовок формы',
            'tag_title' => 'Тег title',
            'tag_keywords' => 'Keywords',
            'tag_description' => 'Description',
            'prev_field' => 'Поле с коротким текстом',
            'gallery_title' => 'Заголовок галереи',
            'main_text' => 'Основной текст',
            'work_text' => 'Список фирм',
            'price_title' => 'Заголовок блока с ценами',
            'table_ex' => 'Отображение таблицы',
            'package_ex' => 'Отображение пакетов',
            'packages' => 'Пакеты',
            'image' => 'Главная картинка',
            'slides' => 'Слайды',
            'video' => 'Видео',
            'img_video' => 'Картинка или видео',
            'benefits' => 'Отображение блока с выгодами',
            'sort' => 'Сортировка',
            'active' => 'Активность',
            'videos_show' => 'Отображать блок видеозаписей',
            'videos' => 'Список видеозаписей'
        ];
    }

}