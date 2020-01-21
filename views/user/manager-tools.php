<?php

use yii\grid\GridView;
use yii\helpers\Html;

?>

<div class="manager-panel" style="display: flex;flex-direction: column">
    <div class="manager-panel-head" style="display: flex;justify-content: space-between;margin-bottom: 3rem;">
        <h1>Панель упралвения мероприятиями <?= $user->username ?>'a</h1>
        <div class="tools">
            <a href="/event/event-create" class="btn" style="border: 1px solid gray;border-radius: 1rem;">
                Создать меропритие<span class="pull-right hidden-xs showopacity glyphicon glyphicon-blackboard"></span>
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
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/event/event-details', 'id' => $model->id]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-remove"></span>', ['/event/event-delete', 'id' => $model->id]);
                        }
                    ]
                ],
            ]
        ])
        ?>
    </div>
</div>