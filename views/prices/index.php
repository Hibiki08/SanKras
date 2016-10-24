<?php
$this->title = 'Прайс-лист';
?>
<section class="price" id="price">
    <div class="width">
        <div class="tabs">
            <ul>
                <li class="exo asphalt active"><a href="<?php echo Yii::$app->urlManager->createUrl('prices'); ?>">Прайс-лист</a></li>
                <li class="exo asphalt calc"><a href="/prices#calc">Рассчитать стоимость</a></li>
                <li class="exo asphalt" ><a href="<?php echo Yii::$app->urlManager->createUrl('prices/rates'); ?>">Пакеты услуг</a></li>
            </ul>
        </div>
        <section class="price-list clear">
            <h2 class="exo asphalt">Стоимость выполнения монтажных работ (прайс-лист <?php echo Yii::$app->formatter->asDate(time(), 'yyyy г.'); ?>)</h2>
            <div class="table">
                <?php $cat = []; ?>
                <?php foreach($prices as $price) { ?>
                    <table id="<?php echo isset(current($price)['parent_link']) ? current($price)['parent_link'] : current($price)['link']; ?>">
                        <?php foreach ($price as $group) { ?>
                            <?php if ($group['parent_cat_id'] == null) { ?>
                                <?php echo !in_array($group['cat_id'], $cat) ? '<caption class="exo">' . $group['cat_title'] . '</caption>' : ''; ?>
                                <tr class="transition">
                                    <td><?php echo $group['title']; ?></td>
                                    <td class="table-unit"><?php echo $group['unit']; ?></td>
                                    <td data-id="<?php echo $group['price_id'];?>" class="table-number hidden"><input class="transition" value="0"></td>
                                    <td class="table-price"><?php echo $group['price']; ?></td>
                                    <td class="table-cost hidden">0</td>
                                    <?php $cat[$group['cat_id']] = $group['cat_id']; ?>
                                </tr>
                            <?php } else { ?>
                                <?php echo !in_array($group['parent_cat_id'], $cat) ? '<caption class="exo">' . $group['parent_cat_title'] . '</caption>' : ''; ?>
                                <?php echo !in_array($group['cat_id'], $cat) ? '<tr id="'. $group['link'] . '" class="sub-title"><td>' . $group['cat_title'] . '</td><td>Ед.</td><td class="hidden">Кол-во</td><td class="hidden">Цена</td><td class="table-cost">Стоимость</td></tr>' : ''; ?>
                                <tr class="transition">
                                    <td><?php echo $group['title']; ?></td>
                                    <td class="table-unit"><?php echo $group['unit']; ?></td>
                                    <td data-id="<?php echo $group['price_id'];?>" class="table-number hidden"><input class="transition" value="0"></td>
                                    <td class="table-price"><?php echo $group['price']; ?></td>
                                    <td class="table-cost hidden">0</td>
                                    <?php $cat[$group['cat_id']] = $group['cat_id']; ?>
                                    <?php $cat[$group['parent_cat_id']] = $group['parent_cat_id']; ?>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </table>
                <?php } ?>
                <div class="sum">
                    <a target="_blank" href="<?php echo Yii::$app->urlManager->createUrl('prices/print'); ?>" class="print exo">Распечатать</a>
                    <div class="reset exo">Очистить всё</div>
                    <div class="result">Итого ориентировочная стоимость работ: <span class="res">0</span><span> руб.</span></div>
                </div>
            </div>
            <div class="nav-menu">
                <ul><?php foreach ($pricesCat as $cats) { ?>
                        <?php if (count($cats) > 2) { ?><li><a class="asphalt transition" href="#<?php echo $cats['parent_link']; ?>"><?php echo $cats['title']; ?></a><ul><?php foreach ($cats as $cat) { ?>
                                    <?php if (is_array($cat)) { ?>
                                        <li><a class="asphalt transition" href="#<?php echo $cat['link']; ?>"><?php echo $cat['title']; ?></a></li>
                                    <?php } ?>
                                <?php } ?></ul></li><?php } else { ?>
                            <li><a class="asphalt transition" href="#<?php echo $cats['link']; ?>"><?php echo $cats['title']; ?></a></li>
                        <?php } ?>
                    <?php } ?>
                </ul>
                <div class="up exo">Наверх</div>
            </div>
            <div class="table-description">
                <ul>
                    <li>Цены, указанные в прайсе, являются ориентировочными, возможно их изменение в зависимости от
                        сложности работ. Мы всегда готовы рассмотреть Ваши предложения, пойти навстречу и подобрать
                        оптимальное решение по соотношению цены и качества.
                    </li>
                    <li>Цены на сантехнические работы не включают в себя материалы. Мы предоставляем услуги по
                        закупке и бесплатной доставке материала.
                    </li>
                    <li>На все сантехнические работы действует гарантия, срок которой зависит от качетсва
                        используемых материалов. Длительность гарантии варьируется от 1 года до 5 лет.
                    </li>
                    <li>К стоимости заказа может применяться коэффициент надбавки 1.2 - 1.5, если сантехническое
                        оборудование и коммуникации находятся в труднодоступном месте.
                    </li>
                    <li>По всем возникшим вопросам Вы всегда можете обратиться за консультацией к нашим мастерам по телефону <?php echo Yii::$app->system->get('phone'); ?></li>
                </ul>
            </div>
        </section>
    </div>
</section>
<script type="text/javascript">
    $('.price .nav-menu > ul > li:first-of-type, .price .table table:first-of-type').addClass('active');
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).scroll(function() {
            sumPosition();
            buttonUp();
        });
    });
</script>