<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

?>

<div class="form"
     style="display: flex;width: 60%;margin: 0 auto;box-sizing: border-box;padding: 4rem;box-shadow: 0px 0px 12px 3px rgba(156,156,156,1);">
    <?php $form = ActiveForm::begin([
        'id' => 'form-input',
        'options' => ['class' => 'form-horizontal col-lg-11',]
    ])
    ?>
    <div class="event-crete-form" style="display: flex;flex-direction: column;">
        <?= $form->field($model, 'title')->textInput(['placeholder' => 'Название мероприятия']) ?>
        <?= $form->field($model, 'adress')->textInput(['placeholder' => 'Введите место проведения мероприятия']) ?>
        <div id="map" style="width: 45rem;height: 27rem;justify-content: center;align-items: center;border: 1px solid gray"></div>
        <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
            'name' => 'check_issue_date',
            'value' => date('Y-M-d H:i:00'),
            'options' => ['placeholder' => 'Введите дату проведения мероприятия'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd H:i:00',
                'todayHighlight' => true
            ]
        ]) ?>
    </div>
    <?= Html::submitButton('Дальше', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end() ?>
</div>
<script type="text/javascript">
    ymaps.ready(init);

    function init() {
        var Map = new ymaps.Map("map", {
            center: [49.83, 73.16],
            zoom: 10
        });

        var searchControl = new ymaps.control.SearchControl({
            options: {
                provider: 'yandex#search'
            }
        });

        myMap.controls.add(searchControl);
        Map.setType('yandex#map');
    }
</script>
