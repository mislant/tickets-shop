<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="form"
     style="display: flex;width: 60%;margin: 0 auto;box-sizing: border-box;padding: 4rem;box-shadow: 0px 0px 12px 3px rgba(156,156,156,1);">
    <?php $form = ActiveForm::begin([
        'id' => 'form-input',
        'options' => ['class' => 'form-horizontal col-lg-11',]
    ])
    ?>
    <div class="form-group row">
        <?= $form->field($model, 'type')->textInput(['placeholder' => 'Тип билета']) ?>
    </div>
    <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end() ?>
</div>
