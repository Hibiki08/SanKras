<?php
use yii\helpers\Url;
use app\models\Opinions;

$this->title = 'SEO';
?>
<h1><?php echo 'Система > ' . $this->title; ?></h1>
<div class="row-fluid">
    <a href="<?php echo Url::toRoute('seo/edit'); ?>" class="btn btn-success">Добавить блок</a>
</div>
<div class="row-fluid" id="opinions">
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>#</th>
            <th>Заголовок</th>
            <th>Краткий текст</th>
            <th>Ключ</th>
            <th>Активность</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($seoBlocks as $seoBlock) { ?>
            <tr>
                <td><?php echo $seoBlock->id; ?></td>
                <td><?php echo $seoBlock->title; ?></td>
                <td><?php echo $seoBlock->short_text; ?></td>
                <td><?php echo $seoBlock->block_key; ?></td>
                <td class="status"><?php echo $seoBlock->active ? 'Да' : 'Нет'; ?></td>
                <td>
                    <div class="btn-group-vertical">
                        <a href="<?php echo Url::toRoute(['seo/edit', 'id' => $seoBlock->id]); ?>" class="btn btn-default btn-xs">Редактировать</a>
                        <a class="btn btn-primary btn-xs btn-activate" data-value="<?php echo $seoBlock->active == 1 ? 0 : 1; ?>" data-id="<?= $seoBlock->id; ?>">
                            <span><?php echo $seoBlock->active ? 'Деактивировать' : 'Активировать'; ?></span>
                            <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        </a>
                        <a class="btn btn-danger btn-xs btn-delete" data-id="<?php echo $seoBlock->id; ?>">Удалить
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
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-activate').click(function () {
            var $this = $(this);
            activeAjax($this, '<?php echo Url::toRoute('seo/active'); ?>');
        });

        $('.btn-delete').click(function () {
            var agree = confirm('Вы действительно хотите удалить этот пункт?');
            if (agree) {
                var $this = $(this);
                deleteAjax($this, '<?php echo Url::toRoute('seo/delete'); ?>');
            }
        });
    });
</script>
