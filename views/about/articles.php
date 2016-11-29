<?php
use yii\widgets\LinkPager;
use app\models\Blog;
use yii\helpers\StringHelper;

$this->title = 'Статьи';
?>
<section class="articles" id="about">
    <div class="width">
        <div class="head">
            <div class="tabs">
                <ul>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/'); ?>">О нас</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/opinions'); ?>">Отзывы</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/news'); ?>">Новости</a></li>
                    <li class="exo asphalt active"><a href="<?php echo Yii::$app->urlManager->createUrl('about/articles'); ?>">Статьи</a></li>
                </ul>
            </div>
            <h2 class="title exo asphalt"><?php echo $this->title; ?></h2>
        </div>
        <div class="block-articles">
            <?php if (!empty($articles)) { ?>
                <?php foreach ($articles as $article) {?>
                    <a href="<?php echo Yii::$app->urlManager->createUrl(['about/articles', 'single' => $article->id]); ?>" class="article">
                        <?php if (!empty($article->preview)) { ?>
                            <img src="<?php echo Yii::$app->params['params']['pathToImage'] . Blog::IMG_FOLDER_ART . 'prev_' . $article->preview; ?>">
                        <?php } ?>
                        <div class="articles-text">
                            <div class="article-title"><?php echo $article->title; ?></div>
                            <div class="short"><?php echo StringHelper::truncate($article->text, 230, '...'); ?></div>
                            <span class="date"><?php echo Yii::$app->formatter->asDate($article->date, 'd MMMM yyyy'); ?></span>
                        </div>
                    </a>
                <?php } ?>
            <?php } else { ?>
                <span class="no-video">В этом разделе пока нет статей. В скором времени они появятся.</span>
            <?php } ?>
        </div>
        <div class="pagination">
            <?php echo LinkPager::widget([
                'pagination' => $pager,
                'prevPageLabel' => '',
                'nextPageLabel' => '',
                'maxButtonCount' => 5
            ]); ?>
        </div>
    </div>
</section>