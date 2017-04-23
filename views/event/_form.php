<?php
use app\models\Event;
use kartik\color\ColorInput;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div>
    <?php
    $form = ActiveForm::begin([
        'id' => 'event-form'
    ]);
    ?>


    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'date_start')->widget(DatePicker::className(), [
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

    <?= $form->field($model, 'time_start')->widget(TimePicker::className(), [
        'pluginOptions' => [
            'format' => 'hh:ii',
            'defaultTime' => false
        ]
    ]) ?>

    <?= $form->field($model, 'date_end')->widget(DatePicker::className(), [
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

    <?= $form->field($model, 'time_end')->widget(TimePicker::className(), [
        'pluginOptions' => [
            'format' => 'hh:ii',
            'defaultTime' => false
        ]
    ]) ?>

    <?= $form->field($model, 'description')->textarea() ?>
    <?= $form->field($model, 'color')->widget(ColorInput::className()) ?>
    <?= $form->field($model, 'status')->dropDownList(Event::$statusNames) ?>


    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?= Html::button('Close', ['class' => 'btn btn-info js-close-popup']) ?>

    <?php ActiveForm::end(); ?>
</div>