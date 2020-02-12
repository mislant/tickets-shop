<?php

/**
 * @var array $model
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

?>
<?php
if (Yii::$app->session->has('error_message')) {
    echo Yii::$app->session->getFlash('error_message');
}
?>
<div class="container-fluid">
    <?php echo Html::a('Создать мероприятие', ['event/create-event'], ['class' => 'btn btn-primary pull-right']); ?>
</div>
<hr>
<? Pjax::begin() ?>
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
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/event/show-event-details', 'id' => $model->id]);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-remove"></span>', ['/event/delete-event', 'id' => $model->id], ['data-pjax' => 0]);
                }
            ]
        ],
    ]

])
?>
<? Pjax::end() ?>
