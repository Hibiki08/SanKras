<?php
use yii\helpers\Url;
use app\models\Slides;

$this->title = 'Обратный звонок';
?>
<h1><?php echo 'Заявки > ' . $this->title; ?></h1>
<div class="row-fluid">
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>#</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Дата</th>
            <th>Обработана</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php if ($requests) { ?>
            <?php foreach ($requests as $card) { ?>
                <tr>
                    <td><?php echo $card->id; ?></td>
                    <td><?php echo $card->name; ?></td>
                    <td><?php echo $card->phone; ?></td>
                    <td><?php echo Yii::$app->formatter->asDate($card->date, 'd MMMM yyyy'); ?></td>
                    <td class="status"><?php echo $card->processe ? 'Да' : 'Нет'; ?></td>
                    <td>
                        <div class="btn-group-vertical">
                            <a class="btn btn-primary btn-xs btn-activate" data-value="<?php echo $card->processe == 1 ? 0 : 1; ?>" data-id="<?= $card->id; ?>">
                                <span><?php echo $card->processe ? 'Не обработана' : 'Обработана'; ?></span>
                                <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-activate').click(function () {
            var $this = $(this);
            var value = $this.attr('data-value');
            var id = $this.data().id;
            $this.find('.progress').show();
            $.ajax({
                url: '<?php echo Url::toRoute('callback/processe'); ?>',
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
    });
</script>