<?php
use app\components\SliderTop;
use app\components\SliderBottom;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\Works;

$this->title = 'СанКрас – сантехнические работы и услуги сантехника в Краснодаре';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Компания СанКрас выполняет сантехнические работы любой сложности в Краснодарском крае и Адыгее. Бесплатный вызов сантехника на замеры: 8 (861) 203-51-06. Звоните!'
]);
    $this->registerMetaTag([
        'name' => 'keywords',
        'content' => 'услуги сантехника, краснодар, сантехнические работы, вызов сантехника на дом'
    ]);
?>
<div id="advice">
    <div class="width clear">
        <div class="form asphalt">
            <div class="close"></div>
            <div class="loading"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>spinner4.gif" alt="loading"></div>
            <span class="exo">получите <span class="exo"><span class="hidden">бесплатную</span> консультацию</span><span class="hidden"> от мастера</span></span>
            <?php $form = ActiveForm::begin([
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'options' => [
                    'id' => 'form_advice',
                ]
            ]);?>
            <?php echo $form->field($letter, 'name', [
                'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'main-name.png' . '" alt="ваше имя" title="ваше имя">{input}{error}</div>',
            ])->input('text', [
                'class' => 'focus',
                'placeholder' => 'Ваше имя*'
            ]); ?>
            <?php echo $form->field($letter, 'phone', [
                'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-phone-grey.png' . '" alt="ваш телефон" title="ваш телефон">{input}{error}</div>',
            ])->input('text', [
                'class' => 'phone-mask',
                'placeholder' => 'Ваш телефон*'
            ]); ?>
            <?php echo $form->field($letter, 'agree',['template' =>'<label>{input} Согласен(на) на обработку персональных данных в соответствии с <a href="/politika-konfidencialnosti">Политикой конфеденциальности</a></label>{error}' ])->input('checkbox', [
                            'value' => '1',
                            'checked' => 'checked',
                            'class' => '_argee'
                        ]); ?>
            <?php echo Html::submitButton('заказать консультацию', ['class' => 'pulse']); ?>
            <span>*ваши данные не будут переданы 3-им лицам</span>
            <?php ActiveForm::end(); ?>
            <div class="success">
                <span class="exo">Спасибо за заявку!</span><br>
                <span>Мастер перезвонит вам<br>в течение 15 минут и<br>проконсультирует по всем<br>интересующим вопросам.</span>
            </div>
        </div>
    </div>
</div>
<?php echo SliderTop::widget(); ?>
<section class="key">
    <div class="width">
        <h3 class="title-big">что включает в себя система «ПОД КЛЮЧ»?</h3>
        <span class="asphalt">Мы производим сантехнические работы "под ключ" в квартирах, частных домах<br>и сотрудничаем с застройщиками частного сектора</span>
        <div class="services clear">
            <div class="service flat">
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>key-flat.png" alt="квартира">
                <div class="exo title">Монтаж в квартире:</div>
                <ul>
                    <li>Консультирование, cоставление сметы</li>
                    <li>Закупка и доставка материала</li>
                    <li>Прокладка труб водоснабжения</li>
                    <li>Установка санфаянса</li>
                    <li>Установка бытовой техники</li>
                    <li>Ввод в эксплуатацию</li>
                    <li>Запуск и наладка всей системы</li>
                    <li>Предоставление гарантии</li>
                </ul>
                <a href="<?php echo Yii::$app->urlManager->createUrl('montazh-v-kvartire'); ?>" class="exo">Подробнее</a>
            </div>
            <div class="service house">
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>key-house.png" alt="дом">
                <div class="exo title">Монтаж в частном доме:</div>
                <ul>
                    <li>Расчет теплопотерь здания, схема проекта</li>
                    <li>Составление сметы, доставка материала</li>
                    <li>Обвязка котельной, теплые полы</li>
                    <li>Обвязка скважины, фильтрация</li>
                    <li>Прокладка канализации, установка септика</li>
                    <li>Установка санфаянса, бытовой техники</li>
                    <li>Ввод в эксплуатацию, запуск и наладка всей системы</li>
                    <li>Предоставление гарантии</li>
                </ul>
                <a href="<?php echo Yii::$app->urlManager->createUrl('montazh-v-chastnom-dome'); ?>" class="exo">Подробнее</a>
            </div>
            <div class="service company">
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>key-company.png" alt="застройщики">
                <div class="exo title">Застройщикам:</div>
                <ul>
                    <li>Высокие скидки на материал от поставщиков оборудования</li>
                    <li>Дополнительные скидки при большом объёме</li>
                    <li>Монтаж в короткие сроки</li>
                    <li>Бесплатная доставка материала на объект</li>
                    <li>Гарантия на выполненные работы</li>
                    <li>Любая сложность заказа</li>
                </ul>
                <a href="<?php echo Yii::$app->urlManager->createUrl('zastroyshchikam'); ?>" class="exo">Подробнее</a>
            </div>
        </div>
    </div>
