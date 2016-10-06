<?php
namespace app\modules\admin\components;

use yii\base\Widget;
use yii\helpers\Html;

class AdminMenu extends Widget {

    public $menu = [
        [
            'name' => 'Система',
            'submenu' => [
                [
                    'name' => 'Контакты',
                    'controller' => 'contacts'
                ],
            ]
        ], [
            'name' => 'Сертификаты',
            'submenu' => [
                [
                    'name' => 'Список',
                    'controller' => 'certificates'
                ],
            ]
        ],
        [
            'name' => 'Слайдеры',
            'submenu' => [
                [
                    'name' => 'Верхний слайдер',
                    'controller' => 'slidertop'
                ],
                [
                    'name' => 'Нижний слайдер',
                    'controller' => 'sliderbottom'
                ],
            ]
        ],
        [
            'name' => 'Цены',
            'submenu' => [
                [
                    'name' => 'Разделы',
                    'controller' => 'price-section'
                ],
                [
                    'name' => 'Услуги',
                    'controller' => 'prices'
                ],
            ]
        ],
        [
            'name' => 'Работы',
            'submenu' => [
                [
                    'name' => 'Разделы',
                    'controller' => 'works-section'
                ],
                [
                    'name' => 'Список',
                    'controller' => 'works'
                ],
            ]
        ],
//        [
//            'name' => 'Блог',
//            'submenu' => [
//                [
//                    'name' => 'Новости',
//                    'controller' => 'news'
//                ],
//                [
//                    'name' => 'Статьи',
//                    'controller' => 'articles'
//                ],
//                [
//                    'name' => 'Видео',
//                    'controller' => 'video'
//                ],
//            ]
//        ],
        [
            'name' => 'Заявки',
            'submenu' => [
                [
                    'name' => 'Дисконтная карта',
                    'controller' => 'card'
                ],
                [
                    'name' => 'Вызов мастера',
                    'controller' => 'master'
                ],
                [
                    'name' => 'Консультация',
                    'controller' => 'advice'
                ],
                [
                    'name' => 'Обратный звонок',
                    'controller' => 'callback'
                ],
            ]
        ],
    ];

    public function run() {
        $mainLi = '';
        $subLi = '';
        foreach ($this->menu as $items) {
            $subLi = '';
            foreach ($items as $key => $item) {
                if (is_array($item)) {
                    foreach ($item as $val) {
                        $subSpan = Html::tag('span', $val['name']);
                        $a = Html::tag('a', $subSpan, ['href' => '/admin/' . $val['controller']]);
                        $subLi .= Html::tag('li', $a);
                    }
                }
            }
            $subUl = Html::tag('ul', $subLi, ['class' => 'dropdown-menu', 'role' => 'menu']);
            $mainSpan = Html::tag('span', '', ['class' => 'caret']);
            $mainA = Html::tag('a', $items['name'] . $mainSpan, [
                'href' => '#',
                'class' => 'dropdown-toggle',
                'data-toggle' => 'dropdown',
                'role' => 'button',
                'aria-expanded' => 'false'
            ]);
            $mainLi .= Html::tag('li', $mainA . $subUl, ['class' => 'dropdown']);
            }
        return $mainLi;
    }

}