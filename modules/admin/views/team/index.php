<?php
use yii\helpers\Url;
use app\models\Team;

$this->title = 'Команда';
?>
<h1><?php echo 'О нас > ' . $this->title; ?></h1>
<div class="row-fluid">
    <a href="<?php echo Url::toRoute('team/edit'); ?>" class="btn btn-success">Добавить сотрудника</a>
</div>
<div class="row-fluid" id="team">
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>#</th>
            <th>Имя</th>
            <th>Должность</th>
            <th>Фото</th>
            <th>Активность</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($team as $tm) { ?>
            <tr>
                <td><?php echo $tm->id; ?></td>
                <td><?php echo $tm->name; ?></td>
                <td><?php echo $tm->post; ?></td>
                <td class="photo">
                    <figure>
                        <img src="<?php echo Yii::$app->params['params']['pathToImage'] . Team::IMG_FOLDER . 'team(' . $tm->id . ')/team_' . $tm->img; ?>">
                    </figure></td>
                <td class="status"><?php echo $tm->active ? 'Да' : 'Нет'; ?></td>
                <td>
                    <div class="btn-group-vertical">
                        <a href="<?php echo Url::toRoute(['team/edit', 'id' => $tm->id]); ?>" class="btn btn-default btn-xs">Редактировать</a>
                        <a class="btn btn-primary btn-xs btn-activate" data-value="<?php echo $tm->active == 1 ? 0 : 1; ?>" data-id="<?= $tm->id; ?>">
                            <span><?= $tm->active ? 'Деактивировать' : 'Активировать'; ?></span>
                            <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        </a>
                        <a class="btn btn-danger btn-xs btn-delete" data-id="<?= $tm->id; ?>">
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
            activeAjax($this, '<?php echo Url::toRoute('team/active'); ?>');
        });

        $('.btn-delete').click(function () {
            var agree = confirm('Вы действительно хотите удалить этот пункт?');
            if (agree) {
                var $this = $(this);
                deleteAjax($this, '<?php echo Url::toRoute('team/delete'); ?>');
            }
        });
    });
</script>
