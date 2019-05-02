<?php
use yii\widgets\LinkPager;
use app\models\Works;
use yii\helpers\Url;

$this->title = 'Примеры выполненных работ компании СанКрас: фото, стоимость, сроки';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Примеры работ, выполненных компанией СанКрас в квартирах и частных домах, с описанием перечня используемых при монтаже материалов, стоимостью и сроками. Фотографии и видео сантехнических работ. '
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'примеры сантехнических работ санкрас'
]);


if($action){
$this->params['breadcrumbs'][] = ['label' => 'Наши работы', 'url'=> ['/works']];
$this->params['breadcrumbs'][] = ($action=='chastnye-doma'?'Частные дома':'Квартиры');}else{
$this->params['breadcrumbs'][] = 'Наши работы';
}
?>
<section class="works" id="works">
    <div class="width">
        <div class="head clear">
            <h1 class="title exo asphalt"><?=$action=='chastnye-doma'?'Работы в частных домах':($action=='kvartiry'?'Работы в квартирах':'Наши работы')?></h1>
            <div class="tabs">
                <ul>
                    <li class="exo asphalt <?php echo empty($action) ? 'active' : ''; ?>"><a href="<?php echo Yii::$app->urlManager->createUrl('nashi-raboty'); ?>">Все работы</a></li>
                    <li class="exo asphalt <?php echo $action == 'chastnye-doma' ? 'active' : ''; ?>"><a href="<?php echo Yii::$app->urlManager->createUrl('/nashi-raboty/chastnye-doma'); ?>">Частные дома</a></li>
                    <li class="exo asphalt <?php echo $action == 'kvartiry' ? 'active' : ''; ?>"><a href="<?php echo Yii::$app->urlManager->createUrl('nashi-raboty/kvartiry'); ?>">Квартиры</a></li>
                    <li class="exo asphalt" ><a href="<?php echo Yii::$app->urlManager->createUrl('nashi-raboty/video-rabot'); ?>">Видео</a></li>
                </ul>
            </div>
        </div>
        <?if($blog && $blog->active){?>
        <div class="seo_text_field"><?=$blog->text?></div>
        <?}?>
        <div class="wrks clear">
            <?php if (!empty($works)) { ?>
            <?php foreach ($works as $work) {?>
                <a href="<?php echo Url::to(['nashi-raboty/'.$work->url]); ?>">
                    <div class="work">
                        <img src="<?php echo Yii::$app->params['params']['pathToImage'] . Works::IMG_FOLDER . '/work(' . $work->id . ')/prev_' . $work->preview; ?>">
                        <div class="work-title exo"><?php echo $work->title; ?></div>
                        <div class="hover">
                            <div class="hover-title exo"><?php echo $work->title; ?></div>
                            <?php $items = explode(";\n", $work->preview_items); ?>
                            <ul>
                                <li><?php echo implode('</li><li>', $items); ?></li>
                            </ul>
                            <div class="more red exo">Посмотреть работу</div>
                        </div>
                    </div>
                </a>
            <?php } ?>
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