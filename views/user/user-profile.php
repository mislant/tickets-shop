<?php

/**
 * @var $user app\models\User
 * @var $tickets app\models\Ticket
 */

use yii\helpers\Html;

?>
    <div class="user-profile-container">
        <div class="user-profile-header">
            <ul>
                <li><?= $user->username ?></li>
                <li><a href="/user/add-money"><i class="fas fa-wallet"></i>+</a>Баланс:<?= $user->wallet ?></li>
            </ul>
        </div>
        <span>Билеты пользователя</span>
        <div class="user-profile-ticket">
            <? foreach ($tickets as $i => $ticket): ?>
                <? if ($ticket->event->date > date('Y-m-d')): ?>
                    <div class="ticket">
                        <div class="radius left"></div>
                        <div class="radius right"></div>
                        <?= Html::a('', ['/user/return-ticket', 'id' => $ticket->id], ['class' => "return fas fa-undo"]) ?>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <div class="ticket-content">
                            <div class="ticket-box event-title">
                                <span><?= $ticket->event->title ?></span>
                            </div>
                            <div class="ticket-box first">
                                <div class="ticket-number">
                                    № билета <span><?= $ticket->id ?></span>
                                </div>
                                <div class="ticket-type">
                                    Тип <span><?= $ticket->ticket_type->type ?></span>
                                </div>
                            </div>
                            <div class="ticket-box second">
                                <div class="ticket-place">
                                    Место <span><?= $ticket->event->adress ?></span>
                                </div>
                                <div>
                                    Время <span><?= Yii::$app->formatter->asDatetime($ticket->event->date) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <? endif; ?>
            <? endforeach; ?>
        </div>
    </div>
<? $this->registerCssFile('/' . Yii::getAlias('@web') . 'css/user-profile.css'); ?>