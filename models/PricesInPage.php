<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\components\AbstractModel;

class PricesInPage extends AbstractModel {

    public static function tableName() {
        return 'sk_prices_in_page';
    }

    public function getPrices($where = false) {
        $query = $this->hasMany(Prices::className(), ['id' => 'price_id'])
            ->alias('prices');
        return $query;
    }

}