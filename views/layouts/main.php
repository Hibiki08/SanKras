<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\forms\BaseForm;
use app\models\Services;
use app\components\MainMenu;

$letter = new BaseForm();

AppAsset::register($this);
//var_dump(Yii::$app->controller->route);die;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <?php echo Html::csrfMetaTags(); ?>
    <?$u = parse_url($_SERVER['REQUEST_URI']);?>
    <?=in_array(trim($u['path'],'/'),['montazh-v-chastnom-dome','montazh-v-kvartire','zastroyshchikam'])?'<meta name="robots" content="noindex, nofollow"/>':''?>
    
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
</head>
<body>
<?php $this->beginBody(); ?>
<!--start wrapper-->
<div class="wrapper">
    <!--start header-->
    <header id="header">
        <div class="description">
            <div class="width clear">
                <div>Монтаж отопления, канализации, водоснабжения <a>в Краснодаре и крае, в Адыгее</a></div>
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
            <?php echo MainMenu::widget(); ?>
            <div class="phone exo" id="phone">
                <?php echo Yii::$app->system->get('phone'); ?>
                <span>звонок бесплатный</span>
            </div>
            <button class="pulse exo" id="callback">Заказать звонок</button>
        </div>
    </header>
    <!--end header-->
    <div class="content-wrapper">
       <div class="width">
           <?php echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]); ?>
       </div>
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
                    <?php echo $form->field($letter, 'agree',['template' =>'<label>{input} Согласен(на) на обработку персональных данных в соответствии с <a href="/politika-konfidencialnosti">Политикой конфеденциальности</a></label>{error}' ])->input('checkbox', [
                            'value' => '1',
                            'checked' => 'checked',
                            'class' => '_argee'
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
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('o-kompanii'); ?>">О компании</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('nashi-raboty'); ?>">Наши работы</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('otzyvy'); ?>">Отзывы</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl(['o-kompanii', '#' => 'sertificates']); ?>">Сертификаты</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('nashi-raboty/video-rabot'); ?>">Видео работ</a></li>
                        </ul>
                    </div>
                    <div class="cell usl">
                        <div class="exo">Услуги</div>
                        <ul>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('/heating'); ?>">Монтаж отопления</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('/heating/ustanovka-kotlov-otopleniya'); ?>">Установка котлов отопления</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('/heating/ustanovka-gazovogo-kotla'); ?>">Установка газового котла</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('/heating/montazh-teplogo-pola'); ?>">Монтаж теплого пола</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('/water-supply'); ?>">Монтаж водоснабжения</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('/water-supply/ustanovka-filtrov'); ?>">Установка фильтров</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('/sewerage'); ?>">Монтаж канализации</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('/sanfayans'); ?>">Установка сантехники</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('/sanfayans/ustanovka-vanny'); ?>">Установка ванны</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('/automatic-watering'); ?>">Монтаж автополива</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('/montazh-i-zamena-trub'); ?>">Монтаж и замена труб</a></li>
                        </ul>
                    </div>
                    <div class="cell price">
                        <div class="exo">Цены</div>
                        <ul>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('prays-list'); ?>">Прайс-лист</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('pakety-uslug'); ?>">Пакеты услуг</a></li>
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl(['prays-list', '#' => 'calc']); ?>">Рассчитать стоимость</a></li>
                        </ul>
                    </div>
                    <div class="cell soc">
                        <a target="_blank" href="https://ok.ru/group/57443680583734" class="ok"></a>
                        <a target="_blank" href="https://vk.com/sankras" class="vk"></a>
                        <a target="_blank" href="https://www.facebook.com/groups/951386194924056/" class="facebook"></a>
                        <a target="_blank" href="https://www.youtube.com/channel/UCEhRxbM0IxcsCc187iQ4WxQ" class="youtube"></a>
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
                    <div class="copy">© 2015-<?php echo Yii::$app->formatter->asDate(time(), 'yyyy')?> «SanKras»</div>
                    <div class="conf"><a href="<?php echo Yii::$app->urlManager->createUrl('politika-konfidencialnosti'); ?>">Политика конфиденциальности</a></div>
                </div>
                <div class="codedex clear">
                    <div class="width">
                        <div class="site"><span>Разработка сайта: </span><a target="_blank" href="https://www.behance.net/dazhdia">Дизайн</a> | <a target="_blank" href="https://vk.com/thishibiki">Программирование</a></div>
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
<!--Google analytics-->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-92186674-1', 'auto');
    ga('require', 'displayfeatures');
    ga('send', 'pageview');

    /* Accurate bounce rate by time */
    if (!document.referrer ||
        document.referrer.split('/')[2].indexOf(location.hostname) != 0)
        setTimeout(function(){
            ga('send', 'event', 'Новый посетитель', location.pathname);
        }, 15000);
</script>
<!--Google analytics-->
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'BBaqWgXNnb';var d=document;var w=window;function l(){var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>
<!-- {/literal} END JIVOSITE CODE -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



