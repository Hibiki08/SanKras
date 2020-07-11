<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $description
 *
 * @property-read Services[] $services
 */
class Video extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    public function getVideoKey()
    {
        preg_match('/https:\/\/youtu.be\/(.+)\/?/', $this->url, $key);
        return !empty($key) && isset($key[1]) ? $key[1] : null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Services::className(), [
            'id' => 'service_id'
        ])->viaTable(Services::SERVICE_VIDEO_REF, [
           'video_id' => 'id'
        ]);
    }
}
