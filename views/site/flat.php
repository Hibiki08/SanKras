<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\Works;
use app\models\WorksCat;

$this->title = 'Сантехнические работы "под ключ" в квартире в Краснодаре';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Компания СанкКрас выполняет полный комплекс улуг по разводке сантехнических коммуникаций в квартире. Профессиональный монтаж отопления, водоснабжения, канализации'
]);

$this->params['breadcrumbs'][] = 'Сантехнические работы в квартире "под ключ"';
?>
<section class="more-flat" id="more">
    <section class="description">
        <div class="width clear">
            <h1 class="title title-big">Сантехнические работы в квартире "под ключ"</h1>
            <figure>
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'more-flat-2.png'; ?>" alt="монтаж квартиры" title="монтаж квартиры">
            </figure>
            <div class="text">
                <p>Дизайн ванной комнаты и удобство использования сантехнических приборов во многом зависит от того, насколько грамотно выполнен монтаж сантехнических коммуникаций. Опасно доверять такое дело неопытному специалисту, так как последствия могут влететь в копеечку. Если вы проводите ремонт своими силами и не сотрудничаете с дизайнером, опытные специалисты СанКрас посоветуют, как расположить сантехнические приборы таким образом, чтобы они были удобны в использовании и гармонировали с интерьером ванной комнаты.</p>
                <p>Компания СанКрас за последний год выполнила монтаж в 22 квартирах и наши специалисты точно знают, с чего начинается и чем заканчивается монтаж сантехнических коммуникаций в ванной комнате.</p>
            </div>
        </div>
    </section>
    <section class="steps">
        <div class="width">
            <div class="step clear">
                <div class="st">
                    <span class="number"></span>
                    <span class="asphalt exo">первый этап работ</span>
                </div>
                <div class="desc">
                    <figure>
                        <img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'more-flat-3.png'; ?>">
                    </figure>
                    <div class="text">
                        <ul>
                            <li>Консультирование, помощь в подборе материала и составление схемы проекта</li>
                            <li>Составление сметы, закупка и доставка материала</li>
                            <li>Согласование и решение вопросов с прорабом отделочников</li>
                            <li>Монтаж труб водоснабжения и канализации со штроблением</li>
                            <li>Вынос мусора</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="step clear">
                <div class="st st-2">
                    <span class="number"></span>
                    <span class="asphalt exo">второй этап после отделки</span>
                </div>
                <div class="desc">
                    <figure>
                        <img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'more-flat-1.png'; ?>">
                    </figure>
                    <div class="text">
                        <ul>
                            <li>Установка санфаянса на стадии финишных работ</li>
                            <li>Установка бытовой техники (стиральной машины и т.д.)</li>
                            <li>Ввод в эксплуатацию бытового оборудования (водонагревателель, газовая колонка)</li>
                            <li>Запуск и наладка всей системы</li>
                            <li>Предоставление гарантии</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="more-key">
        <div class="width">
            <h2 class="title-big">При заказе системы «под ключ» в квартире вы получаете:</h2>
            <div class="flat clear one">
                <div class="fl">
                    <div class="title exo">Выполнение работы быстро и в поставленные сроки</div>
                    <div class="text">Мы берем на себя все обязательства по выполнению работ от начала до конца и решаем все возникающие в ходе монтажа вопросы. Вам не придется решать организационные вопросы, мы сами бесплатно доставим материал на объект и согласуем все этапы монтажа с другими бригадами (например, с бригадами по отделке). Благодаря этому не возникнет организационного беспорядка, и работа будет сдана в оговоренные сроки.</div>
                </div>
                <div class="fl">
                    <div class="title exo">12% скидку на материал и 10% скидку на монтаж для постоянных клиентов</div>
                    <div class="text">Монтаж "под ключ" выгоднее найма отдельных специалистов, так как мы даем дополнительные скидки на монтаж при большом объеме работ.</div>
                </div>
            </div>
            <div class="flat clear two">
                <div class="fl">
                    <div class="title exo">Прозрачную единую смету на стоимость всех работ</div>
                    <div class="text">Мы выполняем весь комплекс работ по разводке сантехнических  коммуникаций и вносим их стоимость в единую смету. Она согласовывается с вами до начала работ, поэтому вы заранее точно знаете стоимость монтажа.</div>
                </div>
                <div class="fl">
                    <div class="title exo">Бесплатное гарантийное устранение неисправностей</div>
                    <div class="text">В случае возникновения неисправностей в системе мы исправим все бесплатно в рамках гарантийного договора.</div>
                </div>
            </div>
        </div>
    </section>
    <?php echo Works::widget(['filter' => ['works.cat_id' => WorksCat::FLAT_ID]]); ?>
    <section class="pakage">
        <div class="width">
            <h2 class="title-big">пакеты услуг по монтажу отопления и водоснабжения в квартире</h2>
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
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                </tr>
                <tr>
                    <td>Монтаж водоснабжения</td>
                    <td>металлопластом Franchise (Германия) / сшитым полиэтиленом Rehau по коллекторной системе</td>
                    <td>металлопластом APE (Италия) по коллекторной системе до 10 точек</td>
                    <td>полипропиленом FV Plast (Чехия) по тройниковой системе до 10 точек</td>
                </tr>
                <tr>
                    <td>Монтаж канализации</td>
                    <td>бесшумная канализация ПВХ Ostendorf (Германия)</td>
                    <td>ПВХ Ostendorf (Германия) до 5 точек</td>
                    <td>ПВХ Политэк (Россия) до 5 точек</td>
                </tr>
                <tr>
                    <td>Шумоизоляция канализационного стояка энергофлексом</td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>no.png" alt="no" title="нет"></td>
                </tr>
                <tr>
                    <td>Монтаж выводов под полотенцесушитель</td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                </tr>
                <tr>
                    <td>Штробление под точки водоснабжения, их дальнейшее крепление и опрессовка</td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                </tr>
                <tr>
                    <td>Установка редукторов давления, сетчатых фильтров 500 мкм, арматура Itap, FIV (Италия)</td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                </tr>
                <tr>
                    <td>Защита трубопровода в энергофлекс Super Protect (Россия)</td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                </tr>
                <tr>
                    <td>Установка компенсаторов от гидроударов FAR (Италия)</td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>no.png" alt="no" title="нет"></td>
                </tr>
                <tr>
                    <td>Установка промывных фильтров Honeywell (Германия) / FAR (Италия)</td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>no.png" alt="no" title="нет"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>no.png" alt="no" title="нет"></td>
                </tr>
                <tr>
                    <td>Установка фильтров тонкой очистки Atoll (США)</td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>no.png" alt="no" title="нет"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>no.png" alt="no" title="нет"></td>
                </tr>
                <tr>
                    <td>Работа по дизайн проекту</td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>no.png" alt="no" title="нет"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>no.png" alt="no" title="нет"></td>
                </tr>
                <tr>
                    <td>Уборка помещения и вынос мусора</td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                </tr>
                <tr class="guar">
                    <td>Гарантия на монтаж</td>
                    <td>5 лет</td>
                    <td>3 года</td>
                    <td>2 года</td>
                </tr>
                <tr class="guarantee one">
                    <td>Стоимость материала</td>
                    <td class="footer-comfort"><span>55 000 <span>р.</span></span></td>
                    <td class="footer-standart"><span>26 000 <span>р.</span></span></td>
                    <td class="footer-mini"><span>15 500 <span>р.</span></span></td>
                </tr>
                <tr class="guarantee">
                    <td>Стоимость монтажа</td>
                    <td class="footer-comfort"><span>27 000 <span>р.</span></span></td>
                    <td class="footer-standart"><span>17 000 <span>р.</span></span></td>
                    <td class="footer-mini"><span>14 000 <span>р.</span></span></td>
                </tr>
                <tr class="cost one">
                    <td>Материал со скидкой 10%*</td>
                    <td class="footer-comfort"><span>49 500 <span>р.</span></span></td>
                    <td class="footer-standart"><span>23 400 <span>р.</span></span></td>
                    <td class="footer-mini"><span>13 950 <span>р.</span></span></td>
                </tr>
                <tr class="cost">
                    <td>Монтаж со скидкой 12%*</td>
                    <td class="footer-comfort"><span>23 760 <span>р.</span></span></td>
                    <td class="footer-standart"><span>14 960 <span>р.</span></span></td>
                    <td class="footer-mini"><span>12 320 <span>р.</span></span></td>
                </tr>
                </tbody>
            </table>
            <div class="footnote">Представлена ориентировочная стоимость. По желанию заказчика услуги из пакета могут исключаться, а также добавляться другие.<br>* Скидка предоставляется по дисконтной карте. <a href="<?php echo Yii::$app->urlManager->createUrl(['/', '#' => 'card']); ?>">Получить дисконтную карту</a></div>
            <div class="pdf">
                <span class="title-big">Посмотреть полный прайс-лист</span><a href="<?php echo Yii::$app->urlManager->createUrl('prices'); ?>"><button class="pulse exo">Прайс-лист</button></a>
            </div>
        </div>
    </section>
    <section class="questions">
        <div class="width clear">
            <div class="question">
                <span class="exo red">Остались вопросы?</span><br>
                <span class="exo qn">Поможем разобраться в вашей проблеме</span>
            </div>
            <div class="form clear">
                <div class="close"></div>
                <div class="loading"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'spinner25.gif'; ?>" alt="loading"></div>
                <span class="title exo"><span>Задайте ваш вопрос мастеру</span> и получите консультацию</span>
                <?php $form = ActiveForm::begin([
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
                    'options' => [
                        'id' => 'form-question',
                    ]
                ]);?>
                <?php echo $form->field($question, 'name', [
                    'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-name.png' . '" alt="ваше имя" title="ваше имя">{input}{error}</div>',
                ])->input('text', [
                    'class' => 'focus',
                    'placeholder' => 'Ваше имя*'
                ]); ?>
                <?php echo $form->field($question, 'text', [
                    'template' => '<div class="field textarea"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-message.png' . '" alt="ваше сообщение" title="ваше сообщение">{label}{input}{error}</div>',
                ])->textarea()->label('Ваш вопрос*');?>
                <?php echo $form->field($question, 'phone', [
                    'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-phone.png' . '" alt="ваш телефон" title="ваш телефон">{input}{error}</div>',
                ])->input('text', [
                    'value' => '',
                    'class' => 'phone-mask',
                    'placeholder' => 'Ваш телефон*'
                ]); ?>
                <?php echo $form->field($question, 'agree',['template' =>'<label>{input} Согласен(на) на обработку персональных данных в соответствии с <a href="/politika-konfidencialnosti">Политикой конфеденциальности</a></label>{error}' ])->input('checkbox', [
                            'value' => '1',
                            'checked' => 'checked',
                            'class' => '_argee'
                        ]); ?>
                <?php echo Html::submitButton('Задать вопрос', ['class' => 'pulse']); ?>
                <div class="success">
                    <span class="exo">Ваше сообщение отправлено!</span><br>
                    <span>Спасибо за ваш вопрос! В ближайшее время<br>мы перезвоним вам.</span>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </section>
</section>
