<?php
use yii\helpers\Url;
use app\models\Slides;

$this->title = 'Нижний слайдер';
?>
<h1><?php echo 'Слайдеры > ' . $this->title; ?></h1>
<div class="row-fluid">
    <a href="<?php echo Url::toRoute('sliderbottom/edit'); ?>" class="btn btn-success">Добавить слайд</a>
</div>
<div class="row-fluid">
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>#</th>
            <th>Превью</th>
            <th>Сортировка</th>
            <th>Активность</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($slides as $slide) { ?>
            <tr>
                <td><?php echo $slide->id; ?></td>
                <td><img src="<?php echo Yii::$app->params['params']['pathToImage'] . Slides::IMG_FOLDER_SLIDER_BOT . '/admin_' . $slide->image; ?>"></td>
                <td><input type="text" class="form-control show_position" name="show_position" placeholder="очерёдность" value="<?php echo $slide->sort; ?>" data-id="<?php echo $slide->id; ?>"></td>
                <td class="status"><?php echo $slide->active ? 'Да' : 'Нет'; ?></td>
                <td>
                    <div class="btn-group-vertical">
                        <a href="<?php echo Url::toRoute(['sliderbottom/edit', 'id' => $slide->id]); ?>" class="btn btn-default btn-xs">Редактировать</a>
                        <a class="btn btn-primary btn-xs btn-activate" data-value="<?php echo $slide->active == 1 ? 0 : 1; ?>" data-id="<?= $slide->id; ?>">
                            <span><?= $slide->active ? 'Деактивировать' : 'Активировать'; ?></span>
                            <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        </a>
                        <a class="btn btn-danger btn-xs btn-delete" data-id="<?= $slide->id; ?>">
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
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-activate').click(function () {
            var $this = $(this);
            activeAjax($this, '<?php echo Url::toRoute('sliderbottom/active'); ?>');
        });

        $('.btn-delete').click(function () {
            var agree = confirm('Вы действительно хотите удалить этот пункт?');
            if (agree) {
                var $this = $(this);
                deleteAjax($this, '<?php echo Url::toRoute('sliderbottom/delete'); ?>');
            }
        });

        $('input[name="show_position"]').change(function() {
            var $this = $(this);
            var value = $(this).val();
            $.ajax({
                url: '<?php echo Url::toRoute('sliderbottom/sort'); ?>',
                type: 'get',
                dataType: 'json',
                data: {id: $this.data().id, value: value}
            });
        });
    });
</script>
