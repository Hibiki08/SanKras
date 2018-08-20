<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\Html;

$this->title = 'Услуги';
?>
<h1><?php echo 'Цены > ' . $this->title; ?></h1>
<div class="row-fluid">
    <a href="<?php echo Url::toRoute('prices/edit'); ?>" class="btn btn-success">Добавить услугу</a>
</div>
<?php echo Html::beginForm(['prices/index'], 'get', ['data-pjax' => 1, 'class' => 'form-inline', 'id' => 'filter']); ?>
<?php echo Html::dropDownList('cat_id', null, $categories, [
    'prompt' => 'Всё',
    'class' => 'form-control',
    'options' => [$catId => ['selected ' => true]]
]); ?>
<?php echo Html::dropDownList('sub_id', null, $subCat, [
    'prompt' => '-----',
    'class' => 'form-control',
    'options' => [$subId => ['selected ' => true]]
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
            <th>Цена</th>
            <th>Ед. изм</th>
            <th>Раздел</th>
            <th>Страницы</th>
            <th>Активность</th>
            <th></th>
        </tr>
        </thead>
        <tbody class="sortable">
        <?php foreach ($options as $option) { ?>
            <tr data-sort="<?php echo $option->sort; ?>" data-id="<?php echo $option->id; ?>">
                <td><?php echo $option->id; ?></td>
                <td><?php echo $option->title; ?></td>
                <td><?php echo $option->price; ?></td>
                <td><?php echo $option->unit; ?></td>
                <td><?php echo $option->category->title; ?></td>
                    <td><?php if(!(empty($option->page))) { ?>
                        <?php foreach ($option->page as $page) { ?>
                        <?php if(isset($page->services) && !(empty($page->services))) { ?>
                            <?php foreach ($page->services as $serv) { ?>
                                    <p><?php echo $serv['title']; ?></p>
                            <?php } ?>
                        <?php } ?>
                        <?php } ?>
                <?php } ?></td>
                <td class="status"><?php echo $option->active ? 'Да' : 'Нет'; ?></td>
                <td>
                    <div class="btn-group-vertical">
                        <a href="<?php echo Url::toRoute(['prices/edit', 'id' => $option->id]); ?>" class="btn btn-default btn-xs">Редактировать</a>
                        <a class="btn btn-primary btn-xs btn-activate" data-value="<?php echo $option->active == 1 ? 0 : 1; ?>" data-id="<?= $option->id; ?>">
                            <span><?= $option->active ? 'Деактивировать' : 'Активировать'; ?></span>
                            <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        </a>
                        <a class="btn btn-danger btn-xs btn-delete" data-id="<?= $option->id; ?>">
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
    <?php if (!is_null($pager)) { ?>
    <div class="row-fluid pager">
        <?php echo LinkPager::widget([
            'pagination' => $pager,
        ]); ?>
    </div>
    <?php } ?>
    </div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-activate').click(function () {
            var $this = $(this);
            activeAjax($this, '<?php echo Url::toRoute('prices/active'); ?>');
        });

        $('.btn-delete').click(function () {
            var agree = confirm('Вы действительно хотите удалить этот пункт?');
            if (agree) {
                var $this = $(this);
                deleteAjax($this, '<?php echo Url::toRoute('prices/delete'); ?>');
            }
        });

        $('#save-sort').click(function() {
            var data = {};
            var id, idSub;
            for (var i = 0; i < $('#sort-table tbody tr').length; i++) {
                id = $('#sort-table tbody tr').eq(i).attr('data-sort', i).data().id;
                data[id] = i;
            }

            sortAjax(data, '<?php echo Url::toRoute('prices/sort'); ?>');
        });

        $('select.form-control[name=cat_id]').change(function() {
            var $this = $(this);
            $('select.form-control[name=sub_id]').html('<option>-----</option>');
            if ($this.val() > 0) {
                $.ajax({
                    url: '<?php echo Url::toRoute('prices/index'); ?>',
                    type: 'get',
                    dataType: 'json',
                    data: {cat_id: $this.val()},
                    success: function (response) {
                        if (response.status == true) {
                            if (Object.keys(response.subCat).length > 0) {
                                var html = '<option>Все</option>';
                                for (var i in response.subCat) {
                                    html += '<option value="' + i + '">' + response.subCat[i] + '</option>';
                                }

                                $('select.form-control[name=sub_id]').html(html);
                            }
                        }
                        else {
                            $('select.form-control[name=sub_id]').html('<option>-----</option>');
                        }
                    },
                    error: function () {
                    }
                });
            } else {
                window.location.search='';
            }
        });

        $('select.form-control[name=sub_id]').change(function() {
            $('#filter').submit();
        });
        $('#reset').click(function() {
            window.location.search='';
        });
    });
</script>
