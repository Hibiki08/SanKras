<?php

namespace app\components;

use yii\validators\Validator;
use yii\helpers\Html;

class ItemsValidations extends Validator {

    public $params = [
        'max',
        'count'
    ];

    public function init() {
        parent::init();
    }

    public function validateAttribute($model, $attribute) {
        $itemsArray = explode(';', $model->$attribute);
        if (!empty($this->params['max'])) {
            foreach ($itemsArray as $item) {
                if (iconv_strlen($item = trim($item), 'UTF-8') > $this->params['max']) {
                    $error = 'Длина пункта "' . $item . '" больше ' . $this->params['max'] . ' символов!';
                    $model->addError($attribute, $this->message = $error);
                    return false;
                }
            }
        }
        if (!empty($this->params['count'])) {
            if (count($itemsArray) > $this->params['count']) {
                $error = 'Пунктов не должно быть больше ' . $this->params['count'] . '!';
                $model->addError($attribute, $this->message = $error);
                return false;
            }
        }
    }

    public function clientValidateAttribute($model, $attribute, $view) {
        $functions = '';
        if (!empty($this->params['max'])) {
            $max = json_encode($this->params['max']);
            $functions .= <<<JS
            var val = value.split(';');
            for (var i = 0; i < val.length; i++) {
                if ($.trim(val[i]).length > $max) {
                var error = 'Длина пункта "' + val[i] + '" больше ' + $max + ' символов!';
                messages.push(error);
                }
            }
JS;
        }
        if (!empty($this->params['count'])) {
            $count = json_encode($this->params['count']);
            $functions .= <<<JS
            var val = value.split(';');
            if (val.length > $count) {
            var error = 'Пунктов не должно быть больше $count!';
                messages.push(error);
            }
JS;
        }
        return <<<JS
                    $functions;
JS;
    }

}