<?php

/**
 * @var array $dataProvider
 */

use yii\helpers\Html;
use yii\grid\GridView;

?>
<div class="container-fluid">
    <?php echo Html::a('Создать новый тип билета', array('event/ticket-type-create'), array('class' => 'btn btn-primary pull-right')); ?>
</div>
<div class="clearfix"></div>
<hr/>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'type',
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
            'buttons' => [
                'delete' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/event/ticket-type-delete', 'id' => $model->id]);
                }
            ]
        ],
    ]
]) ?>
