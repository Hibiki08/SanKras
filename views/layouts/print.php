<?php

use yii\helpers\Html;
use app\assets\PrintAsset;

PrintAsset::register($this);
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
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
</head>
<body>
<?php $this->beginBody() ?>
<!--start wrapper-->
<div class="wrapper">
    <div class="conten-wrapper">
        <?php echo $content; ?>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



