<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::$app->request->get('id') ? 'Редактировать' : 'Добавить';
?>
<h1><?php echo 'Цены > ' . $this->title; ?></h1>

<?php $form = ActiveForm::begin([
    'options' => ['class' => 'form-horizontal',],
    'fieldConfig' => [
        'template' => '<label class="col-lg-2 control-label"></label>{error}{label}<div class="col-lg-10">{input}</div>',
        'labelOptions' => ['class' => 'col-lg-2 control-label'],
    ],
]); ?>
<?php echo $form->field($edit, 'title')->input('text', ['value' => $model->title])->label('Название*'); ?>
<?php echo $form->field($edit, 'price')->input('text', ['value' => $model->price])->label('Цена*'); ?>
<?php echo $form->field($edit, 'unit')->input('text', ['value' => $model->unit])->label('Единица*'); ?>
<?php echo $form->field($edit, 'cat_id')->dropDownList($categories, ['options' => [$model->cat_id => ['selected ' => true]]])->label('Родительский раздел'); ?>
<?php echo $form->field($edit, 'page[]')->listBox($pagePlace, [
    'options' => $page,
    'size' => 10,
    'multiple' => true
])->label('Отображение на странице'); ?>
<?php echo $form->field($edit, 'active')->input('checkbox', [
    'checked' => $model->active == 1 ? 'checked' : false,
    'class' => 'checkbox',
])->label('Активность'); ?>
<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        <a href="<?php echo Url::toRoute(['prices/index']); ?>" class="btn btn-warning">Вернуться к списку</a>
        <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

