<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\models\Opinions;

$this->title = Yii::$app->request->get('id') ? 'Редактировать' : 'Добавить';
?>
<h1><?php echo 'Отзывы > ' . $this->title; ?></h1>

<?php $form = ActiveForm::begin([
    'options' => ['enctype'=>'multipart/form-data', 'class' => 'form-horizontal',],
    'fieldConfig' => [
        'template' => '<label class="col-lg-2 control-label"></label>{error}{label}<div class="col-lg-10">{input}</div>',
        'labelOptions' => ['class' => 'col-lg-2 control-label'],
    ],
]); ?>
<?php echo $form->field($edit, 'name')->input('text', ['value' => $model->name])->label('Имя*'); ?>
<?php echo $form->field($edit, 'description')->input('text', ['value' => $model->description])->label('Подробнее*'); ?>
<?php echo $form->field($edit, 'photo')->fileInput()->label('Загрузить фото'); ?>
<?php echo $form->field($edit, 'hidden', ['template'=>'{input}'])->hiddenInput(['value' => $model->photo]); ?>
<?php if (!empty($model->photo)) { ?>
    <div class="form-group">
        <label class="col-lg-2"></label>
        <figure class="col-lg-10">
<!--            <img class="img-rounded" src="--><?php //echo Yii::$app->params['params']['pathToImage'] . Opinions::IMG_FOLDER . 'opinion(' . $model->id . ')/' . $model->photo; ?><!--">-->
            <a class="fancybox" rel="group" href="<?php echo Yii::$app->params['params']['pathToImage'] . Opinions::IMG_FOLDER . 'opinion(' . $model->id . ')/' . $model->photo; ?>"><img src="<?php echo Yii::$app->params['params']['pathToImage'] . Opinions::IMG_FOLDER . 'opinion(' . $model->id . ')/mini_' . $model->photo; ?>"></a>
        </figure>
    </div>
<?php } ?>
<?php $edit->text = $model->text; echo $form->field($edit, 'text')->textarea(['rows' => '10'])->label('Текст*'); ?>
<?php echo $form->field($edit, 'active')->input('checkbox', [
    'checked' => $model->active == 1 ? 'checked' : false,
    'class' => 'checkbox',
])->label('Активность'); ?>
<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        <a href="<?php echo Url::toRoute(['opinions/']); ?>" class="btn btn-warning">Вернуться к списку</a>
        <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox({
            openEffect	: 'elastic',
            closeEffect	: 'elastic',

            helpers : {
                title : {
                    type : 'inside'
                }
            }
        });
    });
</script>

