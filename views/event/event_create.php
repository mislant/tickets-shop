<?php

/**
 * @var array $model
 */

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
        <?= $form->field($model, 'adress')->hiddenInput(['id' => 'adress'])->label('Выберите место проведения мероприятия') ?>
        <div id="map"
             style="width: 45rem;height: 27rem;justify-content: center;align-items: center;border: 1px solid gray"></div>
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
<?php $this->registerJsFile(Yii::getAlias('@web') . 'js/yandex-api-map-adress.js', ['depends' => [\yii\web\JqueryAsset::className(), \app\assets\AppAsset::className()]]); ?>
