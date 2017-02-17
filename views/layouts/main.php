<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\forms\BaseForm;

$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
$letter = new BaseForm();

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <?php echo Html::csrfMetaTags(); ?>
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
        <div class="description">
            <div class="width clear">
                <div>Монтаж отопления, канализации, водоснабжения <a href="<?php echo Yii::$app->urlManager->createUrl('contacts'); ?>">в Краснодаре</a></div>
                <a href="<?php echo Yii::$app->urlManager->createUrl('contacts'); ?>" class="address">
                    <img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'address.png'; ?>" alt="адрес" title="адрес">
                    <address><?php echo Yii::$app->system->get('address'); ?></address>
                </a>
            </div>
        </div>
        <div class="header width clear">
            <div class="logo">
                <a href="<?php echo Yii::$app->homeUrl; ?>"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'new-logo.png'; ?>" alt="Логотип" title="лого"></a>
            </div>
            <nav class="menu exo asphalt">
                <ul>
                    <li class="list"><a><div class="img"></div>Услуги</a>
                        <ul class="submenu"><li><a href="<?php echo Yii::$app->urlManager->createUrl('heating'); ?>">Монтаж отопления</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('water-supply'); ?>">Монтаж водоснабжения</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('sewerage'); ?>">Монтаж канализации</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('sanfayans'); ?>">Установка санфаянса</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('automatic-watering'); ?>">Система автополива</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('prices'); ?>" class="<?php echo $controller == 'prices' ? 'active' : $action == 'prices' ? 'active' : ''; ?>">Цены</a></li>
                    <li class="list works"><a href="<?php echo Yii::$app->urlManager->createUrl('works'); ?>" class="<?php echo $controller == 'works' ? 'active' : $action == 'works' ? 'active' : ''; ?>">Наши работы</a>
                        <ul class="submenu"><li><a href="<?php echo Yii::$app->urlManager->createUrl('works/video'); ?>">Видео работ</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl(['works', 'group' => 'house']); ?>">Частные дома</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl(['works', 'group' => 'flat']); ?>">Квартиры</a></li>
                        </ul>
                    </li>
                    <li class="list about"><a href="<?php echo Yii::$app->urlManager->createUrl('about'); ?>" class="<?php echo $controller == 'about' ? 'active' : $action == 'about' ? 'active' : ''; ?>">О нас</a>
                        <ul class="submenu"><li><a href="<?php echo Yii::$app->urlManager->createUrl('about/opinions'); ?>">Отзывы</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('about/news'); ?>">Новости</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('about/articles'); ?>">Статьи</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('contacts'); ?>" class="<?php echo $controller == 'contacts' ? 'active' : $action == 'contacts' ? 'active' : ''; ?>">Контакты</a></li>
                </ul>
            </nav>
            <div class="phone exo" id="phone">
                <?php echo Yii::$app->system->get('phone'); ?>
            </div>
            <button class="pulse exo" id="callback">Заказать звонок</button>
        </div>
    </header>
    <!--end header-->
    <div class="content-wrapper">
        <?php echo $content; ?>
        <div class="call-block">
            <div class="block">
                <div class="form">
                    <div class="loading"><img src="/images/system/spinner4.gif" alt="loading"></div>
                    <div class="close"></div>
                    <span>Заказать звонок</span><br>
                    <span>Введите свой номер телефона,<br>и мы перезвоним вам в течении 15 минут</span>
                    <?php $form = ActiveForm::begin([
                        'enableAjaxValidation' => false,
                        'enableClientValidation' => true,
                        'options' => [
                            'id' => 'form_callback',
                        ]
                    ]);?>
                    <?php echo $form->field($letter, 'phone', [
                        'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'main-tel.png' . '" alt="Ваш телефон" title="Ваш телефон">{input}{error}</div>',
                    ])->input('text', [
                        'class' => 'phone-mask',
                        'placeholder' => 'Ваш телефон*'
                    ]); ?>
                    <?php echo Html::submitButton('перезвоните мне', ['class' => 'pulse']); ?>
                    <?php ActiveForm::end(); ?>
                    <span>*ваши данные никогда не будут переданы третьим лицам</span>
                    <div class="success">
                        <span>Спасибо за заявку!</span><br>
                        <span>Мастер перезвонит вам в течениe 15<br>минут и проконсультирует по всем<br>интересующим вопросам</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--start footer -->
    <footer class="footer clear">
        <div class="width">
            <div class="links clear">
                    <div class="cell info">
                        <div class="exo">Информация</div>
                        <ul>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('about'); ?>">О нас</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('works'); ?>">Наши работы</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('about/opinions'); ?>">Отзывы</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl(['about', '#' => 'sertificates']); ?>">Сертификаты</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('works/video'); ?>">Видео работ</a></li>
                        </ul>
                    </div>
                    <div class="cell usl">
                        <div class="exo">Услуги</div>
                        <ul>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('heating'); ?>">Монтаж отопления</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('water-supply'); ?>">Монтаж водоснабжения</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('sewerage'); ?>">Монтаж канализации</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('sanfayans'); ?>">Установка санфаянса</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('automatic-watering'); ?>">Система автополива</a></li>
                        </ul>
                    </div>
                    <div class="cell price">
                        <div class="exo">Цены</div>
                        <ul>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('prices'); ?>">Прайс-лист</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('prices/rates'); ?>">Пакеты услуг</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl(['prices', '#' => 'calc']); ?>">Рассчитать стоимость</a></li>
                        </ul>
                    </div>
                    <div class="cell soc">
                        <a target="_blank" href="https://vk.com/away.php?to=https%3A%2F%2Fok.ru%2Fgroup%2F57443680583734" class="ok"></a>
                        <a target="_blank" href="https://vk.com/sankras" class="vk"></a>
                        <a target="_blank" href="https://vk.com/away.php?to=https%3A%2F%2Fwww.facebook.com%2Fgroups%2F951386194924056%2F" class="facebook"></a>
                        <a target="_blank" href="https://vk.com/away.php?to=https%3A%2F%2Fwww.youtube.com%2Fchannel%2FUCfv_rtyxQfzS4FVRCTQF_4A" class="youtube"></a>
                    </div>
            </div>
            <div class="cont clear">
                <div>
                    <div class="exo">Контакты</div>
                    <div class="phone-number"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'phone-letter.png'; ?>" alt="Телефон"><?php echo Yii::$app->system->get('phone'); ?></div>
                    <div class="skype"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'skype-letter.png'; ?>" alt="Skype"><?php echo Yii::$app->system->get('skype'); ?></div>
                    <div class="email"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'mail-letter.png'; ?>" alt="Email"><a href="mailto:<?php echo Yii::$app->system->get('email'); ?>"><?php echo Yii::$app->system->get('email'); ?></a></div>
                    <div class="time-work"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'work-letter.png'; ?>" alt="Режим работы">ежедневно с 8:00 до 21:00</div>
                    <div class="address"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'addres-blue.png'; ?>" alt="Адрес"><a href="<?php echo Yii::$app->urlManager->createUrl('contacts'); ?>"><?php echo Yii::$app->system->get('address'); ?></a></div>
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
                    <div class="copy">© 2015-2017 «SanKras»</div>
                    <div class="conf"><a href="<?php echo Yii::$app->urlManager->createUrl('privacy-policy'); ?>">Политика конфиденциальности</a></div>
                </div>
                <div class="codedex clear">
                    <div class="width">
                        <div class="site"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'code-dex.png'; ?>" alt=""><a href="https://vk.com/xotonori" target="_blank">Разработка сайта</a></div>
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



