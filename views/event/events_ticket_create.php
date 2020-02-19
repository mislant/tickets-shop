<?php

/**
 * @var array $event
 * @var array $type
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="form-container"
     style="display: flex;width: 60%;margin: 0 auto;box-sizing: border-box;padding: 4rem;box-shadow: 0px 0px 12px 3px rgba(156,156,156,1);">
    <div style="width: 100%">
        <?php
        $form = ActiveForm::begin([
            'id' => 'form-input',
        ]);
        $params = [
            'prompt' => 'Укажите тип билета'
        ]
        ?>
        <div class="form">
            <?= $form->field($model, 'ticket_type_id')->dropDownList($type, $params) ?>
            <?= $form->field($model, 'cost')->textInput(['placeholder' => 'Укажите цену билета']) ?>
            <?= $form->field($model, 'amount')->textInput(); ?>
        </div>
        <div class="form-buttons">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
