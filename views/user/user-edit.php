<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<div class="form">
    <? $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="row">
        <div class="col-md-4">
            <div class="avatar">
                <div class="photo"
                     style="margin: 0 auto;display: flex;justify-content: center;align-items: center;background-color: #222222;width: 16rem;height: 16rem;color: white;">
                    Нет фото
                </div>
                <div class="field" style="display: flex;flex-direction: column; width: 100%;">
                    <?= $form->field($model, 'photo')->fileInput()->label('') ?>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="main-form"
                 style="margin: 0 auto;width: 90%;border: 1px solid gray;border-radius: 1rem;padding: 4rem;background-color: #222222;color:gray">
                <?= $form->field($model, 'firstname') ?>
                <?= $form->field($model, 'surname') ?>
            </div>
            <div style="margin-top: 1rem">
                <?= Html::submitButton('Подвердить', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <? $form = ActiveForm::end() ?>
</div>