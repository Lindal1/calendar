<?php
use yii\bootstrap\Html;

?>
<div>
    <?php if (Yii::$app->getUser()->getIdentity()->isAdmin()): ?>
        <div>
            <?= Html::button('Generate new invite link', ['class' => 'btn btn-warning js-generate-new-invite']) ?>
            <div class="js-new-link-place"></div>
        </div>
    <?php endif ?>
    <div id="calendar"></div>
</div>