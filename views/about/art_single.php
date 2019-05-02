<?php
use app\models\Blog;
use yii\helpers\StringHelper;
$this->title = $article->title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => strip_tags(StringHelper::truncate( $article->text, 150, ''))
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $article->title
]);

$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url'=> ['/stati']];
$this->params['breadcrumbs'][] = $article->title;
?>
<section class="single" id="about">
    <div class="width clear">
        <div class="new">
            <div class="block">
                <h1 class="exo"><?php echo $article->title; ?></h1>
                <span class="date"><?php echo Yii::$app->formatter->asDate($article->date, 'd MMMM yyyy'); ?></span>
                <?php if (!empty($article->preview)) { ?>
                    <img class="preview" src="<?php echo Yii::$app->params['params']['pathToImage'] . Blog::IMG_FOLDER_ART . $article->preview; ?>">
                <?php } ?>
                <div class="text"><?php echo $article->text; ?></div>
            </div>
            <?php if ($prev && $next != null) { ?>
                <div class="prev-next clear">
                    <a href="<?php echo Yii::$app->urlManager->createUrl(['stati/'.$prev]); ?>" class="prev exo"><div class="img"></div><span>Предыдущая статья</span></a>
                    <a href="<?php echo Yii::$app->urlManager->createUrl(['stati']); ?>" class="prev more exo"><div class="img"></div><span>Все статьи</span></a>
                    <a href="<?php echo Yii::$app->urlManager->createUrl(['stati/'.$next]); ?>" class="next exo"><span>Следующая статья</span><div class="img"></div></a>
                </div>
            <?php } ?>
        </div>
        <div class="other">
            <div>Другие статьи</div>
            <?php if (!empty($other)) { ?>
                <?php foreach ($other as $oth) {?>
                    <a href="<?php echo Yii::$app->urlManager->createUrl(['stati/'.$oth->url]); ?>" class="more">
                        <h2><?php echo $oth->title; ?></h2>
                        <div class="short"><?php echo strip_tags(StringHelper::truncate($oth->text, 250, '...'), '<br><p>'); ?></div>
                        <span class="date"><?php echo Yii::$app->formatter->asDate($oth->date, 'd MMMM yyyy'); ?></span>
                    </a>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</section>