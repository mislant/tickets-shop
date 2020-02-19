<?php

/**
 * @var $loginForm yii\base\Model;
 * @var $signupForm yii\base\Model;
 * @var $latestEvents array;
 * @var $latestAmount integer;
 * @var $soonEvents array;
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\JqueryAsset;

?>

<div class="main">
    <div class="latest_events">
        <span>Самые свежие мероприятия</span>
        <div class="wrap">
            <div class="prev n"><i class="fas fa-arrow-left"></i></div>
            <div class="slider">
                <div class="slider-item curry" style="display: block">
                    <div class="crutch">
                        <div class="event1">
                            <img class="photo" src="<?= $latestEvents[0]['events_photos'][0]['photo'] ?>">
                            <p class="event_title">
                                <span><?= $latestEvents[0]['title'] ?></span>
                            </p>
                        </div>
                        <div class="event2">
                            <img class="photo" src="<?= $latestEvents[0]['events_photos'][1]['photo'] ?>">
                            <div class="line"></div>
                            <p>
                                <?= $latestEvents[0]['description'] ?>
                            </p>
                        </div>
                        <?= Html::a('Купить', ['/user/buy-ticket', 'id' => $latestEvents[0]['id']], ['class' => 'button button-buy']) ?>
                    </div>
                </div>
                <? for ($i = 1; $i < $latestAmount; $i++): ?>
                    <div class="slider-item" style="display: none">
                        <div class="crutch">
                            <div class="event1">
                                <img class="photo" src="<?= $latestEvents[$i]['events_photos'][0]['photo'] ?>">
                                <p class="event_title">
                                    <span><?= $latestEvents[$i]['title'] ?></span>
                                </p>
                            </div>
                            <div class="event2">
                                <img class="photo" src="<?= $latestEvents[$i]['events_photos'][1]['photo'] ?>">
                                <div class="line"></div>
                                <p>
                                    <?= $latestEvents[$i]['description'] ?>
                                </p>
                            </div>
                            <?= Html::a('Купить', ['/user/buy-ticket', 'id' => $latestEvents[$i]['id']], ['class' => 'button button-buy']) ?>
                        </div>
                    </div>
                <? endfor; ?>
            </div>
            <div class="next n"><i class="fas fa-arrow-right"></i></div>
        </div>
    </div>
    <div class="line"></div>
    <div class="some"><span>Скоро начнутся</span></div>
    <div class="all_events">
        <? foreach ($soonEvents as $event): ?>
            <div class="event">
                <span class="topic"><?= $event['title'] ?></span>
                <div class="event-preview">
                    <?= Html::a('Купить', ['/user/buy-ticket', 'id' => $event['id']], ['class' => 'button button-buy']) ?>
                    <img src="<?= $event['events_photos'][0]['photo'] ?>">
                    <div class="event-date">
                        <?= Yii::$app->formatter->asDatetime($event['date']) ?>
                    </div>
                </div>
                <div class="description">
                    <p>
                        <?= $event['description'] ?>
                    </p>
                </div>
            </div>
        <? endforeach; ?>
    </div>
    <div class="info_panel">
        <div class="info info-news">
            <h3>Последние и самые свежие новости</h3>
            <div class="news">
                <div class="news_once">
                    <div class="date_news"><span>27</span>НОЯБ</div>
                    <div class="item">
                        <h4>Самая главная новость</h4>
                        <p>
                            Скоро вот вот уже я сдам свой проект.Этот сайт огромное для меня дела, поистенне настоящий
                            проект, не то что в универе.
                        </p>
                    </div>
                </div>
                <div class="news_once">
                    <div class="date_news"><span>27</span>НОЯБ</div>
                    <div class="item">
                        <h4>СКОРО ПРЕЗЕНТАЦИЯ</h4>
                        <p>
                            Уже совсем скоро, а именно через две недели я буду защищать этот сайт. Как бы все не прошло
                            я еще никогда в жизни не получал столь боьшое удовольствие знимаясь этим делом...
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="info info-about">
            <h3>Так кто мы такие?</h3>
            <p>
                Созерцание непредсказуемо. Сомнение рефлектирует естественный
                закон исключённого третьего.. Отсюда естественно следует, что
                автоматизация дискредитирует предмет деятельности. Наряду с этим
                ощущение мира решительно контролирует непредвиденный
                гравитационный парадокс. Наряду с этим ощущение мира решительно
            </p>
        </div>
        <div class="info info-contact">
            <h3>Мы свегда на связи</h3>
            <div class="contact contact-phone">
                <i class="fas fa-mobile-alt"></i>
                <span>+7-776-505-60-90</span>
            </div>
            <div class="contact contact-housephone">
                <i class="fas fa-phone"></i>
                <span>8(7212)44-16-28</span>
            </div>
            <div class="contact contact-mail">
                <i class="fas fa-envelope-open-text"></i>
                <span>kiryakz2000@gmail.com</span>
            </div>
            <div class="contact contact-adress">
                <i class="fas fa-building"></i>
                <span>ул.Академическая д.9/1</span>
            </div>
        </div>
    </div>
    <div class="our_clients">
        <div class="our">
            <div class="line line-first"></div>
            <span><h2>Наши клиенты</h2></span>
            <div class="line"></div>
        </div>
        <div class="clients">
            <img src="/img/woop.png" alt="woop"/>
        </div>
        <div class="line"></div>
    </div>
</div>
<? if (Yii::$app->user->isGuest): ?>
    <div class="popup popup-authorization" id="popup-auth">
        <div class="form-container">
            <div class="form-head"><img src="/img/key-icon_white.png" alt="key"><span>Авторизация<span></div>
            <? $form = ActiveForm::begin([
                'id' => 'form-log',
                'action' => '/user/log-in',
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
                'action' => '/user/sign-up',
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
<?

if (Yii::$app->user->isGuest) {
    $this->registerCssFile('/' . Yii::getAlias('@web') . 'css/form.css');
    $this->registerJsFile('/' . Yii::getAlias('@web') . 'js/popup.js', ['depends' => [JqueryAsset::className()]]);
    $this->registerJsFile('/' . Yii::getAlias('@web') . 'js/auth-reg_ajax.js', ['depends' => [JqueryAsset::className()]]);
}
$this->registerJsFile('/' . Yii::getAlias('@web') . 'js/slider.js', ['depends' => [JqueryAsset::className()]]);
?>

