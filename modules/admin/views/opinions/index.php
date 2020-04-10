<?php
use yii\helpers\Url;
use app\models\Opinions;
use yii\widgets\LinkPager;

$this->title = 'Отзывы';
?>
<h1><?php echo 'О нас > ' . $this->title; ?></h1>
<div class="row-fluid">
    <a href="<?php echo Url::toRoute('opinions/edit'); ?>" class="btn btn-success">Добавить отзыв</a>
</div>
<div class="row-fluid" id="opinions">
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>#</th>
            <th>Имя</th>
            <th>Подробнее</th>
            <th>Фото</th>
            <th>Текст</th>
            <th>Активность</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($opinions as $opinion) { ?>
            <tr>
                <td><?php echo $opinion->id; ?></td>
                <td><?php echo $opinion->name; ?></td>
                <td><?php echo $opinion->description; ?></td>
                <td class="photo">
                    <figure>
                        <img src="<?php echo Yii::$app->params['params']['pathToImage'] . Opinions::IMG_FOLDER . 'opinion(' . $opinion->id . ')/mini_' . $opinion->photo; ?>">
                    </figure></td>
                <td><?php echo $opinion->text; ?></td>
                <td class="status"><?php echo $opinion->active ? 'Да' : 'Нет'; ?></td>
                <td>
                    <div class="btn-group-vertical">
                        <a href="<?php echo Url::toRoute(['opinions/edit', 'id' => $opinion->id]); ?>" class="btn btn-default btn-xs">Редактировать</a>
                        <a class="btn btn-primary btn-xs btn-activate" data-value="<?php echo $opinion->active == 1 ? 0 : 1; ?>" data-id="<?= $opinion->id; ?>">
                            <span><?= $opinion->active ? 'Деактивировать' : 'Активировать'; ?></span>
                            <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        </a>
                        <a class="btn btn-danger btn-xs btn-delete" data-id="<?= $opinion->id; ?>">
                            Удалить
                            <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                            </div>
                        </a>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="row-fluid pager">
        <?php echo LinkPager::widget([
            'pagination' => $pager,
        ]); ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-activate').click(function () {
            var $this = $(this);
            activeAjax($this, '<?php echo Url::toRoute('opinions/active'); ?>');
        });

        $('.btn-delete').click(function () {
            var agree = confirm('Вы действительно хотите удалить этот пункт?');
            if (agree) {
                var $this = $(this);
                deleteAjax($this, '<?php echo Url::toRoute('opinions/delete'); ?>');
            }
        });
    });
</script>
