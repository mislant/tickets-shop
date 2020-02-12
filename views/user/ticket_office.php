<?php

/* @var array $models
 * @var array $event
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<? if (Yii::$app->session->hasFlash('error_mesage')): ?>
    <div class="message err">
        <p style="color: white;">В покупке билетов отказано. Возможно на вашем счету недастаточно <a
                    href="/user/show-profile">средств?</a>
        </p>
    </div>
<? elseif (Yii::$app->session->hasFlash('empty_ticket_err_msg')): ?>
    <div class="message err">
        <p style="color: white;">В покупке билетов отказано. Вы не выбрали ни ондного билета!
        </p>
    </div>
<? elseif (Yii::$app->session->hasFlash('ticket_err_msg')): ?>
    <div class="message err">
        <p style="color: white;">В покупке билетов отказано. Вы выбрали неверное количесвто билетов!
        </p>
    </div>
<? elseif (Yii::$app->session->hasFlash('success')): ?>
    <div class="message success">
        <p style="color: white;">Билеты куплены успешно
        </p>
    </div>
<? endif; ?>
    <div class="ticket-office-panel">
        <div class="event">
            <span class="topic"><?= $event->title ?></span>
            <div class="event-preview">
                <a href="#" class="button button-buy">Купить</a>
                <img src="<?= $event->events_photos[0]->photo ?>">
                <div class="event-date">
                    <?= Yii::$app->formatter->asDatetime($event->date) ?>
                </div>
            </div>
            <div class="description">
                <p>
                    <?= $event->description ?>
                </p>
            </div>
        </div>
        <div class="ticket-cassa">
            <? if ($event->date < date('Y-m-d H:i:s')): ?>
                <h1 style="color: darkred">Мероприятие прошло</h1>
            <? else: ?>
                <h1>Доступные билеты</h1>
                <? $form = ActiveForm::begin([
                'id' => 'buy-form',
            ]) ?>
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
                    <? foreach ($models as $index => $model): ?>
                        <tr>
                            <th>
                                <?= $form->field($model, "[$index]event_id")
                                    ->hiddenInput(['value' => $event->id])
                                    ->label('') ?>
                            </th>
                            <th>
                                <?= $model->ticket_type; ?>
                                <?= $form->field($model, "[$index]ticket_type_id")
                                    ->hiddenInput(['value' => $model->ticket_type_id])
                                    ->label(''); ?>
                            </th>
                            <th>
                                <?= $model->all ?>
                                <?= $form->field($model, "[$index]ticket_type")
                                    ->hiddenInput(['value' => $model->ticket_type])
                                    ->label('') ?>
                            </th>
                            <th>
                                <div class="number"
                                     style="width: 12.4rem;height:4rem;display: flex;justify-content: center;align-items: center;">
                                    <span class="minus btn" style="cursor: pointer">-</span>
                                    <?= $form->field($model, "[$index]amount")
                                        ->textInput(['value' => 0, 'size' => 1])
                                        ->label('') ?>
                                    <span class="plus btn" style="cursor: pointer">+</span>
                                </div>
                            </th>
                            <th>
                                <?= $model->cost; ?>
                                <?= $form->field($model, "[$index]cost")
                                    ->hiddenInput(['value' => $model->cost])
                                    ->label(''); ?>
                            </th>
                            <th>
                                <?= $form->field($model, "[$index]all")
                                    ->hiddenInput(['value' => $model->all])
                                    ->label('') ?>
                            </th>
                        </tr>
                    <? endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>
                            <?= Html::submitButton('Купить', ['class' => 'btn btn-success']) ?>
                        </th>
                    </tr>
                    </tfoot>
                </table>
                <? $form = ActiveForm::end() ?>
            <? endif; ?>
        </div>
    </div>
<?php
$this->registerCssFile(Yii::getAlias('@web') . '/css/messages.css');
$this->registerJsFile(Yii::getAlias('@web') . 'js/buy-ticket.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>