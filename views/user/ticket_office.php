<?php

/* @var array $models
 * @var array $event
 */

use yii\web\JqueryAsset;
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
                            <? if (Yii::$app->user->isGuest): ?>
                                <span class="button" style="background-color: gray;color: white">Для покупки билетов вы должны быть зарегистрированны</span>
                            <? else: ?>
                                <?= Html::submitButton('Купить', ['class' => 'btn btn-success']) ?>
                            <? endif; ?>
                        </th>
                    </tr>
                    </tfoot>
                </table>
                <? $form = ActiveForm::end() ?>
            <? endif; ?>
        </div>
        <? if (Yii::$app->user->isGuest): ?>
            <div class="popup popup-authorization" id="popup-auth">
                <div class="form-container">
                    <div class="form-head"><img src="/img/key-icon_white.png" alt="key"><span>Авторизация<span></div>
                    <? $form = ActiveForm::begin([
                        'id' => 'form-log',
                        'action' => 'user/log-in',
                        'enableClientValidation' => true,
                        'enableAjaxValidation' => true
                    ]) ?>
                    <div class="form-body">
                        <?= $form->field($loginForm, 'emailnick')->textInput() ?>
                        <?= $form->field($loginForm, 'password')->passwordInput() ?>
                    </div>
                    <div class="form-foot">
                        <?= Html::submitButton('Войти', ['class' => 'button button-in']) ?>
                        <a class="a-form" id="auth-reg">Зарегестрироваться?</a>
                    </div>
                    <? $form = ActiveForm::end() ?>
                </div>
            </div>
            <div class="popup popup-register" id="popup-reg">
                <div class="form-container">
                    <div class="form-head"><img src="/img/key-icon_white.png" alt="key"><span>Регистрация<span></div>
                    <? $form = ActiveForm::begin([
                        'id' => 'form-reg',
                        'action' => 'user/sign-up',
                        'enableClientValidation' => true,
                        'enableAjaxValidation' => true,
                    ]) ?>
                    <div class="form-body">
                        <?= $form->field($signupForm, 'username')->textInput() ?>
                        <?= $form->field($signupForm, 'email')->textInput() ?>
                        <?= $form->field($signupForm, 'password')->passwordInput() ?>
                        <?= $form->field($signupForm, 'password_repeat')->passwordInput() ?>
                    </div>
                    <div class="form-foot">
                        <?= Html::submitButton('Зарегестрироваться', ['class' => 'button button-in']) ?>
                        <a class="a-form" id="reg-auth">Есть аккаунт?</a>
                    </div>
                    <? $form = ActiveForm::end() ?>
                </div>
            </div>
        <? endif; ?>
    </div>
<?php
if (Yii::$app->user->isGuest) {
    $this->registerCssFile('/' . Yii::getAlias('@web') . 'css/form.css');
    $this->registerJsFile('/' . Yii::getAlias('@web') . 'js/popup.js', ['depends' => [JqueryAsset::className()]]);
    $this->registerJsFile('/' . Yii::getAlias('@web') . 'js/auth-reg_ajax.js', ['depends' => [JqueryAsset::className()]]);
}
$this->registerCssFile(Yii::getAlias('@web') . '/css/messages.css');
$this->registerJsFile(Yii::getAlias('@web') . 'js/buy-ticket.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>