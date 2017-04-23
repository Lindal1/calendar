<?php
use yii\bootstrap\ActiveForm;

?>
<div>
    <h2>Register new user:</h2>
    <?php
    $form = ActiveForm::begin([
        'id' => 'register-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ]
    ]);
    echo $form->errorSummary($model);
    ?>

    <?= $form->field($model, 'code')->hiddenInput()->label('') ?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'password_repeat')->passwordInput() ?>

    <?= \yii\bootstrap\Html::submitButton('Register', ['class' => 'btn btn-success']) ?>

    <?php
    ActiveForm::end();
    ?>
</div>
