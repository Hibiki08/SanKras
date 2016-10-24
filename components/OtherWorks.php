<?php

namespace app\components;

use yii\base\Widget;
use app\models\Works;

class OtherWorks extends Widget {

    public $id;
//    public $offset = 0;

    public function run() {
//        $this->offset += 1;
        $works = Works::find()->where('active = 1 AND id != ' . $this->id)
            ->orderBy(['id' => SORT_DESC])
            ->limit(1)
            ->offset(1)
            ->all();

        return $this->render('other_works', [
            'works' => $works,
            'id' => $this->id
        ]);
    }

}