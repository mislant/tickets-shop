<?php

use yii\helpers\Html;
use app\models\Ticket;
use app\models\TicketType;
use app\models\Event;

?>
<body>
<div class="box" style="display: flex;flex-direction: column;padding-left: 2rem;">
    <h1 class="user" style="text-align: center;"><?= $user->username ?></h1>
    <div class="user-office" style="display: flex;flex-direction:row;margin-bottom: 5rem;">
        <div class="avatar"
             style="background-color: #1a1a1a;width: 20rem;height: 20rem;color: white;display:flex;justify-content: center;align-items: center;">
            Нет фото
        </div>
        <div class="user-info" style="width: 60%;">
            <div class="user-table" style="width: 100%;padding: 2rem 2rem;margin: 0 auto;">
                <table class="table table-dark">
                    <tr>
                        <th>Имя</th>
                        <th><?= $user->firstname ?></th>
                    </tr>
                    <tr>
                        <th>Фамилия</th>
                        <th><?= $user->surname ?></th>
                    </tr>
                    <tr>
                        <th>Кошелек</th>
                        <th><?= $user->wallet ?></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th><?= Html::a('Пополнить', ['/user/add-money', 'id' => $user->id], ['class' => 'btn btn-warning']) ?></th>
                    </tr>
                </table>
            </div>
            <div style="margin:auto 20rem"><?= Html::a('Редактировать профиль', ['/user/profile-edit', 'id' => $user->id], ['class' => 'btn btn-dark']) ?></div>
        </div>
    </div>
    <div class="user-tickets">
        <h2>Купленные билеты</h2>
        <? foreach ($users_ticket as $ticket): ?>
            <?php
            $event = Event::findOne($ticket->event_id);
            $ticket_type = TicketType::findOne($ticket->ticket_type_id);
            ?>
            <? if ($event->date > date('Y-m-d H:i:s')): ?>
                <h3 style="margin: 2rem;">
                    Билет№ <?= $ticket->id ?> &nbsp; <?= $ticket_type->type ?>
                </h3>
                <div class="ticket_table" style="width: 100%">
                    <table class="table table-dark">
                        <thead class="thead thead-dark">
                        <tr>
                            <th>Мероприятие</th>
                            <th>Время</th>
                            <th>Место</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th><?= $event->title ?></th>
                            <th><?= $event->date ?></th>
                            <th><?= $event->adress ?></th>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th><?= Html::a('Вернуть', ['/user/return-ticket', 'id' => $ticket->id],['class' => ['btn btn-success']]) ?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="message">
                    <h2 style="color: darkred;"><?=Yii::$app->session->hasFlash('error_message')?></h2>
                </div>
            <? endif; ?>
        <? endforeach; ?>
    </div>
</div>
</body>

