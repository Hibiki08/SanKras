<?php
use app\models\Works;
?>
<section id="our-works">
    <div class="width">
<?php if (!empty($works)) { ?>
    <h4 class="title-big">Наши работы</h4>
    <div class="w1 clear">
        <?php foreach ($works as $work) {?>
            <a href="<?php echo Yii::$app->urlManager->createUrl(['nashi-raboty/'.$work->url]); ?>">
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
    </div>
    <div class="other">
        <a href="<?php echo Yii::$app->urlManager->createUrl('nashi-raboty'); ?>" class="button">Посмотреть все работы</a>
    </div>
<?php } ?>
    </div>
</section>
