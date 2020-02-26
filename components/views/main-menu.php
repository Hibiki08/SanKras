<nav class="menu exo asphalt">
    <ul>
        <li class="list">
            <a rel="nofollow" class="drop-down"><div class="img"></div>Услуги</a>
            <?php if(!empty($services)) { ?>
                <?php $i = 0; ?>
                <div class="submenu">
                    <div class="required-section">
                        <a href="<?php echo Yii::$app->urlManager->createUrl('montazh-v-kvartire'); ?>"><span>Монтаж в квартире</span></a>
                        <a href="<?php echo Yii::$app->urlManager->createUrl('montazh-v-chastnom-dome'); ?>"><span>Монтаж в частном доме</span></a>
                        <a href="<?php echo Yii::$app->urlManager->createUrl('zastroyshchikam'); ?>"><span>Сотрудничаем с застройщиками</span></a>
                    </div>
                    <div class="items">
                        <?php foreach ($services as $serv) { ?>
                        <?php if ($serv->parent_id == null) { ?>
                            <?php if ($i == 0) { ?>
                                <ul class="ul">
                            <?php }  ?>
                            <li><a class="title" href="<?php echo Yii::$app->urlManager->createUrl($serv->link); ?>"><?php echo $serv->title_menu; ?></a>
                                <?php if (!empty($serv->childItems)) { ?>
                                    <ul class="sub"><?php foreach ($serv->childItems as $child) { ?>
                                            <li><a href="/<?php echo $serv['link'] .  '/' . $child->link; ?>"><?php echo $child->title_menu; ?></a>
                                            <?php if (!empty($child->childItems)) { ?>
                                                   <ul class="subsub">
                                                       <?php foreach ($child->childItems as $subchild) { ?>
                                                            <li><a href="/<?php echo $serv->link . '/' . $subchild->link; ?>"><?php echo $subchild->title_menu; ?></a></li>
                                                        <?php } ?>
                                                 </ul>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                            <?php if ($i == 1) { $i = 0; ?>
                                </ul>
                            <?php  } else {$i = 1;}  ?>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </li>
        <li class="list prices"><a rel="nofollow" href="javascript:void(0)" class="<?php echo $controller == 'prices' ? 'active' : $action == 'prices' ? 'active' : ''; ?>">Цены</a>
          <ul class="submenu">
                <li><a href="<?php echo Yii::$app->urlManager->createUrl('prays-list'); ?>">Прайс-лист</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createUrl(['pakety-uslug']); ?>">Пакеты услуг</a></li>
            </ul>
        </li>
        <li class="list works"><a rel="nofollow" href="javascript:void(0)" class="<?php echo $controller == 'works' ? 'active' : $action == 'works' ? 'active' : ''; ?>">Наши работы</a>
            <ul class="submenu">
                <li><a href="<?php echo Yii::$app->urlManager->createUrl('nashi-raboty'); ?>">Все работы</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createUrl('nashi-raboty/video-rabot'); ?>">Видео работ</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createUrl('nashi-raboty/chastnye-doma'); ?>">Частные дома</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createUrl('nashi-raboty/kvartiry'); ?>">Квартиры</a></li>
            </ul>
        </li>
        <li class="list about"><a rel="nofollow" href="javascript:void(0)" class="<?php echo $controller == 'about' ? 'active' : $action == 'about' ? 'active' : ''; ?>">О нас</a>
            <ul class="submenu">
                <li><a href="<?php echo Yii::$app->urlManager->createUrl('o-kompanii'); ?>">О компании</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createUrl('otzyvy'); ?>">Отзывы</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createUrl('novosti'); ?>">Новости</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createUrl('stati'); ?>">Статьи</a></li>
            </ul>
        </li>
        <li><a href="<?php echo Yii::$app->urlManager->createUrl('contacts'); ?>" class="<?php echo $controller == 'contacts' ? 'active' : $action == 'contacts' ? 'active' : ''; ?>">Контакты</a></li>
    </ul>
</nav>