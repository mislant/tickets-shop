<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\datetime\DateTimePicker;
use app\models\TicketType;

?>
<div class="event" style="display: flex;flex-direction: column;padding: 2rem;justify-content: center;align-items: flex-start">
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
            <? $form = ActiveForm::begin() ?>
            <th><?= $event->id ?></th>
            <th><?= $form->field($event_model, 'title')->textInput(['value' => $event->title]) ?></th>
            <?php $event_model->date = $event->date ?>
            <th><?= $form->field($event_model, 'date')->widget(DateTimePicker::className(), [
                    'options' => ['placeholder' => $event->date],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd H:i:00',
                        'todayHighlight' => true
                    ]
                ]) ?>
            </th>
            <th><?= $form->field($event_model, 'adress')->textInput(['value' => $event->adress]) ?></th>
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
        <?php foreach ($events_tickets as $event_ticket): ?>
            <? $form = ActiveForm::begin() ?>
            <tr>
                <th>
                    <?php
                    $ticket_type = TicketType::findOne($event_ticket->ticket_type_id);
                    echo $ticket_type->type;
                    echo $form->field($ticket_model, 'ticket_type_id')->hiddenInput(['value' => $ticket_type->id])->label('');
                    ?>
                </th>
                <th><?= $form->field($ticket_model, 'cost')->textInput(['value' => $event_ticket->cost])->label('') ?></th>
                <th><?= $form->field($ticket_model, 'amount')->textInput(['value' => $event_ticket->amount])->label('') ?></th>
                <th><?= Html::submitButton('Изменить', ['class' => 'btn btn-success']) ?></th>
            </tr>
            <?php ActiveForm::end() ?>
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
            <th><?=Html::a('Добавить',['event/events-ticket-create' ,'id' => $event->id])?></th>
        </tr>
        </tfoot>
    </table>
</div>