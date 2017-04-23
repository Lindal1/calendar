<?php
use app\models\Event;
use yii\bootstrap\Html;
use yii\widgets\DetailView;

?>
<div>
    <?php

    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'date_start',
            'time_start',
            'date_end',
            'time_end',
            'description',
            'color',
            'user_id' => [
                'label' => 'Author',
                'value' => $model->user->name
            ],
            'statusName'
        ]
    ]);
    ?>
    <div>
        <?php if (Yii::$app->getUser()->getId() == $model->user_id || Yii::$app->getUser()->getIdentity()->isAdmin()) : ?>
            <?= Html::button('update', ['class' => 'btn btn-info js-update-event', 'data-id' => $model->id]) ?>
            <?= Html::button('delete', ['class' => 'btn btn-danger js-delete-event', 'data-id' => $model->id]) ?>
        <?php endif ?>
    </div>
</div>