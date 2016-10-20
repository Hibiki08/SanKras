<?php
$this->title = 'Пакеты услуг';
?>
<section class="options" id="options">
    <div class="width">
        <div class="tabs">
            <ul>
                <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('prices'); ?>">Прайс-лист</a></li>
                <li class="exo asphalt calc"><a href="/prices#calc">Рассчитать стоимость</a></li>
                <li class="exo asphalt active" ><a href="<?php echo Yii::$app->urlManager->createUrl('rates'); ?>">Пакеты услуг</a></li>
            </ul>
        </div>
        <h2 class="exo asphalt">Монтаж сантехнических коммуникаций в квартире</h2>
        <table>
            <thead>
            <tr>
                <th class="title">В монтаж входит:</th>
                <th class="comfort">Комфорт</th>
                <th class="standart">Стандарт</th>
                <th class="mini">Эконом</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Составление сметы и доставка материала (бесплатно)</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
            </tr>
            <tr>
                <td>Монтаж водоснабжения</td>
                <td>металлопластом Franchise (Германия) / сшитым полиэтиленом Rehau по коллекторной системе</td>
                <td>металлопластом APE (Италия) по коллекторной системе до 10 точек</td>
                <td>полипропиленом FV Plast (Чехия) по тройниковой системе до 10 точек</td>
            </tr>
            <tr>
                <td><strong>Монтаж канализации</strong></td>
                <td>бесшумная канализация ПВХ Ostendorf (Германия)</td>
                <td>ПВХ Ostendorf (Германия) до 5 точек</td>
                <td>ПВХ Политэк (Россия) до 5 точек</td>
            </tr>
            <tr>
                <td>Шумоизоляция канализационного стояка энергофлексом</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/no.png" alt="no" title="нет"></td>
            </tr>
            <tr>
                <td>Монтаж выводов под полотенцесушитель</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
            </tr>
            <tr>
                <td>Штробление под точки водоснабжения, их дальнейшее крепление и опрессовка</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
            </tr>
            <tr>
                <td>Установка редукторов давления, сетчатых фильтров 500 мкм, арматура Itap, FIV (Италия)</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
            </tr>
            <tr>
                <td>Защита трубопровода в энергофлекс Super Protect (Россия)</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
            </tr>
            <tr>
                <td>Установка компенсаторов от гидроударов FAR (Италия)</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/no.png" alt="no" title="нет"></td>
            </tr>
            <tr>
                <td>Установка промывных фильтров Honeywell (Германия) / FAR (Италия)</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/no.png" alt="no" title="нет"></td>
                <td class="ico"><img src="/images/system/no.png" alt="no" title="нет"></td>
            </tr>
            <tr>
                <td>Установка фильтров тонкой очистки Atoll (США)</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/no.png" alt="no" title="нет"></td>
                <td class="ico"><img src="/images/system/no.png" alt="no" title="нет"></td>
            </tr>
            <tr>
                <td>Работа по дизайн проекту</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/no.png" alt="no" title="нет"></td>
                <td class="ico"><img src="/images/system/no.png" alt="no" title="нет"></td>
            </tr>
            <tr>
                <td>Уборка помещения и вынос мусора</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
            </tr>
            <tr class="guarantee">
                <td>Гарантия на монтаж</td>
                <td>5 лет</td>
                <td>3 года</td>
                <td>2 года</td>
            </tr>
            <tr class="cost">
                <td>Стоимость материала*</td>
                <td class="footer-comfort"><span>55</span> т. руб.</td>
                <td class="footer-standart"><span>26</span> т. руб.</td>
                <td class="footer-mini"><span>14</span> т. руб.</td>
            </tr>
            <tr class="cost">
                <td>Стоимость монтажа*</td>
                <td class="footer-comfort"><span>27</span> т. руб.</td>
                <td class="footer-standart"><span>17</span> т. руб.</td>
                <td class="footer-mini"><span>12</span> т. руб.</td>
            </tr>
            </tbody>
        </table>
        <div class="footnote" id="price-house">*Представлена ориентировочная стоимость. По желанию заказчика услуги из пакета могут исключаться, а также добавляться другие.</div>
        <h2 class="exo asphalt">Монтаж сантехнических коммуникаций в частном доме</h2>
        <table>
            <thead>
            <tr>
                <th class="title">В монтаж входит:</th>
                <th class="comfort">Комфорт</th>
                <th class="standart">Стандарт</th>
                <th class="mini">Эконом</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Составление сметы и доставка материала (бесплатно)</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
            </tr>
            <tr>
                <td>Расчет теплопотерь здания</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
            </tr>
            <tr>
                <td>Гидравлический расчет системы водоснабжения и отопления, технический проект инженерных сантехнический сетей</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/no.png" alt="no" title="нет"></td>
                <td class="ico"><img src="/images/system/no.png" alt="no" title="нет"></td>
            </tr>
            <tr>
                <td>Котёл</td>
                <td>Одноконтурный конденсационный Viessmann (Германия) </td>
                <td>Двухконтурный Protherm (Словакия)</td>
                <td>Двухконтурный Navien (Корея) / Baltgaz (Россия)</td>
            </tr>
            <tr>
                <td>Бойлер косвенного нагрева Viessmann (Германия)</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/no.png" alt="no" title="нет"></td>
                <td class="ico"><img src="/images/system/no.png" alt="no" title="нет"></td>
            </tr>
            <tr>
                <td>Группа безопасности</td>
                <td>Системы отопления и ГВС</td>
                <td>Системы отопления</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
            </tr>
            <tr>
                <td>Система отопления</td>
                <td>Коллекторная металлопластом Franchise (Германия) / сшитым полиэтиленом Rehau</td>
                <td>Коллекторная, металлопластом APE (Италия)</td>
                <td>Двухтрубная попутного типа, полипропиленом FD Plast (Россия)</td>
            </tr>
            <tr>
                <td>Радиаторы</td>
                <td>Vogel & Noot (Австрия) диагональное подключение</td>
                <td>Лидея (Россия) / Royal Thermo (Италия) диагональное подключение диагональное подключение</td>
                <td>Лидея (Россия) / Germanium (Китай) диагональное подключение диагональное подключение</td>
            </tr>
            <tr>
                <td>Запорно-регулирующая арматура</td>
                <td>Itap, FAR, FIV, Giacomini (Италия)</td>
                <td>Itap, FAR, FIV (Италия)</td>
                <td>Itap (Италия)</td>
            </tr>
            <tr>
                <td>Теплый пол</td>
                <td>металлопластом Franchise (Германия) / сшитым полиэтиленом Rehau (Германия) с группой подмеса FIV (Италия) / Meibes (Германия)</td>
                <td>30 м2 металлопластом APE (Италия) с системой подмеса, арматура Herz (Венгрия)</td>
                <td>10 м2 металлопластом APE (Италия)</td>
            </tr>
            <tr>
                <td>Обвязка и автоматическое управление скважиной</td>
                <td>DAB (Италия)</td>
                <td>арматура Италия, Россия</td>
                <td>Арматура Россия</td>
            </tr>
            <tr>
                <td>Монтаж водоснабжения</td>
                <td>Металлопластом Franchise (Германия) / сшитым полиэтиленом Rehau по коллекторной системе</td>
                <td>Полипропиленом FV Plast (Чехия) по тройниковой системе</td>
                <td>Полипропиленом FD Plast (Россия) по тройниковой системе</td>
            </tr>
            <tr>
                <td>Система фильтрации</td>
                <td>Хим. анализ воды и система водоподготовки</td>
                <td>Фильтр тонкой очистки Аквафор (Россия)</td>
                <td>Фильтр тонкой очистки Аквафор (Россия)</td>
            </tr>
            <tr>
                <td>Погодозависимая автоматика Viessmann (Германия)</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/no.png" alt="no" title="нет"></td>
                <td class="ico"><img src="/images/system/no.png" alt="no" title="нет"></td>
            </tr>
            <tr>
                <td>Работа по дизайн проекту</td>
                <td class="ico"><img src="/images/system/yes.png" alt="yes" title="есть"></td>
                <td class="ico"><img src="/images/system/no.png" alt="no" title="нет"></td>
                <td class="ico"><img src="/images/system/no.png" alt="no" title="нет"></td>
            </tr>
            <tr class="guarantee">
                <td>Гарантия на монтаж</td>
                <td>5 лет</td>
                <td>3 года</td>
                <td>2 года</td>
            </tr>
            <tr class="cost">
                <td>Стоимость материала*</td>
                <td class="footer-comfort"><span>3 000</span> руб./м<sup>2</sup></td>
                <td class="footer-standart"><span>2 000</span> руб./м<sup>2</sup></td>
                <td class="footer-mini"><span>1 050</span> руб./м<sup>2</sup></td>
            </tr>
            <tr class="cost">
                <td>Стоимость монтажа*</td>
                <td class="footer-comfort"><span>800</span> руб./м<sup>2</sup></td>
                <td class="footer-standart"><span>650</span> руб./м<sup>2</sup></td>
                <td class="footer-mini"><span>450</span> руб./м<sup>2</sup></td>
            </tr>
            </tbody>
        </table>
        <div class="footnote">*Представлена ориентировочная стоимость. По желанию заказчика услуги из пакета могут исключаться, а также добавляться другие.</div>
    </div>
</section>
