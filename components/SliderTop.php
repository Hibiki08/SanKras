<?php

namespace app\components;

use yii\base\Widget;
use app\models\Slides;

class SliderTop extends Widget {

    public function run() {
        $sliderTop = new Slides();
        $sliderTop = $sliderTop->findByColumn(['type_id' => 1], '', ['sort' => SORT_ASC]);

        return $this->render('slider_top', [
            'sliderTop' => $sliderTop
        ]);
    }

}