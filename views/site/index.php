<?php
use app\components\SliderTop;
use app\components\SliderBottom;
use app\models\Works;

$this->title = 'Монтаж отопления, водоснабжения, канализации, котельных, обустройство скважины в Краснодаре';
?>
<div id="advice">
    <div class="width clear">
        <div class="form asphalt">
            <div class="close"></div>
            <div class="loading"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>spinner4.gif" alt="loading"></div>
            <span class="exo">получите<br><span class="exo">бесплатную консультацию</span><br>от мастера</span>
            <div class="field">
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>main-name.png" alt="ваше имя" title="ваше имя">
                <input type="text" name="name" placeholder="Ваше имя*" class="focus" required><br>
                <input type="hidden" value="Ваше имя*" name="hide-name" class="hidden">
            </div>
            <div class="field">
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>callback-phone-grey.png" alt="ваше телефон" title="ваше телефон">
                <input type="text" placeholder="Ваш телефон*" name="phone" class="phone-mask" required><br>
            </div>
            <button class="pulse">заказать консультацию</button><br>
            <span>*ваши данные не будут переданы 3-им лицам</span>
            <div class="success">
                <span class="exo">Спасибо за заявку!</span><br>
                <span>Мастер перезвонит Вам<br>в течение 15 минут и<br>проконсультирует по всем<br>интересующим вопросам.</span>
            </div>
        </div>
    </div>
</div>
<?php echo SliderTop::widget(); ?>
<section class="key">
    <div class="width">
        <h3 class="title-big">что включает в себя система «ПОД КЛЮЧ»?</h3>
        <span class="asphalt">Мы производим монтаж инженерных сантехнических сетей "под ключ" в квартирах, частных домах<br>и сотрудничаем с застройщиками частного сектора</span>
        <div class="services clear">
            <div class="service flat">
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>key-flat.png" alt="квартира">
                <div class="exo title">Монтаж в квартире:</div>
                <ul>
                    <li>Консультирование, cоставление сметы</li>
                    <li>Закупка и доставка материала</li>
                    <li>Монтаж труб водоснабжения</li>
                    <li>Установка санфаянса</li>
                    <li>Установка бытовой техники</li>
                    <li>Ввод в эксплуатацию</li>
                    <li>Запуск и наладка всей системы</li>
                    <li>Предоставление гарантии</li>
                </ul>
                <a href="<?php echo Yii::$app->urlManager->createUrl('flat'); ?>" class="exo">Подробнее</a>
            </div>
            <div class="service house">
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>key-house.png" alt="дом">
                <div class="exo title">Монтаж в частном доме:</div>
                <ul>
                    <li>Расчет теплопотерь здания, схема проекта</li>
                    <li>Составление сметы, доставка материала</li>
                    <li>Обвязка котельной, теплые полы</li>
                    <li>Обвязка скважины, фильтрация</li>
                    <li>Монтаж канализации, установка септика</li>
                    <li>Установка санфаянса, бытовой техники</li>
                    <li>Ввод в эксплуатацию, запуск и наладка всей системы</li>
                    <li>Предоставление гарантии</li>
                </ul>
                <a href="<?php echo Yii::$app->urlManager->createUrl('house'); ?>" class="exo">Подробнее</a>
            </div>
            <div class="service company">
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>key-company.png" alt="застройщики">
                <div class="exo title">Застройщикам:</div>
                <ul>
                    <li>Предоставляем высокие скидки на материал, потому что сотрудничаем с поставщиками оборудования</li>
                    <li>Быстро выполняем монтаж по оптимальной цене</li>
                    <li>Доставку материала берем на себя</li>
                    <li>Гарантия на выполненные работы</li>
                    <li>Любая сложность заказа</li>
                </ul>
                <a href="<?php echo Yii::$app->urlManager->createUrl('company'); ?>" class="exo">Подробнее</a>
            </div>
        </div>
    </div>
