<?php
/**
 * Created by PhpStorm.
 * User: lindal
 * Date: 23.04.17
 * Time: 0:11
 */

namespace app\controllers;


use app\models\forms\EventForm;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Controller;

class EventController extends Controller
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


    public function actionCreate($date_start)
    {
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        $model = new EventForm([
            'date_start' => $date_start,
            'user_id' => Yii::$app->getUser()->getId()
        ]);
        if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
            return $model;
        }
        return [
            'content' => $this->renderAjax('create', ['model' => $model])
        ];
    }
}