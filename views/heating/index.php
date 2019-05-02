<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\Works;

$this->title = 'Монтаж отопления в Краснодаре';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Монтаж отопления в Краснодаре. Компания SanKras'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'отопления в краснодаре, отопления в доме, отопления в коттедже'
]);
?>
<section class="heating" id="more">
    <section class="description">
        <div class="width clear">
            <h1 class="title title-big">Монтаж отопления</h1>
            <div class="more-text clear">
                <div class="txt txt-1">
                    <figure><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'heating.jpg'; ?>" alt="монтаж водоснабжения" title="монтаж водоснабжения"></figure>
                    <p>Компания СанКрас уже более пяти лет производит монтаж отопления и котельного оборудования  в  Краснодаре и Краснодарском крае.</p>
                </div>
                <div class="txt txt-2">
                    <p>За это время мы смонтировали радиаторное и напольное отопление на множестве объектов, только за прошедший год мы провели работы в 36 частных домах.</p>
                    <p>Мы постоянно повышаем качество наших работ, подбираем поставщиков оборудования, отвечающих нашим требованиям, а также используем сертифицированный, качественный и доступный материал. Мы заботимся о своих клиентах, потому предоставляем скидки не только на наши услуги, но и на материалы наших партнеров. Например, на котлы производителей <span>Buderus</span>, <span>Bosch</span>, <span>Viessmann</span>, <span>Protherm</span>, <span>Wolf</span> действует скидка 15%.</p>
                    <p>Кроме того, перед началом работ мы бесплатно предоставим вам <span>проект котельной</span>, исходя из которого вы легко сможете понять, какая система будет смонтирована, какими преимуществами она будет обладать и где будут располагаться ключевые элементы котельной.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="options">
        <div class="width">
            <h2>Мы выполняем следующие виды работ по монтажу отопления:</h2>
            <div class="opts clear">
                <ul class="float-left">Монтаж и обвязка котлов:
                    <li>газовых котлов</li>
                    <li>электрических котлов</li>
                    <li>конденсационных котлов</li>
                    <li>твердотопливных котлов</li>
                    <li>жидкотопливных котлов</li>
                    <li>пеллетных котлов</li>
                    <li>котлов «Булерьян»</li>
                </ul>
                <ul class="float-right">
                    <li>Установка бойлера косвенного нагрева</li>
                    <li>Обвязка насоса рециркуляции</li>
                    <li>Обвязка группы безопасности бойлера</li>
                    <li>Установка накопительной емкости</li>
                    <li>Установка запорной арматуры</li>
                    <li>Установка дешламатора</li>
                    <li>Монтаж дымохода</li>
                </ul>
                <ul class="absolute">
                    <li>Обвязка котельных</li>
                    <li>Монтаж радиаторов</li>
                    <li>Монтаж теплых полов</li>
                    <li>Монтаж модуля для теплого пола</li>
                    <li>Монтаж внутрипольного радиатора<br>(конвектора)</li>
                    <li>Монтаж конвектора типа "вулкан"</li>
                    <li>Установка коллекторов</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="more-key">
        <div class="width">
            <h2 class="title-big">заказывая монтаж системы отопления у нас, вы получаете:</h2>
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
                        <caption class="exo">Монтаж отопления</caption>
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
                    <span class="title-big">Посмотреть полный прайс-лист</span><a href="<?php echo Yii::$app->urlManager->createUrl(['prices', '#' => 'heating']); ?>"><button class="pulse exo">Прайс-лист</button></a>
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
                    'action' =>['heating/include'],
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
                <?php echo $form->field($letter, 'agree',['template' =>'<label>{input} Согласен(на) на обработку персональных данных в соответствии с <a href="/politika-konfidencialnosti">Политикой конфеденциальности</a></label>{error}' ])->input('checkbox', [
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
