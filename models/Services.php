<?php

namespace app\models;

use Yii;
use app\components\AbstractModel;
use yii\db\Expression;

/**
 * @property integer $id
 * @property string $title
 * @property string $title_menu
 * @property string $link
 * @property integer $parent_id
 * @property string $form_title
 * @property string $tag_title
 * @property string $tag_keywords
 * @property string $tag_description
 * @property string $prev_field
 * @property string $gallery_title
 * @property string $main_text
 * @property string $work_text
 * @property string $price_title
 * @property integer $table_ex
 * @property integer $package_ex
 * @property string $packages
 * @property string $image
 * @property integer $video_id
 * @property integer $videos_show
 * @property integer $img_video
 * @property integer $benefits
 * @property integer $sort
 * @property integer $active
 * @property integer $projectdocs_active
 * @property string $projectdocs_title
 *
 * @property-read Video[] $videos
 * @property-read ServiceGoogleSheet $googleSheet
 * @property-read Prices[] $prices
 */
class Services extends AbstractModel {
    
    const IMG_FOLDER = 'pages/';
    const SERVICE_VIDEO_REF = 'sk_service_video_ref';

    public static function tableName() {
        return 'sk_services';
    }

    public function getPrices() {
        return $this->hasMany(Prices::className(), [
            'id' => 'price_id'
        ])->viaTable(PricesInPage::tableName(), [
            'page_id' => 'id'
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderedPricesInPage()
    {
        return $this->getPricesInPage()
            ->orderBy(new Expression('`order` IS NULL, `order` ASC'));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPricesInPage()
    {
        return $this->hasMany(PricesInPage::className(), [
           'page_id' => 'id'
        ]);
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
            ->alias('slides')->orderBy(['sort' => SORT_ASC]);
    }

    public function getProjectdocs() {
        return $this->hasMany(ServicesProjectdocs::className(), ['serv_id' => 'id'])
            ->alias('projectdocs')->orderBy(['sort' => SORT_ASC]);
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

    public static function getOneServ($link, $active = false) {
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(Video::className(), [
            'id' => 'video_id'
        ])->viaTable(self::SERVICE_VIDEO_REF, [
            'service_id' => 'id'
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoogleSheet()
    {
        return $this->hasOne(ServiceGoogleSheet::className(), [
            'service_id' => 'id'
        ]);
    }
}
