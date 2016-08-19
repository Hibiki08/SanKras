<?php
use yii\helpers\Url;
use app\models\Slides;

$this->title = 'Дисконтная карта';
?>
<h1><?php echo 'Заявки > ' . $this->title; ?></h1>
<div class="row-fluid">
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>#</th>
            <th>Email</th>
            <th>Дата</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($requests) { ?>
        <?php foreach ($requests as $card) { ?>
            <tr>
                <td><?php echo $card->id; ?></td>
                <td><?php echo $card->email; ?></td>
                <td><?php echo Yii::$app->formatter->asDate($card->date, 'd MMMM yyyy'); ?></td>
            </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>
