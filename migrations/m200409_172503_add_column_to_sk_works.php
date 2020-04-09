<?php

use yii\db\Migration;

/**
 * Class m200409_172503_add_column_to_sk_works
 */
class m200409_172503_add_column_to_sk_works extends Migration
{
    const TABLE = '{{%works}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(self::TABLE, 'video_id', \yii\db\Schema::TYPE_INTEGER . ' DEFAULT NULL');
        $this->addForeignKey('sk_works_fk', self::TABLE, 'video_id', 'sk_video', 'id', 'CASCADE');

        $data = $this->getData();
        foreach ($data as $datum) {
            $this->update(self::TABLE, [
                'video_id' => $datum['video_id'],
            ], [
                'id' => $datum['work_id']
            ]);
        }

        $this->dropColumn(self::TABLE, 'video');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('sk_works_fk', self::TABLE);
        $this->dropColumn(self::TABLE, 'video_id');
        $this->addColumn(self::TABLE, 'video', \yii\db\Schema::TYPE_STRING . '(500) DEFAULT NULL');
    }

    private function getData()
    {
        return [
            [
                'work_id' => 23,
                'video_id' => 24
            ],
            [
                'work_id' => 30,
                'video_id' => 25
            ],
            [
                'work_id' => 31,
                'video_id' => 26
            ],
            [
                'work_id' => 32,
                'video_id' => 13
            ],
            [
                'work_id' => 33,
                'video_id' => 15
            ],
            [
                'work_id' => 34,
                'video_id' => 27
            ],
            [
                'work_id' => 36,
                'video_id' => 28
            ],
            [
                'work_id' => 38,
                'video_id' => 1
            ],
            [
                'work_id' => 50,
                'video_id' => 2
            ],
            [
                'work_id' => 51,
                'video_id' => 29
            ],
            [
                'work_id' => 55,
                'video_id' => 30
            ],
        ];
    }
}
