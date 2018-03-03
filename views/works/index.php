<?php
use yii\widgets\LinkPager;
use app\models\Works;
use yii\helpers\Url;

$this->title = 'Наши работы | Примеры работ по сантехнике';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Примеры работ по сантехнике SanKras'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'примеры сантехнические работы, санкрас сантехнические работы, sankras работы, сантехнические работы в квартире, сантехнические работы частный дом'
]);
$group = Yii::$app->request->get('group');
?>
<section class="works" id="works">
    <div class="width">
        <div class="head clear">
            <h1 class="title exo asphalt">Наши работы</h1>
            <div class="tabs">
                <ul>
                    <li class="exo asphalt <?php echo empty($group) ? 'active' : ''; ?>"><a href="<?php echo Yii::$app->urlManager->createUrl(['works']); ?>">Все работы</a></li>
                    <li class="exo asphalt <?php echo $group == 'house' ? 'active' : ''; ?>"><a href="<?php echo Yii::$app->urlManager->createUrl(['works', 'group' => 'house']); ?>">Частные дома</a></li>
                    <li class="exo asphalt <?php echo $group == 'flat' ? 'active' : ''; ?>"><a href="<?php echo Yii::$app->urlManager->createUrl(['works', 'group' => 'flat']); ?>">Квартиры</a></li>
                    <li class="exo asphalt" ><a href="<?php echo Yii::$app->urlManager->createUrl('works/video'); ?>">Видео</a></li>
                </ul>
            </div>
        </div>
        <div class="wrks clear">
            <?php if (!empty($works)) { ?>
            <?php foreach ($works as $work) {?>
                <a href="<?php echo Url::to(['works/single', 'id' => $work->id]); ?>">
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