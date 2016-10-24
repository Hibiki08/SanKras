<?php
//
//namespace app\components;
//
//use yii\validators\Validator;
//
//class MyValidations extends Validator {
//
//    public function init() {
//        parent::init();
//        $this->message = 'Invalid status input.';
//    }
//
//    public function checkItems($model, $attribute) {
//        $itemsArray = explode(',', $model->$attribute);
////        if ($params['max']) {
//            foreach ($itemsArray as $item) {
//                if (iconv_strlen($item = trim($item),'UTF-8') > 50) {
//                    $model->addError($attribute, $this->message);
//                }
//            }
////        }
//    }
//
//    public function clientValidateAttribute($model, $attribute, $view) {
//        $itemsArray = explode(',', $model->$attribute);
//        foreach ($itemsArray as $item) {
//            if (iconv_strlen($item = trim($item),'UTF-8') > 50) {
//                $message = json_encode($this->message, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
//            }
//        }
//        return <<<JS
//if ($message) {
//    messages.push($message);
//}
//JS;
//    }
//
//}