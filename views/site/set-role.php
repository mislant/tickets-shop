<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\AuthItem;

?>
<?php
$roles = AuthItem::GiveRoles();
$role = ArrayHelper::map($roles,'name','name');
$params = [
    'prompt' => 'Choose role'
];
?>
<table class="table table-dark" style="font-size: larger">
    <tr>
        <td>Current</td>
        <td>User</td>
        <td>Status</td>
        <td></td>
    </tr>
    <tr>
        <td><?=$data['id']?></td>
        <td><?=$data['username']  ?></td>
        <td>
            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'form-horizontal col-lg-11',]
            ]);
            echo $form->field($model,'item_name')->dropDownList($role,$params);
            ?>
        </td>
        <td>
            <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end() ?>
        </td>
    </tr>
</table>

