<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<div class="container">
    <? if (Yii::$app->session->has('error_mesage')): ?>
        <div class="row">
            <div class="col-md-9"
                 style="display: flex;justify-content: center;align-items: center;border:1px solid gray;border-radius: 2rem;padding: 2rem;background-color: darkred">
                <p style="color: white;">В покупке билетов отказано. Возможно на вашем счету недастаточно <a
                            href="/user/personal-list">средств</a>
                </p>
            </div>
        </div>
    <? endif; ?>
    <div class="row" style="margin-bottom: 3rem;">
        <div class="col-md-3" style="display: flex;flex-direction: column;justify-content: center;align-items: center">
            <h1><?= $event->title ?></h1>
            <div class="event-phohto"
                 style="background-color: #1a1a1a;width: 20rem;height: 14rem;color: white;display:flex;justify-content: center;align-items: center;margin-top: 1rem;margin-bottom: 1rem;">
                Нет фото
            </div>
            <div class="information">
                <?= $event->date ?>
                <?= $event->adress ?>
            </div>
        </div>
        <div class="col-md-6" style="margin-top: 3rem;">
            <p><?= $event->description ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <? if ($event->date < date('Y-m-d H:i:s')): ?>
                <h1 style="color: darkred">Мероприятие прошло</h1>
            <? else: ?>
                <h1>Доступные билеты</h1>
                <table class="table table-dark">
                    <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Тип билета</th>
                        <th>Осталось</th>
                        <th>Количесвто</th>
                        <th>Стоймость</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($events_tickets as $ticket): ?>
                        <? $form = ActiveForm::begin() ?>
                        <tr>
                            <th>
                                <?= $form->field($model, 'event_id')->hiddenInput(['value' => $event->id])->label('') ?>
                            </th>
                            <th>
                                <?php
                                $type = \app\models\TicketType::findOne($ticket->ticket_type_id);
                                echo $form->field($model, 'ticket_type_id')->hiddenInput(['value' => $type->id])->label('');
                                echo $type->type;
                                ?>
                            </th>
                            <th><?= $ticket->amount ?></th>
                            <th>
                                <div class="number">
                                    <span class="minus">-</span>
                                    <?= $form->field($model, 'amount')->textInput(['value' => 0, 'size' => 1])->label('') ?>
                                    <span class="plus">+</span>
                                </div>
                            </th>
                            <th>
                                <?php
                                echo $ticket->cost;
                                echo $form->field($model, 'cost')->hiddenInput(['value' => $ticket->cost])->label('');
                                ?>
                            </th>
                            <th><?= Html::submitButton(
                                    'Купить',
                                    [//'data' => ['confirm' => 'Вы действительно хотите купить эти билеты?'],
                                        'class' => 'btn btn-success'
                                    ])
                                ?>
                            </th>
                        </tr>
                        <? $form = ActiveForm::end() ?>
                    <? endforeach; ?>
                    </tbody>
                </table>
            <? endif; ?>
        </div>
    </div>
</div>
<?php $this->registerJsFile(Yii::getAlias('@web') . 'js/buy-ticket.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>