<?php
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\models\Blog;

$this->title = Yii::$app->request->get('id') ? 'Редактировать' : 'Добавить';
?>
<h1><?php echo 'Сео-тексты >' . $this->title; ?></h1>

<div class="row-fluid">
    <p class="text-danger"><?php echo $errors ? implode('<br/>', $errors) : ''; ?></p>
</div>

<?php $form = ActiveForm::begin([
    'options' => ['enctype'=>'multipart/form-data', 'class' => 'form-horizontal',],
    'fieldConfig' => [
        'template' => '<label class="col-lg-2 control-label"></label>{error}{label}<div class="col-lg-10">{input}</div>',
        'labelOptions' => ['class' => 'col-lg-2 control-label'],
    ],
]); ?>
<?php echo $form->field($edit, 'title')->input('text', ['value' => $model->title])->label('Заголовок'); ?>
<?php echo $form->field($edit, 'url')->dropDownList(['nashi-raboty'=>'Наши работы','chastnye-doma'=>'Частные дома','kvartiry'=>'Квартиры','video-rabot'=>'Видео работ'], ['options' => isset($model->url) ? [$model->url => ['selected ' => true]] : ''])->label('Раздел'); ?>
<?php echo $form->field($edit, 'text')->widget(CKEditor::className(), [
    'editorOptions' => ElFinder::ckeditorOptions(['elfinder'], [
        'preset' => 'full',
        'inline' => false,
    ]),
    'options' => [
        'value' => $model->text
    ]
])->label('Текст'); ?>
<?php echo $form->field($edit, 'preview', ['options' => [
    'id' => 'preview-file',
    'class' => 'form-group field-editnewsform-preview'
]])->fileInput()->label('Загрузить превью');
if (isset($model->preview)) { ?>
    <label class="col-lg-2 control-label"></label>
    <div class="slides">
        <figure>
            <img class="img-thumbnail" src="<?php echo Yii::$app->params['params']['pathToImage'] . 'blog/node/' . 'mini_' . $model->preview; ?>">
        </figure>
        <span class="glyphicon glyphicon-remove" data-new-id="<?php echo $model->id; ?>"></span>
        <?php echo $form->field($edit, 'hidden', ['template'=>'{input}', 'options' => ['class' => '', 'id' => 'preview']])->hiddenInput(['value' => $model->preview]); ?>
    </div>
<?php } ?>
<?php echo $form->field($edit, 'active')->input('checkbox', [
    'checked' => $model->active == 1 ? 'checked' : false,
    'class' => 'checkbox',
])->label('Активность'); ?>
<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        <a href="<?php echo Url::toRoute(['node/index']); ?>" class="btn btn-warning">Вернуться к списку</a>
        <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.glyphicon-remove').click(function() {
            var $this = $(this);
            var newId = $(this).data('new-id');
            $.ajax({
                url: '<?php echo Url::toRoute('node/delete-slide'); ?>',
                type: 'get',
                dataType: 'json',
                data: {newId: newId},
                success: function (response) {
                    if (response.status == true) {
                        $this.parent('.slides').find('img').remove();
                        $this.remove();
                    }
                },
                error: function () {
                }
            });
        });
    });
</script>
