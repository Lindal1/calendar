<?php
use kartik\color\ColorInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;

?>
<div>
    <h2><?php echo($model->isNewRecord ? 'New' : 'Update') ?> event:</h2>
    <?php
    $form = ActiveForm::begin();
    ?>


    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'date_start')->widget(DatePicker::className(), [
        'dateFormat' => 'yyyy-MM-dd'
    ]) ?>
    <?= $form->field($model, 'date_end')->widget(DatePicker::className(), [
        'dateFormat' => 'yyyy-MM-dd'
    ]) ?>

    <?= $form->field($model, 'description')->textarea() ?>
    <?= $form->field($model, 'color')->widget(ColorInput::className()) ?>


    <?= Html::submitButton('Save') ?>

    <?php ActiveForm::end(); ?>
</div>