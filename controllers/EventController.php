<?php
/**
 * Created by PhpStorm.
 * User: lindal
 * Date: 23.04.17
 * Time: 0:11
 */

namespace app\controllers;


use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class EventController extends ActiveController
{
    public $modelClass = 'app\models\Event';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authnticator'] = [
            'class' => HttpBearerAuth::className()
        ];
        return $behaviors;
    }
}