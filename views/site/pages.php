<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Services;
use app\models\ServicesSlides;
use app\models\ServicesProjectdocs;
use yii\imagine\Image;
use app\models\Team;

$this->title = $service['tag_title'];
$this->registerMetaTag([
    'name' => 'description',
    'content' => $service['tag_description']
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $service['tag_keywords']
]);
// var_dump($service);
if($parent) $this->params['breadcrumbs'][] = ['label' => $parent['title'], 'url'=> ['/'.$parent['link'].'/']];
$this->params['breadcrumbs'][] = $service['title'];
?>
<div class="pages">
    <header>
        <div class="width">
            <h1><?php echo $service['title']; ?></h1>
            <div class="block">
                <div class="preview">
                    <?php if(!empty($service['image']) || !empty($service['video'])) {
                        if (($service['img_video'] == 1) || ($service['img_video'] == 2 && empty($service['video']))) { ?>
                            <?php echo $this->render('/part/_picture-source-template', [
                                'imagePath' => '/images/pages/page(' . $service->id . ')/' . $service->image,
                                'altText' => $service->title,
                                'class' => 'img-video'
                            ]); ?>
                        <?php } else {
                        if (($service['img_video'] == 2) || ($service['img_video'] == 1 && empty($service['image']))) { ?>
                            <div class="img-video"><?php echo $service['video']; ?></div>
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
                    <div class="loading lazyload"><img class="lazyload" data-src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>spinner4.gif" alt="loading"></div>
                    <div class="visible">
                        <h3><?php echo $service['form_title']; ?></h3>
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
                        ])->hiddenInput(['value' => $service['title']]); ?>
                        <?php echo Html::submitButton('заказать услугу', ['class' => 'pulse']); ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="success">
                        <span class="title">Спасибо за заявку!</span><br>
                        <span>Мы перезвоним вам в течение 15&nbsp;минут для уточнения деталей заказа.</span>
                    </div>
                </div>
                <div class="prev_text sidebar-serviceList js-scroll">
					<h3>Стоимость работ:</h3>
					<?php if ((!empty($service->price) && $service['table_ex'] == 1) ||
						(!empty($service['packages']) && $service['package_ex'] == 1)) { ?>
						<?php if (!empty($service->price) && $service['table_ex'] == 1) { ?>
							<table>
								<?php foreach ($service->price as $price) { ?>
									<?php foreach ($price['prices'] as $item) { ?>
										<tr>
											<td colspan="2"><?php echo $item['title']; ?></td>
										</tr>
										<tr>
											<td><a href="<?=$item['image']?>" rel="gallery2" class="fancy-price"><?php
                                                    echo $this->render('/part/_picture-source-template', [
                                                        'imagePath' => $item->image,
                                                        'altText' => ''
                                                    ]); ?></a></td>
											<td class="price"><b><?php echo number_format($item['price'], 0, "", " "); ?></b> руб.</td>
										</tr>
									<?php } ?>
								<?php } ?>
							</table>
						<?php } ?>
					<?php } ?>
				</div>
            </div>
        </div>
    </header>
    <main>
        <div class="width">
            <?php if($service['projectdocs_active'] && !empty($service->projectdocs)) {?>
                <div class="gallery">
					<header class="flex">
						<h2><?php echo $service['projectdocs_title']; ?></h2>
						<div>
						  <span class="_count"><?=count($service->projectdocs)?></span> <a class="fancy b_all" href="#all1">Посмотреть все</a>
						</div>
					</header>
                    <div class="flexslider2" style="margin:0px 50px 10px">
                        <div class="slides owl-carousel owl-theme">
                            <?php foreach ($service->projectdocs as $doc) {?>
								<?list($width, $height) = getimagesize($_SERVER["DOCUMENT_ROOT"].Yii::$app->params['params']['pathToImage'] . ServicesProjectdocs::IMG_FOLDER . 'page(' . $service['id'] . ')/' . 'mini_slider_' . $doc['image']);?>
                                <div class="item" style="width:<?=$width?>px">
                                    <a class="fancy" rel="carousel1" href="/images/projectdocs/<?php echo 'page(' . $service['id'] . ')/' . $doc['image']; ?>" title="<?php echo $doc['name']; ?>">
                                        <?php echo $this->render('/part/_picture-source-template', [
                                            'imagePath' => '/images/projectdocs/page(' . $service->id . ')/' . 'mini_slider_' . $doc->image,
                                            'altText' => $doc->name
                                        ]); ?>
                                    </a>
									<div class="name">
										<b><?php echo $doc['name']; ?></b>
										<span><?php echo $doc['description']; ?></span>
									</div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div style="display:none">
                      <div class="all" id="all1">
                        <div style="text-align:center">
                          <strong><?=$service['title'];?></strong><br>
                          <span class="_count"><?=count($service->projectdocs)?> фотографии</span>
                        </div>
							<?php foreach ($service->projectdocs as $doc) { ?>
                                <div class="wrap">
                                    <a class="fancy" rel="carousel1" href="/images/projectdocs/<?php echo 'page('
                                        . $service->id . ')/' . $doc->image; ?>" title="<?php echo $doc->name; ?>">
                                        <?php echo $this->render('/part/_picture-source-template', [
                                            'imagePath' => '/images/projectdocs/page(' . $service->id . ')/'
                                                . 'mini_slider_' . $doc->image,
                                            'altText' => $doc->name
                                        ]); ?>
                                    </a>
                                </div>
                            <?php } ?>
                      </div>
                    </div>
                </div>
            <?php } ?>
            <?php if(!empty($service->slides)) {?>
                <div class="gallery">
					<header class="flex">
						<h2><?php echo $service['gallery_title']; ?></h2>
						<div>
						  <span class="_count"><?=count($service->slides)?></span> <a class="fancy b_all" href="#all2">Посмотреть все</a>
						</div>
					</header>
                    <div class="flexslider" style="margin:0px 50px 10px;">
                        <ul class="slides">
                            <?php foreach ($service->slides as $slide) {?>
                                <li>
                                    <a class="fancy" rel="carousel2" href="/images/sliders/pages/page(<?php
                                    echo $service->id . ')/' . $slide->slide; ?>" title="<?php echo $slide->text; ?>">
                                        <?php echo $this->render('/part/_picture-source-template', [
                                            'imagePath' => '/images/sliders/pages/page(' . $service->id . ')/'
                                                . 'mini_slider_' . $slide->slide,
                                            'altText' => $slide->text
                                        ]); ?>
                                    </a>
									<div class="name">
										<b><?php echo $slide['text']; ?></b>
										<span><?php echo $slide['description']; ?></span>
									</div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div style="display:none">
                      <div class="all" id="all2">
                        <div style="text-align:center">
                          <strong><?=$service['title'];?></strong><br>
                          <span class="_count"><?=count($service->slides)?> фотографии</span>
                        </div>
							<?php foreach ($service->slides as $slide) { ?>
                                <div class="wrap">
                                    <a class="fancy" rel="carousel2" href="/images/sliders/pages/<?php
                                    echo 'page(' . $service['id'] . ')/' . $slide->slide; ?>" title="<?php echo $slide->text; ?>">
                                        <?php echo $this->render('/part/_picture-source-template', [
                                            'imagePath' => '/images/sliders/pages/page(' . $service->id . ')/'
                                            . 'mini_slider_' . $slide->slide,
                                            'altText' => $slide->text
                                        ]); ?>
                                    </a>
                                </div>
                            <?php } ?>
                      </div>
                    </div>
                </div>
            <?php } ?>
            <?php if($service->videos_show) { ?>
                <div class="gallery">
					<header class="flex">
						<h2>Видео работ</h2>
						<div>
						  <span class="_count"><?=count($service->videos)?></span> <a class="fancy b_all" href="#all3">Посмотреть все</a>
						</div>
					</header>
                    <div class="flexslider" style="margin:0px 50px 10px;">
                        <ul class="slides">
                            <?php foreach ($service->videos as $key => $v) {?>
                                <li>
                                    <iframe src="https://www.youtube.com/embed/<?=$v[1]?>?showinfo=0&iv_load_policy=3&modestbranding=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
									<div class="name">
										<b><?php echo $v[0]; ?></b>
										<span><?php echo $service->videos_name[$key]; ?></span>
									</div>
                                </li>
                            <?php } ?>
							<?if(count($service->videos) < 3) {
								for($i = count($service->videos); $i < 3; $i++)
								echo '<li>' . $this->render('/part/_picture-source-template', [
                                            'imagePath' => 'images/system/default-video.png',
                                            'altText' => ''
                                        ]) . '</li>';
							}?>
                        </ul>
                    </div>
                    <div style="display:none">
                      <div class="all" id="all3">
                        <div style="text-align:center">
                          <strong>Видео работ</strong><br>
                          <span class="_count"><?=count($service->videos)?> видео</span>
                        </div>
							<?php foreach ($service->videos as $v) { ?>
                                <div class="wrap">
                                    <iframe src="https://www.youtube.com/embed/<?=$v[1]?>?showinfo=0&iv_load_policy=3&modestbranding=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            <?php } ?>
                      </div>
                    </div>
                </div>
            <?php } ?>
            <?php if (!empty($service['main_text'])) { ?>
                <div class="content page-widget">
                        <div class="main-text"><?php echo $service['main_text']; ?></div>
                    <?php if (!empty($service['work_text'])) { ?>
                        <div class="work-text">
							<h3>Поделиться:</h3>
							<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
							<script src="https://yastatic.net/share2/share.js"></script>
							<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki"></div>
							<br>
							<div class="opinions-wrapper">
								<div class="layout"></div>
								<div class="google-reviews" style="display:none"><h3>Отзывы Google</h3><a href="https://www.google.com/search?q=%D1%81%D0%B0%D0%BD%D0%BA%D1%80%D0%B0%D1%81&oq=%D1%81%D0%B0%D0%BD&aqs=chrome.0.69i59j69i57j69i59l2j0j69i61l3.1106j0j7&sourceid=chrome&ie=UTF-8#lrd=0x40f041ae603d412b:0xac151144a9732c31,1,,," target="_blank">Смотреть все</a><div id="GReviewsContent"></div></div>
								<div class="opinions">
									<div class="opinions-head">Нас рекомендуют!</div>
									<div class="GRating">
										<span id="starsGReviews"></span> <a href="#" class="showGReviews"><span id="googleCountReviews"></span> отзывов</a>
									</div>
									<div class="opinions-desc">Более половины новых<br>клиентов приходят к нам<br>по рекомендации от своих<br>друзей и знакомых. <b>Читайте<br>отзывы о компании СанКрас!</b></div>
                                    <?php echo $this->render('/part/_picture-source-template', [
                                        'imagePath' => '/images/system/opinions.png',
                                        'altText' => '',
                                        'class' => 'opinions-img'
                                    ]); ?>
									<a href="https://www.google.com/search?q=%D1%81%D0%B0%D0%BD%D0%BA%D1%80%D0%B0%D1%81&oq=%D1%81%D0%B0%D0%BD&aqs=chrome.0.69i59j69i57j69i59l2j0j69i61l3.1106j0j7&sourceid=chrome&ie=UTF-8#lrd=0x40f041ae603d412b:0xac151144a9732c31,1,,," target="_blank" class="opinions-link">Читать отзывы</a>
								</div>
								<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDLBlB4Ee1GwjoyYFafHHirrnTtA1_9Zpc&libraries=places"></script>
								<script src="/lib/google-reviews/google-reviews.js"></script>
								<script>
									$(document).ready(function() {
										$("#GReviewsContent").googlePlaces({placeId:"ChIJK0E9YK5B8EARMSxzqUQRFaw"});
									});
								</script>
							</div>
							<br>
							<h3>Наша команда:</h3>
							<div class="teams-wrapper">
								<div class="teams">
									<?php foreach ($team as $tm) {?>
										<div class="tm">
                                            <?php echo $this->render('/part/_picture-source-template', [
                                                'imagePath' => '/images/team/team(' . $tm->id . ')/team_' . $tm->img,
                                                'altText' => 'Команда'
                                            ]); ?>
											<div class="description">
												<div class="name"><?php echo $tm->name; ?>,</div>
												<div class="desc"> <?php echo $tm->post; ?></div>
											</div>
										</div>
									<?php } ?>
								</div>
								<a href="#" class="showMoreTeam"><span>Развернуть список</span><span>Свернуть список</span></a>
							</div>
							<br>
							<?php echo $service['work_text']; ?>
						</div>
                        <?php } ?>
                </div>
            <?php } ?>
        </div>
            <?php if ((!empty($service->price) && $service['table_ex'] == 1) ||
                (!empty($service['packages']) && $service['package_ex'] == 1)) { ?>
                <div class="prices">
                    <div class="width">
                        <h2><?php echo $service['price_title']; ?></h2>
                        <?php if (!empty($service->price) && $service['table_ex'] == 1) { ?>
                            <div class="table">
                                <table>
                                    <tr class="sub-title">
                                        <td>Услуга</td>
                                        <td>Ед.</td>
                                        <td class="table-cost">Стоимость</td>
                                    </tr>
                                    <?php foreach ($service->price as $price) { ?>
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
                        <?php if (!empty($service['packages']) && $service['package_ex'] == 1) { ?>
                            <div class="packages">
                                <?php echo $service['packages']; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <?php if ($service['benefits'] == 1) { ?>
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
                    <div class="loading"><img data-src="<?php echo Yii::$app->params['params']['pathToImageSystem']; ?>spinner4.gif" alt="loading"></div>
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
                            'template' => '<div class="field"><img class="lazyload" data-src="' . Yii::$app->params['params']['pathToImageSystem'] . 'main-name.png' . '" alt="ваше имя" title="ваше имя">{input}{error}</div>',
                        ])->input('text', [
                            'class' => 'focus',
                            'placeholder' => 'Ваше имя*'
                        ]); ?>
                        <?php echo $form->field($letter, 'phone', [
                            'template' => '<div class="field"><img class="lazyload" data-src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-phone-grey.png' . '" alt="ваш телефон" title="ваш телефон">{input}{error}</div>',
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
                        ])->hiddenInput(['value' => $service['title']]); ?>
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
<?php if(!empty($service->slides) || !empty($service->projectdocs) || !empty($service->videos_show)) { ?>
<link rel="stylesheet" href="/lib/OwlCarousel/css/owl.carousel.min.css">
<link rel="stylesheet" href="/lib/OwlCarousel/css/owl.theme.default.min.css">
<script src="/lib/OwlCarousel/js/owl.carousel.js"></script>
<script type="text/javascript">
    $(window).load(function() {
        $('.flexslider').flexslider({
          slideshow: false,
          animation:'slide',
          animationSpeed:0,
          controlNav: false,
          maxItems:3,
          itemWidth: 340,
          itemMargin: 30,
        });
		$('.owl-carousel').owlCarousel({
			margin:15,
			loop:true,
			autoWidth:true,
			items:4,
			nav: true,
			dots: false
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
		$('a.fancy-price').fancybox({
            openEffect	: 'elastic',
            titleShow : true,
            helpers : {
                title : {
                    type : 'inside'
                }
            }
		});
		$(".showMoreTeam").click(function(e) {
			e.preventDefault();
			
			$(this).toggleClass("active").siblings(".teams").toggleClass("active");
		});
        setTimeout('yaCounter39483720.reachGoal("minuta<?php echo $service['id']; ?>");', 60000);
		$(".showGReviews").click(function(e) {
			e.preventDefault();
			
			$(".google-reviews").fadeIn();
			$(".layout").fadeIn();
		});
		$(".layout").click(function(e) {
			e.preventDefault();
			
			$(".google-reviews").fadeOut();
			$(".layout").fadeOut();
		});

    });
</script>
    <script type="text/javascript">
        $('.js-scroll').perfectScrollbar();
    </script>
<?php } ?>