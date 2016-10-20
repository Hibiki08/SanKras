<?php
?>
<div class="width">
    <div class="header clear">
        <figure class="logo">
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'print-logo.png'; ?>" alt="лого">
        </figure>
        <div class="adress">
            г. Краснодар<br>
            Телефон: <?php echo Yii::$app->system->get('phone'); ?><br>
            Email: <span><?php echo Yii::$app->system->get('email'); ?></span><br>
            http://san-kras.ru<br>
        </div>
    </div>
    <div class="print-list" title="Распечатать страницу"></div>
    <div class="content">
        <h1>Смета стоимости монтажных работ №_____ от <?php echo Yii::$app->formatter->asDate(time(), 'd.MM.yyyy'); ?></h1>
        <div class="strings">
            <div class="string">
                <div class="name">Заказчик: </div><div class="line"></div>
            </div>
            <div class="string">
                <div class="name">Объект: </div><div class="line"></div>
            </div>
            <div class="string">
                <div class="name">Подрядчик: </div><div class="line"></div>
            </div>
        </div>
        <table>
            <tr>
                <td class="title">Наименование работы</td>
                <td class="title quantity">Кол-<br>во</td>
                <td class="title unit">Ед.<br>изм.</td>
                <td class="title price">Цена,<br>руб.</td>
                <td class="title cost">Сумма,<br>руб.</td>
            </tr>
            <?php if (!empty($data)) {
                    foreach ($data as $val) { ?>
            <tr><?php if (is_array($val)) { ?>
                <td><?php echo $val['title']; ?></td>
                <td><?php echo $val['table-number']; ?></td>
                <td><?php echo $val['unit']; ?></td>
                <td><?php echo $val['price']; ?></td>
                <td><?php echo $val['cost']; ?></td>
                <?php } ?>
            </tr>
                    <?php } ?>
            <?php } else { ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            <?php } ?>
        </table>
            <div class="res">Итого: <?php echo !empty($data['cost']) ? $data['cost'] : ''; ?> руб.</div>
        <div class="strings">
            <div class="string signature">
                <div class="name">Заказчик: </div><div class="line"></div>
                <div class="write"><span>(подпись)</span></div>
            </div>
            <div class="string signature">
                <div class="name">Подрядчик: </div><div class="line"></div>
                <div class="write"><span>(подпись)</span></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.print-list').click(function() {
            window.print();
        });
    });
</script>