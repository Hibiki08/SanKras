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
<?php echo $form->field($edit, 'title_menu')->input('text', ['value' => $model->title_menu])->label('Заголовок пункта меню*'); ?>
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
]); ?>
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
<?php echo $form->field($edit, 'video')->input('text', ['value' => $model->video, 'placeholder' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/C4xGb7aMsDQ" frameborder="0" allowfullscreen></iframe>'])->label('Видео'); ?>
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
<hr>
<h4>Видео</h4>
	<?php echo $form->field($edit, 'videos_show')->input('checkbox', ['value' => '1', 'checked' => $model->videos_show == 1 ? 'checked' : false, 'class' => 'checkbox'])->label('Отображать блок видеозаписей'); ?>
	<div class="form-group field-editserviceform-videos">
	<label class="col-lg-2 control-label">Список видеозаписей</label><div class="col-lg-10 videos-collection">
	<?php
	if(!empty($model->videos)){
	 $vids = json_decode($model->videos);
	 $vids_name = json_decode($model->videos_name);
	 $i = 0;
	 foreach ($vids as $k=>$v){?>
	  <div><input type="hidden" class="form-control" name="EditServiceForm[videos][<?=$k?>]" value="<?=$v?>"><input type="hidden" class="form-control" name="EditServiceForm[videos_name][]" value="<?=$vids_name[$i]?>">
	  <span style="width:60%;"><?=$v?> - <?=$k?></span>
	  <span class="glyphicon glyphicon-remove"></span></div>
	<?php  $i++;
	 }
	}
	?>
	  <div>
		<input type="text" class="form-control" value="" placeholder="Название видео" style="width:70%;display:block;">
		<input type="text" class="form-control" value="" placeholder="Описание видео" style="width:70%;display:block;">
		<input type="text" class="form-control" value="" placeholder="Cсылка видео" style="width:70%;display:block;">
		<span class="glyphicon glyphicon-plus" style="color: blue;float: right;margin: -43px 250px 0px 0px;cursor: pointer;"></span>
	  </div>
	 </div>
	</div>
<hr>
<h4>Слайдер</h4>
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
                        <?php echo $form->field($edit, 'slide_text[' . $slide->id . ']', ['template'=>'{input}'])->input('text', ['value' => $slide->text, 'class' => 'form-control image', 'placeholder' => 'Название'])->label(''); ?>
                        <?php echo $form->field($edit, 'slide_description[' . $slide->id . ']', ['template'=>'{input}'])->input('text', ['value' => $slide->description, 'class' => 'form-control image', 'placeholder' => 'Описание'])->label(''); ?>
                        <span class="glyphicon glyphicon-remove" data-slide-id="<?php echo $slide->id; ?>"></span>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
<?php } ?>
<hr>
<h4>Проектная документация</h4>
<?php echo $form->field($edit, 'projectdocs_active')->input('checkbox', ['checked' => $model->projectdocs_active == 1 ? 'checked' : false, 'class' => 'checkbox',])->label('Активность'); ?>
<?php echo $form->field($edit, 'projectdocs_title')->input('text', ['value' => $model->projectdocs_title])->label('Заголовок'); ?>
<?php echo @$form->field($edit, 'projectdocs[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label('Загрузить картинку'); ?>
<?php if (!empty($projectdocs)) { ?>
    <div class="other-projectdocs">
        <?php foreach ($projectdocs as $doc) {
            if (isset($doc->image)) { ?>
                <div>
                    <label class="col-lg-2 control-label"></label>
                    <div class="slides">
                        <figure>
                            <img class="img-rounded" src="<?php echo Yii::$app->params['params']['pathToImage'] . \app\models\ServicesProjectdocs::IMG_FOLDER . 'page(' . $model->id . ')' . '/mini_' . $doc->image; ?>">
                        </figure>
                        <?php echo $form->field($edit, 'projectdocs_name[' . $doc->id . ']', ['template'=>'{input}'])->input('text', ['value' => $doc->name, 'class' => 'form-control image', 'placeholder' => 'Название'])->label(''); ?>
                        <?php echo $form->field($edit, 'projectdocs_description[' . $doc->id . ']', ['template'=>'{input}'])->input('text', ['value' => $doc->description, 'class' => 'form-control image', 'placeholder' => 'Описание'])->label(''); ?>
                        <span class="glyphicon glyphicon-remove" data-doc-id="<?php echo $doc->id; ?>"></span>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
<?php } ?>
<hr>
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
        $('.other-slides .glyphicon-remove').click(function() {
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
        $('.other-projectdocs .glyphicon-remove').click(function() {
            var $this = $(this);
            var docId = $(this).data('doc-id') ? $(this).data('doc-id') : false;
            $.ajax({
                url: '<?php echo Url::toRoute('pages/delete-doc'); ?>',
                type: 'post',
                dataType: 'json',
                data: {
                    docId: docId,
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
        $('body').on('click','.videos-collection .glyphicon-plus',function(){
          d = $(this).closest('div');
          i = d.find('input');
          $(d).before('<div><input type="hidden" name="EditServiceForm[videos]['+i[2].value+']" value="'+i[0].value+'"><input type="hidden" name="EditServiceForm[videos_name][]" value="'+i[1].value+'"><span style="width:60%;">'+i[0].value+' - '+i[2].value+'</span> <span class="glyphicon glyphicon-remove"></span></div>');
          i.val('');
        });
        $('body').on('click','.videos-collection .glyphicon-remove',function(){
          $(this).closest('div').remove();
        });
    });
</script>
<style>
.videos-collection div span {
  display:inline-block;
}
.videos-collection > div {
margin-bottom:0.5em;
}
</style>