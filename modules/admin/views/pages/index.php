<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use app\models\Services;

$this->title = 'Список';
?>
<h1><?php echo 'Посадочные страницы > ' . $this->title; ?></h1>
<div class="row-fluid">
    <a href="<?php echo Url::toRoute('pages/edit'); ?>" class="btn btn-success">Добавить страницу</a>
</div>
<?php echo Html::beginForm(['pages/index'], 'get', ['data-pjax' => 1, 'class' => 'form-inline', 'id' => 'filter']); ?>
<?php echo Html::dropDownList('parent_id', null, $categories, [
    'prompt' => 'Все',
    'class' => 'form-control',
    'options' => [$parentId => ['selected ' => true]]
]); ?>
<button type="button" class="btn btn-danger" id="reset">Сбросить</button>
<?php echo Html::endForm(); ?>
<div class="sort">
    <button type="button" class="btn btn-info" id="sort">Сортировать</button>
    <button type="button" class="btn btn-primary" id="save-sort">Сохранить</button>
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
            <th>Title</th>
            <th>Keywords</th>
            <th>Description</th>
            <th>Категория</th>
            <th>Активность</th>
            <th></th>
        </tr>
        </thead>
        <tbody class="sortable">
        <?php foreach ($services as $service) { ?>
            <tr data-sort="<?php echo $service['sort']; ?>" data-id="<?php echo $service['id']; ?>">
                <td><?php echo $service['id']; ?></td>
                <td><?php echo $service['title']; ?></td>
                <td><?php echo $service['tag_title']; ?></td>
                <td><?php echo $service['tag_keywords']; ?></td>
                <td><?php echo $service['tag_description']; ?></td>
                <td><?php echo isset($service->parent[0]['title']) ? $service->parent[0]['title'] : ''; ?></td>
                <td class="status"><?php echo $service['active'] ? 'Да' : 'Нет'; ?></td>
                <td>
                    <div class="btn-group-vertical">
                        <a href="<?php echo Url::toRoute(['pages/edit', 'id' => $service['id']]); ?>" class="btn btn-default btn-xs">Редактировать</a>
                        <a class="btn btn-primary btn-xs btn-activate" data-value="<?php echo $service['active'] == 1 ? 0 : 1; ?>" data-id="<?= $service['id']; ?>">
                            <span><?= $service['active'] ? 'Деактивировать' : 'Активировать'; ?></span>
                            <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        </a>
                        <a class="btn btn-danger btn-xs btn-delete" data-id="<?= $service['id']; ?>">
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
            activeAjax($this, '<?php echo Url::toRoute('pages/active'); ?>');
        });

        $('#save-sort').click(function() {
            var data = {};
            var id, idSub;
            for (var i = 0; i < $('#sort-table tbody tr').length; i++) {
                id = $('#sort-table tbody tr').eq(i).attr('data-sort', i).data().id;
                data[id] = i;
            }
            console.log(data);
            sortAjax(data, '<?php echo Url::toRoute('pages/sort'); ?>');
        });

        $('.btn-delete').click(function () {
            var agree = confirm('Вы действительно хотите удалить этот пункт?');
            if (agree) {
                var $this = $(this);
                deleteAjax($this, '<?php echo Url::toRoute('pages/delete'); ?>');
            }
        });

        $('select.form-control[name=parent_id]').change(function() {
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
