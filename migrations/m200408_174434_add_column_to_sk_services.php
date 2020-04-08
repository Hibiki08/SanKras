<?php

use yii\db\Migration;

/**
 * Class m200408_174434_add_column_to_sk_services
 */
class m200408_174434_add_column_to_sk_services extends Migration
{
    const TABLE = '{{%services}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(self::TABLE, 'video_id', \yii\db\Schema::TYPE_INTEGER . ' DEFAULT NULL');
        $this->addForeignKey('sk_services_fk', self::TABLE, 'video_id', 'sk_video', 'id', 'CASCADE');

        $data = $this->getData();
        foreach ($data as $datum) {
            $this->update(self::TABLE, [
                'video_id' => $datum['video_id'],
            ], [
                'id' => $datum['service_id']
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('sk_services_fk', self::TABLE);
        $this->dropColumn(self::TABLE, 'video_id');
    }

    private function getData()
    {
        return [
            [
                'service_id' => 1,
                'video_id' => 7
            ],
            [
                'service_id' => 2,
                'video_id' => 8
            ],
            [
                'service_id' => 3,
                'video_id' => 10
            ],
            [
                'service_id' => 3,
                'video_id' => 10
            ],
            [
                'service_id' => 4,
                'video_id' => 10
            ],
            [
                'service_id' => 6,
                'video_id' => 11
            ],
            [
                'service_id' => 7,
                'video_id' => 12
            ],
            [
                'service_id' => 10,
                'video_id' => 13
            ],
            [
                'service_id' => 13,
                'video_id' => 14
            ],
            [
                'service_id' => 16,
                'video_id' => 15
            ],
            [
                'service_id' => 18,
                'video_id' => 16
            ],
            [
                'service_id' => 19,
                'video_id' => 17
            ],
            [
                'service_id' => 20,
                'video_id' => 18
            ],
            [
                'service_id' => 22,
                'video_id' => 19
            ],
            [
                'service_id' => 25,
                'video_id' => 20
            ],
            [
                'service_id' => 26,
                'video_id' => 21
            ],
            [
                'service_id' => 41,
                'video_id' => 22
            ],
            [
                'service_id' => 46,
                'video_id' => 9
            ],
        ];
    }
}
