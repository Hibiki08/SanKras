<?php
use app\models\Opinions;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\StringHelper;

$this->title = 'Отзывы о компании СанКрас: 50% заказов приходят к нам по рекомендации';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Читайте отзывы о компании СанКрас: почему в "мертвый сезон" мы не сидим без работы? Доля заказов через "сарафанное радио" составляет более 50%. Почему нас рекомендуют.'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'отзывы компания санкрас'
]);

$this->params['breadcrumbs'][] = ['label' => 'О нас', 'url'=> ['/about/']];
$this->params['breadcrumbs'][] = 'Отзывы';
?>

<section class="opinions" id="opinions">
    <div class="width">
        <div class="head">
            <div class="tabs">
                <ul>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/'); ?>">О нас</a></li>
                    <li class="exo asphalt active"><a href="<?php echo Yii::$app->urlManager->createUrl('about/opinions'); ?>">Отзывы</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/news'); ?>">Новости</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/articles'); ?>">Статьи</a></li>
                </ul>
            </div>
            <h1 class="title exo asphalt">Отзывы</h1>
            <div class="review-description clear">
                <div class="review-description__left">
                    <p>Почему мы не сидим без работы зимой, в "мертвый сезон" для многих сантехнических компаний?</p>
                    <p>Клиенты рекомендуют нас своим друзьям и знакомым: более 50% заказов приходят через "сарафанное радио".</p>
                </div>
                <div class="review-description__right">
                    <a href="#reviews-block" class="review-description-btn">написать отзыв</a>
                </div>
            </div>
        </div>
        <div class="opin-block clear">
            <div class="opinion">
                <?php if (!empty($opinions)) { ?>
                    <?php foreach ($opinions as $opinion) { ?>
                        <div class="op">
                            <!--<figure>
                                <img src="<?php /*echo Yii::$app->params['params']['pathToImage'] . Opinions::IMG_FOLDER . 'opinion(' . $opinion->id . ')/' . $opinion->photo; */?>" alt="отзыв" title="отзыв">
                            </figure>-->
                            <div class="name-with-rating">
                                <div class="rating-stars">
                                    <div class="star">
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star_border</i>
                                    </div>
                                </div>
                                <div class="name-review">Николай Дрига</div>
                                <div class="date-review">28.02.2016</div>
                            </div>
                            <div class="text">
                                <!--<span class="title"><span class="red"><?php /*echo $opinion->name; */?>,</span> <?php /*echo $opinion->description; */?></span>
                                <p class="full"><?php /*echo $opinion->text; */?><span class="more asphalt">Свернуть</span></p>
                                <?php /*$length = iconv_strlen($opinion->text, 'UTF-8'); */?>
                                <p class="short"><?php /*echo StringHelper::truncate($opinion->text, 300, '...'); */?><?php /*echo $length > 300 ? '<span class="more asphalt">Читать полностью</span>' : ''; */?></p>-->
                                <div class="title">Монтаж отопления частного дома</div>
                                <p class="full">Долгое время я искал специалиста по сантехнике, на которого можно положиться. Надоедало постоянно перепроверять работу и тратить время на то, чтобы держать все под контролем. С Артемом познакомился на одном из объектов. Сразу понравилось как он подходит к монтажу: работы ведутся по проекту, ребята имеют весь необходимый инструмент, работают в защитной экипировке, быстро решают возникающие организационные вопросы. По привычке я все перепроверял, но быстро понял что в этом нет необходимости, возникло доверие и желание... сотрудничать. Совместно мы выполнили несколько десятков объктов, за это время ни разу не были сорваны сроки, претензий от заказчиков не поступало. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, quia!<span class="more asphalt">Свернуть</span></p>
                                <p class="short">Долгое время я искал специалиста по сантехнике, на которого можно положиться. Надоедало постоянно перепроверять работу и тратить время на то, чтобы держать все под контролем. С Артемом познакомился на одном из объектов. Сразу понравилось как он подходит к монтажу: работы ведутся по проекту, ребята имеют весь необходимый инструмент, работают в защитной экипировке, быстро решают возникающие организационные вопросы. По привычке я все перепроверял, но быстро понял что в этом нет необходимости, возникло доверие и желание... сотрудничать. Совместно мы выполнили несколько десятков объктов, за это время ни разу не были сорваны сроки, претензий от заказчиков не поступало.<span class="more asphalt">Читать полностью</span></p>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
                <div class="pagination">
                    <?php echo LinkPager::widget([
                        'pagination' => $pager,
                        'prevPageLabel' => '',
                        'nextPageLabel' => '',
                        'maxButtonCount' => 5
                    ]); ?>
                </div>
            </div>
            <!--<div class="form">
                <div class="close"></div>
                <div class="loading"><img src="<?php /*echo Yii::$app->params['params']['pathToImageSystem'] . 'spinner25.gif'; */?>" alt="loading"></div>
                <span class="exo title">Написать отзыв:</span><div class="close"></div>
                <div class="loading"><img src="<?php /*echo Yii::$app->params['params']['pathToImageSystem'] . 'spinner25.gif'; */?>" alt="loading"></div>
                <?php /*$form = ActiveForm::begin([
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
                    'options' => [
                        'id' => 'opinions-form',
                    ]
                ]);*/?>
                <?php /*echo $form->field($opins, 'name', [
                    'template' => '<div class="field name"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-name.png' . '" alt="ваше имя" title="ваше имя">{input}{error}</div>',
                ])->input('text', [
                    'class' => 'focus',
                    'placeholder' => 'Ваше имя*'
                ]); */?>
                <?php /*echo $form->field($opins, 'description', [
                    'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'more.png' . '" alt="кем вы являетесь" title="описание">{input}</div>',
                ])->input('text', [
                    'class' => 'focus',
                    'placeholder' => 'Кем вы являетесь'
                ]); */?>
                <div class="description">Например: владелец частного дома, застройщик</div>
                <?php /*echo $form->field($opins, 'photo', [
                    'template' => '<div class="field photo"><label><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'photo.png' . '" alt="фото" title="добавить фото"><div class="false-input">Ваше фото</div>{input}</label>{error}</div>',
                ])->fileInput()->label('Ваше фото'); */?>
                <?php /*echo $form->field($opins, 'text', [
                    'template' => '<div class="field textarea"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-message.png' . '" alt="написать" title="написать">{label}{input}{error}</div>',
                ])->textarea()->label('Ваш отзыв*'); */?>
                <span>*обязательные поля; ваши данные не будут переданы третьим лицам</span>
                <?php /*echo Html::submitButton('Отправить', ['class' => 'pulse']); */?>
                <div class="success">
                    <span class="exo title">Спасибо за ваш отзыв!</span><br>
                    <span><span class="thank">Благодарим вас<br>за потраченное время!</span> Нам<br>очень важно ваше мнение.</span>
                    <span>Ваш отзыв отправлен. В скором<br>времени он появится на сайте.</span>
                </div>
                <?php /*ActiveForm::end(); */?>
            </div>-->
        </div>
    </div>
    <div class="reviews-block" id="reviews-block">
        <div class="width">
            <?php $form = ActiveForm::begin([
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'options' => [
                    'id' => 'opinions-form',
                    'class' => 'clear',
                ]
            ]);?>

            <div class="reviews-block__left">
                <div class="reviews-block__title">Напишите отзыв</div>
                <div class="reviews-block__text">
                    <p>Мы стремимся улучшать качество наших услуг, поэтому нам важно знать ваше мнение. </p>
                    <p class="last-text-block">Напишите, пожалуйста, что вам понравилось, или что вы хотели бы улучшить в нашей работе.</p>
                    <?php echo $form->field($opins, 'name', [
                        'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'main-name.png' . '" alt="ваше имя" title="ваше имя">{input}{error}</div>',
                    ])->input('text', [
                        'class' => 'focus',
                        'placeholder' => 'Ваше имя*'
                    ]); ?>

                    <div class="form-group field-editopinionsform-name required">
                        <div class="field name">
                            <img src="/images/system/rating-icon.png" alt="оценка" title="оценка">
                            <div class="rating-stars">
                                <div class="star">
                                    <i class="material-icons">star</i>
                                    <i class="material-icons">star</i>
                                    <i class="material-icons">star</i>
                                    <i class="material-icons">star</i>
                                    <i class="material-icons">star_border</i>
                                </div>
                            </div>
                            <div class="help-block"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="reviews-block__right">
            <?php echo $form->field($opins, 'description', [
                'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'service-icon.png' . '" alt="Вид предоставленной услуги" title="Вид предоставленной услуги">{input}</div>',
            ])->input('text', [
                'class' => 'focus',
                'placeholder' => 'Вид предоставленной услуги*'
            ]); ?>
            <div class="description">Например: монтаж отопления в частном доме; обвязка скважины и монтаж системы водоочистки</div>
            <?php echo $form->field($opins, 'text', [
                'template' => '<div class="field textarea"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'pen-icon.png' . '" alt="написать" title="написать">{label}{input}{error}</div>',
            ])->textarea()->label('Ваш отзыв*'); ?>
                <span class="required-fields">*обязательные поля</span>
            <?php echo Html::submitButton('Отправить отзыв', ['class' => 'pulse']); ?>
            <div class="success">
                <span class="exo title">Спасибо за ваш отзыв!</span><br><br>
                <span><span class="thank">Благодарим вас<br>за потраченное время!</span> Нам<br>очень важно ваше мнение.</span>
                <span>Ваш отзыв отправлен. В скором<br>времени он появится на сайте.</span>
            </div>
            <?php ActiveForm::end(); ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>

</section>
<script type="text/javascript">
    <?php if (isset($_SESSION['success'])) {?>
    var opinions = $('#opinions');
    $('.form *:not(.close):not(.loading):not(.loading img)').css('visibility', 'hidden');
    $('.form .success, .form .close').css('display', 'block');
    $('.form .success span').css('visibility', 'visible');
    $('.form .loading').css('display', 'none');
    <?php } ?>
    $(document).ready(function() {
        $('.text .short .more').click(function() {
            $(this).parent('.short').css('display', 'none');
            $(this).parents('.text').find('.full').css('display', 'block');
        });
        $('.text .full .more').click(function() {
            $(this).parent('.full').css('display', 'none');
            $(this).parents('.text').find('.short').css('display', 'block');
        });
        $('.form input[type=file]').change(function() {
            var file = $(this).val();
            if (file.indexOf('\\') > -1) {
                file = file.split('\\');
            }
            if (file.indexOf('/') > -1) {
                file = file.split('/');
            }

            file = file.slice(-1);
            file = file.join('');

            if (file.length > 0) {
                if (file.length > 25) {
                    var first = file.slice(1, 10);
                    var last = file.slice(-10);
                    file = first + '...' + last;
                }
                $(this).parent('label').find('.false-input').text(file);
            }
        });
    });
</script>
<?php unset($_SESSION['success']);?>