</section>
<section class="quality" id="better">
    <h3 class="title-small">Вы получаете надежную <span class="title-big">долговечную</span> систему,<br>потому что мы ответственно подходим к делу</h3>
    <div class="grey"></div>
    <div class="columns clear width">
        <div class="col wow zoomIn">
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>better-1.png" alt="гарантия" title="гарантия">
            <h3><span>гарантия</span><br>от 1 года до 5 лет на работы</h3>
            <div>В течение гарантийного срока мы <strong>бесплатно</strong> устраним возможные неисправности. Однако мы уверены в высоком качестве нашей работы, потому что она <span style="letter-spacing: -1px">выполняется квалифицированными специалистами с использованием надежных материалов.</span></div>
        </div>
        <div class="col wow zoomIn" data-wow-delay="0.3s">
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>better-2.png" alt="отношение" title="отношение">
            <h3><span>Несколько решений</span><br>на выбор с учётом бюджета</h3>
            <div>С учетом всех ваших потребностей мы составляем <strong>несколько оптимальных решений</strong>, из которых вы выбираете наиболее подходящее по соотношению цены и качества. Также мы предлагаем бесплатную доставку и скидку на материал в размере 10%.</div>
        </div>
        <div class="col wow zoomIn" data-wow-delay="0.6s">
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>better-3.png" alt="поддержка" title="поддержка">
            <h3><span>обслуживание</span><br>во время эксплуатации</h3>
            <div>После завершения работ мы не прекращаем сотрудничество с вами. По всем вопросам, возникающим в ходе эксплуатации системы, мы предоставляем консультацию, <strong>помогаем в настройке оборудования</strong> и при необходимости <strong>проводим профилактику системы</strong>.</div>
        </div>
        <div class="col wow zoomIn" data-wow-delay="0.9s">
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>better-4.png" alt="материалы" title="материалы">
            <h3><span>материалы</span><br>известных производителей</h3>
            <div>Мы работаем с производителями материалов и оборудования, зарекомендовавшими себя на рынке сантехнических услуг и имеющими <strong>сертификат качества</strong> и гарантию. Это такие бренды, как: Rehau, FAR, Frankische, Oventrop, Ostendorf, Wolf, Vogel & Noot, Viessmann, Fondital, Meibes и другие.</div>
        </div>
    </div>
