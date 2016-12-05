<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\models\Blog;

$this->title = 'Статьи';
?>
<h1><?php echo 'Блог > ' . $this->title; ?></h1>
<div class="row-fluid">
    <a href="<?php echo Url::toRoute('articles/edit'); ?>" class="btn btn-success">Добавить статью</a>
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
            <th>Раздел</th>
            <th>Дата</th>
            <th>Активность</th>
            <th></th>
        </tr>
        </thead>
        <?php foreach ($articles as $article) { ?>
            <tr>
                <td><?php echo $article->id; ?></td>
                <td><?php echo $article->title; ?></td>
                <td>
                    <?php if ($article->preview) { ?>
                        <img class="img-thumbnail" src="<?php echo Yii::$app->params['params']['pathToImage'] . Blog::IMG_FOLDER_ART . '/mini_' . $article->preview; ?>">
                    <?php } else { ?>
                        Нет
                    <?php } ?>
                </td>
                <td><?php echo !is_null($article->category->parent_id) ? $article->category->description : 'Нет'; ?></td>
                <td><?php echo Yii::$app->formatter->asDate($article->date, 'd MMMM yyyy'); ?></td>
                <td class="status"><?php echo $article->active ? 'Да' : 'Нет'; ?></td>
                <td>
                    <div class="btn-group-vertical">
                        <a href="<?php echo Url::toRoute(['articles/edit', 'id' => $article->id]); ?>" class="btn btn-default btn-xs">Редактировать</a>
                        <a class="btn btn-primary btn-xs btn-activate" data-value="<?php echo $article->active == 1 ? 0 : 1; ?>" data-id="<?= $article->id; ?>">
                            <span><?= $article->active ? 'Деактивировать' : 'Активировать'; ?></span>
                            <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        </a>
                        <a class="btn btn-danger btn-xs btn-delete" data-id="<?= $article->id; ?>">
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
            activeAjax($this, '<?php echo Url::toRoute('articles/active'); ?>');
        });

        $('.btn-delete').click(function () {
            var agree = confirm('Вы действительно хотите удалить этот пункт?');
            if (agree) {
                var $this = $(this);
                deleteAjax($this, '<?php echo Url::toRoute('articles/delete'); ?>');
            }
        });
    });
</script>
