<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\models\Blog;

$this->title = 'Контакты';
?>
<h1><?php echo 'Система > ' . $this->title; ?></h1>
<div class="row-fluid sections">
    <div class="progress progress-striped active sort-progress">
        <div class="progress-bar progress-bar-info" style="width: 100%"></div>
    </div>
    <table id="sort-table" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Ключ</th>
            <th>Значение</th>
            <th></th>
        </tr>
        </thead>
        <?php foreach ($contacts as $contact) { ?>
            <tr>
                <td><?php echo $contact->id; ?></td>
                <td><?php echo $contact->description; ?></td>
                <td><?php echo $contact->title; ?></td>
                <td><?php echo $contact->value; ?></td>
                <td>
                    <div class="btn-group-vertical">
                        <a href="<?php echo Url::toRoute(['contacts/edit', 'id' => $contact->id]); ?>" class="btn btn-default btn-xs">Редактировать</a>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
