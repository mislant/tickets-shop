<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
?>

<?php $form = ActiveForm::begin([
    'id' => 'form-input',
    'options' => ['class' => 'form-horizontal col-lg-11',]
])
?>
<div class="form-group row">
    <?=$form->field($model,'title')->textInput(['placeholder' => 'Название мероприятия']) ?>
    <?=$form->field($model,'adress')->textInput(['placeholder' => 'Введите место проведения мероприятия']) ?>
    <?=$form->field($model,'date') ->widget(DateTimePicker::className(),[
    'name' => 'check_issue_date',
    'value' => date('Y-M-d H:i:00'),
    'options' => ['placeholder' => 'Введите дату проведения мероприятия'],
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd H:i:00',
        'todayHighlight' => true
    ] 
    ])?>
</div>
<?= Html::submitButton('Next step',['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>