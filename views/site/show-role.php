<?php
/**
 * @var array $dataProvider
 */

use yii\grid\GridView;
use yii\helpers\Html;

?>



<?= GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            [
                'header' => 'Роль',
                'value' => function ($model) {
                    return $model->getAssignment()->item_name;
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class = "glyphicon glyphicon-refresh"></span>', ['/site/set-role', 'id' => $model['id']]);
                    }
                ]
            ]
        ]
    ])
?>