<?php

namespace app\components;

use yii\base\Widget;
use app\models\Slides;

class SliderBottom extends Widget {

    public function run() {
        $sliderBottom = new Slides();
        $sliderBottom = $sliderBottom->findByColumn(['type_id' => 2], '', ['sort' => SORT_ASC]);

        return $this->render('slider_bottom', [
            'sliderBottom' => $sliderBottom
        ]);
    }

}