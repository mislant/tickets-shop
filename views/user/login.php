<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="container"
     style="width: 50%;border: 1px solid gray;border-radius: 1rem;padding: 4rem;background-color: #222222;color:gray">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal']
    ])
    ?>
    <?= $form->field($model, 'emailnick')->textInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <div style="display: flex;width: 50%;flex-direction: row;align-items: center;text-align: center;justify-content: space-evenly;">
        <?= Html::submitButton('Войти', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Не зарагестрирован? Сделай это сейчас!', '/user/sign-up') ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
