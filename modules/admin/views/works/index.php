<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use app\models\Works;

$this->title = 'Список';
?>
<h1><?php echo 'Работы > ' . $this->title; ?></h1>
<div class="row-fluid">
    <a href="<?php echo Url::toRoute('works/edit'); ?>" class="btn btn-success">Добавить работу</a>
</div>
<?php echo Html::beginForm(['works/index'], 'get', ['data-pjax' => 1, 'class' => 'form-inline', 'id' => 'filter']); ?>
<?php echo Html::dropDownList('cat_id', null, $categories, [
    'prompt' => 'Все',
    'class' => 'form-control',
    'options' => [$catId => ['selected ' => true]]
]); ?>
<button type="button" class="btn btn-danger" id="reset">Сбросить</button>
<?php echo Html::endForm(); ?>
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
            <th>Видео</th>
            <th>Сортировка</th>
            <th>Активность</th>
            <th></th>
        </tr>
        </thead>
        <?php foreach ($works as $work) { ?>
            <tr>
                <td><?php echo $work->id; ?></td>
                <td><?php echo $work->title; ?></td>
                <td><img src="<?php echo Yii::$app->params['params']['pathToImage'] . Works::IMG_FOLDER . 'work(' .  $work->id . ')/mini_prev_' . $work->preview; ?>"></td>
                <td><?php echo isset($work->category->title) ? $work->category->title : ''; ?></td>
                <td><?php echo !empty($work->video) ? 'Да' : 'Нет'; ?></td>
                <td><input type="text" class="form-control show_position" name="show_position" placeholder="очерёдность" value="<?php echo $work->sort ? $work->sort : 0; ?>" data-id="<?php echo $work->id; ?>"></td>
                <td class="status"><?php echo $work->active ? 'Да' : 'Нет'; ?></td>
                <td>
                    <div class="btn-group-vertical">
                        <a href="<?php echo Url::toRoute(['works/edit', 'id' => $work->id]); ?>" class="btn btn-default btn-xs">Редактировать</a>
                        <a class="btn btn-primary btn-xs btn-activate" data-value="<?php echo $work->active == 1 ? 0 : 1; ?>" data-id="<?= $work->id; ?>">
                            <span><?= $work->active ? 'Деактивировать' : 'Активировать'; ?></span>
                            <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        </a>
                        <a class="btn btn-danger btn-xs btn-delete" data-id="<?= $work->id; ?>">
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
            activeAjax($this, '<?php echo Url::toRoute('works/active'); ?>');
        });

        $('input[name="show_position"]').change(function() {
            var $this = $(this);
            var value = $(this).val();
            $.ajax({
                url: '<?php echo Url::toRoute('works/sort'); ?>',
                type: 'get',
                dataType: 'json',
                data: {id: $this.data().id, value: value}
            });
        });

        $('.btn-delete').click(function () {
            var agree = confirm('Вы действительно хотите удалить этот пункт?');
            if (agree) {
                var $this = $(this);
                deleteAjax($this, '<?php echo Url::toRoute('works/delete'); ?>');
            }
        });

        $('select.form-control[name=cat_id]').change(function() {
            if ($(this).val() == '') {
                window.location.search='';
            } else {
                $('#filter').submit();
            }
        });

        $('#reset').click(function() {
            window.location.search='';
        });
});
</script>
