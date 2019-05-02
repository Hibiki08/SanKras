<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\Works;
use app\models\WorksCat;

$this->title = 'Сантехнические работы "под ключ" в частном доме в Краснодаре';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Компания СанкКрас выполняет полный комплекс улуг по разводке отопления, водоснабжения и канализации в частном доме. Профессиональный монтаж и гарантия 5 лет на работы.'
]);

$this->params['breadcrumbs'][] = 'Сантехнические работы в частном доме "под ключ"';
?>
<section class="more-flat" id="more">
    <section class="description">
        <div class="width clear">
            <h1 class="title title-big">Сантехнические работы в частном доме "под ключ"</h1>
            <figure>
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'more-house-1.png'; ?>" alt="монтаж квартиры" title="монтаж квартиры">
            </figure>
            <div class="text">
                <p>Сантехнические коммуникации в частном доме — это структура, состоящая из таких элементов комфорта, как отопление, водоснабжение и канализация. Для того чтобы каждый из этих элементов работал исправно и не доставлял вам хлопот в будущем, монтаж сантехнических коммуникаций нужно начинать с проектирования.</p>
                <p>Проект включает в себя: расчет теплопотерь здания, подбор нужного оборудования и видов материала, из которого будет производиться монтаж. Помимо этой информации монтажнику нужно учесть еще множество факторов, которые прямым образом будут влиять на работоспособность системы.  Для заказчика важно знать то, что после заливки стяжкой труб отопления, водоснабжения и канализации, исправить что-либо уже будет очень сложно и дорого, отсюда следует, что к вопросу монтажа вышеперечисленных элементов нужно подходить очень серьезно, доверять такое дело нужно только компетентным специалистам в данной области.</p>
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
                        <img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'more-house-2.png'; ?>">
                    </figure>
                    <div class="text">
                        <ul>
                            <li>Расчет теплопотерь здания для правильного подбора материала и оборудования</li>
                            <li>Консультирование, помощь в подборе материала и составление схемы проекта</li>
                            <li>Составление сметы, закупка и доставка материала</li>
                            <li>Согласование и решение вопросов с прорабом отделочников</li>
                            <li>Монтаж системы отопления, обвязка котельной</li>
                            <li>Монтаж радиаторов, теплого пола</li>
                            <li>Монтаж системы водоснабжения, обвязка скважины</li>
                            <li>Монтаж систем водоподготовки и фильтрации</li>
                            <li>Земельные работы, монтаж канализации, установка септика</li>
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
                        <img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'more-house-3.png'; ?>">
                    </figure>
                    <div class="text">
                        <ul>
                            <li>Установка санфаянса на стадии финишных работ</li>
                            <li>Установка бытовой техники (стиральная / посудомоечная машина и др.)</li>
                            <li>Ввод в эксплуатацию установленного оборудования (котел, бойлер косвенного нагрева, накопительный водонагреватель, газовая колонка)
                            </li>
                            <li>Запуск и наладка всей системы</li>
                            <li>Консультация по эксплуатации установленного оборудования</li>
                            <li>Предоставление гарантии</li>
                            <li>Консультация по вопросам, возникающим в ходе эксплуатации</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="more-key">
        <div class="width">
            <h2 class="title-big">При заказе системы «под ключ» в частном доме вы получаете:</h2>
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
    <?php echo Works::widget(['filter' => ['works.cat_id' => WorksCat::HOUSE_ID]]); ?>
    <section class="pakage">
        <div class="width">
            <h2 class="title-big">пакеты услуг по монтажу отопления и водоснабжения в частном доме</h2>
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
                    <td>Расчет теплопотерь здания</td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                </tr>
                <tr>
                    <td>Гидравлический расчет системы водоснабжения и отопления, технический проект инженерных сантехнический сетей</td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>no.png" alt="no" title="нет"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>no.png" alt="no" title="нет"></td>
                </tr>
                <tr>
                    <td>Котёл</td>
                    <td>Одноконтурный конденсационный Viessmann (Германия) </td>
                    <td>Двухконтурный Protherm (Словакия)</td>
                    <td>Двухконтурный Navien (Корея) / Baltgaz (Россия)</td>
                </tr>
                <tr>
                    <td>Бойлер косвенного нагрева Viessmann (Германия)</td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>no.png" alt="no" title="нет"></td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>no.png" alt="no" title="нет"></td>
                </tr>
                <tr>
                    <td>Группа безопасности</td>
                    <td>Системы отопления и ГВС</td>
                    <td>Системы отопления</td>
                    <td class="ico"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'];?>yes.png" alt="yes" title="есть"></td>
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
                <tr class="guar">
                    <td>Гарантия на монтаж</td>
                    <td>5 лет</td>
                    <td>3 года</td>
                    <td>2 года</td>
                </tr>
                <tr class="guarantee one">
                    <td>Стоимость материала</td>
                    <td class="footer-comfort"><span>3 000 <span>р./м<sup>2</sup></span></span></td>
                    <td class="footer-standart"><span>2 000 <span>р./м<sup>2</sup></span></span></td>
                    <td class="footer-mini"><span>1 350 <span>р./м<sup>2</sup></span></span></td>
                </tr>
                <tr class="guarantee">
                    <td>Стоимость монтажа</td>
                    <td class="footer-comfort"><span>800 <span>р./м<sup>2</sup></span></span></td>
                    <td class="footer-standart"><span>650 <span>р./м<sup>2</sup></span></span></td>
                    <td class="footer-mini"><span>500 <span>р./м<sup>2</sup></span></span></td>
                </tr>
                <tr class="cost one">
                    <td>Материал со скидкой 10%*</td>
                    <td class="footer-comfort"><span>2 700 <span>р./м<sup>2</sup></span></span></td>
                    <td class="footer-standart"><span>1 800 <span>р./м<sup>2</sup></span></span></td>
                    <td class="footer-mini"><span>1 080 <span>р./м<sup>2</sup></span></span></td>
                </tr>
                <tr class="cost">
                    <td>Монтаж со скидкой 12%*</td>
                    <td class="footer-comfort"><span>700 <span>р./м<sup>2</sup></span></span></td>
                    <td class="footer-standart"><span>570 <span>р./м<sup>2</sup></span></span></td>
                    <td class="footer-mini"><span>440 <span>р./м<sup>2</sup></span></span></td>
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
