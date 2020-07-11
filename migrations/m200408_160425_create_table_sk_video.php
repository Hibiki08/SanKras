<?php

use yii\db\Migration;

/**
 * Class m200408_160425_create_table_sk_video
 */
class m200408_160425_create_table_sk_video extends Migration
{
    const TABLE = 'sk_video';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'url' => $this->string(500)->notNull(),
            'title' => $this->string(500)->notNull()
        ]);

        $data = $this->getData();
        foreach ($data as $datum) {
            $this->insert(self::TABLE, [
                'url' => $datum['url'],
                'title' => $datum['title']
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
                'url' => 'https://youtu.be/rQIdV8KNZ8g',
                'title' => 'Обзор котельной',
            ],
            [
                'url' => 'https://youtu.be/0UCoYYaG0bs',
                'title' => 'Монтаж отопления Краснодар, Казачий хутор',
            ],
            [
                'url' => 'https://youtu.be/nWoUS2yo57k',
                'title' => 'Обзор отопления в доме 260 м2',
            ],
            [
                'url' => 'https://youtu.be/maA3xZfY76o',
                'title' => 'Обзор тёплого пола из сшитого полиэтилена, Краснодар',
            ],
            [
                'url' => 'https://youtu.be/s0LS4Fv0008',
                'title' => 'Обзор тёплого пола, посёлок Южный Краснодар',
            ],
            [
                'url' => 'https://youtu.be/G2ZQpsk0Fyw',
                'title' => 'Обустройство скважины',
            ],
            [
                'url' => 'https://youtu.be/pE47iwzZ8rA',
                'title' => 'Монтаж отопления Краснодар',
            ],
            [
                'url' => 'https://youtu.be/Q6wiYlXBHgk',
                'title' => 'Монтаж котельной Краснодар',
            ],
            [
                'url' => 'https://youtu.be/OKf44D_UnQA',
                'title' => 'Обслуживание котла отопления Краснодар',
            ],
            [
                'url' => 'https://youtu.be/wxdDZWJSgj4',
                'title' => 'Установка котла отопления Краснодар',
            ],
            [
                'url' => 'https://youtu.be/pxVvW5TFd4s',
                'title' => 'Монтаж радиаторов отопления Краснодар',
            ],
            [
                'url' => 'https://youtu.be/A9YynF5Og-I',
                'title' => 'Монтаж тёплого пола Краснодар',
            ],
            [
                'url' => 'https://youtu.be/h6Rq6T3xaLo',
                'title' => 'Обвязка скважины Краснодар',
            ],
            [
                'url' => 'https://youtu.be/KCYH_2ExeWs',
                'title' => 'Установка водонагревателя Краснодар',
            ],
            [
                'url' => 'https://youtu.be/vqR9htQ9P5k',
                'title' => 'Монтаж твердотопливного котла Краснодар',
            ],
            [
                'url' => 'https://youtu.be/_ksU-yxGWlc',
                'title' => 'Установка системы водоподготовки Краснодар',
            ],
            [
                'url' => 'https://youtu.be/zNl1neZJbAU',
                'title' => 'Подключение насоса Краснодар',
            ],
            [
                'url' => 'https://youtu.be/AgDpRBPQIhk',
                'title' => 'Монтаж водопровода в квартире Краснодар',
            ],
            [
                'url' => 'https://youtu.be/Qb7R9hn2Qoo',
                'title' => 'Замена канализации Краснодар',
            ],
            [
                'url' => 'https://youtu.be/xYBIw5VaNl8',
                'title' => 'Установка сантехники Краснодар',
            ],
            [
                'url' => 'https://youtu.be/qVgqyAh-xaY',
                'title' => 'Установка ванной Краснодар',
            ],
            [
                'url' => 'https://youtu.be/DfrNkmC9l_U',
                'title' => 'Монтаж труб из сшитого полиэтилена Краснодар',
            ],
            [
                'url' => 'https://youtu.be/qVgqyAh-xaY',
                'title' => 'Установка ванной Краснодар',
            ],
            [
                'url' => 'https://youtu.be/qiTE7vNM_oI',
                'title' => 'Монтаж отопления за 5 минут. SanKras',
            ],
            [
                'url' => 'https://youtu.be/AgDpRBPQIhk',
                'title' => 'Монтаж отопления за 5 минут. SanKras',
            ],
            [
                'url' => 'https://youtu.be/GXG4JkC1RGQ',
                'title' => 'Котельная в Немецкой деревне, Краснодар',
            ],
            [
                'url' => 'https://youtu.be/_WHQC0PFzPE',
                'title' => 'Монтаж отопления Краснодар',
            ],
            [
                'url' => 'https://youtu.be/5bPvWF3ZqKs',
                'title' => 'Очистка воды из скважины Краснодар',
            ],
            [
                'url' => 'https://youtu.be/gBj14spJo4I',
                'title' => 'Монтаж отопления с тепловым насосом Краснодар',
            ],
            [
                'url' => 'https://youtu.be/599kPJYm8t0',
                'title' => 'Монтаж отопления Краснодар, (Немецкая Деревня)',
            ],
        ];
    }
}