</section>
<section class="simple" id="discount">
    <div class="width">
        <h3 class="title-big">С нами выгодно и легко работать</h3>
        <div class="smpl">Вы сэкономите на сантехнических услугах минимум 22% за счет наших скидок</div>
        <div class="sml-col clear">
            <div class="sub-col">
                <div class="col" data-wow-delay="0.1s">
                    <span>скидка на материал</span>
                    <div class="material"></div>
                </div>
                <div class="col" data-wow-delay="0.3s">
                    <span>консультация, составление<br>сметы и доставка материала</span>
                    <div class="advice"></div>
                </div>
                <div class="col wow slideInRight" data-wow-delay="0.1s">
                    <span>опыт работы в сфере<br>сантехнических услуг</span>
                    <div class="experience"></div>
                </div>
                <div class="col wow slideInRight" data-wow-delay="0.2s">
                    <span>крупных объектов<br>за последний год</span>
                    <div class="years"></div>
                </div>
            </div>
            <div class="sub-col">
                <div class="col" data-wow-delay="0.2s">
                    <div class="installation"></div>
                    <span> скидка на монтаж<br>для постоянных клиентов</span>
                </div>
                <div class="col" data-wow-delay="0.4s">
                    <div class="present"></div>
                    <span>проект котельной в подарок<br>при заказе системы отопления</span>
                </div>
                <div class="col wow slideInRight" data-wow-delay="0.3s">
                    <div class="guarantee"></div>
                    <span>гарантии на наши<br>услуги</span>
                </div>
                <div class="col wow slideInRight" data-wow-delay="0.4s">
                    <div class="time"></div>
                    <span>составление сметы в течении<br>суток с момента обращения</span>
                </div>
            </div>
        </div>
        <div class="card" id="card">
            <div class="title-big">Получите дисконтную карту</div>
            <div class="form">
                <div class="loading"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>spinner4.gif" alt="loading"></div>
                <div class="close"></div>
                <span><span>Просто введите свой e-mail</span><br>и получите скидку 12% на монтаж<br>и 10% на материал</span>
                <?php $form = ActiveForm::begin([
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
                    'options' => [
                        'id' => 'form_discount',
                    ]
                ]);?>
                <?php echo $form->field($letter, 'email', [
                    'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'card-email.png' . '" alt="email" title="email">{input}{error}</div>',
                ])->input('email', [
                    'class' => 'focus',
                    'placeholder' => 'Ваш e-mail*'
                ]); ?>
                <?php echo $form->field($letter, 'agree',['template' =>'<label>{input} Согласен(на) на обработку персональных данных в соответствии с <a href="/politika-konfidencialnosti">Политикой конфеденциальности</a></label>{error}' ])->input('checkbox', [
                            'value' => '1',
                            'checked' => 'checked',
                            'class' => '_argee'
                        ]); ?>
                <?php echo Html::submitButton('получить скидку', ['class' => 'pulse']); ?>
                <?php ActiveForm::end(); ?>
                <div class="success">
                    <span>Спасибо за заявку!</span><br>
                    <span>Вы закрепили за собой скидку!<br>В течение 5 минут вам на почту<br>придет бланк на получение<br>дисконтной карты и скидки</span>
                </div>
            </div>
            <span>*ваши данные не будут переданы третьим лицам; акция действует с 01.<?php echo $date_card_from; ?> по 20.<?php echo $date_card_to; ?></span>
        </div>
    </div>
</section>
<section class="how-work">
    <h3 class="title-small">Простая схема сотрудничества</h3>
    <div class="how clear width">
        <figure>
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>main-how-1.png" alt="Звонок и консультация" title="звонок на консультацию">
            <figcaption>Заявка с сайта, звонок и<br>консультация</figcaption>
        </figure>
        <figure class="red-arrow">
            <img class="wow fadeInLeft" src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>main-how-arrow.png" alt="следующий шаг" title="следующий шаг">
        </figure>
        <figure>
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>main-how-2.png" alt="Встреча и подбор оптимального решения" title="Встреча и подбор оптимального решения">
            <figcaption>Осмотр объекта, подбор<br>решения, составление<br>нескольких смет</figcaption>
        </figure>
        <figure class="red-arrow">
            <img class="wow fadeInLeft" data-wow-delay="0.2s" src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>main-how-arrow.png" alt="следующий шаг" title="следующий шаг">
        </figure>
        <figure>
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>main-how-5.png" alt="Закупка материала и доставка">
            <figcaption>Закупка материала и доставка</figcaption>
        </figure>
        <figure class="red-arrow">
            <img class="wow fadeInLeft" data-wow-delay="0.4s" src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>main-how-arrow.png" alt="следующий шаг" title="следующий шаг">
        </figure>
        <figure>
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>main-how-3.png" alt="Монтаж с учётом ваших потребностей" title="Монтаж">
            <figcaption>Монтаж с учётом ваших потребностей</figcaption>
        </figure>
        <figure class="red-arrow">
            <img class="wow fadeInLeft" data-wow-delay="0.6s" src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>main-how-arrow.png" alt="следующий шаг" title="следующий шаг">
        </figure>
        <figure>
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>main-how-4.png" alt="Введение в эксплуатацию и обслуживание" title="Введение в эксплуатацию">
            <figcaption>Введение в эксплуатацию и обслуживание</figcaption>
        </figure>
    </div>
