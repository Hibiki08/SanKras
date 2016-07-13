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
<html>
<head lang="en">
    <meta charset="UTF-8">
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <?php echo Html::csrfMetaTags() ?>
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
</head>
<body>
<?php $this->beginBody() ?>
<!--start wrapper-->
<div class="wrapper">
    <!--start header-->
    <header id="header">
        <div class="header width">
            <div class="logo">
                <a href="<?php echo Yii::$app->homeUrl; ?>"><img src="/images/system/logo.png" alt="Логотип"></a>
            </div>
            <div class="description">
                Монтаж отопления, канализации, водоснабжения <span>в Краснодаре</span>
            </div>
            <div id="menu">
                <div id="hidden-menu" onclick="menuBlock()">
                    <div class="ico">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="word">Меню</div>
                    <div class="arrow"></div>
                </div>
                <div id="menu">
                    <div id="hidden-menu" onclick="menuBlock()">
                        <div class="ico">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="word">Меню</div>
                        <div class="arrow"></div>
                    </div>
                    <nav id="main" class="menu" style="display: block;">
                        <ul>
                            <li><a href="<?php echo Yii::$app->homeUrl; ?>">Главная</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('prices'); ?>" <?php if ($action == 'prices') { ?>class="active"<?php } ?>>Цены</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('about'); ?>" <?php if ($action == 'about') { ?>class="active"<?php } ?>>О нас</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('contacts'); ?>" <?php if ($action == 'contacts') { ?>class="active"<?php } ?>>Контакты</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="phone" id="phone">
                +7 <span>(918)</span> 684 79 99
            </div>
        </div>
        <div class="clear"></div>
    </header>
    <!--end header-->
<?php echo $content; ?>
    <!--start footer -->
    <div class="footer">
        <div class="width">
            <div class="links information">
                <h3>Информация</h3>
                <nav>
                    <ul>
                        <li><a href="<?php echo Yii::$app->homeUrl; ?>">SanKras</a></li>
                        <li><a href="http://#">Приглашаем к сотрудничеству</a></li>
                        <li><a href="http://#">Сертификаты</a></li>
                        <li><a href="http://#">Наши работы</a></li>
                        <li><a href="http://#">Отзывы</a></li>
                    </ul>
                </nav>
            </div>
            <div class="links options">
                <h3>Услуги</h3>
                <nav>
                    <ul>
                        <li><a href="http://#">Установка санфаянса</a></li>
                        <li><a href="http://#">Подключение бытовой техники</a></li>
                        <li><a href="http://#">Монтаж водоснабжения</a></li>
                        <li><a href="http://#">Установка счётчиков</a></li>
                        <li><a href="http://#">Монтаж отопления</a></li>
                        <li><a href="http://#">Черновые работы</a></li>
                        <li><a href="http://#">Монтаж канализации</a></li>
                        <li><a href="http://#">Обслуживание котлов</a></li>
                        <li><a href="http://#">Ремонт и обслуживание</a></li>
                        <li><a href="http://#">Демонтаж</a></li>
                    </ul>
                </nav>
            </div>
            <div class="links soc">
                <h3>Мы в социальных сетях</h3>
                <figure><a href=""><div></div></a></figure>
                <figure><a href=""><div></div></a></figure>
                <figure><a href=""><div></div></a></figure>
                <figure><a href=""><div></div></a></figure>
                <figure><a href=""><div></div></a></figure>
                <figure><a href=""><div></div></a></figure>
                <figure><a href=""><div></div></a></figure>
                <figure><a href=""><div></div></a></figure>
                <figure><a href=""><div></div></a></figure>
                <figure><a href=""><div></div></a></figure>
            </div>
            <div class="last">
                <div class="metrika">
                    <!-- Yandex.Metrika informer -->
                    <a href="https://metrika.yandex.ru/stat/?id=33225778&amp;from=informer"
                       target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/33225778/3_0_FFFFFFFF_EFEFEFFF_0_pageviews"
                                                           style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:33225778,lang:'ru'});return false}catch(e){}" /></a>
                    <!-- /Yandex.Metrika informer -->
                </div>
                <div class="cop">© 2015 «Sankras»</div>
                <div class="web"><a href="">Разработка сайта</a></div>
            </div>
        </div>
    </div>
    <!--end footer -->
</div>
<!-- end content-wrapper -->
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter33225778 = new Ya.Metrika({
                    id:33225778,
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
<noscript><div><img src="https://mc.yandex.ru/watch/33225778" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