</section>
<section class="quality" id="better">
    <h3 class="title-small">Вы получаете надежную <span class="title-big">долговечную</span> систему,<br>потому что мы ответственно подходим к работе</h3>
    <div class="grey"></div>
    <div class="columns clear width">
        <div class="col wow zoomIn">
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>better-1.png" alt="гарантия" title="гарантия">
            <h3><span>гарантия</span><br>от 1 года до 5 лет на работы</h3>
            <div>В течение гарантийного срока мы <strong>бесплатно устраним неисправности</strong> монтажа. Мы уверены в высоком качестве нашей работы, потому что она <span style="letter-spacing: -1px">выполняется квалифицированными специалистами</span> с использованием надежных материалов.</div>
        </div>
        <div class="col wow zoomIn" data-wow-delay="0.3s">
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>better-2.png" alt="отношение" title="отношение">
            <h3><span>Несколько решений</span><br>на выбор с учётом бюджета</h3>
            <div>С учетом всех Ваших потребностей мы составляем <strong>несколько оптимальных решений</strong>, из которых Вы выбираете наиболее подходящее по соотношению цены и качества. Также предлагаем  скидку 10% на материал и бесплатную доставку.</div>
        </div>
        <div class="col wow zoomIn" data-wow-delay="0.6s">
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>better-3.png" alt="поддержка" title="поддержка">
            <h3><span>обслуживание</span><br>во время эксплуатации</h3>
            <div>После проведения монтажа мы не прекращаем сотрудничество с Вами. По всем вопросам, возникающим в ходе эксплуатации системы, мы предоставляем консультацию, <strong>помогаем в настройке оборудования</strong> и при необходимости <strong>проводим профилактику системы</strong>.</div>
        </div>
        <div class="col wow zoomIn" data-wow-delay="0.9s">
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>better-4.png" alt="материалы" title="материалы">
            <h3><span>материалы</span><br>известных производителей</h3>
            <div>Мы работаем с производителями материалов и оборудования, зарекомендовавших себя на рынке сантехнических услуг и имеющих <strong>сертификат качества</strong> и гарантию. Это такие бренды, как: Rehau, FAR, Frankische, APE, Oventrop, Ostendorf, Caleffi, FIV, KAN, Wolf, Vogel & Noot, Viessmann, Protherm, Fondital, Meibes.</div>
        </div>
    </div>
</section>
<section class="simple" id="discount">
    <div class="width">
        <h3 class="title-big">С нами выгодно и легко работать</h3>
        <div class="smpl">Вы сэкономите на сантехнических коммуникациях минимум 22% за счет наших скидок</div>
        <div class="sml-col clear">
            <div class="sub-col">
                <div class="col" data-wow-delay="0.1s">
                    <span>скидка на материал</span>
                    <div class="material"></div>
                </div>
                <div class="col" data-wow-delay="0.2s">
                    <span> скидка на монтаж<br>для постоянных клиентов</span>
                    <div class="installation"></div>
                </div>
                <div class="col" data-wow-delay="0.3s">
                    <span>консультация, составление<br>сметы и доставка материала</span>
                    <div class="advice"></div>
                </div>
                <div class="col" data-wow-delay="0.4s">
                    <span>проект котельной в подарок<br>при заказе системы отопления</span>
                    <div></div>
                </div>
            </div>
            <div class="sub-col">
                <div class="col wow slideInRight" data-wow-delay="0.1s">
                    <div class="experience"></div>
                    <span>опыт работы в сфере<br>сантехнических услуг</span>
                </div>
                <div class="col wow slideInRight" data-wow-delay="0.2s">
                    <div class="years"></div>
                    <span>крупных объектов<br>за последний год</span>
                </div>
                <div class="col wow slideInRight" data-wow-delay="0.3s">
                    <div class="guarantee"></div>
                    <span>гарантии на наши<br>работы</span>
                </div>
                <div class="col wow slideInRight" data-wow-delay="0.4s">
                    <div class="time"></div>
                    <span>составление сметы в течении<br>суток с момента обращения</span>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="title-big">Получите дисконтную карту</div>
            <div class="form">
                <div class="loading"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>spinner4.gif" alt="loading"></div>
                <div class="close"></div>
                <span><span>Просто введите свой e-mail</span><br>и получите скидку 12% на монтаж<br>и 10% на материал</span>
                <div class="field">
                    <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>card-email.png" alt="email" title="email">
                    <input name="email" type="email" placeholder="Ваш e-mail*" class="focus" required><br>
                    <button class="pulse">получить скидку</button>
                </div>
                <div class="success">
                    <span>Спасибо за заявку!</span><br>
                    <span>Вы закрепили за собой скидку!<br>В течение 5 минут Вам на почту<br>придет бланк на получение<br>дисконтной карты и скидки</span>
                </div>
            </div>
            <span>*ваши данные не будут переданы третьим лицам; акция действует с 07.10.2016 по 31.12.2016</span>
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
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>main-how-3.png" alt="Монтаж с учётом Ваших потребностей" title="Монтаж">
            <figcaption>Монтаж с учётом Ваших потребностей</figcaption>
        </figure>
        <figure class="red-arrow">
            <img class="wow fadeInLeft" data-wow-delay="0.6s" src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>main-how-arrow.png" alt="следующий шаг" title="следующий шаг">
        </figure>
        <figure id="call-master">
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>main-how-4.png" alt="Введение в эксплуатацию и обслуживание" title="Введение в эксплуатацию">
            <figcaption>Введение в эксплуатацию и обслуживание</figcaption>
        </figure>
    </div>
