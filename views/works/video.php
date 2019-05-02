<?php
use yii\widgets\LinkPager;
use app\models\Works;

$this->title = 'Примеры выполненных работ компании СанКрас: видео с объектов';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Видео выполненных работ компании СанКрас позволит вам оценить качество и профессиональный подход к монтажу сантехнических коммуникаций на объектах наших клиентов!'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'видео сантехнических работ санкрас'
]);
$this->params['breadcrumbs'][] = ['label' => 'Наши работы', 'url'=> ['/works']];
$this->params['breadcrumbs'][] = 'Видео';
?>
<section class="videos" id="video">
    <div class="width">
        <div class="head clear">
            <h1 class="title exo asphalt">Видео наших работ</h1>
            <div class="tabs">
                <ul>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('nashi-raboty'); ?>">Все работы</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('nashi-raboty/chastnye-doma'); ?>">Частные дома</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('nashi-raboty/kvartiry'); ?>">Квартиры</a></li>
                    <li class="exo asphalt active"><a href="<?php echo Yii::$app->urlManager->createUrl('nashi-raboty/video-rabot'); ?>">Видео</a></li>
                </ul>
            </div>
        </div>
        <?if($blog && $blog->active){?>
        <div class="seo_text_field"><?=$blog->text?></div>
        <?}?>
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