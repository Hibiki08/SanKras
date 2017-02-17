<?php

namespace app\components;

use yii\base\Widget;
use app\models\Works as ModelWorks;

class Works extends Widget {

    public $filter = false;

    public function run() {
        $works = new ModelWorks;
        $where = $this->filter ? array_merge(['works.active' => 1], $this->filter) : ['works.active' => 1];
        $works = $works->getAllCat($where, '(case when sort is null then 1 else 0 end), sort ASC, id DESC', false);
        $works = $works->limit(3)->all();

        return $this->render('works', [
            'works' => $works,
        ]);
    }

}