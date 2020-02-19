<?php

/**
 * @var $event app\models\Event
 * @var $eventModel app\models\CreateEventForm
 * @var $eventPhoto app\models\EventsPhoto
 * @var $eventsTicket app\models\EventsTicket
 * @var $total integer
 */

use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\web\JqueryAsset;
use app\assets\AppAsset;
use yii\helpers\Html;

?>
<? if (Yii::$app->session->hasFlash('photo_warn')): ?>
    <div class="warn">
        <p>
            Нельзя загружать больше 6 фотографий
        </p>
    </div>
<? endif; ?>
<div class="event-control-panel">
    <div class="event-control-title">
        <? if (Yii::$app->user->can('admin')): ?>
            <?= Html::a('Назад', '/event/show-events', ['class' => 'fas fa-caret-left']) ?>
        <? else: ?>
            <?= Html::a('Назад', '/user/show-manager-tools', ['class' => 'fas fa-caret-left']) ?>
        <? endif; ?>
        <p>Панель управления мероприятием</p>
        <span><?= $event->title ?></span>
    </div>
    <div class="line"></div>
    <div class="event-control-boxes">
        <span>Основные настройки мероприятия</span>
        <div class="main-control-box">
            <? $form = ActiveForm::begin([
                'id' => 'main-form',
            ]) ?>
            <input type="hidden" name="event_id" value="<?= $event->id ?>">
            <div class="box">
                <table class="table">
                    <tr>
                        <th>
                            <?= $form->field($eventModel, 'title')
                                ->textInput(['value' => $event->title]) ?>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <? $eventModel->date = $event->date ?>
                            <?= $form->field($eventModel, 'date')->widget(DateTimePicker::className(), [
                                'options' => ['placeholder' => $event->date],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd H:i:00',
                                    'todayHighlight' => true
                                ]
                            ]) ?>
                        </th>
                    </tr>
                </table>
            </div>
            <div class="box">
                <h4>Место</h4>
                <div id="map"></div>
                <span>Текущее место</span>
                <p><?= $event->adress ?></p>
                <span>Новое место</span>
                <?= $form->field($eventModel, 'adress')->textarea(['rows' => 2, 'id' => 'adress', 'value' => $event->adress])->label('') ?>
            </div>
            <div class="box">
                <h4>Описание</h4>
                <?= $form->field($eventModel, 'description')->textarea(['rows' => '6', 'value' => $event->description, 'style' => 'width:100%'])->label('') ?>
            </div>
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            <? $form = ActiveForm::end() ?>
        </div>
        <span>Фотографии мероприятий</span>
        <div class="photos-control-box">
            <? foreach ($event->events_photos as $photo): ?>
                <? $form = ActiveForm::begin([
                    'id' => 'delete-photo',
                    'action' => 'delete-event-photo'
                ]) ?>
                <input type="hidden" name="event_id" value="<?= $event->id ?>">
                <img src="<?= $photo->photo ?>" class="event-photo">
                <?= $form->field($eventPhoto, 'id')
                    ->hiddenInput(['value' => $photo->id, 'class' => 'my-form'])
                    ->label('') ?>
                <?= Html::submitButton(' ', ['class' => 'fas fa-minus-circle', 'style' => 'font-size: 3rem;background: none;border: none;box-shadow: none;']) ?>
                <? $form = ActiveForm::end() ?>
            <? endforeach; ?>
            <? $form = ActiveForm::begin([
                'id' => 'photo-form',
                'options' => ['enctype' => 'multipart/form-data'],
                'enableClientValidation' => false,
                'enableAjaxValidation' => false
            ]) ?>
            <input type="hidden" name="event_id" value="<?= $event->id ?>">
            <div class="event-photo">
                <div class="plus">
                    <i class="fas fa-plus"></i>
                    <?= $form->field($eventPhoto, 'photo')->fileInput(["class" => "photo-input"])->label('') ?>
                </div>
            </div>
            <?= Html::submitButton(' ', ['class' => 'fas fa-upload', 'style' => 'font-size: 2rem;background: none;border: none;box-shadow: none;']) ?>
            <? $form = ActiveForm::end() ?>
        </div>
        <span>Билеты мероприятия</span>
        <div class="tickets-control-box">
            <? $form = ActiveForm::begin([
                'id' => 'ticket-form',
            ]) ?>
            <input type="hidden" name="event_id" value="<?= $event->id ?>">
            <table>
                <tr>
                    <th>Тип билета</th>
                    <th>Стоимость</th>
                    <th>Количество</th>
                    <th></th>
                </tr>
                <? foreach ($eventsTicket as $i => $ticket): ?>
                    <tr>
                        <th class="first">
                            <?= $ticket->ticket_type->type ?>
                            <?= $form->field($ticket, "[$i]events_ticket_type")
                                ->hiddenInput(['value' => $ticket->ticket_type_id])
                                ->label('') ?>
                        </th>
                        <th><?= $form->field($ticket, "[$i]cost")
                                ->textInput(['value' => $ticket->cost])
                                ->label('') ?>
                        </th>
                        <th>
                            <?= $form->field($ticket, "[$i]amount")
                                ->textInput(['value' => $ticket->amount])
                                ->label('') ?>
                        </th>
                         <th><?= Html::a('-', ['event/delete-events-tickets', 'ticket_type_id' => $ticket->ticket_type_id, 'event_id' => $event->id], ['class' => 'fas fa-backspace', 'style' => 'font-size:2rem']) ?></th>
                    </tr>
                <? endforeach; ?>
                <tr>
                    <th></th>
                    <th>Всего</th>
                    <th>
                        <div class="result"><?= $total ?></div>
                    </th>
                    <th>
                         <?= Html::a('Добавить', ['event/create-events-tickets', 'id' => $event->id]) ?>
                        <?= Html::submitButton('Изменить', ['class' => 'btn btn-success']) ?>
                    </th>
                </tr>
            </table>
            <? $form = ActiveForm::end() ?>
        </div>
    </div>
</div>

<? $this->registerCssFile('/' . Yii::getAlias('@web') . 'css/event-details.css'); ?>
<? $this->registerJsFile(Yii::getAlias('@web') . 'js/yandex-api-map-adress.js', ['depends' => [JqueryAsset::className(), AppAsset::className()]]); ?>
<? $this->registerJsFile(Yii::getAlias('@web') . 'js/event_details_ajax.js', ['depends' => [JqueryAsset::className()]]); ?>
