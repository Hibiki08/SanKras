<?php

use yii\db\Migration;

class m200629_153134_change_column_in_prices extends Migration
{
    const TABLE = '{{%prices}}';

    public function safeUp()
    {
        $this->alterColumn(self::TABLE, 'image', $this->string(256));
    }

    public function safeDown()
    {
        $this->update(self::TABLE, [
            'image' => ' '
        ], [
            'image' => null
        ]);
        $this->alterColumn(self::TABLE, 'image', $this->string(256)->notNull());
    }

}