</section>
<section id="our-works">
    <div class="width">
        <h4 class="title-big">Наши работы</h4>
        <div class="w1 clear">
            <?php if (!empty($works)) { ?>
                <?php foreach ($works as $work) {?>
                    <a href="<?php echo Yii::$app->urlManager->createUrl(['works/single', 'id' => $work->id]); ?>">
                        <div class="work">
                            <img src="<?php echo Yii::$app->params['params']['pathToImage'] . Works::IMG_FOLDER . '/work(' . $work->id . ')/prev_' . $work->preview; ?>">
                            <div class="work-title exo"><?php echo $work->title; ?></div>
                            <div class="hover">
                                <div class="hover-title exo"><?php echo $work->title; ?></div>
                                <?php $items = explode(",\n", $work->preview_items); ?>
                                <ul>
                                    <li><?php echo implode('</li><li>', $items); ?></li>
                                </ul>
                                <div class="more red exo">Посмотреть работу</div>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="other">
            <a href="<?php echo Yii::$app->urlManager->createUrl('works/'); ?>" class="button">Посмотреть все работы</a>
        </div>
    </div>
</section>
<section class="reviews" id="reviews">
    <div class="width">
        <h2 class="title-big">отзывы наших клиентов</h2>
        <div class="review wow bounceInLeft">
            <div class="block">
                <img src="<?php echo Yii::$app->params['params']['pathToImage'] . 'system/review-1.png'; ?>" alt="монтаж водоснабжения отзыв" title="отзыв">
                <div class="text">
                    <span><span class="red"><a href="http://сам-себе-электростанция.рф/" target="_blank">Николай Дрига</a>,</span> предприниматель и владелец дома<br>с полным автономным энергообеспечением</span>
                    <p>Когда я впервые увидел с какой аккуратностью Артем подходит к решению технических вопросов при монтаже систем отопления и водоснабжения, сразу понял — наш человек! :)  Заказчику всегда предлагается выбор из нескольких вариантов с описанием всех плюсов и минусов каждого, соответственно, человек может делать осознанный выбор в соответствии с индивидуальными особенностями и возможностями.</p>
                </div>
            </div>
            <blockquote>Заказчику всегда предлагается выбор из нескольких вариантов с описанием плюсов и минусов каждого</blockquote>
        </div>
        <div class="review rw-2 wow bounceInRight">
            <blockquote>Работы ведутся по проекту, ребята имеют весь необходимый инструмент, работают в защитной экипировке, быстро решают организационные вопросы</blockquote>
            <div class="block">
                <img data-wow-delay="0.4s" src="<?php echo Yii::$app->params['params']['pathToImage'] . 'system/review-2.png'; ?>" alt="монтаж водоснабжения отзыв" title="отзыв">
                <div class="text">
                    <span><span class="red">Роман,</span> руководитель строительной фирмы "Краснодарский дизайн-салон"</span>
                    <p>Долгое время я искал специалиста по сантехнике, на которого можно положиться. Надоедало постоянно перепроверять работу и тратить время на то, чтобы держать все под контролем. С Артемом познакомился на одном из объектов. Сразу понравилось как он подходит к монтажу: работы ведутся по проекту, ребята имеют весь необходимый инструмент, работают в защитной экипировке, быстро решают возникающие организационные вопросы. По привычке я все перепроверял, но быстро понял что в этом нет необходимости, возникло доверие и желание сотрудничать. Совместно мы выполнили несколько десятков объектов, за это время ни разу не были сорваны сроки, претензий от заказчиков не поступало.</p>
                </div>
            </div>
        </div>
        <div class="other">
            <a href="<?php echo Yii::$app->urlManager->createUrl('about/opinions'); ?>" class="button">Посмотреть все отзывы</a>
        </div>
    </div>
</section>
<section class="call-master">
    <h2 class="title-big">закажите бесплатный выезд мастера на замер</h2>
    <div class="master width">
        <figure>
            <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>call-master.png" alt="вызвать мастера" title="вызвать мастера">
        </figure>
        <div class="call clear">
            <div class="about">
                <div class="master-title">закажите выезд мастера и получите:</div>
                <ul>
                    <li>консультацию и рекомендации мастера</li>
                    <li>эскизный проект</li>
                    <li>две сметы стоимости: на монтаж и материал</li>
                </ul>
                <h3>Монтаж сантехнических<br>коммуникаций любой сложности:</h3>
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
                <span>выезд мастера</span>
                <div class="field">
                    <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>main-name.png" alt="ваше имя" title="ваше имя">
                    <input type="text" name="name" placeholder="Ваше имя*" class="focus" required><br>
                </div>
                <div class="field">
                    <img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>main-tel.png" alt="ваш телефон" title="ваше телефон">
                    <input type="text" placeholder="Ваш телефон*" name="phone" class="phone-mask" required><br>
                    <button class="pulse">заказать выезд</button>
                </div>
                <span>*обязательные поля <br>данные не будут переданы 3-им лицам</span>
                <div class="success">
                    <span>Спасибо за заявку!</span><br>
                    <span>Мы перезвоним Вам в<br>течение 15 минут для<br>уточнения деталей<br>встречи</span>
                </div>
            </div>
        </div>
        <div class="benefit">
            <div class="bf-1 wow bounceInLeft">
                <div>
                    <span>бесплатно</span><br>
                    <span>Вызов мастера не обязывает Вас<br>к дальнейшему сотрудничеству</span>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('.slider').HbKSlider({
            sliderSize: 1,
            autoPlay: true,
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