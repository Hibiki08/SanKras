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

$this->params['breadcrumbs'][] = 'Отзывы';
?>
<section class="opinions" id="opinions">
    <div class="width">
        <div class="head">
           <? /*<div class="tabs">
                <ul>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/'); ?>">О нас</a></li>
                    <li class="exo asphalt active"><a href="<?php echo Yii::$app->urlManager->createUrl('about/opinions'); ?>">Отзывы</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/news'); ?>">Новости</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/articles'); ?>">Статьи</a></li>
                </ul>
            </div>*/?>
            <h1 class="title exo asphalt">Отзывы</h1>
        </div>
        <div class="opin-block clear">
            <div class="opinion">
                <?php if (!empty($opinions)) { ?>
                    <?php foreach ($opinions as $opinion) { ?>
                        <div class="op">
                            <figure>
                                <img src="<?php echo Yii::$app->params['params']['pathToImage'] . Opinions::IMG_FOLDER . 'opinion(' . $opinion->id . ')/' . $opinion->photo; ?>" alt="отзыв" title="отзыв">
                            </figure>
                            <div class="text">
                                <span class="title"><span class="red"><?php echo $opinion->name; ?>,</span> <?php echo $opinion->description; ?></span>
                                <p class="full"><?php echo $opinion->text; ?><span class="more asphalt">Свернуть</span></p>
                                <?php $length = iconv_strlen($opinion->text, 'UTF-8'); ?>
                                <p class="short"><?php echo StringHelper::truncate($opinion->text, 300, '...'); ?><?php echo $length > 300 ? '<span class="more asphalt">Читать полностью</span>' : ''; ?></p>
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
            <div class="form">
                <div class="close"></div>
                <div class="loading"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'spinner25.gif'; ?>" alt="loading"></div>
                <span class="exo title">Написать отзыв:</span>
                <?php $form = ActiveForm::begin([
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
                    'options' => [
                        'id' => 'opinions-form',
                    ]
                ]);?>
                <?php echo $form->field($opins, 'name', [
                    'template' => '<div class="field name"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-name.png' . '" alt="ваше имя" title="ваше имя">{input}{error}</div>',
                ])->input('text', [
                    'class' => 'focus',
                    'placeholder' => 'Ваше имя*'
                ]); ?>
                <?php echo $form->field($opins, 'description', [
                    'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'more.png' . '" alt="кем вы являетесь" title="описание">{input}</div>',
                ])->input('text', [
                    'class' => 'focus',
                    'placeholder' => 'Кем вы являетесь'
                ]); ?>
                <div class="description">Например: владелец частного дома, застройщик</div>
                <?php echo $form->field($opins, 'photo', [
                    'template' => '<div class="field photo"><label><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'photo.png' . '" alt="фото" title="добавить фото"><div class="false-input">Ваше фото</div>{input}</label>{error}</div>',
                ])->fileInput()->label('Ваше фото'); ?>
                <?php echo $form->field($opins, 'text', [
                    'template' => '<div class="field textarea"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-message.png' . '" alt="написать" title="написать">{label}{input}{error}</div>',
                ])->textarea()->label('Ваш отзыв*'); ?>
                <?php echo $form->field($opins, 'agree',['template' =>'<label>{input} Согласен(на) на обработку персональных данных в соответствии с <a href="/politika-konfidencialnosti">Политикой конфеденциальности</a></label>{error}' ])->input('checkbox', [
                            'value' => '1',
                            'checked' => 'checked',
                            'class' => '_argee'
                        ]); ?>
                <span>*обязательные поля; ваши данные не будут переданы третьим лицам</span>
                <?php echo Html::submitButton('Отправить', ['class' => 'pulse']); ?>
                <div class="success">
                    <span class="exo title">Спасибо за ваш отзыв!</span><br>
                    <span><span class="thank">Благодарим вас<br>за потраченное время!</span> Нам<br>очень важно ваше мнение.</span>
                    <span>Ваш отзыв отправлен. В скором<br>времени он появится на сайте.</span>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
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
