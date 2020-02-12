<?php

/**
 * @var $events app\models\Event
 */

use yii\helpers\Html;

?>
    <div class="all-events">
        <? foreach ($events as $event): ?>
            <div class="event-small">
                <div class="small-photo">
                    <img src="<?= $event->events_photos[0]->photo ?>" style="width: 100%;height: 100%;">
                    <?= Html::a('Купить', ['/user/buy-ticket', 'id' => $event->id], ['class' => 'button button-buy']) ?>
                </div>
                <div class="small-container">
                    <?= Yii::$app->formatter->asDatetime($event->date) ?>
                    <span>
                        <?= $event->title ?>
                    </span>
                </div>
            </div>
        <? endforeach; ?>
    </div>


<?php
$this->registerCssFile('/' . Yii::getAlias('@web') . 'css/all.css');
?>