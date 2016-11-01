<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Разделы';
?>
<h1><?php echo 'Цены > ' . $this->title; ?></h1>
<div class="row-fluid">
    <a href="<?php echo Url::toRoute('price-section/edit'); ?>" class="btn btn-success">Добавить раздел</a>
</div>

<div class="sort">
    <button type="button" class="btn btn-info" id="sort">Сортировать</button>
    <button type="button" class="btn btn-primary" id="save-sort">Сохранить</button>
</div>

<div class="row-fluid sections">
    <div class="progress progress-striped active sort-progress">
        <div class="progress-bar progress-bar-info" style="width: 100%"></div>
    </div>
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-4">Название</th>
            <th class="col-md-3">Ссылка</th>
            <th class="col-md-2">Активность</th>
            <th class="col-md-2"></th>
        </tr>
        </thead>
    </table>
    <ul id="accordion" class="sortable">
        <?php foreach ($categories as $category) { ?>
            <?php if ($category->parent_id == null) { ?>
        <li class="clear" data-sort="<?php echo $category->sort; ?>" data-id="<?php echo $category->id; ?>"><a href="#id<?php echo $category->id; ?>">
                <span class="col-md-1"><?php echo $category->id; ?></span>
                <span class="col-md-4"><?php echo $category->title; ?></span>
                <span class="col-md-3"><?php echo $category->link; ?></span>
                <span class="status col-md-2" data-id="<?php echo $category->id; ?>"><?php echo $category->active ? 'Да' : 'Нет'; ?></span>
            </a>
            <ul class="sub-cat sortable">
                <?php foreach ($categories as $cat) { ?>
                    <?php if ($cat->parent_id == $category->id) { ?>
                <li class="clear" id="id<?php echo $cat->id; ?>" data-sort="<?php echo $cat->sort; ?>" data-id="<?php echo $cat->id; ?>">
                    <div class="col-md-1"><?php echo $cat->id; ?></div>
                    <div class="col-md-4"><?php echo $cat->title; ?></div>
                    <span class="col-md-3"><?php echo $cat->link; ?></span>
                    <div class="status col-md-2" data-id="<?php echo $cat->id; ?>"><?php echo $cat->active ? 'Да' : 'Нет'; ?></div>
                    <div class="data col-md-1" data-id="<?php echo $cat->id; ?>">
                        <div class="btn-group-vertical">
                            <a href="<?php echo Url::toRoute(['price-section/edit', 'id' => $cat->id]); ?>" class="btn btn-default btn-xs" title="Редактировать"></a>
                            <a class="btn btn-primary btn-xs btn-activate mini" data-value="<?php echo $cat->active == 1 ? 0 : 1; ?>" data-id="<?= $cat->id; ?>" title="<?= $cat->active ? 'Деактивировать' : 'Активировать'; ?>">
                                <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                            </a>
                            <a class="btn btn-danger btn-xs btn-delete" data-id="<?= $cat->id; ?>" title="Удалить">
                                <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                    <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </li>
                    <?php } ?>
                <?php } ?>
            </ul>
            <div class="data">
                <div class="btn-group-vertical">
                    <a href="<?php echo Url::toRoute(['price-section/edit', 'id' => $category->id]); ?>" class="btn btn-default btn-xs">Редактировать</a>
                    <a class="btn btn-primary btn-xs btn-activate" data-value="<?php echo $category->active == 1 ? 0 : 1; ?>" data-id="<?= $category->id; ?>">
                        <span><?= $category->active ? 'Деактивировать' : 'Активировать'; ?></span>
                        <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                    </a>
                    <a class="btn btn-danger btn-xs btn-delete" data-id="<?= $category->id; ?>">
                        Удалить
                        <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                            <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                        </div>
                    </a>
                </div>
            </div>
        </li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#accordion').accordion({
            heightStyle: "content"
        });

        $('.btn-activate').click(function () {
            var $this = $(this);
            var id = $this.data().id;
            var value = $this.attr('data-value');
            $this.find('.progress').show();
            $.ajax({
                url: '<?php echo Url::toRoute('price-section/active'); ?>',
                type: 'get',
                dataType: 'json',
                data: {id: id, value: value},
                success: function (response) {
                    if (response.status == true) {
                        if (value == 1) {
                            $this.find('span').text('Деактивировать');
                            $('.btn-activate.mini[data-id=' + id + ']').attr('title', 'Деактивировать');
                            $this.attr('data-value', 0);
                            $('.status[data-id=' + id + ']').text('Да');
                        } else {
                            $this.find('span').text('Активировать');
                            $('.btn-activate.mini[data-id=' + id + ']').attr('title', 'Активировать');
                            $this.attr('data-value', 1);
                            $('.status[data-id=' + id + ']').text('Нет');
                        }
                    }
                    $this.find('.progress').hide();
                },
                error: function () {
                    $this.find('.progress').hide();
                }
            });
        });

        $('.btn-delete').click(function () {
            var agree = confirm('Вы действительно хотите удалить этот пункт?');
            if (agree) {
                var $this = $(this);
                $this.find('.progress').show();
                $.ajax({
                    url: '<?php echo Url::toRoute('price-section/delete'); ?>',
                    type: 'get',
                    dataType: 'json',
                    data: {id: $this.data().id},
                    success: function (response) {
                        if (response.status == true) {
                            $('li[data-id=' + $this.data().id + ']').remove();
                        }
                        $this.find('.progress').hide();
                    },
                    error: function () {
                        $this.find('.progress').hide();
                    }
                });
            }
        });

        $('#save-sort').click(function() {
            var data = {};
            var id, idSub;
            for (var i = 0; i < $('#accordion > li').length; i++) {
                id = $('#accordion > li').eq(i).attr('data-sort', i).data().id;
                data[id] = i;
            }
            for (var c = 0; c < $('.sub-cat > li').length; c++) {
                idSub = $('.sub-cat > li').eq(c).attr('data-sort', c).data().id;
                data[idSub] = c;
            }

            sortAjax(data, '<?php echo Url::toRoute('price-section/sort'); ?>');
        });
    });
</script>
