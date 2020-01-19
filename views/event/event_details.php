<?php

/**
 * @var array $event
 * @var array $event_model
 * @var array $events_tickets
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\datetime\DateTimePicker;
use app\assets\AppAsset;
use yii\web\JqueryAsset;

?>
    <div class="event"
         style="display: flex;flex-direction: column;padding: 2rem;justify-content: center;align-items: flex-start">
        <h1>Просмотр мероприятия</h1>
        <table class="table" style="font-size: large">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <? $form = ActiveForm::begin([
                    'id' => 'event-form'
                ]) ?>
                <th><?= $event->id ?></th>
                <th><?= $form->field($event_model, 'title')->textInput(['value' => $event->title]) ?></th>
                <th>
                    <? $event_model->date = $event->date ?>
                    <?= $form->field($event_model, 'date')->widget(DateTimePicker::className(), [
                        'options' => ['placeholder' => $event->date],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd H:i:00',
                            'todayHighlight' => true
                        ]
                    ]) ?>
                </th>
                <th>
                    <div id="map"
                         style="width: 35rem;height: 25rem;justify-content: center;align-items: center;border: 1px solid gray"></div>
                    <?= $form->field($event_model, 'adress')->textInput(['value' => $event->adress])->label('Текущее место проведения мероприятия') ?>
                </th>
            </tr>
            </tbody>
        </table>
        <div class="event-info" style="width: 80%;">
            <h2>Описание</h2>
            <?= $form->field($event_model, 'description')->textarea(['rows' => '6', 'value' => $event->description])->label('') ?>
        </div>
        <?= Html::submitButton('Изменить', ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end() ?>
        <h2>Билеты мероприятия</h2>
        <? $form = ActiveForm::begin([
            'id' => 'ticket-form'
        ]) ?>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>Тип билета</th>
                <th>Стоймость</th>
                <th>Количество</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($events_tickets as $index => $events_ticket): ?>
                <tr>
                    <th>
                        <?= $events_ticket->ticket_type->type ?>
                        <?= $form->field($events_ticket, "[$index]events_ticket_type")
                            ->hiddenInput(['value' => $events_ticket->ticket_type_id])
                            ->label(''); ?></th>
                    <th><?= $form->field($events_ticket, "[$index]cost")
                            ->textInput(['value' => $events_ticket->cost])
                            ->label('') ?></th>
                    <th><?= $form->field($events_ticket, "[$index]amount")
                            ->textInput(['value' => $events_ticket->amount])
                            ->label('') ?></th>
                    <th></th>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <th></th>
                <th>Всего</th>
                <th>
                    <?php
                    $total = 0;
                    foreach ($events_tickets as $event_ticket) {
                        $total += $event_ticket->amount;
                    }
                    echo $total;
                    ?>
                </th>
                <th>
                    <?= Html::a('Добавить', ['event/events-ticket-create', 'id' => $event->id]) ?>
                    <?= Html::submitButton('Изменить', ['class' => 'btn btn-success']) ?>
                </th>
            </tr>
            </tfoot>
        </table>
        <?php ActiveForm::end() ?>
    </div>
<?php $this->registerJsFile(Yii::getAlias('@web') . 'js/yandex-api-map-adress.js', ['depends' => [JqueryAsset::className(), AppAsset::className()]]); ?>