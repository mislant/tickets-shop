<?php

use yii\helpers\Html;
use app\models\TicketType;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

?>
<div class="container-fluid">
    <?php echo Html::a('Create new ticket type', array('event/ticket-type-create'), array('class' => 'btn btn-primary pull-right')); ?>
</div>
<div class="clearfix"></div>
<hr/>

<?php
$query = TicketType::find();
$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => '10',
    ]
]);
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'type',
        ['class' => 'yii\grid\ActionColumn',
        'template' => '{delete}',
            'buttons' => [
                    'delete' => function($url,$model,$key)
                    {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/event/ticket-type-delete','id' => $model->id]);
                    }
            ]
        ],
    ]
])  ?>
