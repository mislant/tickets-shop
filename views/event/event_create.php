<?php

/**
 * @var $modelEvent app\models\CreateEventForm
 * @var $modelTickets app\models\CreateEventsTicketForm
 * @var $type array
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\datetime\DateTimePicker;

?>
<?if(Yii::$app->session->hasFlash('ticket_type_err')):?>
<div class="error">
    <p>Нельзя два раза выбирать один и тот же тип билетов</p>
</div>
<?endif;?>
<? $form = ActiveForm::begin() ?>
<div class="cover-common">
    <div class="cover">
        <div class="form-container">
            <div class="form-head">
                <span>Создание мероприятия</span>
            </div>
            <div class="form-body">
                <?= $form->field($modelEvent, 'title')->textInput(['placeholder' => 'Название мероприятия']) ?>
                <?= $form->field($modelEvent, 'adress')->hiddenInput(['id' => 'adress'])->label('Выберите место проведения мероприятия') ?>
                <div id="map"></div>
                <?= $form->field($modelEvent, 'date')->widget(DateTimePicker::className(), [
                    'name' => 'check_issue_date',
                    'value' => date('Y-M-d H:i:00'),
                    'options' => ['placeholder' => 'Введите дату проведения мероприятия'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd H:i:00',
                        'todayHighlight' => true
                    ]
                ]) ?>
                <a id="addTickets" class="btn btn-info">Создать билеты</a>
            </div>
            <div class="form-foot">
                <a id="addMore" class="button button-more">Еще</a>
                <?= Html::submitButton('Создать мероприятие', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <div class="cover cover-flex">
        <? foreach ($modelTickets as $idx => $model): ?>
            <div class="small-form">
                <div class="form-head"><span>Тип билета</span></div>
                <div class="form-body">
                    <?= $form->field($model, "[$idx]ticket_type_id")->dropDownList($type, $params) ?>
                    <?= $form->field($model, "[$idx]cost")->textInput(['placeholder' => 'Укажите цену билета']) ?>
                    <?= $form->field($model, "[$idx]amount")->textInput(); ?>
                </div>
                <div class="form-foot">
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>
<? $form = ActiveForm::end() ?>

<? $this->registerCssFile(Yii::getAlias('@web') . '/css/form.css') ?>
<? $this->registerJsFile(Yii::getAlias('@web') . '/js/event-create.js', ['depends' => [\yii\web\JqueryAsset::className()]]) ?>
<? $this->registerJsFile(Yii::getAlias('@web') . 'js/yandex-api-map-adress.js', ['depends' => [\yii\web\JqueryAsset::className(), \app\assets\AppAsset::className()]]); ?>