</section>
<?php echo Works::widget(); ?>
<section class="reviews" id="reviews">
    <div class="width">
        <h2 class="title-big">отзывы наших клиентов</h2>
        <div class="review wow bounceInLeft">
            <div class="block">
                <img src="<?php echo Yii::$app->params['params']['pathToImage'] . 'system/review-1.png'; ?>" alt="монтаж водоснабжения отзыв" title="отзыв">
                <div class="text">
                    <span><span class="red"><!--noindex--><a href="http://сам-себе-электростанция.рф/" rel="nofollow" target="_blank">Николай Дрига</a><!--/noindex-->,</span> предприниматель и владелец дома<br>с полным автономным энергообеспечением</span>
                    <p>Когда я впервые увидел с какой аккуратностью Артем подходит к решению технических вопросов при монтаже систем отопления и водоснабжения, сразу понял — наш человек! :)  Заказчику всегда предлагается выбор из нескольких вариантов с описанием всех плюсов и минусов каждого, соответственно, человек может делать осознанный выбор в соответствии с индивидуальными особенностями и возможностями.</p>
                </div>
            </div>
            <blockquote><span>З</span>аказчику всегда предлагается выбор из нескольких вариантов с описанием плюсов и минусов каждого</blockquote>
        </div>
        <div class="review rw-2 wow bounceInRight">
            <blockquote><span>Р</span>аботы ведутся по проекту, ребята имеют весь необходимый инструмент, работают в защитной экипировке, быстро решают организационные вопросы</blockquote>
            <div class="block">
                <img data-wow-delay="0.4s" src="<?php echo Yii::$app->params['params']['pathToImage'] . 'system/review-2.png'; ?>" alt="монтаж водоснабжения отзыв" title="отзыв">
                <div class="text">
                    <span><span class="red">Роман,</span> руководитель строительной фирмы "Краснодарский дизайн-салон"</span>
                    <p>Долгое время я искал специалиста по сантехнике, на которого можно положиться. Надоедало постоянно перепроверять за мастером и тратить время на то, чтобы держать все под контролем. С Артемом познакомился на одном из объектов. Сразу понравилось как он подходит к монтажу: работы ведутся по проекту, ребята имеют весь необходимый инструмент, работают в защитной экипировке, быстро решают возникающие организационные вопросы. По привычке я все перепроверял, но быстро понял что в этом нет необходимости, возникло доверие и желание сотрудничать. Совместно мы выполнили несколько десятков объектов, за это время ни разу не были сорваны сроки, претензий от заказчиков не поступало.</p>
                </div>
            </div>
        </div>
        <div class="other">
            <a href="<?php echo Yii::$app->urlManager->createUrl('otzyvy'); ?>" class="button">Посмотреть все отзывы</a>
            <a href="<?php echo Yii::$app->urlManager->createUrl('otzyvy'); ?>" class="button">Оставить отзыв</a>
        </div>
    </div>
