<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin([
    'id' => 'form-input',
    'options' => ['class' => 'form-horizontal col-lg-11',]
])
?>
<div class="form-group row">
    <?=$form->field($model,'type')->textInput(['placeholder' => 'Тип билета']) ?>
</div>
<?= Html::submitButton('Submit',['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>