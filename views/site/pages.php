<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Services;
use app\models\ServicesSlides;

$this->title = $options['tag_title'];
$this->registerMetaTag([
    'name' => 'description',
    'content' => $options['tag_description']
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $options['tag_keywords']
]);
// var_dump($options);
if($parent) $this->params['breadcrumbs'][] = ['label' => $parent['title'], 'url'=> ['/'.$parent['link'].'/']];
$this->params['breadcrumbs'][] = $options['title'];
?>
<div class="pages">
    <header>
        <div class="width">
            <h1><?php echo $options['title']; ?></h1>
            <div class="block">
                <div class="preview">
                    <?php if(!empty($options['image']) || !empty($options['video'])) {
                        if (($options['img_video'] == 1) || ($options['img_video'] == 2 && empty($options['video']))) { ?>
                            <img class="img-video" src="<?php echo Yii::$app->params['params']['pathToImage'] . Services::IMG_FOLDER . 'page(' . $options['id'] . ')/' . $options['image']; ?>" alt="<?php echo $options['title']; ?>">
                        <?php } else {
                        if (($options['img_video'] == 2) || ($options['img_video'] == 1 && empty($options['image']))) { ?>
                            <div class="img-video"><?php echo $options['video']; ?></div>
                        <?php }}
                    } ?>
                    <footer>
                        <div>Выезд бесплатно</div>
                        <div>В удобное время</div>
                        <div>Гарантия до 5&nbsp;лет</div>
                    </footer>
                </div>
                <div class="form">
                    <div class="close"></div>
                    <div class="loading"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>spinner4.gif" alt="loading"></div>
                    <div class="visible">
                        <h3><?php echo $options['form_title']; ?></h3>
                        <?php $form = ActiveForm::begin([
                            'enableAjaxValidation' => false,
                            'enableClientValidation' => true,
                            'options' => [
                                'id' => 'form_service',
                            ]
                        ]);?>
                        <?php echo $form->field($letter, 'name', [
                            'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'main-name.png' . '" alt="ваше имя" title="ваше имя">{input}{error}</div>',
                        ])->input('text', [
                            'class' => 'focus',
                            'placeholder' => 'Ваше имя*'
                        ]); ?>
                        <?php echo $form->field($letter, 'phone', [
                            'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-phone-grey.png' . '" alt="ваш телефон" title="ваш телефон">{input}{error}</div>',
                        ])->input('text', [
                            'class' => 'phone-mask',
                            'placeholder' => 'Ваш телефон*'
                        ]); ?>
                        <?php echo $form->field($letter, 'agree',['template' =>'<label>{input} Согласен(на) на обработку персональных данных в соответствии с <a href="/politika-konfidencialnosti">Политикой конфеденциальности</a></label>{error}' ])->input('checkbox', [
                            'value' => '1',
                            'checked' => 'checked',
                            'class' => '_argee'
                        ]); ?>
                        <?php echo $form->field($letter, 'hidden', [
                            'template' => '{input}',
                        ])->hiddenInput(['value' => $options['title']]); ?>
                        <?php echo Html::submitButton('заказать услугу', ['class' => 'pulse']); ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="success">
                        <span class="title">Спасибо за заявку!</span><br>
                        <span>Мы перезвоним вам в течение 15&nbsp;минут для уточнения деталей заказа.</span>
                    </div>
                </div>
                <div class="prev_text"><?php echo $options['prev_field']; ?></div>
            </div>
        </div>
    </header>
    <main>
        <div class="width">
            <?php if(!empty($options->slides)) { $c = 0;?>
                <div class="gallery">
                    <h2><?php echo $options['gallery_title']; ?></h2>
                    <div class="flexslider" style="margin:0px 50px 10px;">
                        <ul class="slides">
                            <?php foreach ($options->slides as $slide) { $c++;?>
                                <li>
                                    <a class="fancy" rel="carousel2" href="<?php echo Yii::$app->params['params']['pathToImage'] . ServicesSlides::IMG_FOLDER . 'page(' . $options['id'] . ')/' . $slide['slide']; ?>" title="<?php echo $slide['text']; ?>">
                                        <img src="<?php echo Yii::$app->params['params']['pathToImage'] . ServicesSlides::IMG_FOLDER . 'page(' . $options['id'] . ')/' . $slide['slide']; ?>"  alt="<?php echo $slide['text']; ?>"/>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div style="text-align:right;margin-top:10px;">
                      <span class="_count"><?=$c?></span> <a class="fancy b_all" href="#all">Посмотреть все</a>
                    </div>
                    <div style="display:none">
                      <div id="all">
                        <div style="text-align:center">
                          <strong><?=$options['title'];?></strong><br>
                          <span class="_count"><?=$c?> фотографии</span>
                        </div>
                      <?php foreach ($options->slides as $slide) { ?>
                                <div class="wrap">
                                    <a class="fancy" rel="carousel2" href="<?php echo Yii::$app->params['params']['pathToImage'] . ServicesSlides::IMG_FOLDER . 'page(' . $options['id'] . ')/' . $slide['slide']; ?>" title="<?php echo $slide['text']; ?>">
                                        <img src="<?php echo Yii::$app->params['params']['pathToImage'] . ServicesSlides::IMG_FOLDER . 'page(' . $options['id'] . ')/' . 'mini_slider_' . $slide['slide']; ?>"  alt="<?php echo $slide['text']; ?>"/>
                                    </a>
                                </div>
                            <?php } ?>
                      </div>
                    </div>
                </div>
            <?php } ?>
            <?php if($options->videos_show) { ?>
                <div class="gallery" style="margin-top:30px;">
                    <h2>Видео работ</h2>
                    <div class="video_gallary"><!--
                    <?foreach($options->videos as $v){?>
                      --><div>
                        <div><iframe src="https://www.youtube.com/embed/<?=$v[1]?>?showinfo=0&iv_load_policy=3&modestbranding=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                        <div><?=$v[0]?></div>
                      </div><!--
                    <?}?>
                    --></div>
                </div>
            <?php } ?>
            <?php if (!empty($options['main_text'])) { ?>
                <div class="content">
                        <div class="main-text"><?php echo $options['main_text']; ?></div>
                    <?php if (!empty($options['work_text'])) { ?>
                        <div class="work-text"><?php echo $options['work_text']; ?></div>
                        <?php } ?>
                </div>
            <?php } ?>
        </div>
            <?php if ((!empty($options->price) && $options['table_ex'] == 1) ||
                (!empty($options['packages']) && $options['package_ex'] == 1)) { ?>
                <div class="prices">
                    <div class="width">
                        <h2><?php echo $options['price_title']; ?></h2>
                        <?php if (!empty($options->price) && $options['table_ex'] == 1) { ?>
                            <div class="table">
                                <table>
                                    <tr class="sub-title">
                                        <td>Услуга</td>
                                        <td>Ед.</td>
                                        <td class="table-cost">Стоимость</td>
                                    </tr>
                                    <?php foreach ($options->price as $price) { ?>
                                        <?php foreach ($price['prices'] as $item) { ?>
                                            <tr class="transition">
                                                <td><?php echo $item['title']; ?></td>
                                                <td class="table-unit"><?php echo $item['unit']; ?></td>
                                                <td class="table-price"><?php echo $item['price']; ?> <span>руб.</span></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </table>
                            </div>
                        <?php } ?>
                        <?php if (!empty($options['packages']) && $options['package_ex'] == 1) { ?>
                            <div class="packages">
                                <?php echo $options['packages']; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <?php if ($options['benefits'] == 1) { ?>
                <div class="benefits">
                    <div class="width">
                        <h3>Оцените преимущества работы с компетентными мастерами:</h3>
                        <div class="one">
                            <div>
                                <div class="title">Выполнение работы быстро и в поставленные сроки</div>
                                <div class="text">Мы берем на себя все обязательства по выполнению работ от начала до конца и решаем все возникающие в ходе монтажа вопросы. Вам не придется решать организационные вопросы, мы сами бесплатно доставим материал на объект и согласуем все этапы монтажа с другими бригадами (например, с бригадами по отделке). Благодаря этому не возникнет организационного беспорядка, и работа будет сдана в оговоренные сроки.</div>
                            </div>
                            <div>
                                <div class="title">12% скидка на материал и 10% скидка на монтаж для постоянных клиентов</div>
                                <div class="text">Монтаж "под ключ" выгоднее найма отдельных специалистов, так как мы даем дополнительные скидки на монтаж при большом объеме работ.</div>
                            </div>
                        </div>
                        <div class="two">
                            <div>
                                <div class="title">Прозрачная единая смета на стоимость всех работ</div>
                                <div class="text">Мы выполняем весь комплекс работ по разводке сантехнических  коммуникаций и вносим их стоимость в единую смету. Она согласовывается с вами до начала работ, поэтому вы заранее точно знаете стоимость монтажа.</div>
                            </div>
                            <div class="fl">
                                <div class="title">Бесплатное гарантийное устранение неисправностей</div>
                                <div class="text">В случае возникновения неисправностей в системе мы исправим все бесплатно в рамках гарантийного договора.</div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <div class="question">
            <div class="width">
                <div class="master">
                    <div class="name">Артем Алексеевич</div>
                    <div>Инженер сантехнических коммуникаций, стаж работы более 9 лет</div>
                </div>
                <div class="form">
                    <div class="close"></div>
                    <div class="loading"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>spinner4.gif" alt="loading"></div>
                    <div class="visible">
                        <h3>Остались вопросы?</h3>
                        <span>Заполните форму, мастер перезвонит<br>вам и поможет найти решение!</span>
                        <?php $form = ActiveForm::begin([
                            'enableAjaxValidation' => false,
                            'enableClientValidation' => true,
                            'options' => [
                                'id' => 'form_question',
                            ]
                        ]);?>
                        <?php echo $form->field($letter, 'name', [
                            'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'main-name.png' . '" alt="ваше имя" title="ваше имя">{input}{error}</div>',
                        ])->input('text', [
                            'class' => 'focus',
                            'placeholder' => 'Ваше имя*'
                        ]); ?>
                        <?php echo $form->field($letter, 'phone', [
                            'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-phone-grey.png' . '" alt="ваш телефон" title="ваш телефон">{input}{error}</div>',
                        ])->input('text', [
                            'class' => 'phone-mask',
                            'placeholder' => 'Ваш телефон*'
                        ]); ?>
                        <?php echo $form->field($letter, 'agree',['template' =>'<label>{input} Согласен(на) на обработку персональных данных в соответствии с <a href="/politika-konfidencialnosti">Политикой конфеденциальности</a></label>{error}' ])->input('checkbox', [
                            'value' => '1',
                            'checked' => 'checked',
                            'class' => '_argee'
                        ]); ?>
                        <?php echo $form->field($letter, 'hidden', [
                            'template' => '{input}',
                        ])->hiddenInput(['value' => $options['title']]); ?>
                        <?php echo Html::submitButton('Задать вопрос мастеру', ['class' => 'pulse']); ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="success">
                        <span class="title">Спасибо за заявку!</span><br>
                        <span>Мастер перезвонит вам в&nbsp;течение 15&nbsp;минут и с&nbsp;удовольствием ответит<br>на все ваши вопросы.</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<?php if(!empty($options->slides)) { ?>
<script type="text/javascript">
    $(window).load(function() {
        $('.flexslider').flexslider({
          slideshow: false,
          animation:'slide',
          animationSpeed:0,
          controlNav: false,
          maxItems:3,
          itemWidth: 310,
          itemMargin: 40,
        });
        $("a.fancy").fancybox({
            openEffect	: 'elastic',
            titleShow : true,
            helpers : {
                title : {
                    type : 'inside'
                }
            }
        });
        setTimeout('yaCounter39483720.reachGoal("minuta<?php echo $options['id']; ?>");', 60000);
    });
</script>
<?php } ?>