<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use app\models\Blog;

$this->title = 'Новости';
?>
<h1><?php echo 'Блог > ' . $this->title; ?></h1>
<div class="row-fluid">
    <a href="<?php echo Url::toRoute('news/edit'); ?>" class="btn btn-success">Добавить новость</a>
</div>
<div class="row-fluid sections">
    <div class="progress progress-striped active sort-progress">
        <div class="progress-bar progress-bar-info" style="width: 100%"></div>
    </div>
    <table id="sort-table" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Превью</th>
            <th>Дата</th>
            <th>Активность</th>
            <th></th>
        </tr>
        </thead>
        <?php foreach ($news as $new) { ?>
            <tr>
                <td><?php echo $new->id; ?></td>
                <td><?php echo $new->title; ?></td>
                <td>
                    <?php if ($new->preview) { ?>
                    <img class="img-thumbnail" src="<?php echo Yii::$app->params['params']['pathToImage'] . Blog::IMG_FOLDER_NEWS . 'mini_' . $new->preview; ?>">
                    <?php } else { ?>
                        Нет
                    <?php } ?>
                </td>
                <td><?php echo Yii::$app->formatter->asDate($new->date, 'd MMMM yyyy'); ?></td>
                <td class="status"><?php echo $new->active ? 'Да' : 'Нет'; ?></td>
                <td>
                    <div class="btn-group-vertical">
                        <a href="<?php echo Url::toRoute(['news/edit', 'id' => $new->id]); ?>" class="btn btn-default btn-xs">Редактировать</a>
                        <a class="btn btn-primary btn-xs btn-activate" data-value="<?php echo $new->active == 1 ? 0 : 1; ?>" data-id="<?= $new->id; ?>">
                            <span><?= $new->active ? 'Деактивировать' : 'Активировать'; ?></span>
                            <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        </a>
                        <a class="btn btn-danger btn-xs btn-delete" data-id="<?= $new->id; ?>">
                            Удалить
                            <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                            </div>
                        </a>
                    </div>
                </td>
            </tr>
        <?php } ?>
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
            activeAjax($this, '<?php echo Url::toRoute('news/active'); ?>');
        });

        $('.btn-delete').click(function () {
            var agree = confirm('Вы действительно хотите удалить этот пункт?');
            if (agree) {
                var $this = $(this);
                deleteAjax($this, '<?php echo Url::toRoute('news/delete'); ?>');
            }
        });
    });
</script>
