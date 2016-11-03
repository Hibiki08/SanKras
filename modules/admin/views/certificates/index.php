<?php
use yii\helpers\Url;
use app\models\Certificates;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Сертификаты';
?>
<h1><?php echo 'О нас > ' . $this->title; ?></h1>
<?php $form = ActiveForm::begin([
    'options' => ['enctype'=>'multipart/form-data', 'class' => 'form-inline certificate',],
    'fieldConfig' => [
        'template' => '{label}<div class="col-lg-10">{input}</div>',
        'labelOptions' => ['class' => 'col-lg-2 control-label'],
    ],
]); ?>
<?php echo $form->field($edit, 'img', [
        'template' => '<label class="certificate-label"><div class="btn btn-success">Добавить сертификат</div>{input}</label>'
    ])->fileInput(); ?>
<?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>
<?php ActiveForm::end(); ?>
<div class="sort">
    <button type="button" class="btn btn-info" id="sort">Сортировать</button>
    <button type="button" class="btn btn-primary" id="save-sort">Сохранить</button>
</div>
<div class="row-fluid sections">
    <div class="progress progress-striped active sort-progress">
        <div class="progress-bar progress-bar-info" style="width: 100%"></div>
    </div>
    <table id="sort-table" class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>#</th>
            <th>Сертификат</th>
            <th>Активность</th>
            <th></th>
        </tr>
        </thead>
        <tbody class="sortable">
        <?php if ($certificates) { ?>
            <?php foreach ($certificates as $certificate) { ?>
                <tr data-sort="<?php echo $certificate->sort; ?>" data-id="<?php echo $certificate->id; ?>">
                    <td><?php echo $certificate->id; ?></td>
                    <td><img src="<?php echo Yii::$app->params['params']['pathToImage'] . Certificates::IMG_FOLDER . 'mini_' . $certificate->img; ?>"></td>
                    <td class="status"><?php echo $certificate->active ? 'Да' : 'Нет'; ?></td>
                    <td>
                        <div class="btn-group-vertical">
                            <a class="btn btn-primary btn-xs btn-activate" data-value="<?php echo $certificate->active == 1 ? 0 : 1; ?>" data-id="<?= $certificate->id; ?>">
                                <span><?= $certificate->active ? 'Деактивировать' : 'Активировать'; ?></span>
                                <div class="progress progress-striped active" style="border-radius: 0;margin: 0;height: 3px; display: none">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                            </a>
                            <a class="btn btn-danger btn-xs btn-delete" data-id="<?= $certificate->id; ?>">
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
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-activate').click(function () {
            var $this = $(this);
            activeAjax($this, '<?php echo Url::toRoute('certificates/active'); ?>');
        });

        $('.btn-delete').click(function () {
            var agree = confirm('Вы действительно хотите удалить этот пункт?');
            if (agree) {
                var $this = $(this);
                deleteAjax($this, '<?php echo Url::toRoute('certificates/delete'); ?>');
            }
        });

        $('.certificate').submit(function() {
            if ($(this).find('div').has('has-success')) {
                return true;
            } else {
                $(this).find('div').addClass('has-error');
                return false;
            }
        });

        $('#save-sort').click(function() {
            var data = {};
            var id, idSub;
            for (var i = 0; i < $('#sort-table tbody tr').length; i++) {
                id = $('#sort-table tbody tr').eq(i).attr('data-sort', i).data().id;
                data[id] = i;
            }

            sortAjax(data, '<?php echo Url::toRoute('certificates/sort'); ?>');
        });
    });
</script>
