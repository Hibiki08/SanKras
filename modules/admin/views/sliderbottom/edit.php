<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\models\Slides;

$this->title = Yii::$app->request->get('id') ? 'Редактировать' : 'Добавить';
?>
<h1><?php echo 'Нижний слайдер > ' . $this->title; ?></h1>

<?php if ($errors) { ?>
    <div class="row-fluid">
        <p class="text-danger"><?php echo implode('<br/>', $errors); ?></p>
    </div>
<?php } ?>

<?php $form = ActiveForm::begin([
    'options' => ['enctype'=>'multipart/form-data', 'class' => 'form-horizontal',],
    'fieldConfig' => [
        'template' => '<label class="col-lg-2 control-label"></label>{error}{label}<div class="col-lg-10">{input}</div>',
        'labelOptions' => ['class' => 'col-lg-2 control-label'],
    ],
]); ?>
<?php echo $form->field($edit, 'image')->fileInput()->label('Загрузить слайд'); ?>
<?php echo $form->field($edit, 'hidden', ['template'=>'{input}'])->hiddenInput(['value' => $model->image]); ?>
<?php if (!empty($model->image)) { ?>
    <div class="form-group">
        <label class="col-lg-2"></label>
        <figure class="col-lg-10">
            <img class="img-rounded" src="<?php echo Yii::$app->params['params']['pathToImage'] . Slides::IMG_FOLDER_SLIDER_BOT . '/admin_' . $model->image; ?>">
        </figure>
    </div>
<?php } ?>
<?php echo $form->field($edit, 'sort')->input('text', ['value' => $model->sort ? $model->sort : 0])->label('Сортировка'); ?>
<?php echo $form->field($edit, 'active')->input('checkbox', [
    'checked' => $model->active == 1 ? 'checked' : false,
    'class' => 'checkbox',
])->label('Активность'); ?>
<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        <a href="<?php echo Url::toRoute(['sliderbottom/index']); ?>" class="btn btn-warning">Вернуться к списку</a>
        <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

