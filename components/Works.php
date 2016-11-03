<?php

namespace app\components;

use yii\base\Widget;
use app\models\Works as ModelWorks;

class Works extends Widget {

    public $filter = false;

    public function run() {
        $works = new ModelWorks;
        $where = $this->filter ? array_merge(['works.active' => 1], $this->filter) : ['works.active' => 1];
        $works = $works->getAllCat($where, ['works.id' => SORT_ASC], false);
        $works = $works->limit(3)->all();

        return $this->render('works', [
            'works' => $works,
        ]);
    }

}