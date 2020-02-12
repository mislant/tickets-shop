<? Use yii\helpers\Html; ?>
<?php
$form = \yii\widgets\ActiveForm::begin([
    'id' => 'form',
    'action' => 'test-ajax',
    'method' => 'post',
]);
?>
<?= $form->field($model, 'text')->textInput(); ?>
<?= Html::submitButton('Save'); ?>
<?php $form->end(); ?>
<!-- Ответ сервера будем выводить сюда -->
<p id="output"></p>

<?php
$js = <<<JS
    $('#form').on('beforeSubmit', function () {
        alert('send');
        return false;
    })
JS;

$this->registerJs($js);
?>
