<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="container" style="width: 50%;border: 1px solid gray;border-radius: 1rem;padding: 4rem;background-color: #222222;color:gray;">
    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'username')->textInput()->hint('Введите логин') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'password_repeat')->passwordInput() ?>
    <?= Html::submitButton('Регистрация', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end() ?>
