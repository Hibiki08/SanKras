<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Получить дисконтную карту</title>
    <style>
        @font-face {
            font-family: 'Exo 2';
            src: url('<?php echo Yii::$app->homeUrl; ?>/fonts/exo2/Exo2-Medium.eot');
            src: url('<?php echo Yii::$app->homeUrl; ?>/fonts/exo2/Exo2-Medium.eot?#iefix') format('embedded-opentype'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/exo2/Exo2-Medium.woff2') format('woff2'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/exo2/Exo2-Medium.woff') format('woff'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/exo2/exo2.0-medium.ttf') format('truetype'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/exo2/Exo2-Medium.otf') format('opentype');
            font-weight: 500;
            font-style: normal;
        }
        @font-face {
            font-family: 'Exo 2';
            src: url('<?php echo Yii::$app->homeUrl; ?>/fonts/exo2/exo2.0-light.eot');
            src: url('<?php echo Yii::$app->homeUrl; ?>/fonts/exo2/exo2.0-light.eot?#iefix') format('embedded-opentype'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/exo2/Exo2-Light.woff2') format('woff2'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/exo2/Exo2-Light.woff') format('woff'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/exo2/exo2.0-light.ttf') format('truetype'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/exo2/Exo2.0-Light.otf') format('opentype');
            font-weight: 300;
            font-style: normal;
        }
        @font-face {
            font-family: 'Roboto';
            src: url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-Light.eot');
            src: url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-Light.eot?#iefix') format('embedded-opentype'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-Light.woff2') format('woff2'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-Light.woff') format('woff'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-Light.ttf') format('truetype'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-Light.otf') format('opentype');
            font-weight: 300;
            font-style: normal;
        }
        @font-face {
            font-family: 'Roboto';
            src: url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-LightItalic.eot');
            src: url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-LightItalic.eot?#iefix') format('embedded-opentype'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-LightItalic.woff2') format('woff2'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-LightItalic.woff') format('woff'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-LightItalic.ttf') format('truetype'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-LightItalic.otf') format('opentype');
            font-weight: 300;
            font-style: italic;
        }
        @font-face {
            font-family: 'Roboto';
            src: url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-Medium.eot');
            src: url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-Medium.eot?#iefix') format('embedded-opentype'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-Medium.woff2') format('woff2'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-Medium.woff') format('woff'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-Medium.ttf') format('truetype'),
            url('<?php echo Yii::$app->homeUrl; ?>/fonts/roboto/Roboto-Medium.otf') format('opentype');
            font-weight: 500;
            font-style: normal;
        }
        * {
            margin: 0;
            padding: 0;
        }
        .red,
        .red a {
            color: #f44336;
        }
        body {
            width: 690px;
            margin: auto;
            font-family: 'Roboto', sans-serif;
            color: #34495e;
            font-weight: 300;
        }
        .content-wrapper {
            background: url('<?php echo Yii::$app->homeUrl; ?>/images/system/texture-mail.png') repeat;
            padding: 45px;
        }
        .content {
            background: #f5f6f7;
        }
        .clear:after {
            content: '';
            clear: both;
            width: 100%;
            display: table;
        }
        header {
            padding: 20px 15px 15px;
            box-shadow: 0px 1px 7px 0px rgba(0, 0, 0, 0.42);
            -moz-box-shadow: 0px 1px 7px 0px rgba(0, 0, 0, 0.42);
            -o-box-shadow: 0px 1px 7px 0px rgba(0, 0, 0, 0.42);
            -webkit-box-shadow: 0px 1px 7px 0px rgba(0, 0, 0, 0.42);
        }
        header div:first-of-type {
            float: left;
        }
        header .phone {
            float: right;
        }
        .phone {
            font-family: 'Exo 2', sans-serif;
            font-size: 25px;
            font-weight: 500;
            letter-spacing: -1px;
            color: #34495e;
            text-decoration: none;
        }
        .description {
            width: 100%;
            text-align: center;
            font-size: 15px;
            margin-top: 20px;
            font-style: italic;
        }
        .body {
            padding: 0 25px 87px;
            box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0.43);
            -moz-box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0.43);
            -o-box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0.43);
            -webkit-box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0.43);
        }
        h2 {
            font-family: 'Exo 2', sans-serif;
            font-weight: 300;
            font-size: 30px;
            text-transform: uppercase;
            width: 100%;
            text-align: center;
            margin-top: 35px;
        }
        .discount:before {
            content: '';
            background: url('<?php echo Yii::$app->homeUrl; ?>/images/system/discount-letter.png') no-repeat;
            width: 368px;
            height: 286px;
            position: absolute;
            top: -47px;
            left: -70px;
        }
        .discount {
            font-size: 18px;
            text-align: right;
            margin-top: 50px;
            position: relative;
        }
        .discount p {
            width: 350px;
            display: inline-block;
            text-align: left;
            text-indent: -30px;
        }
        .discount p:first-of-type {
            margin-bottom: 25px;
        }
        .discount p span,
        .subscibe {
            font-weight: 500;
        }
        .subscibe {
            margin-top: 45px;
            font-size: 18px;
        }
        .subscibe a {
            color: #34495e;
        }
        .master {
            text-align: left;
            margin-top: 75px;
            font-size: 24px;
        }
        .body ul {
            margin-top: 40px;
            font-size: 16px;
            line-height: 1.4;
            margin-left: 38px;
            position: relative;
        }
        .body ul:after {
            content: '';
            background: url('<?php echo Yii::$app->homeUrl; ?>/images/system/master-mail.png') no-repeat;
            width: 388px;
            height: 221px;
            position: absolute;
            top: 25px;
            right: -70px;
        }
        .button {
            margin-top: 45px;
            background: #f44336;
            color: #fff;
            text-transform: uppercase;
            font-family: 'Exo 2', sans-serif;
            font-size: 15px;
            padding: 10px 0;
            border-radius: 3px;
            border-bottom: 2px solid #cb372c;
            width: 200px;
            text-align: center;
            display: block;
            text-decoration: none;
        }
        footer {
            margin-top: 35px;
        }
        footer ul {
            float: left;
            line-height: 1.4;
        }
        footer ul a,
        .contacts {
            color: #9db7d1;
            font-size: 14px;
            line-height: 1.4;
        }
        .contacts {
            float: right;
            line-height: 2;
            width: 300px;
        }
        .contacts a {
            color: #9db7d1;
        }
        .contacts .cont {
            float: left;
        }
        .contacts .soc {
            float: right;
            margin-top: -9px;
        }
        .contacts .soc a {
            width: 42px;
            height: 42px;
            display: block;
            margin-bottom: 4px;
        }
        .vk {
            background: url('<?php echo Yii::$app->homeUrl; ?>/images/system/vk.png') no-repeat;
        }
        .vk:hover {
            background: url('<?php echo Yii::$app->homeUrl; ?>/images/system/vk-hov.png') no-repeat;
        }
        .ok {
            background: url('<?php echo Yii::$app->homeUrl; ?>/images/system/ok.png') no-repeat;
        }
        .ok:hover {
            background: url('<?php echo Yii::$app->homeUrl; ?>/images/system/ok-hov.png') no-repeat;
        }
        .facebook {
            background: url('<?php echo Yii::$app->homeUrl; ?>/images/system/facebook.png') no-repeat;
        }
        .facebook:hover {
            background: url('<?php echo Yii::$app->homeUrl; ?>/images/system/facebook-hov.png') no-repeat;
        }
        .cont div {
            position: relative;
        }
        .phone-number:before,
        .skype:before,
        .email:before,
        .work:before {
            content: '';
            width: 18px;
            height: 18px;
            background: url("<?php echo Yii::$app->homeUrl; ?>/images/system/phone-letter.png");
            position: absolute;
            top: 5px;
            left: -30px;
        }
        .skype:before {
            background: url("<?php echo Yii::$app->homeUrl; ?>/images/system/skype-letter.png");
        }
        .email:before {
            background: url("<?php echo Yii::$app->homeUrl; ?>/images/system/mail-letter.png");
            width: 20px;
            height: 16px;
        }
        .work:before {
            background: url("<?php echo Yii::$app->homeUrl; ?>/images/system/work-letter.png");
        }
    </style>