</section>
<section class="call-master" id="call-master">
    <h2 class="title-big">закажите бесплатный вызов сантехника на замер</h2>
    <div class="master width">
        <figure>
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>call-master.png" alt="вызвать мастера" title="вызвать мастера">
        </figure>
        <div class="call clear">
            <div class="about">
                <div class="master-title">закажите вызов сантехника и получите:</div>
                <ul>
                    <li>консультацию и рекомендации мастера</li>
                    <li>эскизный проект</li>
                    <li>две сметы стоимости: на работы, на материал</li>
                </ul>
                <h3>Сантехнические услуги<br>любой сложности:</h3>
                <ul>
                    <li>отопление</li>
                    <li>водоснабжение</li>
                    <li>водоотведение</li>
                    <li>установка санфаянса</li>
                    <li>автополив</li>
                </ul>
            </div>
            <div class="form">
                <div class="close"></div>
                <div class="loading"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>spinner4.gif" alt="loading"></div>
                <span>вызов сантехника</span>
                <?php $form = ActiveForm::begin([
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
                    'options' => [
                        'id' => 'form_call_master',
                    ]
                ]);?>
                <?php echo $form->field($letter, 'name', [
                    'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'main-name.png' . '" alt="Ваше имя" title="Ваше имя">{input}{error}</div>',
                ])->input('text', [
                    'class' => 'focus',
                    'placeholder' => 'Ваше имя*'
                ]); ?>
                <?php echo $form->field($letter, 'phone', [
                    'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'main-tel.png' . '" alt="Ваш телефон" title="Ваш телефон">{input}{error}</div>',
                ])->input('text', [
                    'class' => 'phone-mask',
                    'placeholder' => 'Ваш телефон*'
                ]); ?>
                <?php echo $form->field($letter, 'agree',['template' =>'<label>{input} Согласен(на) на обработку персональных данных в соответствии с <a href="/politika-konfidencialnosti">Политикой конфеденциальности</a></label>{error}' ])->input('checkbox', [
                            'value' => '1',
                            'checked' => 'checked',
                            'class' => '_argee'
                        ]); ?>
                <?php echo Html::submitButton('оставить заявку', ['class' => 'pulse']); ?>
                <?php ActiveForm::end(); ?>
                <span>*обязательные поля <br>данные не будут переданы 3-им лицам</span>
                <div class="success">
                    <span>Спасибо за заявку!</span><br>
                    <span>Мы перезвоним вам в<br>течение 15 минут для<br>уточнения деталей<br>встречи</span>
                </div>
            </div>
        </div>
        <div class="benefit">
            <div class="bf-1 wow bounceInLeft">
                <div>
                    <span>бесплатно</span><br>
                    <span>Вызов сантехника не обязывает вас<br>к дальнейшему сотрудничеству</span>
                </div>
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>master-free.png" alt="бесплатно" title="бесплатно">
            </div>
            <div class="bf-2 wow bounceInRight">
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>master-fast.png" alt="быстро" title="быстро">
                <div>
                    <span>быстро</span><br>
                    <span>Получите точную стоимость<br>в течение 48 часов</span>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="cooperate">
    <h3 class="title-small">Мы сотрудничаем:</h3>
    <div class="width">
        <?php echo SliderBottom::widget(); ?>
    </div>
</section>
<?php
if (!empty($seoBottom)) { ?>
    <section class="seo" id="seo">
        <div class="width">
            <h2><?php echo $seoBottom->title; ?></h2>
            <div class="short">
                <?php echo $seoBottom->short_text; ?>
            </div>
            <div class="full">
                <?php echo $seoBottom->full_text; ?>
            </div>
            <div class="more">
                <fieldset>
                    <legend>
                        <span class="legend-inner">
                            <span class="legend-left"></span>
                            <span class="legend-content">Развернуть</span>
                            <span class="legend-right"></span>
                        </span>
                    </legend>
                </fieldset>
            </div>
        </div>
    </section>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.slider').HbKSlider({
            sliderSize: 1,
            autoPlay: false,
            overStop: true,
            navigationArrows: true,
            navigationRadioButtons: true,
            sliderSpeed: 5500,
            animation: 'fade'
        });
        $('.coop').HbKSlider({
            sliderSize: 4,
            autoPlay: true,
            overStop: true,
            navigationArrows: true,
            sliderSpeed: 5500,
            animation: 'carousel'
        });
    });
</script>