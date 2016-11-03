<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Напишите нам';
?>
<h1><?php echo 'Заявки > ' . $this->title; ?></h1>
<div class="row-fluid">
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>#</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Текст</th>
            <th>Дата</th>
            <th>Обработана</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php if ($requests) { ?>
            <?php foreach ($requests as $master) { ?>
                <tr>
                    <td><?php echo $master->id; ?></td>
                    <td><?php echo $master->name; ?></td>
                    <td><?php echo $master->phone; ?></td>
                    <td><?php echo $master->email; ?></td>
                    <td><?php echo $master->text; ?></td>
                    <td><?php echo Yii::$app->formatter->asDate($master->date, 'd MMMM yyyy H:m'); ?></td>
                    <td class="status"><?php echo $master->processe ? 'Да' : 'Нет'; ?></td>
                    <td>
                        <div class="btn-group-vertical">
                            <a class="btn btn-primary btn-xs btn-activate" data-value="<?php echo $master->processe == 1 ? 0 : 1; ?>" data-id="<?= $master->id; ?>">
                                <span><?php echo $master->processe ? 'Не обработана' : 'Обработана'; ?></span>
                                <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                            </a>
                            <a class="btn btn-danger btn-xs btn-delete" data-id="<?= $master->id; ?>">
                                Удалить
                                <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                    <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                                </div>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
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
            var value = $this.attr('data-value');
            var id = $this.data().id;
            $this.find('.progress').show();
            $.ajax({
                url: '<?php echo Url::toRoute('write-us/processe'); ?>',
                type: 'get',
                dataType: 'json',
                data: {id: id, value: value},
                success: function (response) {
                    if (response.status == true) {
                        if (value == 1) {
                            $this.find('span').text('Не обработана');
                            $this.attr('data-value', 0);
                            $this.closest('tr').find('.status').text('Да');
                        } else {
                            $this.find('span').text('Обработана');
                            $this.attr('data-value', 1);
                            $this.closest('tr').find('.status').text('Нет');
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
                deleteAjax($this, '<?php echo Url::toRoute('write-us/delete'); ?>');
            }
        });
    });
</script>
