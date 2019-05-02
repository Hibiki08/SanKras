<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\Works;
use app\models\WorksCat;
$this->title = 'Нужна бригада сантехников для работы в частном секторе в Краснодаре?';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Компания СанКрас сотрудничает с застройщиками частного сектора: профессиональный монтаж отопления, водоснабжения, канализации "под ключ". Высокие скидки на большой объем!'
]);

$this->params['breadcrumbs'][] = 'Сотрудничаем с застройщиками частного сектора';
?>
<section class="more-flat more-company" id="more">
    <section class="description">
        <div class="width clear">
            <h1 class="title title-big">Сотрудничаем с застройщиками частного сектора</h1>
            <figure>
                <img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'more-company-1.png'; ?>" alt="монтаж квартиры" title="монтаж квартиры">
            </figure>
            <div class="text">
                <p>Компания СанКрас предлагает выгодные условия сотрудничества для застройщиков. Например, скидки на материал от 20%, низкие цены на монтаж, качественное выполнение работ квалифицированными специалистами. За несколько лет наши сотрудники внедрили множество технологий, позволяющих снизить общую стоимость материала, не затронув при этом работоспособность системы, а также опытным путем выявили оптимальные виды материалов, отвечающих соотношению "цена - качество".</p>
            </div>
        </div>
    </section>
    <section class="steps">
        <div class="width">
            <div class="step clear">
                <div class="st">
                    <span class="number"></span>
                    <span class="asphalt exo">первый этап работ</span>
                </div>
                <div class="desc">
                    <figure>
                        <img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'more-company-2.png'; ?>">
                    </figure>
                    <div class="text">
                        <ul>
                            <li>Встреча, расчет теплопотерь здания для правильного подбора материала и оборудования</li>
                            <li>Консультирование, помощь в подборе материала и составление схемы проекта</li>
                            <li>Составление сметы, закупка и доставка материала</li>
                            <li>Монтаж системы отопления, обвязка котельной</li>
                            <li>Монтаж радиаторов, теплого пола</li>
                            <li>Монтаж системы водоснабжения, обвязка скважины</li>
                            <li>Монтаж систем водоподготовки и фильтрации</li>
                            <li>Земельные работы, монтаж канализации, установка септика</li>
                            <li>Вынос мусора</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="step clear">
                <div class="st st-2">
                    <span class="number"></span>
                    <span class="asphalt exo">второй этап после отделки</span>
                </div>
                <div class="desc">
                    <figure>
                        <img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'more-company-3.png'; ?>">
                    </figure>
                    <div class="text">
                        <ul>
                            <li>Установка санфаянса на стадии финишных работ</li>
                            <li>Установка бытовой техники (стиральная / посудомоечная машина и др.)</li>
                            <li>Ввод в эксплуатацию установленного оборудования (котел, бойлер косвенного нагрева, накопительный водонагреватель, газовая колонка)</li>
                            <li>Запуск и наладка всей системы</li>
                            <li>Сдача объекта</li>
                            <li>Предоставление гарантии и дальнейшее сотрудничество</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="more-key">
        <div class="width">
            <h2 class="title-big">При сотрудничестве с нами вы получаете:</h2>
            <div class="flat clear one">
                <div class="fl">
                    <div class="title exo">Выполнение работы быстро и в поставленные сроки</div>
                    <div class="text">Мы берем на себя все обязательства по выполнению работ от начала до конца и решаем все возникающие в ходе монтажа вопросы. Вам не придется решать организационные вопросы, мы сами бесплатно доставим материал на объект и согласуем все этапы монтажа с другими бригадами (например, с бригадами по отделке). Благодаря этому не возникнет организационного беспорядка, и работа будет сдана в оговоренные сроки.</div>
                </div>
                <div class="fl">
                    <div class="title exo">12% скидку на материал и 10% скидку на монтаж для постоянных клиентов</div>
                    <div class="text">Монтаж "под ключ" выгоднее найма отдельных специалистов, так как мы даем дополнительные скидки на монтаж при большом объеме работ.</div>
                </div>
            </div>
            <div class="flat clear two">
                <div class="fl">
                    <div class="title exo">Прозрачную единую смету на стоимость всех работ</div>
                    <div class="text">Мы выполняем весь комплекс работ по разводке сантехнических  коммуникаций и вносим их стоимость в единую смету. Она согласовывается с вами до начала работ, поэтому вы заранее точно знаете стоимость монтажа.</div>
                </div>
                <div class="fl">
                    <div class="title exo">Бесплатное гарантийное устранение неисправностей</div>
                    <div class="text">В случае возникновения неисправностей в системе мы исправим все бесплатно в рамках гарантийного договора.</div>
                </div>
            </div>
        </div>
    </section>
    <?php echo Works::widget(); ?>
    <section class="questions">
        <div class="width clear">
            <div class="question">
                <span class="exo red">Остались вопросы?</span><br>
                <span class="exo qn">Поможем разобраться в вашей проблеме</span>
            </div>
            <div class="form clear">
                <div class="close"></div>
                <div class="loading"><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'spinner25.gif'; ?>" alt="loading"></div>
                <span class="title exo"><span>Задайте ваш вопрос мастеру</span> и получите консультацию</span>
                <?php $form = ActiveForm::begin([
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
                    'options' => [
                        'id' => 'form-question',
                    ]
                ]);?>
                <?php echo $form->field($question, 'name', [
                    'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-name.png' . '" alt="ваше имя" title="ваше имя">{input}{error}</div>',
                ])->input('text', [
                    'class' => 'focus',
                    'placeholder' => 'Ваше имя*'
                ]); ?>
                <?php echo $form->field($question, 'text', [
                    'template' => '<div class="field textarea"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-message.png' . '" alt="ваше сообщение" title="ваше сообщение">{label}{input}{error}</div>',
                ])->textarea()->label('Ваш вопрос*');?>
                <?php echo $form->field($question, 'phone', [
                    'template' => '<div class="field"><img src="' . Yii::$app->params['params']['pathToImageSystem'] . 'callback-phone.png' . '" alt="ваш телефон" title="ваш телефон">{input}{error}</div>',
                ])->input('text', [
                    'value' => '',
                    'class' => 'phone-mask',
                    'placeholder' => 'Ваш телефон*'
                ]); ?>
                <?php echo $form->field($question, 'agree',['template' =>'<label>{input} Согласен(на) на обработку персональных данных в соответствии с <a href="/politika-konfidencialnosti">Политикой конфеденциальности</a></label>{error}' ])->input('checkbox', [
                            'value' => '1',
                            'checked' => 'checked',
                            'class' => '_argee'
                        ]); ?>
                <?php echo Html::submitButton('Задать вопрос', ['class' => 'pulse']); ?>
                <div class="success">
                    <span class="exo">Ваше сообщение отправлено!</span><br>
                    <span>Спасибо за ваш вопрос! В ближайшее время<br>мы перезвоним вам.</span>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </section>
</section>
