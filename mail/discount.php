<?php
use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Получить дисконтную карту</title>
</head>
<body>
<?php $this->beginBody() ?>
<div style="width: 690px;margin: auto;">
    <div style="background: url('<?php echo $homeUrl; ?>/images/system/texture-mail.png') repeat;padding: 45px;padding-left: 10px;">
        <div style="background: url(<?php echo $homeUrl; ?>/images/system/letter.png) no-repeat top center;height: 160px;width: 670px;padding-top: 835px;">
            <a href="<?php echo $homeUrl; ?>/#call-master" target="_blank" style="background: #f44336;color: #fff;text-transform: uppercase;font-size: 15px;padding: 10px 0;border-radius: 3px;border-bottom: 2px solid #cb372c;width: 200px;text-align: center;display: block;text-decoration: none;font-family: Arial,sans-serif;margin-left: 85px;">Заполнить заявку</a>
        </div>
        <footer style="font-family: Arial,sans-serif;">
            <ul style="float: left;line-height: 1.4;color: #9db7d1;list-style-type: none;">
                <li><a href="<?php echo $homeUrl; ?>/prices" target="_blank" style="color: #9db7d1;font-size: 14px;">Прайс-лист</a></li>
                <li><a href="<?php echo $homeUrl; ?>/prices/rates" target="_blank" style="color: #9db7d1;font-size: 14px;">Стоимость пакетов услуг</a></li>
                <li><a href="<?php echo $homeUrl; ?>/works" target="_blank" style="color: #9db7d1;font-size: 14px;">Наши работы</a></li>
                <li><a href="<?php echo $homeUrl; ?>/about/opinions" target="_blank" style="color: #9db7d1;font-size: 14px;">Отзывы</a></li>
                <li><a href="<?php echo $homeUrl; ?>/contacts" target="_blank" style="color: #9db7d1;font-size: 14px;">Контакты</a></li>
            </ul>
            <div style="float: right;width: 300px;line-height: 1.9;margin-top: 11px;">
                <div style="float: left">
                    <div><img src="<?php echo $homeUrl; ?>/images/system/phone-letter.png" alt="Телефон" style="margin-left: -30px;margin-right: 10px;display: inline-block;vertical-align: middle;"><a href="tel:<?php echo $adminPhone; ?>" style="color: #9db7d1;"><?php echo $adminPhone; ?></a></div>
                    <div style=";color: #9db7d1;"><img src="<?php echo $homeUrl; ?>/images/system/skype-letter.png" alt="skype" style="margin-left: -30px;margin-right: 10px;display: inline-block;vertical-align: middle;"><?php echo $adminSkype; ?></div>
                    <div><img src="<?php echo $homeUrl; ?>/images/system/mail-letter.png" alt="email" style="margin-left: -30px;margin-right: 10px;display: inline-block;vertical-align: middle;"><a href="mailto:info@san-kras.ru" style="color: #9db7d1;"><?php echo $adminEmail; ?></a></div>
                    <div style="color: #9db7d1;"><img src="<?php echo $homeUrl; ?>/images/system/work-letter.png" alt="Режим работы" style="margin-left: -30px;margin-right: 10px;display: inline-block;vertical-align: middle;">ежедневно с 8:00 до 21:00</div>
                </div>
                <div style="float: right;margin-top: -9px;">
                    <a href="https://vk.com/sankras" target="_blank" style="display: block;margin-bottom: 4px;height: 40px;"><img src="<?php echo $homeUrl; ?>/images/system/vk.png" alt="vk"></a>
                    <a href="https://vk.com/away.php?to=https%3A%2F%2Fok.ru%2Fgroup%2F57443680583734" target="_blank" style="display: block;margin-bottom: 4px;height: 40px;"><img src="<?php echo $homeUrl; ?>/images/system/ok.png" alt="ok"></a>
                    <a href="https://vk.com/away.php?to=https%3A%2F%2Fwww.facebook.com%2Fgroups%2F951386194924056%2F" target="_blank" style="display: block;margin-bottom: 4px;height: 40px;"><img src="<?php echo $homeUrl; ?>/images/system/facebook.png" alt="facebook"></a>
                </div>
                <div style="display: table;width: 100%;clear: both;"></div>
            </div>
            <div style="display: table;width: 100%;clear: both;"></div>
        </footer>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>