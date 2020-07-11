<?php

use yii\db\Migration;

class m200702_152410_remove_column_from_services extends Migration
{
    const TABLE = '{{%services}}';

    public function safeUp()
    {
        $this->dropColumn(self::TABLE, 'videos');
    }

    public function safeDown()
    {
        $this->addColumn(self::TABLE, 'videos', $this->string(50));
    }
}
