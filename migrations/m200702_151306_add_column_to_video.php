<?php

use yii\db\Migration;

class m200702_151306_add_column_to_video extends Migration
{
    const TABLE = 'sk_video';

    public function safeUp()
    {
        $this->addColumn(self::TABLE, 'description', $this->string(500));
    }

    public function safeDown()
    {
        $this->dropColumn(self::TABLE, 'description');
    }
}
