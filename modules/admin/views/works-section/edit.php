<?php
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::$app->request->get('id') ? 'Редактировать' : 'Добавить';
?>
<h1><?php echo 'Разделы > ' . $this->title; ?></h1>

<?php $form = ActiveForm::begin([
    'options' => ['class' => 'form-horizontal',],
    'fieldConfig' => [
        'template' => '{label}<div class="col-lg-10">{input}</div>',
        'labelOptions' => ['class' => 'col-lg-2 control-label'],
    ],
]); ?>
<?php echo $form->field($edit, 'title')->input('text', ['value' => $model->title])->label('Название'); ?>
<?php echo $form->field($edit, 'description')->input('text', ['value' => $model->description])->label('Описание'); ?>
<?php echo $form->field($edit, 'parent_id')->dropDownList($categories, ['options' => [ $model->parent_id => ['selected ' => true]]])->label('Родительский раздел'); ?>
<?php echo $form->field($edit, 'active')->input('checkbox', [
    'checked' => $model->active == 1 ? 'checked' : false,
    'class' => 'checkbox',
])->label('Активность'); ?>
<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        <a href="<?php echo Url::toRoute(['works-section/index']); ?>" class="btn btn-warning">Вернуться к списку</a>
        <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

