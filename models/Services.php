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

    public function getAllForMenu($where = false, $order = 'sort ASC') {
        $query = $this->find()
            ->select(['id', 'title', 'link', 'parent_id', 'sort']);

        if ($order) {
            $query->orderBy($order);
        }

        if ($where) {
            $query->where($where);
        }
        $services = $query->all();
        $allServices = [];

        foreach ($services as $service) {
            if (is_null($service['parent_id'])) {
                $allServices[$service['id']]['id'] = $service['id'];
                $allServices[$service['id']]['title'] = $service['title'];
                $allServices[$service['id']]['link'] = $service['link'];
            } else {
                if (isset($allServices[$service['parent_id']])) {
                    $allServices[$service['parent_id']]['sub_cat'][$service['id']]['id'] = (int)$service['id'];
                    $allServices[$service['parent_id']]['sub_cat'][$service['id']]['title'] = $service['title'];
                    $allServices[$service['parent_id']]['sub_cat'][$service['id']]['link'] = $service['link'];
                }
                else {
                    foreach ($allServices as $key => $serv) {
                        if (key_exists('sub_cat', $serv)) {
                            if (isset($serv['sub_cat'][$service['parent_id']])) {
                                $allServices[$key]['sub_cat'][$service['parent_id']]['sub_cat'][$service['id']]['id'] = $service['id'];
                                $allServices[$key]['sub_cat'][$service['parent_id']]['sub_cat'][$service['id']]['title'] = $service['title'];
                                $allServices[$key]['sub_cat'][$service['parent_id']]['sub_cat'][$service['id']]['link'] = $service['link'];
                            }
                        }
                    }
                }
            }
        }
        return $allServices;
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

        return $query->one();
    }

}