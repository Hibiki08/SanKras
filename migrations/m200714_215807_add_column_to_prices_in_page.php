<?php

use yii\db\Migration;

class m200714_215807_add_column_to_prices_in_page extends Migration
{
    const TABLE = '{{%prices_in_page}}';

    public function safeUp()
    {
        $this->addColumn(self::TABLE, 'order', $this->integer());
//        $this->update(self::TABLE, [
//            'order' => 0
//        ], [
//            'order' => null
//        ]);
    }

    public function safeDown()
    {
        $this->dropColumn(self::TABLE, 'order');
    }
}
