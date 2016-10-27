<?php
use app\models\Opinions;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\LinkPager;

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
                                <img src="<?php echo Yii::$app->params['params']['pathToImage'] . Opinions::IMG_FOLDER . 'opinion(' . $opinion->id . ')/' . 'mini_' . $opinion->photo; ?>" alt="отзыв" title="отзыв">
                            </figure>
                            <div class="text">
                                <span><span class="red"><?php echo $opinion->name; ?>,</span> <?php echo $opinion->description; ?></span>
                                <p><?php echo $opinion->text; ?></p>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="form">
                <div class="close"></div>
                <div class="loading"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'spinner25.gif'; ?>" alt="loading"></div>
                <span>Написать отзыв:</span>
                <?php $form = ActiveForm::begin([
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
                    'options' => [
                        'id' => 'opinions-form_' . rand(1, 255),
                    ]
                ]);?>
                <?php echo $form->field($opins, 'name', [
                    'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-name.png' . '" alt="ваше имя" title="ваше имя">{input}</div>',
                ])->input('text', [
                    'class' => 'focus',
                    'placeholder' => 'Ваше имя*'
                ]); ?>
                <?php echo $form->field($opins, 'description', [
                    'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-name.png' . '" alt="кем вы являетесь" title="описание">{input}</div>',
                ])->input('text', [
                    'class' => 'focus',
                    'placeholder' => 'Кем вы являетесь'
                ]); ?>
                <?php echo $form->field($opins, 'photo', [
                    'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-name.png' . '" alt="фото" title="добавить фото">{input}</div>',
                ])->fileInput()->label('Ваше фото'); ?>
                <?php echo $form->field($opins, 'text', [
                    'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-name.png' . '" alt="написать" title="написать">{input}</div>',
                ])->textarea(['rows' => '10'])->label('Ваш отзыв*'); ?>
                <span>*обязательные поля; ваши данные не будут переданы третьим лицам </span>
                <?php echo Html::submitButton('Отправить', ['class' => 'pulse']); ?>
                <div class="success">
                    <span class="exo">Ваше сообщение<br>отправлено!</span><br>
                    <span>В ближайшее время<br>мы ответим Вам на почту или<br>перезвоним.</span>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="pagination">
            <?php echo LinkPager::widget([
                'pagination' => $pager,
                'prevPageLabel' => '',
                'nextPageLabel' => '',
                'maxButtonCount' => 5
            ]); ?>
        </div>
    </div>
</section>
