<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\TicketType;

?>
<div class="form" style="display: flex;width: 60%;margin: 0 auto;box-sizing: border-box;padding: 4rem;box-shadow: 0px 0px 12px 3px rgba(156,156,156,1);">
<?php
$form = ActiveForm::begin([
    'id' => 'form-input',
    'options' => ['class' => 'form-horizontal col-lg-11',]
]);
$ticket_types = TicketType::find()->all();
$type = ArrayHelper::map($ticket_types, 'id', 'type');
$params = [
    'prompt' => 'Укажите тип билета'
]
?>
    <div class="form-group row">
        <?= $form->field($model, 'ticket_type_id')->dropDownList($type, $params) ?>
        <?= $form->field($model, 'cost')->textInput(['placeholder' => 'Укажите цену билета']) ?>
        <?= $form->field($model, 'amount')->textInput(); ?>
    </div>
    <div class="form-row">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
        <?= Html:: a('Закончить', ['/event/event-details','id' => $model->event_id], ['class' => 'btn btn-primary']) ?>
    </div>


<?php ActiveForm::end() ?>
</div>
