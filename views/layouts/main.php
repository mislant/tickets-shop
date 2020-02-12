<?php

/* @var $this \yii\web\View */

/* @var $content string */

/**
 * @var $loginForm array
 */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="/img/logo2sqr.ico" type="image/x-icon">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="all">
    <div class="yellow_line_big"></div>
    <div class="body">
        <div class="yellow_line_small"></div>
        <div class="content">
            <div class="title">
                <div class="logo">
                    <img src="/img/logo2.png" alt="logo"/><span>TicketShop</span>
                </div>
                <div class="co-dis">
                    <p>
                        <span>Хочешь хорошо провести время?</span> <br/>
                        самые свежие и самые дешевые билеты только у нас
                    </p>
                </div>
            </div>
            <nav class="navigation">
                <ul>
                    <? if (Yii::$app->user->isGuest): ?>
                        <li>
                            <a href="/site/index">Главная<i class="fas fa-home"></i></a>
                        </li>
                        <li>
                            <a id="auth" style="cursor: pointer"
                            >Войти<i class="fas fa-door-open"></i></a>
                        </li>
                        <li>
                            <a id="reg" style="cursor: pointer"
                            >Зарегистрироваться<i class="fas fa-sign-in-alt"></i></a>
                        </li>
                    <? elseif (Yii::$app->user->can('admin')): ?>
                        <li>
                            <a href="/site/index">Главная<i class="fas fa-home"></i></a>
                        </li>
                        <li>
                            <a href="/user/show-profile">Личный кабинет<i class="fas fa-user"></i></a>
                        </li>
                        <li>
                            <a href="#">Инструменты<i class="fas fa-cogs"></i>
                            </a>
                            <ul>
                                <li><a href="/site/show-role">Управление ролями<i class="fas fa-calendar-alt"></i></a>
                                </li>
                                <li><a href="/event/show-events">Управление мероприятиями<i class="fas fa-edit"></i></a>
                                </li>
                                <li><a href="/event/show-ticket-type">Управление типами билетов<i
                                                class="fas fa-user-edit"></i></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="/user/logout">Выйти<i class="fas fa-sign-in-alt"></i></a>
                        </li>
                    <? elseif (Yii::$app->user->can('manager')): ?>
                        <li>
                            <a href="/site/index">Главная<i class="fas fa-home"></i></a>
                        </li>
                        <li>
                            <a href="/user/show-manager-tools">Мои мероприятия<i class="fas fa-edit"></i></a>
                        </li>
                        <li>
                            <a href="/user/show-profile">Личный кабинет<i class="fas fa-user"></i></a>
                        </li>
                        <li>
                            <a href="/user/logout">Выйти<i class="fas fa-sign-in-alt"></i></a>
                        </li>
                    <? elseif (Yii::$app->user->can('user')): ?>
                        <li>
                            <a href="/site/index">Главная<i class="fas fa-home"></i></a>
                        </li>
                        <li>
                            <a href="/site/render-all">Все мероприятия<i class="fas fa-door-open"></i></a>
                        </li>
                        <li>
                            <a href="/user/show-profile">Личный кабинет<i class="fas fa-user"></i></a>
                        </li>
                        <li>
                            <a href="/user/logout">Выйти<i class="fas fa-sign-in-alt"></i></a>
                        </li>
                    <? endif; ?>
                </ul>
            </nav>
            <?= $content ?>
        </div>
        <footer>
            <div class="in-foot">
                <div class="logo">
                    <img src="/img/logo2.png" alt="logo"/><span>TicketShop</span>
                </div>
                <span>&copy; TicketShop <?= date('Y') ?></span>
            </div>
        </footer>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
