<nav class="menu exo asphalt">
    <ul>
        <li class="list"><a class="drop-down"><div class="img"></div>Услуги</a>
            <?php if(!empty($services)) { ?>
                <?php $i = 0; ?>
                <div class="submenu">
                    <div class="required-section">
                        <a href="<?php echo Yii::$app->urlManager->createUrl('flat'); ?>"><span>Монтаж в квартире</span></a>
                        <a href="<?php echo Yii::$app->urlManager->createUrl('house'); ?>"><span>Монтаж в частном доме</span></a>
                        <a href="<?php echo Yii::$app->urlManager->createUrl('company'); ?>"><span>Сотрудничаем с застройщиками</span></a>
                    </div>
                    <div class="items">
                        <?php foreach ($services as $serv) { ?>
                        <?php if ($serv->parent_id == null) { ?>
                            <?php if ($i == 0) { ?>
                                <ul class="ul">
                            <?php }  ?>
                            <li><a class="title" href="<?php echo Yii::$app->urlManager->createUrl($serv->link); ?>"><?php echo $serv->title; ?></a>
                                <?php if (!empty($serv->childItems)) { ?>
                                    <ul class="sub"><?php foreach ($serv->childItems as $child) { ?>
                                            <li><a href="<?php echo Yii::$app->urlManager->createUrl([$serv['link'], 'key' => $child->link]); ?>"><?php echo $child->title; ?></a>
                                            <?php if (!empty($child->childItems)) { ?>
                                                   <ul class="subsub">
                                                       <?php foreach ($child->childItems as $subchild) { ?>
                                                            <li><a href="<?php echo Yii::$app->urlManager->createUrl([$subchild->link, 'key' => $subchild->link]); ?>"><?php echo $subchild->title; ?></a></li>
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
        <li><a href="<?php echo Yii::$app->urlManager->createUrl('prices'); ?>" class="<?php echo $controller == 'prices' ? 'active' : $action == 'prices' ? 'active' : ''; ?>">Цены</a></li>
        <li class="list works"><a href="<?php echo Yii::$app->urlManager->createUrl('works'); ?>" class="<?php echo $controller == 'works' ? 'active' : $action == 'works' ? 'active' : ''; ?>">Наши работы</a>
            <ul class="submenu"><li><a href="<?php echo Yii::$app->urlManager->createUrl('works/video'); ?>">Видео работ</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createUrl(['works', 'group' => 'house']); ?>">Частные дома</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createUrl(['works', 'group' => 'flat']); ?>">Квартиры</a></li>
            </ul>
        </li>
        <li class="list about"><a href="<?php echo Yii::$app->urlManager->createUrl('about'); ?>" class="<?php echo $controller == 'about' ? 'active' : $action == 'about' ? 'active' : ''; ?>">О нас</a>
            <ul class="submenu"><li><a href="<?php echo Yii::$app->urlManager->createUrl('about/opinions'); ?>">Отзывы</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createUrl('about/news'); ?>">Новости</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createUrl('about/articles'); ?>">Статьи</a></li>
            </ul>
        </li>
        <li><a href="<?php echo Yii::$app->urlManager->createUrl('contacts'); ?>" class="<?php echo $controller == 'contacts' ? 'active' : $action == 'contacts' ? 'active' : ''; ?>">Контакты</a></li>
    </ul>
</nav>