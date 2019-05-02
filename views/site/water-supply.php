<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\Works;

$this->title = 'Монтаж водоснабжения в Краснодаре';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Монтаж водоснабжения в Краснодаре. Компания SanKras'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'водоснабжение в краснодаре, водоснабжение в доме, водоснабжение в коттедже'
]);
?>
<section class="water-supply" id="more">
    <section class="description">
        <div class="width clear">
            <h1 class="title title-big">Монтаж водоснажения</h1>
            <div class="more-text clear">
                <div class="txt txt-1">
                    <figure><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'water-supply.jpg'; ?>" alt="монтаж водоснабжения" title="монтаж водоснабжения"></figure>
                    <p>Компания СанКрас производит монтаж водоснабжения и систем водоподготовки в Краснодаре и Краснодарском крае.</p>
                    <p>За время существования нашей компании мы выполнили множество объектов по монтажу водоснабжения, монтированию систем химической водоочистки и обвязке скважин, установке колодезного оборудования.</p>
                    <p>Только за последний год мы провели работы по обвязке 17 скважин, смонтировали 24 установки фильтрации водоснабжения.</p>
                    <p>Без системы водоснабжения невозможно представить себе</p>
                </div>
                <div class="txt txt-2">
                    <p>проживание в частном секторе. Не имея доступа к воде для бытовых нужд, мы лишаем себя значительной степени комфорта. Но перед тем как использовать воду, нужно обязательно провести ее химический анализ. Это грамотный выбор для безопасности вашего здоровья и долговечности системы водоснабжения в целом.</p>
                    <p>Заказывая услугу монтажа и закупку оборудования для системы водоочистки в СанКрас, вы получаете бесплатный <span>химический анализ</span> воды в ООО «Росводоканал Краснодар». Кроме того, в первый же выезд на ваш объект мы измерим уровень Ph воды с помощью переносного TDS-метра.</p>
                    <p>Мы выполняем <span>обвязки скважин</span> под ключ. Данная услуга включает в себя установку глубинного насоса, автоматики включения и отключения насоса, монтаж накопительной емкости или гидроаккумулятора, фильтрующее оборудование. Приобретая оборудование  для монтажа через наших поставщиков, вы гарантированно получаете скидку 10% на монтаж и 5% на весь материал.</p>
                    <p>В компанию СанКрас нередко обращаются жители частного сектора, дома которых подключены к центральному водоснабжению, с проблемой слабого напора воды. С этим вопросом мы тоже работаем. Решение предполагает установку накопительной емкости в тандеме с установкой насосного оборудования для <span>повышения давления</span>.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="options">
        <div class="width">
            <h2>Мы выполняем следующие виды работ по монтажу водоснабжения:</h2>
            <div class="opts clear">
                <ul class="float-left">
                    <li>Монтаж водоснабжения ГВС и ХВС</li>
                    <li>Установка коллекторного водоснабжения</li>
                    <li>Монтаж запорной арматуры</li>
                    <li>Установка счетчиков</li>
                    <li>Установка редуктора давления</li>
                    <li>Опрессовка системы водопровода</li>
                    Прокладка труб водоснабжения
                    <li>Металлопластиковых</li>
                    <li>Полипропиленовых ППР</li>
                    <li>Пластиковых ПВХ</li>
                </ul>
                <ul class="float-right">Установка фильтрующих систем:
                    <li>сетчатого фильтра</li>
                    <li>промывного фильтра</li>
                    <li>фильтра механической очистки</li>
                    <li>фильтра «обратный осмос»</li>
                    <li>магнитного фильтра</li>
                    <li>двух-/трехступенчатого фильтра под мойку</li>
                    <li>установка колбы-умягчителя</li>
                </ul>
                <ul class="absolute">Монтаж фильтров для водоподготовки:
                    <li>мешочного фильтра "защита от песка"</li>
                    <li>установка аэрационной колонны для обезжелезования</li>
                    <li>засыпного фильтра (умягчитель)</li>
                    <li>Установка УФ-лампы (стерилизатора)</li>
                    Обвязка скважины:
                    <li>монтаж насоса повыщающего давление</li>
                    <li>установка погружного насоса</li>
                    <li>установка насосной станции</li>
                    <li>установка накопительного бака</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="more-key">
        <div class="width">
            <h2 class="title-big">Заказывая монтаж системы водоснабжения у нас, вы получаете:</h2>
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
    <?php echo Works::widget(); ?>
    <?php if (!empty($options)) { ?>
    <section class="price-list">
        <div class="width">
            <div class="table">
                <table>
                    <caption class="exo">Монтаж водоснабжения</caption>
                    <tr class="sub-title">
                        <td>Услуга</td>
                        <td>Ед.</td>
                        <td class="table-cost">Стоимость</td>
                    </tr>
                    <?php foreach($options as $price) { ?>
                    <tr class="transition">
                        <td><?php echo $price->title; ?></td>
                        <td class="table-unit"><?php echo $price->unit; ?></td>
                        <td class="table-price"><?php echo $price->price; ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="pdf">
                <span class="title-big">Посмотреть полный прайс-лист</span><a href="<?php echo Yii::$app->urlManager->createUrl(['prices', '#' => 'plumbing']); ?>"><button class="pulse exo">Прайс-лист</button></a>
            </div>
        </div>
    </section>
    <?php } ?>
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
