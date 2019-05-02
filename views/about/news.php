<?php
use yii\widgets\LinkPager;
use app\models\Blog;
use yii\helpers\StringHelper;

$this->title = 'Новости компании СанКрас: посещение семинаров и повышение квалификации';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Специалисты компании СанКрас постоянно повышают квалификацию: посещение семинаров и выставок по сантехнике позволяет использовать в работе новейшие технологии.'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'новости компании санкрас'
]);

$this->params['breadcrumbs'][] = 'Новости';
?>
<section class="news" id="about">
    <div class="width">
        <div class="head">
           <? /*<div class="tabs">
                <ul>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/'); ?>">О нас</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/opinions'); ?>">Отзывы</a></li>
                    <li class="exo asphalt active"><a href="<?php echo Yii::$app->urlManager->createUrl('about/news'); ?>">Новости</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/articles'); ?>">Статьи</a></li>
                </ul>
            </div>*/?>
            <h1 class="title exo asphalt">Новости</h1>
        </div>
        <div class="block-news go-wide clear"><!--
            <?php if (!empty($news)) { ?>
                <?php foreach ($news as $new) {?>
                 --><a href="<?php echo Yii::$app->urlManager->createUrl(['novosti/'.$new->url]); ?>" class="new">
                        <?php if (!empty($new->preview)) { ?>
                            <img src="<?php echo Yii::$app->params['params']['pathToImage'] . Blog::IMG_FOLDER_NEWS . 'prev_' . $new->preview; ?>">
                        <?php } ?>
                        <div class="news-text">
                            <div class="new-title"><?php echo $new->title; ?></div>
                            <div class="short"><?php echo strip_tags(StringHelper::truncate($new->text, 230, '...')); ?></div>
                            <span class="date"><?php echo Yii::$app->formatter->asDate($new->date, 'd MMMM yyyy'); ?></span>
                        </div>
                    </a><!--
                <?php } ?>
            <?php } else { ?>
                --><span class="no-video">В этом разделе пока нет новостей. В скором времени они появятся.</span><!--
            <?php } ?>
        --></div>
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