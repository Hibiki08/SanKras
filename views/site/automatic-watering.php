<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\Works;

$this->title = 'Система автополива в Краснодаре';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Система автополива в Краснодаре. Компания СанКрас'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'система автополива в краснодаре, установка автополива'
]);
?>
<section class="automatic-watering" id="more">
    <section class="description">
        <div class="width clear">
            <h1 class="title title-big">Система автополива</h1>
            <div class="more-text clear">
                <div class="txt txt-1">
                    <figure><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'automatic-watering.jpg'; ?>" alt="монтаж водоснабжения" title="монтаж водоснабжения"></figure>
                    <p>Компания СанКрас производит монтаж систем автополива в Краснодаре и Краснодарском крае уже более пяти лет.</p>
                    <p>Имея в наличии профессиональный инструмент и штат из квалифицированных специалистов, мы можем всегда гарантировать качественное исполнение монтажа оборудования и его долгосрочную работу.</p>
                    <p>Система автополива на вашем дачном участке  - это комфорт, экономия времени и возможность насладиться отдыхом. Для произведения монтажа системы автополива мы используем материалы ведущих производителей, таких как Hunter, Rain Bird, Tairi, Espa.</p>
                </div>
                <div class="txt txt-2">
                    <p>Компания СанКрас предоставляет своим заказчикам возможность оборудовать на своем участке систему автополива используя услугу <span class="red">Эконом пакет</span>.</p>
                    <p>В стоимость данной  услуги включен материал российского и итальянского производства  для оборудования водоснабжения автополива, исходя из расчета до четырех статических оросителей на одну сотку. Стоимость пакета - 15 тыс. руб. за сотку.</p>
                    <p>Компания СанКрас предоставляет <span class="red">сервисное обслуживание</span> системы автополива стоимостью от 12 тысяч:</p>
                    <ul>
                        <li><span>консервация</span> - подготовка системы автоматического полива на зимний период (обслуживание проводится 20 октября)</li>
                        <li><span>расконсервация</span> - запуск и подготовка системы к работе весной (обслуживание проводится 20 апреля).</li>
                    </ul>
                    <p>Наши специалисты предлагают заказчикам услугу <span class="red">Шеф-монтаж</span> (надзор мастера) 1600 руб. в час.</p>
                    <p>Воспользуйтесь данным выгодным предложением в случаях, если вы планируете произвести монтаж самостоятельно в целях экономии средств или просто хотите разобраться в процессе монтажа вашего оборудования для автополива. Услуга включает выезд нашего специалиста к вам на участок, пояснение и контроль всего процесса монтажа, помощь в запуске и наладке оборудования.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="options">
        <div class="width">
            <h2>Мы выполняем следующие виды работ по монтажу системы автополива:</h2>
            <div class="opts clear">
                <ul class="float-left">Капельный полив (микроорошение):
                    <li>установка капельного шланга</li>
                    <li>автоматическое управление микроорошением</li>
                    Полив оросителями:
                    <li>роторныме оросители</li>
                    <li>стационарные оросители</li>
                </ul>
                <ul class="float-right">Фильтрация для автополива:
                    <li>установка песочного отстойника</li>
                    <li>установка гидроциклонов</li>
                </ul>
                <ul class="absolute">Обвязка водоснабжения автополива:
                    <li>установка насосного оборудования</li>
                    <li>обвязка накопительных ёмкостей</li>
                    <li>монтаж автоматики</li>
                    <li>установка запорно-регулирующей арматуры</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="more-key">
        <div class="width">
            <h2 class="title-big">Заказывая монтаж системы автополива у нас, вы получаете:</h2>
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
    <?php if (!empty($options)) { ?>
        <section class="price-list">
            <div class="width">
                <div class="table">
                    <table>
                        <caption class="exo">Автополив</caption>
                        <tr class="sub-title">
                            <td>Услуга</td>
                            <td>Ед.</td>
                            <td class="table-cost">Стоимость</td>
                        </tr>
                        <?php foreach($options as $price) { ?>
                            <tr class="transition">
                                <td><?php echo $price->title; ?></td>
                                <td class="table-unit"><?php echo $price->unit; ?></td>
                                <td class="table-price"><?php echo $price->price; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="pdf">
                    <span class="title-big">Посмотреть полный прайс-лист</span><a href="<?php echo Yii::$app->urlManager->createUrl(['prices', '#' => 'automaticwatering']); ?>"><button class="pulse exo">Прайс-лист</button></a>
                </div>
            </div>
        </section>
    <?php } ?>
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
