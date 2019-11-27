<?php 

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Ticket_type;
use wbraganca\dynamicform\DynamicFormWidget;

?>

<?php 
$form = ActiveForm::begin([
    'id' => 'form-input',
    'options' => ['class' => 'form-horizontal col-lg-11',]
    ]);
$ticket_types = Ticket_type::find()->all();
$type = ArrayHelper::map($ticket_types,'id','type');
$params = [
    'promit' => 'Укажите тип билета'
]
?>
<div class="form-group row">
    <?=$form->field($model,'ticket_type_id')->dropDownList($type,$params) ?>
    <?=$form->field($model,'cost')->textInput(['placeholder' => 'Укажите цену билета']) ?>
    <?=$form->field($model,'amount')->textInput(); ?>
</div>
<?= Html::submitButton('Add More',['class' => 'btn btn-success']) ?>
<?= Html:: a('End',['/event/total-tickets'],['class' => 'btn btn-primary'])?>

<?php ActiveForm::end() ?>