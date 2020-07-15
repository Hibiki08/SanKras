<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\components\AbstractModel;

/**
 * @property integer $id
 * @property integer $price_id
 * @property string $page_id
 * @property integer $order
 *
 * @property-read Services $service
 * @property-read Prices $price
 */
class PricesInPage extends AbstractModel {

    public $sort;

    public function rules()
    {
        return [
            [['sort'], 'each', 'rule' => ['integer']],
        ];
    }

    public static function tableName() {
        return 'sk_prices_in_page';
    }

    public function getPrices() {
        $query = $this->hasMany(Prices::className(), ['id' => 'price_id'])
            ->alias('prices');
        return $query;
    }

    public function getServices() {
        $query = $this->hasMany(Services::className(), ['id' => 'page_id'])
            ->alias('pages');
        return $query;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Services::className(), [
            'id' => 'page_id'
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrice()
    {
        return $this->hasOne(Prices::className(), [
            'id' => 'price_id'
        ]);
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'sort' => 'Порядок отображения на посадочных страницах'
        ];
    }
}