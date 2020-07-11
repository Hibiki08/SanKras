<?php

namespace app\models;

use Yii;
use app\components\AbstractModel;

/**
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $text
 * @property string $preview
 * @property string $preview_text
 * @property integer $cat_id
 * @property string $preview_items
 * @property string $work_items
 * @property integer $year
 * @property string $area
 * @property string $cost_install
 * @property string $cost_material
 * @property string $time
 * @property integer $sort
 * @property integer $active
 * @property string $video
 *
 */
class Works extends AbstractModel {

    const IMG_FOLDER = 'works/';

    public static function tableName() {
        return 'sk_works';
    }

    public function getCategory() {
        return $this->hasOne(WorksCat::className(), ['id' => 'cat_id'])->alias('cat');
    }

    public function getAllCat($where = false, $order = ['id' => SORT_ASC], $request = true) {
        $query = Works::find()
            ->joinWith('category')
            ->orderBy($order)
            ->alias('works');
        if ($where) {
            $query->where($where);
        }

        if ($request) {
            return $query->all();
        } else {
            return $query;
        }
    }
}
