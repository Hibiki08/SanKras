<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$action = Yii::$app->controller->action->id;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <?php echo Html::csrfMetaTags(); ?>
    <?php $this->registerMetaTag([
        'name' => 'description',
        'content' => 'Профессиональный монтаж сантехнических коммуникаций "под ключ" от 450 р/м2 с гарантией до 5 лет'
    ]);
    $this->registerMetaTag([
        'name' => 'keywords',
        'content' => 'монтаж отопления, монтаж канализации, монтаж водоснабжения, проектирование отопления, обустройство скважины'
    ]); ?>
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="/images/system/favicon.png" rel="shortcut icon" type="image/x-icon">
</head>
<body>
<?php $this->beginBody() ?>
<!--start wrapper-->
<div class="wrapper">
    <!--start header-->
    <header id="header">
        <div class="description">
            <div class="width clear">
                <h1>Монтаж отопления, канализации, водоснабжения <span>в Краснодаре</span></h1>
                <div class="address">
                    <img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'address.png'; ?>" alt="адрес" title="адрес">
                    <address><?php echo Yii::$app->system->get('address'); ?></address>
                </div>
            </div>
        </div>
        <div class="header width clear">
            <div class="logo">
                <a href="<?php echo Yii::$app->homeUrl; ?>"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'new-logo.png'; ?>" alt="Логотип" title="лого"></a>
            </div>
            <nav class="menu exo asphalt">
                <ul>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>">Главная</a></li>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('prices'); ?>" <?php if ($action == 'prices') { ?>class="active"<?php } ?>>Цены</a></li>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('works'); ?>" <?php if ($action == 'works') { ?>class="active"<?php } ?>>Наши работы</a></li>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('about'); ?>" <?php if ($action == 'about') { ?>class="active"<?php } ?>>О нас</a></li>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('contacts'); ?>" <?php if ($action == 'contacts') { ?>class="active"<?php } ?>>Контакты</a></li>
                </ul>
            </nav>
            <div class="phone exo" id="phone">
                <?php echo Yii::$app->system->get('phone'); ?>
            </div>
            <button class="pulse exo" id="callback">Заказать звонок</button>
        </div>
    </header>
    <!--end header-->
    <div class="conten-wrapper">
        <?php echo $content; ?>
    </div>
    <!--start footer -->
    <footer class="footer clear">
        <div class="width">
            <div class="links clear">
                    <div class="cell info">
                        <div class="exo">Информация</div>
                        <ul>
                            <li><a href="">О нас</a></li>
                            <li><a href="">Наши работы</a></li>
                            <li><a href="">Отзывы</a></li>
                            <li><a href="">Сертификаты</a></li>
                            <li><a href="">Видео работ</a></li>
                        </ul>
                    </div>
                    <div class="cell usl">
                        <div class="exo">Услуги</div>
                        <ul>
                            <li><a href="">Монтаж отопления</a></li>
                            <li><a href="">Монтаж водоснабжения</a></li>
                            <li><a href="">Монтаж водоотведения</a></li>
                            <li><a href="">Установка санфаянса</a></li>
                            <li><a href="">Обвязка котлов</a></li>
                        </ul>
                    </div>
                    <div class="cell price">
                        <div class="exo">Цены</div>
                        <ul>
                            <li><a href="">Прайс-лист</a></li>
                            <li><a href="">Пакеты услуг</a></li>
                            <li><a href="">Рассчитать стоимость</a></li>
                        </ul>
                    </div>
                    <div class="cell soc">
                        <a href="" class="ok"></a>
                        <a href="" class="vk"></a>
                        <a href="" class="facebook"></a>
                        <a href="" class="youtube"></a>
                    </div>
            </div>
            <div class="cont clear">
                <div>
                    <div class="exo">Контакты</div>
                    <div class="phone-number"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'phone-letter.png'; ?>" alt="Телефон"><?php echo Yii::$app->system->get('phone'); ?></div>
                    <div class="skype"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'skype-letter.png'; ?>" alt="Skype"><?php echo Yii::$app->system->get('skype'); ?></div>
                    <div class="email"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'mail-letter.png'; ?>" alt="Email"><a href="mailto:<?php echo Yii::$app->system->get('email'); ?>"><?php echo Yii::$app->system->get('email'); ?></a></div>
                    <div class="time-work"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'work-letter.png'; ?>" alt="Режим работы">ежедневно с 8:00 до 21:00</div>
                    <div class="address"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'addres-blue.png'; ?>" alt="Адрес"><?php echo Yii::$app->system->get('address'); ?></div>
                </div>
            </div>
            <div class="sub-footer clear">
                <div class="sub clear">
                    <div class="metrika">
                        <!-- Yandex.Metrika informer -->
                        <a href="https://metrika.yandex.ru/stat/?id=39483720&amp;from=informer"
                           target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/39483720/3_0_607B99FF_405B79FF_1_pageviews"
                                                               style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="39483720" data-lang="ru" /></a>
                        <!-- /Yandex.Metrika informer -->
                    </div>
                    <div class="copy">© 2016 «SanKras»</div>
                    <div class="conf"><a href="">Политика конфиденциальности</a></div>
                </div>
                <div class="codedex clear">
                    <div class="width">
                        <div class="site"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'code-dex.png'; ?>" alt=""><a href="https://vk.com/thishibiki" target="_blank">Разработка сайта</a></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--end footer -->
</div>
<!-- end content-wrapper -->
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter39483720 = new Ya.Metrika({
                    id:39483720,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/39483720" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



