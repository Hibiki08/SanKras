<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $service_id
 * @property string $share_link
 * @property integer $active
 *
 * @property-read Services $service
 */
class ServiceGoogleSheet extends ActiveRecord
{
    const HASH_PATTERN = '/https:\/\/docs.google.com\/spreadsheets\/d\/e\/(.+)\/pubhtml\?(.+)/i';

    public static function tableName() {
        return 'sk_service_google_sheet';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Services::className(), [
            'id' => 'service_id'
        ]);
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['service_id'], 'safe'],
            [['active'], 'in', 'range' => [0, 1]],
            [['share_link'],
                'match',
                'pattern' => self::HASH_PATTERN
            ],
        ];
    }

    /**
     * @return mixed|null
     */
    public function getHash()
    {
        preg_match(self::HASH_PATTERN, $this->share_link, $hash);
        return !empty($hash) && isset($hash[1]) ? $hash[1] : null;
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'share_link' => 'Ссылка на таблицу',
            'active' => 'Отображать таблицу на странице',
        ];
    }
}
