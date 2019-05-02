<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\Works;

$this->title = 'Установка санфаянса в Краснодаре';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Установка санфаянса в Краснодаре. Компания SanKras'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'санфаянс в краснодаре, установка санфаянса, установка раковины, установка ванны, установка унитаза'
]);
?>
<section class="sanfayans" id="more">
    <section class="description">
        <div class="width clear">
            <h1 class="title title-big">Установка санфаянса</h1>
            <div class="more-text clear">
                <div class="txt txt-1">
                    <figure><img src="<?php echo Yii::$app->params['params']['pathToImageSystem'] . 'sanfayans.jpg'; ?>" alt="монтаж водоснабжения" title="монтаж водоснабжения"></figure>
                    <p>Компания СанКрас производит установку санфаянса в Краснодаре и Краснодарском крае.</p>
                    <p>Наши специалисты имеют богатый опыт работ по монтажу сантехнического фаянса, только за последний год было установлено более 160 приборов.</p>
                </div>
                <div class="txt txt-2">
                    <p>Благодаря наличию профессионального инструмента и высокой квалификации наших монтажников, вы всегда получаете быструю и качественную установку приборов. Это экономит ваше время, а нас выделяет как профессионалов своего дела.</p>
                    <p>Установка сантехнических приборов производится в ванных комнатах, душевых, туалетах. Прежде чем приступить к установке санфаянса, мы, опираясь на пожелания заказчика, корректируем местоположение приборов так, чтобы сохранить эргономику помещения и его полезное пространство. Это один из  самых важных моментов, который иногда упускают сторонние монтажные организации.</p>
                    <p>При <span>комплексной</span>, т.е. единовременной, установке всего санфаянса, под который сделаны выводы в ванной комнат,е на вашем объекте, мы предоставляем  10%-ю скидку на работы.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="options">
        <div class="width">
            <h2>Мы выполняем следующие виды работ по установке санфаянса:</h2>
            <div class="opts clear">
                <ul class="float-left">Установка и подключение раковины:
                    <li>раковины «тюльпан»</li>
                    <li>раковины с полупьедесталом</li>
                    <li>подвесной раковины</li>
                    Установка и подключение кухонной мойки:
                    <li>мойки из нержавейки</li>
                    <li>мойки из искусственного камня</li>
                    <li>встраиваемой мойки</li>
                </ul>
                <ul class="float-right">
                    <li>Монтаж смесителей</li>
                    <li>Установка и подключение биде/писсуаров</li>
                    Установка и подключение унитаза:
                    <li>унитаза-компакт</li>
                    <li>монолитного унитаза</li>
                    <li>подвесного унитаза (инсталляция)</li>
                    <li>унитаза с выносным бачком</li>
                </ul>
                <ul class="absolute">
                    <li>Установка и подключение душевой кабины</li>
                    <li>Монтаж полотенцесушителей</li>
                    Установка и подключение ванны:
                    <li>акриловой ванны</li>
                    <li>стальной ванны</li>
                    <li>чугунной ванны</li>
                    <li>гидромассажной ванны</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="more-key">
        <div class="width">
            <h2 class="title-big">Заказывая установку санфаянса у нас, вы получаете:</h2>
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
                        <caption class="exo">Установка санфаянса</caption>
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
                    <span class="title-big">Посмотреть полный прайс-лист</span><a href="<?php echo Yii::$app->urlManager->createUrl(['prices', '#' => 'sanitaryware']); ?>"><button class="pulse exo">Прайс-лист</button></a>
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
