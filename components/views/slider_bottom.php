<?php
use app\models\Slides;
?>
<div class="coop">
    <div class="sliderWrapper">
        <div class="Blockswrapper">
            <?php foreach ($sliderBottom as $slide) { ?>
                <div class="wrap">
                    <?php if (!empty($slide->link)) { ?><a href="<?php echo $slide->link; ?>"><?php } ?>
                        <?php if (!empty($slide->text)) { ?>
                            <div class="text">
                                <div class="width">
                                    <?php echo $slide->text; ?>
                                </div>
                            </div>
                        <?php } ?>
                        <img src="<?php echo Yii::$app->params['params']['pathToImage'] . Slides::IMG_FOLDER_SLIDER_BOT . $slide->image; ?>" alt="мы сотрудничаем">
                        <?php if (!empty($slide->link)) { ?></a><?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>