</head>
<body>
<div class="content-wrapper">
    <div class="content">
        <header class="clear">
            <div class="logo">
                <a href="<?php echo Yii::$app->homeUrl; ?>" target="_blank"><img src="<?php echo Yii::$app->homeUrl; ?>/images/system/new-logo.png" alt="Логотип" title="лого"></a>
            </div>
            <a href="tel:+78612035106" class="phone" >+7 <span class="red">(861)</span> 203-51-06</a>
        </header>
        <div class="body">
            <div class="description">Монтаж отопления, канализации, водоснабжения в Краснодаре</div>
            <h2 class="red">Получение дисконтной карты</h2>
            <div class="discount">
                <p>Вы получили это письмо, потому что заказали дисконтную карту со скидкой на монтаж сантехнических систем. Теперь при заказе сантехнических услуг в Sankras <span>для Вас действует скидка 10% на материал и 12% на монтаж</span>.</p>
                <p>Получить дисконтную карту Вы можете при вызове мастера на замер, показав это письмо или распечатанный бланк, прикрепленный к письму.</p>
            </div>
            <div class="subscibe">С уважением, <a href="<?php echo Yii::$app->homeUrl; ?>" target="_blank">Sankras!</a></div>
            <h2 class="red master">Закажите бесплатный вызов мастера<br>на замер и получите:</h2>
            <ul>
                <li>консультацию и рекомендации мастера</li>
                <li>эскизный проект</li>
                <li>смету стоимости монтажных работ</li>
                <li>смету стоимости материала</li>
            </ul>
            <a href="<?php echo Yii::$app->homeUrl; ?>/#call-master" target="_blank" class="button">Заполнить заявку</a>
        </div>
    </div>
    <footer class="clear">
        <ul>
            <li><a href="<?php echo Yii::$app->homeUrl; ?>/#price" target="_blank">Прайс-лист</a></li>
            <li><a href="<?php echo Yii::$app->homeUrl; ?>/#price-flat" target="_blank">Стоимость пакетов услуг</a></li>
            <li><a href="<?php echo Yii::$app->homeUrl; ?>/#works" target="_blank">Наши работы</a></li>
            <li><a href="<?php echo Yii::$app->homeUrl; ?>/#reviews" target="_blank">Отзывы</a></li>
            <li><a href="<?php echo Yii::$app->homeUrl; ?>/#contacts" target="_blank">Контакты</a></li>
        </ul>
        <div class="contacts clear">
            <div class="cont">
                <div class="phone-number">+7 (861) 203-51-06</div>
                <div class="skype">skype sankras_pro</div>
                <div class="email"><a href="mailto:info@san-kras.ru">info@san-kras.ru</a></div>
                <div class="work">ежедневно с 8:00 до 21:00</div>
            </div>
            <div class="soc">
                <a href="https://vk.com/sankras" target="_blank" class="vk"></a>
                <a href="https://vk.com/away.php?to=https%3A%2F%2Fok.ru%2Fgroup%2F57443680583734" target="_blank" class="ok"></a>
                <a href="https://vk.com/away.php?to=https%3A%2F%2Fwww.facebook.com%2Fgroups%2F951386194924056%2F" target="_blank" class="facebook"></a>
            </div>
        </div>
    </footer>
</div>
</body>
</html>