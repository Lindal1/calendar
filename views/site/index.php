<?php

/* @var $this yii\web\View */
use app\models\forms\LoginForm;
use yii\jui\Dialog;

$this->title = 'My Yii Application';
?>

    <div id="content"></div>

<?php
Dialog::begin([
    'id' => 'popup',
    'clientOptions' => [
        'autoOpen' => false,
        'modal' => true,
        'resizable' => false,
        'draggable' => false,
        'closeOnEscape' => true
    ]
]);
echo "<div id='popup-content'></div>";
Dialog::end();
?>