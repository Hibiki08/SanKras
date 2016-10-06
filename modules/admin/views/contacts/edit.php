<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Редактировать';
?>
<h1><?php echo 'Контакты > ' . $this->title; ?></h1>

<?php $form = ActiveForm::begin([
    'options' => ['class' => 'form-horizontal',],
    'fieldConfig' => [
        'template' => '{label}<div class="col-lg-10">{input}</div>',
        'labelOptions' => ['class' => 'col-lg-2 control-label'],
    ],
]); ?>
<?php echo $form->field($edit, 'description')->input('text', ['value' => $model->description])->label('Название'); ?>
<?php echo $form->field($edit, 'value')->input('text', ['value' => $model->value])->label('Значение'); ?>
<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        <a href="<?php echo Url::toRoute(['contacts/index']); ?>" class="btn btn-warning">Вернуться к списку</a>
        <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

