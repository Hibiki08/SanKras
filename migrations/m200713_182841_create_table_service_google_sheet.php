<?php

use yii\db\Migration;

class m200713_182841_create_table_service_google_sheet extends Migration
{
    const TABLE = '{{%service_google_sheet}}';

    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'service_id' => $this->bigInteger(20)->unsigned()->notNull(),
            'share_link' => $this->string(500)->notNull(),
            'active' => $this->boolean()->defaultValue(0)
        ]);

        $this->addForeignKey('service_sheet_fk1', self::TABLE, 'service_id', 'sk_services', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
