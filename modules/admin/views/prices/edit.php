<?php

use app\models\PricesInPage;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/** @var \app\models\Prices $model */
/** @var array $checkedItems */
/** @var array $pagePlace */
/** @var \app\models\PricesInPage $priceInPage */

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
<?php echo $form->field($edit, 'image')->fileInput()->label('Картинка'); ?>
<?php if (!empty($model->image)) { ?>
    <label class="col-lg-2 control-label"></label>
    <div class="slides">
        <figure class="col-lg-10">
            <?php echo Html::img($model->image, ["class" => "img-thumbnail"]); ?>
            <span class="glyphicon glyphicon-remove" data-id="<?php echo $model->id; ?>"></span>
        </figure>
    </div>
<?php } ?>
<?php echo $form->field($edit, 'price')->input('text', ['value' => $model->price])->label('Цена*'); ?>
<?php echo $form->field($edit, 'unit')->input('text', ['value' => $model->unit])->label('Единица*'); ?>
<?php echo $form->field($edit, 'cat_id')->dropDownList($categories, ['options' => [$model->cat_id => ['selected ' => true]]])->label('Родительский раздел'); ?>
<?php echo $form->field($edit, 'page[]', [
    'template' => '<label class="col-lg-2 control-label"></label>{error}{label}<div class="col-lg-10 price-in-page">{input}</div>',
])->checkboxList($pagePlace, [
    'item' => function ($index, $label, $name, $checked, $value) use ($checkedItems, $edit) {
        return '<label class="col-md-12 checkbox"><input type="checkbox" name="' . Html::getInputName($edit, 'page[]')
            . '" value="' . $value . '"'
            . (in_array($value, $checkedItems) ? ' checked' : '') . '>' . $label . '</label>';
    }
]); ?>
<?php if ($priceInPage) { ?>
<div class="form-group">
    <label class="col-lg-2 control-label">Порядок отображения на посадочных страницах</label>
    <?php /** @var PricesInPage $page */
    foreach ($priceInPage as $page) { ?>
        <?php echo $form->field($page, 'sort[' . $page->page_id . ']', [
            'options' => [
                'class' => '',
            ],
            'template' => '<label class="col-lg-2" style="margin:0"></label>{error}
            <div class="col-lg-10" style="display: flex;margin-bottom: 5px">
                <input type="number" class="form-control" style="width: 65px;margin-right: 10px" value="'
                . ($page->order ?: 0) . '" name="' . $page->formName() . '[sort][' . $page->page_id . ']">
                <span>' . $page->service->title . '</span>
            </div>',
        ])->input(
            'number', [
            'value' => $page->order,
            ])->label(''); ?>
    <?php } ?>
</div>
<?php } ?>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('.glyphicon-remove').click(function() {
            var $this = $(this);
            $.ajax({
                type: 'get',
                url: '<?php echo Url::to('delete-preview'); ?>',
                data: {id: $this.data('id')},
                success: function (response) {
                    if (response.status == true) {
                        $this.parents('.slides').find('img').remove();
                        $this.remove();
                    }
                },
                error: function () {
                }
            });
        });
    });
</script>

