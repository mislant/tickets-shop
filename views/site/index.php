<?php

use app\models\User;
use yii\widgets\LinkPager;
use yii\helpers\Html;

$user = User::findOne(Yii::$app->user->id)

?>
<? if (Yii::$app->user->isGuest): ?>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-9" style="margin-top:">
                <?php foreach ($events as $event): ?>
                    <div class="event"
                         style="display: flex; margin-top: 3rem;box-shadow: -3px 3px 4px 0px rgba(33,33,33,0.55);padding: 0.3rem;padding-left: 1rem;">
                        <div style="display: flex;flex-direction: column;align-items: center;">
                            <div class="event-phohto"
                                 style="background-color: #222222;width: 20rem;height: 14rem;color: white;display:flex;justify-content: center;align-items: center;margin-top: 1rem;margin-bottom: 1rem;">
                                Нет фото
                            </div>
                            <? if ($event->date < date('Y-m-d H:i:s')): ?>
                                <?= Html::a('Подробнее', ["/user/log-in", 'id' => $event->id]) ?>
                            <? else: ?>
                                <?= Html::a('Купить билеты', ["/user/log-in", 'id' => $event->id]) ?>
                            <? endif; ?>
                        </div>
                        <div class="event-info" style="margin: 0 2rem 2rem 2rem; width: 60%">
                            <span class="event-main" style="font-size: 2rem;">
                                <?= $event->title ?>
                                <? if ($event->date < date('Y-m-d H:i:s')): ?>
                                    <span style="color: darkred;">Прошло</span>
                                <? endif; ?>
                            </span>
                            <p class="event-description"
                               style="width:100%; height:14rem;overflow: hidden;text-overflow: ellipsis; margin: 1rem;box-sizing: border-box;"><?= $event->description ?></p>
                        </div>
                    </div>
                <? endforeach; ?>
                <? echo LinkPager::widget([
                    'pagination' => $pages,
                ]); ?>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    </body>

<? else: ?>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="user"
                     style="display: flex;justify-content: center;flex-direction: column;align-items: center;box-shadow: 0px 2px 7px 2px #949494;;padding: 1rem;border-radius: 1rem;">
                    <div class="avatar"
                         style="background-color: #222222;width: 14rem;height: 14rem;color: white;display:flex;justify-content: center;align-items: center;">
                        Нет фото
                    </div>
                    <span style="font-weight: bold;font-size: 2rem;"><i><?= $user->username ?></i></span>
                </div>
            </div>
            <div class="col-md-8" style="margin-top:">
                <?php foreach ($events as $event): ?>
                    <div class="event"
                         style="display: flex; margin-top: 3rem;box-shadow: -3px 3px 4px 0px rgba(33,33,33,0.55);padding: 0.3rem;padding-left: 1rem;">
                        <div style="display: flex;flex-direction: column;align-items: center;">
                            <div class="event-phohto"
                                 style="background-color: #222222;width: 20rem;height: 14rem;color: white;display:flex;justify-content: center;align-items: center;margin-top: 1rem;margin-bottom: 1rem;">
                                Нет фото
                            </div>
                            <? if ($event->date < date('Y-m-d H:i:s')): ?>
                                <?= Html::a('Подробнее', ["/user/buy-ticket", 'id' => $event->id]) ?>
                            <? else: ?>
                                <?= Html::a('Купить билеты', ["/user/buy-ticket", 'id' => $event->id]) ?>
                            <? endif; ?>
                        </div>
                        <div class="event-info" style="margin: 0 2rem 2rem 2rem; width: 60%">
                            <span class="event-main" style="font-size: 2rem;">
                                <h2 style="margin: 0;"><?= $event->title ?></h2>
                                <? if ($event->date < date('Y-m-d H:i:s')): ?>
                                    <span style="color: darkred;">Прошло</span>
                                <? endif; ?>
                            </span>
                            <p class="event-description"
                               style="width:100%; height:14rem;overflow: hidden;text-overflow: ellipsis; margin: 1rem;box-sizing: border-box;"><?= $event->description ?></p>
                        </div>
                    </div>
                <? endforeach; ?>
                <? echo LinkPager::widget([
                    'pagination' => $pages,
                ]); ?>
            </div>
        </div>
    </div>
    </body>
<? endif; ?>