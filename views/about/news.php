<?php
use yii\widgets\LinkPager;
use app\models\Blog;
use yii\helpers\StringHelper;

$this->title = 'Новости';
?>
<section class="news" id="about">
    <div class="width">
        <div class="head">
            <div class="tabs">
                <ul>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/'); ?>">О нас</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/opinions'); ?>">Отзывы</a></li>
                    <li class="exo asphalt active"><a href="<?php echo Yii::$app->urlManager->createUrl('about/news'); ?>">Новости</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/articles'); ?>">Статьи</a></li>
                </ul>
            </div>
            <h2 class="title exo asphalt"><?php echo $this->title; ?></h2>
        </div>
        <div class="block-news clear">
            <?php if (!empty($news)) { ?>
                <?php foreach ($news as $new) {?>
                    <a href="<?php echo Yii::$app->urlManager->createUrl(['about/news', 'single' => $new->id]); ?>" class="new">
                        <?php if (!empty($new->preview)) { ?>
                            <img src="<?php echo Yii::$app->params['params']['pathToImage'] . Blog::IMG_FOLDER_NEWS . 'prev_' . $new->preview; ?>">
                        <?php } ?>
                        <div class="news-text">
                            <div class="new-title"><?php echo $new->title; ?></div>
                            <div class="short"><?php echo StringHelper::truncate($new->text, 280, '...'); ?></div>
                            <span class="date"><?php echo Yii::$app->formatter->asDate($new->date, 'd MMMM yyyy'); ?></span>
                        </div>
                    </a>
                <?php } ?>
            <?php } else { ?>
                <span class="no-video">В этом разделе пока нет новостей. В скором времени они появятся.</span>
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
<script type="text/javascript">
    $(window).load(function() {
        $('.block-news').isotope({
            itemSelector: '.new',
            layoutMode: 'fitRows',
        })
    });
</script>