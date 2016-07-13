<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Разделы';
?>
<h1><?php echo 'Работы > ' . $this->title; ?></h1>
<div class="row-fluid">
    <a href="<?php echo Url::toRoute('works-section/edit'); ?>" class="btn btn-success">Добавить раздел</a>
</div>

<div class="row-fluid sections">
    <div class="progress progress-striped active sort-progress">
        <div class="progress-bar progress-bar-info" style="width: 100%"></div>
    </div>
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-6">Название</th>
            <th class="col-md-5">Активность</th>
        </tr>
        </thead>
    </table>
    <ul id="accordion" class="sortable">
        <?php foreach ($categories as $category) { ?>
            <?php if ($category->parent_id == null) { ?>
                <li data-id="<?php echo $category->id; ?>"><a href="#id<?php echo $category->id; ?>">
                        <span class="col-md-1"><?php echo $category->id; ?></span><?php echo $category->title; ?>
                    </a>
                    <ul class="sub-cat sortable">
                        <?php foreach ($categories as $cat) { ?>
                            <?php if ($cat->parent_id == $category->id) { ?>
                                <li id="id<?php echo $cat->id; ?>" data-id="<?php echo $cat->id; ?>">
                                    <div class="col-md-1"><?php echo $cat->id; ?></div>
                                    <div class="col-md-6"><?php echo $cat->title . ' ' . $cat->description; ?></div>
                                    <div class="status col-md-4"><?php echo $cat->active ? 'Да' : 'Нет'; ?></div>
                                    <div class="status col-md-1">
                                        <div class="btn-group-vertical">
                                            <a href="<?php echo Url::toRoute(['works-section/edit', 'id' => $cat->id]); ?>" class="btn btn-default btn-xs" title="Редактировать"></a>
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
                        <div class="status col-md-9"><?php echo $category->active ? 'Да' : 'Нет'; ?></div>
                        <div class="btn-group-vertical">
                            <a href="<?php echo Url::toRoute(['works-section/edit', 'id' => $category->id]); ?>" class="btn btn-default btn-xs">Редактировать</a>
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
            var value = $this.attr('data-value');
            var id = $this.data().id;
            $this.find('.progress').show();
            $.ajax({
                url: '<?php echo Url::toRoute('works-section/active'); ?>',
                type: 'get',
                dataType: 'json',
                data: {id: id, value: value},
                success: function (response) {
                    if (response.status == true) {
                        if (value == 1) {
                            $this.find('span').text('Деактивировать');
                            $this.attr('data-value', 0);
                            $this.closest('.data').find('.status').text('Да');
                        } else {
                            $this.find('span').text('Активировать');
                            $this.attr('data-value', 1);
                            $this.closest('.data').find('.status').text('Нет');
                        }
                    }
                    $this.find('.progress').hide();
                },
                error: function () {
                    $this.find('.progress').hide();
                }
            });
        });

        $('.btn-activate.mini').click(function () {
            var $this = $(this);
            var value = $this.attr('data-value');
            var id = $this.data().id;
            $this.find('.progress').show();
            $.ajax({
                url: '<?php echo Url::toRoute('works-section/active'); ?>',
                type: 'get',
                dataType: 'json',
                data: {id: id, value: value},
                success: function (response) {
                    if (response.status == true) {
                        if (value == 1) {
                            $this.attr('title', 'Деактивировать');
                            $this.attr('data-value', 0);
                            $this.closest('.status').prev('.status').text('Да');
                        } else {
                            $this.attr('title', 'Активировать');
                            $this.attr('data-value', 1);
                            $this.closest('.status').prev('.status').text('Нет');
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
            var $this = $(this);
            $this.find('.progress').show();
            $.ajax({
                url: '<?php echo Url::toRoute('works-section/delete'); ?>',
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
        });
    });
</script>
