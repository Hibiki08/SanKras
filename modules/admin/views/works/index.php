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
    'prompt' => 'Главный раздел',
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
            <th>Главный раздел</th>
            <th>Местоположение</th>
            <th>Активность</th>
            <th></th>
        </tr>
        </thead>
        <?php foreach ($works as $work) { ?>
            <tr>
                <td><?php echo $work->id; ?></td>
                <td><?php echo $work->title; ?></td>
                <td><img src="/<?php echo Yii::$app->params['params']['pathToImage'] . Works::IMG_FOLDER . '/mini_' . $work->preview; ?>"></td>
                <td><?php echo isset($work->category->title) ? $work->category->title : ''; ?></td>
                <td><?php echo isset($work->allCategory->title)? $work->allCategory->title : ''; ?></td>
                <td><?php echo $work->place; ?></td>
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

        $('.btn-delete').click(function () {
            var $this = $(this);
            deleteAjax($this, '<?php echo Url::toRoute('works/delete'); ?>');
        });

        $('select.form-control[name=cat_id]').change(function() {
            var $this = $(this);
            $('select.form-control[name=sub_id]').html('<option>-----</option>');
            if ($this.val() > 0) {
                $.ajax({
                    url: '<?php echo Url::toRoute('works/index'); ?>',
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
