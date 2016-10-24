<?php
use app\models\Works;
use yii\widgets\Pjax;
use yii\helpers\Html;
?>
<?php Pjax::begin(); ?>
<div class="other">
    <div class="navig">
        <div class="prev-work"></div>
        <div class="other-title">Другие работы</div>
        <div class="next-work"></div>
        <?php echo Html::a("Дальше", ['works/single', 'id' => $id], ['class' => 'next-other']);?>
    </div>
    <div class="more-works">
        <?php if (!empty($works)) { ?>
            <?php foreach ($works as $work) {?>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['works/single', 'id' => $work->id]); ?>">
                    <div class="work">
                        <img src="<?php echo Yii::$app->params['params']['pathToImage'] . Works::IMG_FOLDER . '/work(' . $work->id . ')/prev_' . $work->preview; ?>">
                        <div class="work-title exo"><?php echo $work->title; ?></div>
                        <div class="hover">
                            <div class="hover-title exo"><?php echo $work->title; ?></div>
                            <?php $items = explode(",\n", $work->preview_items); ?>
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
</div>
<?php Pjax::end(); ?>
