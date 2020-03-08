<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\components\AbstractModel;

class Services extends AbstractModel {
    
    const IMG_FOLDER = 'pages/';

    public static function tableName() {
        return 'sk_services';
    }

    public function getPrice() {
        return $this->hasMany(PricesInPage::className(), ['page_id' => 'id'])
            ->joinWith('prices')
            ->alias('price');
    }

    public function getChildItems() {
        return $this->hasMany(Services::className(), ['parent_id' => 'id'])
            ->orderBy([
                'childItems.sort' => SORT_ASC,
                'childItems.id' => SORT_DESC
            ])
            ->alias('childItems');
    }

    public function getPriceActive() {
        return $this->hasMany(PricesInPage::className(), ['page_id' => 'id'])
            ->joinWith([
                'prices' => function ($query) {
                    $query->andOnCondition(['prices.active' => 1]);
                },
            ])
            ->alias('price');
    }

    public function getParent() {
        return $this->hasMany(Services::className(), ['id' => 'parent_id'])
            ->alias('parent');
    }

    public function getSlides() {
        return $this->hasMany(ServicesSlides::className(), ['serv_id' => 'id'])
            ->alias('slides');
    }

    public function getProjectdocs() {
        return $this->hasMany(ServicesProjectdocs::className(), ['serv_id' => 'id'])
            ->alias('projectdocs');
    }

    public function getAllForMenu($where = false, $order = 'sort ASC', $active = false) {
        $query = Services::find();
        if ($active) {
            $query->joinWith(['childItems' => function ($query) {
                $query->andOnCondition(['childItems.active' => 1]);
            }]);
        } else {
            $query->joinWith('childItems');
        }

        if ($order) {
            $query->orderBy($order);
        }

        if ($where) {
            $query->where($where);
        }
        return $query->all();
    }

    public function getAllServ($where = false, $order = ['id' => SORT_ASC], $request = true) {

        $services = Services::find()
            ->orderBy($order)
            ->joinWith('parent');

        if ($where) {
            $services->where($where);
        }
        
        if ($request) {
            return $services->all();
        } else {
            return $services;
        }

    }

    public function getOneServ($link, $active = false) {
        $query = Services::find();
        if ($active) {
            $query->joinWith('priceActive')
                ->andWhere(['sk_services.active' => 1]);
        } else {
            $query->joinWith('price');
        }
            $query->joinWith('slides')
                ->andWhere(['sk_services.link' => $link]);
            $query->joinWith('projectdocs');

        return $query->one();
    }

}