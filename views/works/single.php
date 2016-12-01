<?php
use app\models\Works;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;

$this->title = $work->title;
?>
<section class="work" id="work">
    <div class="width clear">
        <div class="head clear">
            <h2 class="title asphalt"><?php echo $work->title; ?></h2>
            <div class="button-video exo"><span>Видео</span><div class="img"></div></div>
        </div>
        <ul class="pgwSlider">
            <?php foreach ($images as $image) {?>
            <li><img src="<?php echo Yii::$app->params['params']['pathToImage'] . Works::IMG_FOLDER . 'work(' . $image->work_id . ')' . '/mini_slider_' . $image->slide; ?>" alt="<?php echo $image->text; ?>" data-large-src="<?php echo Yii::$app->params['params']['pathToImage'] . Works::IMG_FOLDER . 'work(' . $image->work_id . ')' . '/' . $image->slide; ?>"></li>
            <?php } ?>
        </ul>
    </div>
        <div class="info clear">
            <div class="width clear">
                <div class="block">
                    <div class="text">
                        <div class="briefly">
                            <div class="tr">
                                <span class="bold">Год выполнения:</span><span class="val"><?php echo $work->year; ?></span>
                            </div>
                            <div class="tr">
                                <span class="bold">Раздел:</span><span class="val"><?php echo $work->category->title; ?></span>
                            </div>
                            <div class="tr">
                                <span class="bold">Площадь:</span><span class="val"><?php echo $work->area; ?> м<sup>2</sup></span>
                            </div>
                        </div>
                        <div class="full"><?php echo $work->text; ?></div>
                    </div>
                    <div class="work-items">
                        <div class="title-items exo">В систему входят следующие элементы:</div>
                        <ul>
                            <?php $workItems = explode(";\n", $work->work_items); ?>
                            <li><?php echo implode('</li><li>', $workItems); ?></li>
                        </ul>
                        <div class="cost">
                            <span>Стоимость монтажа — <?php echo $work->cost_install; ?> тыс. руб.</span><br>
                            <span>Стоимость материала — <?php echo $work->cost_material; ?> тыс. руб.</span>
                            <?php if (!empty($work->time)) {?>
                                <br><span>Время выполнения — <?php echo $work->time; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if ($prev && $next != null) { ?>
                        <div class="prev-next">
                            <a href="<?php echo Yii::$app->urlManager->createUrl(['works/single', 'id' => $prev]); ?>" class="prev exo"><div class="img"></div><span>Предыдущая работа</span></a>
                            <a href="<?php echo Yii::$app->urlManager->createUrl(['works/single', 'id' => $next]); ?>" class="next exo"><span>Следующая работа</span><div class="img"></div></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php if (!empty($work->video)) {?>
                <div class="video">
                    <div class="width clear">
                        <iframe width="870" height="490" src="<?php echo $work->video; ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            <?php } ?>
            <?php if ($prev && $next != null) { ?>
                    <?php Pjax::begin([
                        'timeout' => 10000,
                    ]); ?>
                    <div class="other clear">
                        <div class="width">
                            <div class="navig">
                                <a data-pjax=0 href="<?php echo Yii::$app->urlManager->createUrl(['works']); ?>" class="other-title exo asphalt">Все работы</a><br>
                                <?php echo LinkPager::widget([
                                    'options' => [
                                        'class' => 'pagination clear',
                                    ],
                                    'pagination' => $pager,
                                    'prevPageLabel' => '',
                                    'nextPageLabel' => '',
                                    'maxButtonCount' => 0
                                ]); ?>
                            </div>
                            <div class="more-works clear">
                                <?php if (!empty($other)) { ?>
                                    <?php foreach ($other as $val) {?>
                                        <a data-pjax=0 href="<?php echo Yii::$app->urlManager->createUrl(['works/single', 'id' => $val->id]); ?>">
                                            <div class="work">
                                                <img src="<?php echo Yii::$app->params['params']['pathToImage'] . Works::IMG_FOLDER . '/work(' . $val->id . ')/prev_' . $val->preview; ?>">
                                                <div class="work-title exo"><?php echo $val->title; ?></div>
                                                <div class="hover">
                                                    <div class="hover-title exo"><?php echo $val->title; ?></div>
                                                    <?php $items = explode(";\n", $val->preview_items); ?>
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
                    </div>
                    <?php Pjax::end(); ?>
            <?php } ?>
        </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        var pgwSlider = $('.pgwSlider').pgwSlider({
            displayControls: true,
            touchControls: true,
            transitionDuration: 100
        });
        pgwSlider.stopSlide();
    });
    $(document).ready(function() {
        $('.work .pgwSlider ul.ps-list').mCustomScrollbar({
            theme: "dark"
        });
    });
</script>