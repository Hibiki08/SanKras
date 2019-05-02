<?php
use app\models\Team;
use app\models\Certificates;
use yii\helpers\Url;

$this->title = 'О компании СанКрас: профессиональные монтажники сантехники';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'С 2014 года компания СанКрас выполнила проектирование и монтаж инженерных сантех. сетей в 120 частных домах площадью 100-600 кв.м., в 80 квартирах, в коммерческих и производственных помещениях.'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'сайт сантехников сантехническии компании бригада сандехников'
]);

$this->params['breadcrumbs'][] = 'О компании';
?>
<section class="about" id="about">
    <div class="width">
        <div class="head">
            <?/*<div class="tabs">
                <ul>
                    <li class="exo asphalt active"><a href="<?php echo Yii::$app->urlManager->createUrl('about/'); ?>">О нас</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/opinions'); ?>">Отзывы</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/news'); ?>">Новости</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/articles'); ?>">Статьи</a></li>
                </ul>
            </div>*/?>
            <h1 class="title exo asphalt">О компании</h1>
        </div>
        <div class="about-block">
            <div class="text clear">
                <div class="txt txt-1">
                    <figure><img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>about-1.png" alt="СанКрас" title="SanKras"></figure>
                    <p>Почему люди доверяют одним компаниями, но не пользуются услугами других? Мы в СанКрас долго думали над этим, пока не поняли, что, наверное, главным критерием при выборе поставщика каких-либо услуг является репутация.</p>
                    <p>Мы подумали, что если делать работу качественно, при этом предоставлять заказчику привилегии, бонусы и не задирать цены, нас станут рекомендовать друзьям. Нам нужно делать работу так, чтобы у заказчиков не возникало проблем с отоплением и</p>
                </div>
                <div class="txt txt-2">
                    <p> канализацией, тогда мы сможем рассчитывать на хорошие отзывы. Важно все время помнить, что мы работаем не для какой-то массы "клиентов", а для конкретных людей, которые будут жить в своих квартирах и домах.</p>
                    <p>Говорят, что каждый должен быть на своем месте. Мы не пытаемся заниматься сторонними делами (для этого у нас есть широкий список компаний, с которыми мы сотрудничаем по самым разным вопросам), все наши усилия сосредоточены именно на  монтаже сантехнических коммуникаций.</p>
                    <p>Наши специалисты имеют большой опыт работы и постоянно повышают свою квалификацию, что подтверждают многочисленные сертификаты и грамоты. У нас имеется небольшой автопарк, который позволяет бесплатно доставлять материал. Также мы используем профессиональный инструмент, благодаря которому существенно увеличивается скорость монтажа. Подробнее о некоторых фактах компании вы можете почитать <a target="_blank" href="<?php echo Url::to(['/', '#' => 'seo']); ?>">здесь</a>.</p>
                    <p>Работа на совесть, а не за деньги - вот наше кредо. Многие наши заказчики уже оценили плюсы индивидуального подхода и гибкой системы скидок, попробуйте и вы.</p>
                    <span class="subscribe">Артем Алексеевич, инженер компании СанКрас</span>
                </div>
            </div>
            <?php if (!empty($team)) { ?>
            <div class="team clear">
                <h2 class="title-big">Наша команда</h2>
                <?php foreach ($team as $tm) {?>
                <div class="tm">
                    <figure><img src="<?php echo Yii::$app->params['params']['pathToImage'] . Team::IMG_FOLDER . 'team(' . $tm->id . ')/team_' . $tm->img; ?>" alt="Команда" title="Команда"></figure>
                    <div class="description">
                        <span class="name exo"><?php echo $tm->name; ?></span><span class="desc exo">, <?php echo $tm->post; ?></span>
                        <?php $items = explode(";\n", $tm->text); ?>
                        <span class="team-text"><p><?php echo implode('</p><p>', $items); ?></p></span>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
            <?php if (!empty($certificates)) { ?>
            <div class="sertificates clear" id="sertificates">
                <h2 class="title-big">Наши сертификаты</h2>
                <?php foreach ($certificates as $cert) {?>
                <div class="sertif">
                    <a class="fancybox" rel="group" href="<?php echo Yii::$app->params['params']['pathToImage'] . Certificates::IMG_FOLDER  . $cert->img; ?>"><img src="<?php echo Yii::$app->params['params']['pathToImage'] . Certificates::IMG_FOLDER . 'mini_' . $cert->img; ?>" alt="Сертификат" title="Сертификат"></a>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox({
            openEffect	: 'elastic',
            closeEffect	: 'elastic',

            helpers : {
                title : {
                    type : 'inside'
                }
            }
        });
    });
</script>
