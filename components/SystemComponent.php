<?php

namespace app\components;

use yii\base\Component;
use app\models\System;
use yii\base\Exception;

class SystemComponent extends Component {

    protected $data = [];

    public function init() {
        $system = System::find()->all();
        foreach ($system as $item) {
            $this->data[$item->title] = $item->value;
        }
        parent::init();
    }

    public function get($key) {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        } else {
            throw new Exception('Undefined parameter ' . $key);
        }
    }

    public function set($key, $value) {
        $system = new System();
        $system->findByColumn([['title' => $key], ['value' => $value]], 'AND', ['id' => SORT_ASC]);
        if (!$system) {
            throw new Exception('Undefined parameter ' . $key);
        }

        $this->data[$key] = $value;
        $system->value = $value;
        $system->update();
    }

}