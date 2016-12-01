<?php
use yii\widgets\LinkPager;
use app\models\Works;

$this->title = 'Видео работ | Примеры работ по сантехнике';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Примеры работ по сантехнике SanKras'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'примеры сантехнические работы, санкрас сантехнические работы, sankras работы, сантехнические работы в квартире, сантехнические работы частный дом'
]);
?>
<section class="videos" id="video">
    <div class="width">
        <div class="head clear">
            <h1 class="title exo asphalt">Видео</h1>
            <div class="tabs">
                <ul>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl(['works', 'group' => 'all']); ?>">Все работы</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl(['works', 'group' => 'house']); ?>">Частные дома</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl(['works', 'group' => 'flat']); ?>">Квартиры</a></li>
                    <li class="exo asphalt active"><a href="<?php echo Yii::$app->urlManager->createUrl('works/video'); ?>">Видео</a></li>
                </ul>
            </div>
        </div>
        <div class="vid clear">
            <?php if (!empty($videos)) { ?>
                <?php foreach ($videos as $video) {?>
                    <div class="video">
                        <iframe width="370" height="280" src="<?php echo $video->video; ?>" frameborder="0" allowfullscreen></iframe>
                        <div class="video-title exo"><?php echo $video->title; ?></div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <span class="no-video">В этом разделе пока нет видео. В скором времени оно появится.</span>
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