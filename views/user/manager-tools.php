<?php

use yii\grid\GridView;
use yii\helpers\Html;

?>

<div class="manager-panel">
    <div class="manager-panel-head">
        <h1>Панель упралвения мероприятиями <span><?= $user->username ?>'a</span></h1>
        <div class="tools">
            <a href="/event/create-event" class="btn"
               style="display: flex;border: 1px solid gray;border-radius: 1rem;align-items: center;">
                Создать меропритие
                <span class="pull-right hidden-xs showopacity glyphicon glyphicon-blackboard"></span>
            </a>
        </div>
    </div>
    <div class="manager-panel-body">
        <?= GridView::widget([
            'dataProvider' => $model->search(Yii::$app->request->queryParams, $user->id),
            'filterModel' => $model,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'title',
                'adress',
                'date',
                'amount_of_tickets',
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/event/show-event-details', 'id' => $model->id]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-remove"></span>', ['/event/delete-event', 'id' => $model->id]);
                        }
                    ]
                ],
            ]
        ])
        ?>
    </div>
</div>

<? $this->registerCssFile('/' . Yii::getAlias('@web') . 'css/manager-tools.css'); ?>
