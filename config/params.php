<?php

return [
//    'adminEmail' => 'devilcatt1@gmail.com',
    'adminEmail' => Yii::$app->system->get('email'),
    'phone' => '+7 (918) 684 79 99',
    'address' => '',
    'skype' => '',
    'params' => [
        'pathToImage' => 'images/'
    ]
];
