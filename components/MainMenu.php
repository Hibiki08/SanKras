<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Services;

class MainMenu extends Widget {

    public function run() {
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
//        $services = $services->getAllForMenu(['active' => 1], 'sk_services.parent_id, sk_services.sort ASC, ISNULL(sk_services.sort),  sk_services.id ASC');
        $services = (new Services())->getAllForMenu([
            Services::tableName(). '.active' => 1],
            [
                Services::tableName() . '.sort' => SORT_ASC,
                Services::tableName() . '.id' => SORT_DESC,
            ], true);

//        var_dump($services);die;

        return $this->render('main-menu', [
            'services' => $services,
            'controller' => $controller,
            'action' => $action
        ]);
    }

}