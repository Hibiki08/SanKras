<?php
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\models\Works;

$this->title = Yii::$app->request->get('id') ? 'Редактировать' : 'Добавить';
?>
<h1><?php echo 'Работы > ' . $this->title; ?></h1>

<div class="row-fluid">
    <p class="text-danger"><?php echo $errors ? implode('<br/>', $errors) : ''; ?></p>
</div>

<?php $form = ActiveForm::begin(['enableClientValidation' => true,
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'id' => 'form'],
    'fieldConfig' => [
        'template' => '<label class="col-lg-2 control-label"></label>{error}{label}<div class="col-lg-10">{input}</div>',
        'labelOptions' => ['class' => 'col-lg-2 control-label'],
    ],
]); ?>
<?php echo $form->field($edit, 'title')->input('text', ['value' => $model->title])->label('Название*'); ?>
<?php echo $form->field($edit, 'url')->input('text', ['value' => $model->url])->label('URL*'); ?>
<?php echo $form->field($edit, 'text')->widget(CKEditor::className(), [
    'editorOptions' => ElFinder::ckeditorOptions(['elfinder'], [
        'preset' => 'full',
        'inline' => false,
    ]),
    'options' => [
        'value' => $model->text
    ]
])->label('Текст*'); ?>
<?php echo $form->field($edit, 'cat_id')->dropDownList($categories, ['options' => [ $model->cat_id => ['selected ' => true]]])->label('Раздел*'); ?>
<?php echo $form->field($edit, 'year')->input('text', ['value' => !empty($model->year) ? $model->year : Yii::$app->formatter->asDate(time(), 'yyyy')])->label('Год выполнения*'); ?>
<?php echo $form->field($edit, 'area', [
    'template' => '<label class="col-lg-2 control-label"></label>{error}{label}<div class="col-lg-10 add-text">{input}м<sup>2</sup></div>'
])->input('text', ['value' => $model->area, 'placeholder' => 80])->label('Площадь помещения*'); ?>
<?php echo $form->field($edit, 'cost_install', [
    'template' => '<label class="col-lg-2 control-label"></label>{error}{label}<div class="col-lg-10 add-text">{input}тыс. руб.</div>'
])->input('text', ['value' => $model->cost_install])->label('Ст-ть монтажа*'); ?>
<?php echo $form->field($edit, 'cost_material', [
    'template' => '<label class="col-lg-2 control-label"></label>{error}{label}<div class="col-lg-10 add-text">{input}тыс. руб.</div>'
])->input('text', ['value' => $model->cost_material])->label('Ст-ть материала*'); ?>
<?php echo $form->field($edit, 'time')->input('text', ['value' => $model->time, 'placeholder' => '7 дней'])->label('Время выполнения'); ?>
<?php echo $form->field($edit, 'video')->input('text', ['value' => $model->video, 'placeholder' => 'https://www.youtube.com/watch?v=UtEYIfnojM8'])->label('Видео'); ?>
<?php $edit->preview_items = !empty($model->preview_items) ? $model->preview_items : "пункт1;\nпунтк2;\nпункт3;\nпункт4 - макс 4 пункта"; echo $form->field($edit, 'preview_items')->textarea(['rows' => '6'])->label('Пункты превью*'); ?>
<?php $edit->work_items = !empty($model->work_items) ? $model->work_items : "пункт1;\nпунтк2;\nпункт3;\nпункт4 и т.д"; echo $form->field($edit, 'work_items')->textarea(['rows' => '10'])->label('Пункты работы*'); ?>
<?php echo $form->field($edit, 'sort')->input('text', ['value' => $model->sort ? $model->sort : 0])->label('Сортировка'); ?>
<?php echo $form->field($edit, 'preview', ['options' => [
    'class' => isset($errors['emptyImage']) ? 'has-error form-group' : 'form-group',
    'id' => 'preview-file'
]])->fileInput()->label('Загрузить превью*');
if (isset($model->preview)) { ?>
    <label class="col-lg-2 control-label"></label>
    <div class="slides">
        <figure>
            <img class="img-thumbnail" src="<?php echo Yii::$app->params['params']['pathToImage'] . Works::IMG_FOLDER . 'work(' . $model->id . ')' . '/mini_prev_' . $model->preview; ?>">
        </figure>
        <?php echo $form->field($edit, 'hidden', ['template'=>'{input}', 'options' => ['class' => '', 'id' => 'preview']])->hiddenInput(['value' => $model->preview]); ?>
    </div>
<?php } ?>
<?php echo @$form->field($edit, 'slides[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label('Загрузить слайды'); ?>
<?php if (!empty($slides)) { ?>
    <div class="other-slides">
        <?php foreach ($slides as $slide) {
            if (isset($slide->slide)) { ?>
                <div>
                    <label class="col-lg-2 control-label"></label>
                    <div class="slides">
                        <figure>
                            <img class="img-rounded" src="<?php echo Yii::$app->params['params']['pathToImage'] . Works::IMG_FOLDER . 'work(' . $model->id . ')' . '/mini_' . $slide->slide; ?>">
                        </figure>
                        <?php echo $form->field($edit, 'slide[' . $slide->id . ']', ['template'=>'{input}'])->input('text', ['value' => $slide->text, 'class' => 'form-control image'])->label(''); ?>
                        <span class="glyphicon glyphicon-remove" data-slide-id="<?php echo $slide->id; ?>"></span>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
<?php } ?>
<?php echo $form->field($edit, 'active')->input('checkbox', [
    'checked' => $model->active == 1 ? 'checked' : false,
    'class' => 'checkbox',
])->label('Активность'); ?>
<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        <a href="<?php echo Url::toRoute(['works/index']); ?>" class="btn btn-warning">Вернуться к списку</a>
        <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.glyphicon-remove').click(function() {
            var $this = $(this);
            var workId = $(this).data('work-id') ? $(this).data('work-id') : false;
            var slideId = $(this).data('slide-id') ? $(this).data('slide-id') : false;
            $.ajax({
                url: '<?php echo Url::toRoute('works/delete-slide'); ?>',
                type: 'get',
                dataType: 'json',
                data: {workId: workId, slideId: slideId},
                success: function (response) {
                    if (response.status == true) {
                        if (workId) {
                            $this.parent('.slides').find('input[type=hidden]').val('');
                            $this.parent('.slides').find('img').attr('src', '<?php echo '/' . Yii::$app->params['params']['pathToImage']; ?>')
                        }
                        if (slideId) {
                            $this.parent('.slides').prev('label').remove();
                            $this.parent('.slides').remove();
                        }
                    }
                },
                error: function () {
                }
            });
        });
    });
</script>