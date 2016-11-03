<?php
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\models\Team;

$this->title = Yii::$app->request->get('id') ? 'Редактировать' : 'Добавить';
?>
<h1><?php echo 'Команда > ' . $this->title; ?></h1>

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
<?php echo $form->field($edit, 'name')->input('text', ['value' => $model->name])->label('Имя*'); ?>
<?php echo $form->field($edit, 'post')->input('text', ['value' => $model->post])->label('Должность*'); ?>
<?php $edit->text = !empty($model->text) ? $model->text : "строка1;\nстрока2;\nстрока3;\nстрока4 - макс 6 строк"; echo $form->field($edit, 'text')->textarea(['rows' => '6'])->label('Описание*'); ?>
<?php echo $form->field($edit, 'img', ['options' => [
    'class' => 'form-group',
    'id' => 'img',
]])->fileInput()->label('Загрузить фото*');
if (isset($model->img)) { ?>
    <label class="col-lg-2 control-label"></label>
    <div class="slides">
        <figure>
            <img class="img-thumbnail" src="<?php echo Yii::$app->params['params']['pathToImage'] . Team::IMG_FOLDER . 'team(' . $model->id . ')' . '/team_' . $model->img; ?>">
        </figure>
        <?php echo $form->field($edit, 'hidden', ['template'=>'{input}', 'options' => ['class' => '', 'id' => 'hide-img']])->hiddenInput(['value' => $model->img]); ?>
    </div>
<?php } ?>
<?php echo $form->field($edit, 'active')->input('checkbox', [
    'checked' => $model->active == 1 ? 'checked' : false,
    'class' => 'checkbox',
])->label('Активность'); ?>
<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        <a href="<?php echo Url::toRoute(['team/index']); ?>" class="btn btn-warning">Вернуться к списку</a>
        <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>