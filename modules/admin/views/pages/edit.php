<?php
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\models\Services;

$this->title = Yii::$app->request->get('id') ? 'Редактировать' : 'Добавить';
?>
<h1><?php echo 'Посадочные страницы > ' . $this->title; ?></h1>

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
<?php echo $form->field($edit, 'tag_title')->input('text', ['value' => $model->tag_title])->label('Тег title*'); ?>
<?php echo $form->field($edit, 'tag_description')->input('text', ['value' => $model->tag_description])->label('Тег description*'); ?>
<?php echo $form->field($edit, 'tag_keywords')->input('text', ['value' => $model->tag_keywords])->label('Тег keywords*'); ?>
<?php echo $form->field($edit, 'title')->input('text', ['value' => $model->title])->label('Заголовок страницы*'); ?>
<?php echo $form->field($edit, 'link')->input('text', ['value' => $model->link])->label('Ссылка на страницу*'); ?>
<?php //echo $form->field($edit, 'form_title')->input('text', ['value' => $model->form_title])->label('Заголовок формы*'); ?>
<?php echo $form->field($edit, 'gallery_title')->input('text', ['value' => $model->gallery_title])->label('Заголовок галереи*'); ?>
<?php echo $form->field($edit, 'price_title')->input('text', ['value' => $model->price_title])->label('Заголовок блока с ценами*'); ?>
<?php echo $form->field($edit, 'form_title')->widget(CKEditor::className(), [
    'editorOptions' => ElFinder::ckeditorOptions(['elfinder'], [
        'preset' => 'basic',
        'inline' => false,
    ]),
    'options' => [
        'value' => $model->form_title
    ]
])->label('Заголовок формы*'); ?>
<?php echo $form->field($edit, 'prev_field')->widget(CKEditor::className(), [
    'editorOptions' => ElFinder::ckeditorOptions(['elfinder'], [
        'preset' => 'full',
        'inline' => false,
    ]),
    'options' => [
        'value' => $model->prev_field
    ]
])->label('Поле с коротким текстом*'); ?>
<?php echo $form->field($edit, 'main_text')->widget(CKEditor::className(), [
    'editorOptions' => ElFinder::ckeditorOptions(['elfinder'], [
        'preset' => 'full',
        'inline' => false,
    ]),
    'options' => [
        'value' => $model->main_text
    ]
])->label('Основной текст*'); ?>
<?php echo $form->field($edit, 'work_text')->widget(CKEditor::className(), [
    'editorOptions' => ElFinder::ckeditorOptions(['elfinder'], [
        'preset' => 'full',
        'inline' => false,
    ]),
    'options' => [
        'value' => $model->work_text
    ]
])->label('Список работ'); ?>
<?php echo $form->field($edit, 'packages')->widget(CKEditor::className(), [
    'editorOptions' => ElFinder::ckeditorOptions(['elfinder'], [
        'preset' => 'full',
        'inline' => false,
    ]),
    'options' => [
        'value' => $model->packages
    ]
])->label('Пакеты'); ?>
<?php echo $form->field($edit, 'package_ex')->input('checkbox', [
    'checked' => $model->package_ex == 1 ? 'checked' : false,
    'class' => 'checkbox',
])->label('Отображение пакетов'); ?>
<?php echo $form->field($edit, 'table_ex')->input('checkbox', [
    'checked' => $model->table_ex == 1 ? 'checked' : false,
    'class' => 'checkbox',
])->label('Отображение таблицы'); ?>
<?php $edit->img_video = $model->img_video; ?>
<?php echo $form->field($edit, 'img_video')->radioList([
    '1' => 'Отображение картинки',
    '2' => 'Отображение видео'
]); ?>
<?php echo $form->field($edit, 'benefits')->input('checkbox', [
    'checked' => $model->benefits == 1 ? 'checked' : false,
    'class' => 'checkbox',
])->label('Отображение блока с выгодами'); ?>
<?php echo $form->field($edit, 'video')->input('text', ['value' => $model->video, 'placeholder' => 'https://www.youtube.com/watch?v=UtEYIfnojM8'])->label('Видео'); ?>
<?php echo $form->field($edit, 'parent_id')->dropDownList($categories, ['options' => [ $model->parent_id => ['selected ' => true]]])->label('Родительская страница*'); ?>
<?php //echo $form->field($edit, 'sort')->input('text', ['value' => $model->sort ? $model->sort : 0])->label('Сортировка'); ?>
<?php echo $form->field($edit, 'image', ['options' => [
    'class' => isset($errors['emptyImage']) ? 'has-error form-group' : 'form-group',
    'id' => 'preview-file'
]])->fileInput()->label('Загрузить главную картинку');
if (isset($model->image)) { ?>
    <label class="col-lg-2 control-label"></label>
    <div class="slides">
        <figure>
            <img class="img-thumbnail" src="<?php echo Yii::$app->params['params']['pathToImage'] . Services::IMG_FOLDER . 'page(' . $model->id . ')' . '/mini_prev_' . $model->image; ?>">
        </figure>
        <?php echo $form->field($edit, 'hidden', ['template'=>'{input}', 'options' => ['class' => '', 'id' => 'image']])->hiddenInput(['value' => $model->image]); ?>
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
                            <img class="img-rounded" src="<?php echo Yii::$app->params['params']['pathToImage'] . \app\models\ServicesSlides::IMG_FOLDER . 'page(' . $model->id . ')' . '/mini_' . $slide->slide; ?>">
                        </figure>
                        <?php echo $form->field($edit, 'slide_text[' . $slide->id . ']', ['template'=>'{input}'])->input('text', ['value' => $slide->text, 'class' => 'form-control image'])->label(''); ?>
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
        <a href="<?php echo Url::toRoute(['pages/index']); ?>" class="btn btn-warning">Вернуться к списку</a>
        <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.glyphicon-remove').click(function() {
            var $this = $(this);
            var slideId = $(this).data('slide-id') ? $(this).data('slide-id') : false;
            $.ajax({
                url: '<?php echo Url::toRoute('pages/delete-slide'); ?>',
                type: 'post',
                dataType: 'json',
                data: {
                    slideId: slideId,
                    _csrf: yii.getCsrfToken()
                },
                success: function (response) {
                    if (response.status == true) {
                            $this.parent('.slides').prev('label').remove();
                            $this.parent('.slides').remove();
                    }
                },
                error: function () {
                }
            });
        });
    });
</script>