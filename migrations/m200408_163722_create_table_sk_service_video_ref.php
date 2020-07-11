<?php

use yii\db\Migration;

/**
 * Class m200408_163722_create_table_sk_service_video_ref
 */
class m200408_163722_create_table_sk_service_video_ref extends Migration
{
    const TABLE = 'sk_service_video_ref';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'service_id' => $this->bigInteger()->notNull()->unsigned(),
            'video_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('service_video_fk1', self::TABLE, 'service_id', 'sk_services', 'id', 'CASCADE');
        $this->addForeignKey('service_video_fk2', self::TABLE, 'video_id', 'sk_video', 'id', 'CASCADE');
        $this->addPrimaryKey('service_video_pk', self::TABLE, ['service_id', 'video_id']);

        $data = $this->getData();
        foreach ($data as $datum) {
            $this->insert(self::TABLE, [
                'service_id' => $datum['service_id'],
                'video_id' => $datum['video_id']
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }

    private function getData()
    {
        return [
            [
                'service_id' => 1,
                'video_id' => 1
            ],
            [
                'service_id' => 1,
                'video_id' => 2
            ],
            [
                'service_id' => 1,
                'video_id' => 3
            ],
            [
                'service_id' => 7,
                'video_id' => 4
            ],
            [
                'service_id' => 7,
                'video_id' => 5
            ],
            [
                'service_id' => 8,
                'video_id' => 6
            ],
            [
                'service_id' => 35,
                'video_id' => 23
            ],
        ];
    }
}
