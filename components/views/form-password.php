<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ChangePasswordForm;
/** @var \yii\web\View $this */
/** @var $optionsActiveForm array*/

$this->title = "Изменить пароль";
?>

<?php $form = ActiveForm::begin($optionsActiveForm); ?>
<?php
if($model->getScenario() == ChangePasswordForm::SCENARIO_WITH_PASSWORD) {
    echo $form->field($model, 'old_password')->passwordInput();
}
?>
<?=$form->field($model, 'new_password')->passwordInput() ?>
<?=$form->field($model, 'confirm_password')->passwordInput() ?>
<div class="form-group">
    <?=Html::submitButton('Изменить пароль', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>