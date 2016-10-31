<?php
use app\models\Opinions;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\StringHelper;

$this->title = 'Отзывы';
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
            <h2 class="title exo asphalt"><?php echo $this->title; ?></h2>
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
                    'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-name.png' . '" alt="ваше имя" title="ваше имя">{input}</div>',
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
                    'template' => '<div class="field photo"><label><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'photo.png' . '" alt="фото" title="добавить фото"><div class="false-input">Ваше фото</div>{input}</label></div>',
                ])->fileInput()->label('Ваше фото'); ?>
                <?php echo $form->field($opins, 'text', [
                    'template' => '<div class="field textarea"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-message.png' . '" alt="написать" title="написать">{label}{input}</div>',
                ])->textarea()->label('Ваш отзыв*'); ?>
                <span>*обязательные поля; ваши данные не будут переданы третьим лицам</span>
                <?php echo Html::submitButton('Отправить', ['class' => 'pulse']); ?>
                <div class="success">
                    <span class="exo title">Спасибо за ваш отзыв!</span><br>
                    <span><span class="thank">Благодарим Вас<br>за потраченное время!</span> Нам<br>очень важно Ваше мнение.</span>
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
    });
</script>
<?php unset($_SESSION['success']);?>
