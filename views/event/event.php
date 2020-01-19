<?php

/**
 * @var array $model
 */

use yii\helpers\Html;
use yii\grid\GridView;

?>
<?php
if (Yii::$app->session->has('error_message')) {
    echo Yii::$app->session->getFlash('error_message');
}
?>
<div class="container-fluid">
    <?php echo Html::a('Создать мероприятие', ['event/event-create'], ['class' => 'btn btn-primary pull-right']); ?>
</div>
<hr>
<?= GridView::widget([

    'dataProvider' => $model->search(Yii::$app->request->queryParams),
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
