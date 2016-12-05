<?php
use app\models\Slides;
?>
<div class="slider">
    <div class="sliderWrapper">
        <div class="Blockswrapper">
            <?php foreach ($sliderTop as $slide) { ?>
                <div class="wrap">
                    <?php if (!empty($slide->text)) { ?>
                        <div class="text">
                            <div class="width clear">
                                <?php echo $slide->text; ?>
                                <?php if (!empty($slide->link)) { ?>
                                    <a class="more" href="<?php echo $slide->link; ?>"><span>Подробнее</span><div class="img"></div></a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <img src="<?php echo Yii::$app->params['params']['pathToImage'] . Slides::IMG_FOLDER_SLIDER_TOP . $slide->image; ?>" alt="Сантехнические услуги">
                </div>
            <?php } ?>
        </div>
    </div>
</div>