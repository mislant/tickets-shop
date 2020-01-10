<?php
/**
 * @var $model User
 */

use app\models\User;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

?>

<?php
$query = User::find();
$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 20,
    ],
    'sort' => [
        'attributes' => ['id', 'username'],
    ],
])
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
                        return \yii\helpers\Html::a('<span class = "glyphicon glyphicon-refresh"></span>', ['/site/set-role', 'id' => $model['id']]);
                    }
                ]
            ]
        ]
    ])
?>