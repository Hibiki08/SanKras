<?php
use app\models\Blog;
use yii\helpers\StringHelper;

$this->title = $new->title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => strip_tags(StringHelper::truncate( $new->text, 150, ''))
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $new->title
]);
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url'=> ['/novosti']];
$this->params['breadcrumbs'][] = $new->title;
?>
<section class="single" id="about">
    <div class="width clear">
        <div class="new">
            <div class="block">
                <h1 class="exo"><?php echo $new->title; ?></h1>
                <span class="date"><?php echo Yii::$app->formatter->asDate($new->date, 'd MMMM yyyy'); ?></span>
                <?php if (!empty($new->preview)) { ?>
                    <img class="preview" src="<?php echo Yii::$app->params['params']['pathToImage'] . Blog::IMG_FOLDER_NEWS . $new->preview; ?>">
                <?php } ?>
                <div class="text"><?php echo $new->text; ?></div>
            </div>
            <?php if ($prev && $next != null) { ?>
                <div class="prev-next clear">
                    <a href="<?php echo Yii::$app->urlManager->createUrl(['novosti/'.$prev]); ?>" class="prev exo"><div class="img"></div><span>Предыдущая новость</span></a>
                    <a href="<?php echo Yii::$app->urlManager->createUrl(['novosti']); ?>" class="prev more exo"><div class="img"></div><span>Все новости</span></a>
                    <a href="<?php echo Yii::$app->urlManager->createUrl(['novosti/'.$next]); ?>" class="next exo"><span>Следующая новость</span><div class="img"></div></a>
                </div>
            <?php } ?>
        </div>
        <div class="other">
            <div>Другие новости</div>
            <?php if (!empty($other)) { ?>
                <?php foreach ($other as $oth) {?>
                    <a href="<?php echo Yii::$app->urlManager->createUrl(['novosti/'.$oth->url]); ?>" class="more">
                        <h2><?php echo $oth->title; ?></h2>
                        <div class="short"><?php echo strip_tags(StringHelper::truncate($oth->text, 250, '...'), '<br><p>'); ?></div>
                        <span class="date"><?php echo Yii::$app->formatter->asDate($oth->date, 'd MMMM yyyy'); ?></span>
                    </a>
                    <?php } ?>
            <?php } ?>
        </div>
    </div>
</section>