<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Контакты | Компания по оказанию сантехнических услуг СанКрас';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Компания по оказанию сантехнических услуг СанКрас'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'телефон sankras, адрес сантехники краснодара, контакты санкрас'
]);
?>
<section class="contacts" id="contacts">
    <div class="width">
        <div class="cont">
            <h1>Мы работаем<br>в Краснодаре и пригороде</h1>
            <div class="cnt">
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'cont-phone.png'; ?>" alt="телефон" title="телефон">
                <div>
                    <span>Телефон</span><br>
                    <span><?php echo Yii::$app->system->get('phone'); ?></span>
                </div>
            </div>
            <div class="cnt">
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'cont-skype.png'; ?>" alt="skype" title="skype">
                <div>
                    <span>Skype</span><br>
                    <span><?php echo Yii::$app->system->get('skype'); ?></span>
                </div>
            </div>
            <div class="cnt">
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'cont-email.png'; ?>" alt="email" title="email">
                <div>
                    <span>Email</span><br>
                    <a href="mailto:<?php echo Yii::$app->system->get('email'); ?>"><?php echo Yii::$app->system->get('email'); ?></a>
                </div>
            </div>
            <div class="cnt">
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'cont-time.png'; ?>" alt="время работы" title="время работы">
                <div>
                    <span>Время работы</span><br>
                    <span>Ежедневно с 8:00 до 21:00</span>
                </div>
            </div>
        </div>
    </div>
    <div id="map_canvas"></div>
</section>
<section class="cooperation">
    <div class="width clear">
        <div class="text">
            <div>
                <div class="title-big">Приглашаем к сотрудничеству!</div>
                <p>Приглашаем к сотрудничеству специалистов различных областей, а также поставщиков и производителей сантехнического материала в Краснодаре. Условия сотрудничества вы можете узнать по телефону или связавшись с нами через форму справа.</p>
                <p>Наша компания занимается предоставлением услуг в сфере монтажа сантехнических систем в городе Краснодар. Разводка подобных сетей производится практически с основания дома, это отражается в закладке канализационных труб для систем водоотведения. В процессе монтажных работ у заказчика часто возникает вопрос, можем ли предоставить и другие услуги, такие как:</p>
                <ul>
                    <li>укладка плитки,</li>
                    <li>стяжка пола,</li>
                    <li>натяжные потолки,</li>
                    <li>монтаж пластиковых окон, вентиляции, электрики.</li>
                </ul>
                <p>Для того, чтобы избавить заказчика от необходимости искать дополнительных подрядчиков, мы приглашаем к сотрудничеству специалистов, которые могут обеспечить максимально качественное выполнение работ и дать гарантию на них.</p>
            </div>
        </div>
        <div class="form">
            <div class="close"></div>
            <div class="loading"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'spinner25.gif'; ?>" alt="loading"></div>
            <span>Напишите нам:</span>
            <?php $form = ActiveForm::begin([
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'options' => [
                    'id' => 'writeUs-form_submit_' . rand(1, 255),
                ]
            ]);?>
            <?php echo $form->field($write, 'name', [
                'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-name.png' . '" alt="ваше имя" title="ваше имя">{input}{error}</div>',
            ])->input('text', [
                'class' => 'focus',
                'placeholder' => 'Ваше имя*'
            ]); ?>
            <?php echo $form->field($write, 'phone', [
                'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-phone.png' . '" alt="ваш телефон" title="ваш телефон">{input}{error}</div>',
            ])->input('text', [
                'value' => '',
                'class' => 'phone-mask',
                'placeholder' => 'Ваш телефон'
            ]); ?>
            <?php echo $form->field($write, 'email', [
                'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-email.png' . '" alt="ваш email" title="ваш email">{input}{error}</div>',
            ])->input('email', [
                'placeholder' => 'Ваш email*',
                'class' => 'focus'
            ]); ?>
            <?php echo $form->field($write, 'message', [
                'template' => '<div class="field textarea"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-message.png' . '" alt="ваше сообщение" title="ваше сообщение">{label}{input}{error}</div>',
            ])->textarea()->label('Ваше сообщение*');?>
            <span>*обязательные поля; ваши данные не будут переданы третьим лицам </span>
            <?php echo Html::submitButton('Отправить', ['class' => 'pulse']); ?>
            <div class="success">
                <span class="exo">Ваше сообщение<br>отправлено!</span><br>
                <span>В ближайшее время<br>мы ответим вам на почту или<br>перезвоним.</span>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDf-hsTgqnZkyUEnOtvyinarywEN1hDLMc&callback=initMap"></script>
