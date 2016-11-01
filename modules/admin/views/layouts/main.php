<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\modules\admin\assets\AdminAsset;
use app\modules\admin\components\AdminMenu;

$action = Yii::$app->controller->action->id;
AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="fuelux">
<head>
    <meta charset="UTF-8">
    <?php echo Html::csrfMetaTags() ?>
    <title><?php echo $this->title; ?></title>
    <?php $this->head() ?>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
</head>
<body>
<?php $this->beginBody() ?>
<nav class="navbar navbar-inverse" style="border-radius: 0;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo Yii::$app->homeUrl; ?>" target="_blank">SanKras</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php echo AdminMenu::widget(); ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container content">
    <div class="row-fluid">
        <div>
            <?php echo $content ?>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
