<?php

use yii\db\Migration;

/**
 * Class m200408_182302_drop_column_from_sk_services
 */
class m200408_182302_drop_column_from_sk_services extends Migration
{
    const TABLE = '{{%services}}';
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn(self::TABLE, 'videos');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->addColumn(self::TABLE, 'videos', \yii\db\Schema::TYPE_TEXT . ' DEFAULT NULL');

        $this->update(self::TABLE, [
            'videos' => '{"https:\/\/youtu.be\/rQIdV8KNZ8g":"\u041e\u0431\u0437\u043e\u0440 \u043a\u043e\u0442\u0435\u043b\u044c\u043d\u043e\u0439","https:\/\/youtu.be\/0UCoYYaG0bs":"\u041c\u043e\u043d\u0442\u0430\u0436 \u043e\u0442\u043e\u043f\u043b\u0435\u043d\u0438\u044f \u041a\u0440\u0430\u0441\u043d\u043e\u0434\u0430\u0440, \u041a\u0430\u0437\u0430\u0447\u0438\u0439 \u0445\u0443\u0442\u043e\u0440","https:\/\/youtu.be\/nWoUS2yo57k":"\u041e\u0431\u0437\u043e\u0440 \u043e\u0442\u043e\u043f\u043b\u0435\u043d\u0438\u044f \u0432 \u0434\u043e\u043c\u0435 260 \u043c2"}'
        ], [
            'id' => 1
        ]);

        $this->update(self::TABLE, [
            'videos' => '{"https:\/\/youtu.be\/maA3xZfY76o":"\u041e\u0431\u0437\u043e\u0440 \u0442\u0451\u043f\u043b\u043e\u0433\u043e \u043f\u043e\u043b\u0430 \u0438\u0437 \u0441\u0448\u0438\u0442\u043e\u0433\u043e \u043f\u043e\u043b\u0438\u044d\u0442\u0438\u043b\u0435\u043d\u0430, \u041a\u0440\u0430\u0441\u043d\u043e\u0434\u0430\u0440","https:\/\/youtu.be\/s0LS4Fv0008":"\u041e\u0431\u0437\u043e\u0440 \u0442\u0451\u043f\u043b\u043e\u0433\u043e \u043f\u043e\u043b\u0430, \u043f\u043e\u0441\u0451\u043b\u043e\u043a \u042e\u0436\u043d\u044b\u0439 \u041a\u0440\u0430\u0441\u043d\u043e\u0434\u0430\u0440"}'
        ], [
            'id' => 7
        ]);

        $this->update(self::TABLE, [
            'videos' => '{"https:\/\/youtu.be\/G2ZQpsk0Fyw":"\u041e\u0431\u0443\u0441\u0442\u0440\u043e\u0439\u0441\u0442\u0432\u043e \u0441\u043a\u0432\u0430\u0436\u0438\u043d\u044b"}'
        ], [
            'id' => 8
        ]);

        $this->update(self::TABLE, [
            'videos' => '["https:\/\/youtu.be\/qVgqyAh-xaY"]'
        ], [
            'id' => 35
        ]);
    }
}
