<?php

use app\models\TicketType;
use yii\helpers\Html;

?>

<div class="confirm">
    <h1 style="color: darkred;">Подтвреждение покупки</h1>
    <hr/>
    <table class="table table-dark">
        <thead>
        <tr>
            <th>Билет</th>
            <th>Количество</th>
            <th>Стоймость 1х</th>
            <th>Стомость</th>
        </tr>
        </thead>
        <? $count = 0 ?>
        <? foreach ($models as $model): ?>
            <? if ($model['amount'] > 0): ?>
                <tbody>
                <tr>
                    <th>
                        <?php
                        $type = TicketType::findOne(['id' => $model['ticket_type_id']]);
                        echo $type->type;
                        ?>
                    </th>
                    <th><?= $model['amount'] ?></th>
                    <th><?= $model['cost'] ?></th>
                    <th>
                        <?= $model['amount'] * $model['cost'] ?>
                        <? $count += $model['amount'] * $model['cost'] ?>
                    </th>
                </tr>
                </tbody>
            <? endif; ?>
        <? endforeach; ?>
        <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th>Всего</th>
            <th><?= $count ?></th>
        </tr>
        </tfoot>
    </table>
    <div class="buttons-container" style="width: 100%;display: flex;justify-content: space-around">
        <?=Html::a('Отказать',['user/buy-ticket'],['class' => 'btn btn-info'])?>
        <?=Html::a('Подтвердить покупку',['/event/buy-ticket', 'models' => $models,'id' => $id],['class' => 'btn btn-success'])?>
    </div>
</div>