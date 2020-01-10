<?php

use app\models\User;

?>
<? if (!Yii::$app->user->isGuest): ?>
    <nav class="navbar navbar-inverse sidebar" role="navigation" style="width:auto;margin:0 auto;position: fixed;box-shadow: -1px 1px 6px 0px #b5b5b5;">
        <div class="navbar-header">
            <ul class="nav navbar-nav" style="display: flex; flex-direction: column;padding:0.5rem;";>
                <? if (Yii::$app->user->can('admin')): ?>
                    <li><a href="/user/personal-list">Профиль<span style="font-size:16px;"
                                                                   class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
                    </li>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Инструменты
                            <span class="caret"></span>
                            <span style="font-size:16px;"
                                  class="pull-right hidden-xs showopacity glyphicon glyphicon-cog"></span>
                        </a>
                        <ul class="dropdown-menu forAnimate" role="menu">
                            <li><a href="/event/events-list">Управление мероприятиями</a></li>
                            <li><a href="/event/ticket-type-list">Управление типами билетов</a></li>
                            <li class="divider"></li>
                            <li><a href="/site/show-role">Управление ролями</a></li>
                        </ul>
                    </li>
                <? elseif (Yii::$app->user->can('manager')): ?>
                    <li><a href="/user/personal-list">Профиль<span style="font-size:16px;"
                                                                   class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
                    </li>
                    </li>
                    <li><a href="#">Мои мероприятия<span style="font-size:16px;"
                                                         class="pull-right hidden-xs showopacity glyphicon glyphicon-blackboard"></span></a>
                    </li>
                <? elseif (Yii::$app->user->can('user')): ?>
                    <li><a href="/user/personal-list">Профиль<span style="font-size:16px;"
                                                                   class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
                    </li>
                    </li>
                    <li>
                        <p style="color: gray">Текущий счет
                            <?php
                            $user = Yii::$app->getUser()->getIdentity();
                            echo $user->wallet;
                            ?>
                            <span style="font-size:16px;"
                                  class="pull-right hidden-xs showopacity glyphicon glyphicon-ruble"></span>
                        </p>
                    </li>
                <? endif; ?>
            </ul>
        </div>
    </nav>
<? endif; ?>