<?php

$this->title = $name;
?>
<section id="not-found">
    <section class="description">
        <div class="width">
            <div class="oops">
                <div class="text">Страницы с таким названием не существует. Проверьте правильность ввода названия или перейдите на главную страницу.</div>
                <a class="exo" href="<?php echo Yii::$app->homeUrl; ?>">Перейти на главную страницу</a>
            </div>
        </div>
    </section>
</section>