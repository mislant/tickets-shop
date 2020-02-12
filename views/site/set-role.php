<?php

/**
 * @var array $data
 * @var array $role
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php
$params = [
    'prompt' => 'Choose role'
];
?>
<div class="role" style="display: flex;padding: 2rem;margin: 2rem;box-shadow: -6px 5px 3px -2px rgba(120,120,120,1);">
    <table class="table table-dark" style="font-size: larger">
        <tr>
            <td>Current</td>
            <td>User</td>
            <td>Status</td>
            <td></td>
        </tr>
        <tr>
            <td><?= $data['id'] ?></td>
            <td><?= $data['username'] ?></td>
            <td>
                <?php $form = ActiveForm::begin([
                    'options' => ['class' => 'form-horizontal col-lg-11',]
                ]);
                echo $form->field($model, 'item_name')->dropDownList($role, $params);
                ?>
            </td>
            <td>
                <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
                <?php ActiveForm::end() ?>
            </td>
        </tr>
    </table>
</div>

