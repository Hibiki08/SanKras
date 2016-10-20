<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Контакты';
?>
<section class="contacts" id="contacts">
    <div class="width">
        <div class="cont">
            <h2>Мы работаем<br>в Краснодаре и пригороде</h2>
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
                    <span><?php echo Yii::$app->system->get('email'); ?></span>
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
                <p>Наша компания занимается предоставлением услуг в сфере монтажа сантехнических систем в городе Краснодар.</p>
                <p>Разводка инженерных сантехнических сетей производится практически с основания дома, это отражается в закладке канализационных труб для систем водоотведения. В процессе монтажных работ у заказчика часто возникает вопрос, принимает ли наша компания заказы на другие виды работ, такие как:</p>
                <ul>
                    <li>укладка плитки,</li>
                    <li>стяжка пола,</li>
                    <li>натяжные потолки,</li>
                    <li>монтаж пластиковых окон, вентиляции, электрики.</li>
                </ul>
                <p>В таких случаях возникает потребность в сотрудничестве с монтажниками различных специализаций, которые смогут выполнить монтаж максимально качественно и дать гарантии на выполненные работы. Так же наша компания предлагает сотрудничество оптовым поставщикам и производителям сантехнического материала в городе Краснодаре.</p>
                <p>Условия сотрудничества Вы можете узнать по нашему телефону или связавшись с нами через форму справа.</p>
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
                'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-name.png' . '" alt="ваше имя" title="ваше имя">{input}</div>',
            ])->input('text', [
                'class' => 'focus',
                'placeholder' => 'Ваше имя*'
            ]); ?>
            <?php echo $form->field($write, 'phone', [
                'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-phone.png' . '" alt="ваш телефон" title="ваш телефон">{input}</div>',
            ])->input('text', [
                'value' => '',
                'class' => 'phone-mask',
                'placeholder' => 'Ваш телефон'
            ]); ?>
            <?php echo $form->field($write, 'email', [
                'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-email.png' . '" alt="ваш email" title="ваш email">{input}</div>',
            ])->input('email', [
                'placeholder' => 'Ваш email*',
                'class' => 'focus'
            ]); ?>
            <?php echo $form->field($write, 'message', [
                'template' => '<div class="field textarea"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-message.png' . '" alt="ваше сообщение" title="ваше сообщение">{label}{input}</div>',
            ])->textarea()->label('Ваше сообщение*');?>
            <span>*обязательные поля; ваши данные не будут переданы третьим лицам </span>
            <?php echo Html::submitButton('Отправить', ['class' => 'pulse']); ?>
            <div class="success">
                <span class="exo">Ваше сообщение<br>отправлено!</span><br>
                <span>В ближайшее время<br>мы ответим Вам на почту или<br>перезвоним.</span>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDf-hsTgqnZkyUEnOtvyinarywEN1hDLMc&callback=initMap"></script>
