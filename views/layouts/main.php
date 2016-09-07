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
<div class="wrapper <?php echo $action == 'index' ? 'bg' : ''; ?>">
    <!--start header-->
    <header id="header">
        <div class="header width clear">
            <div class="logo">
                <a href="<?php echo Yii::$app->homeUrl; ?>"><img src="/images/system/logo.png" alt="Логотип" title="лого"></a>
            </div>
            <div class="description">
                <h1><span>Монтаж отопления, канализации,<br></span> водоснабжения <span>в Краснодаре</span></h1>
            </div>
            <!--<nav id="main" class="menu" style="display: block;">
               <ul>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>">Главная</a></li>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('prices'); ?>" <?php if ($action == 'prices') { ?>class="active"<?php } ?>>Цены</a></li>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('about'); ?>" <?php if ($action == 'about') { ?>class="active"<?php } ?>>О нас</a></li>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('contacts'); ?>" <?php if ($action == 'contacts') { ?>class="active"<?php } ?>>Контакты</a></li>
                </ul>
            </nav>-->
            <div class="phone" id="phone">
                +7 <span class="red">(918)</span> 684 79 99
            </div>
            <button class="pulse" id="callback">Заказать звонок</button>
        </div>
    </header>
    <!--end header-->
    <div class="conten-wrapper">
        <?php echo $content; ?>
    </div>
    <!--start footer -->
    <footer class="footer">
        <div class="width clear">
            <div class="metrika">
                <!-- Yandex.Metrika informer -->
                <a href="https://metrika.yandex.ru/stat/?id=39483720&amp;from=informer"
                   target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/39483720/3_0_FFFFFFFF_EFEFEFFF_0_pageviews"
                                                       style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="39483720" data-lang="ru" /></a>
                <!-- /Yandex.Metrika informer -->
            </div>
            <div class="site"><a href="https://vk.com/thishibiki" target="_blank">Разработка сайта</a></div>
            <div>© 2016 «SanKras»</div>
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
                    accurateTrackBounce:true
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



