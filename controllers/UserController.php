<?php
/**
 * Created by PhpStorm.
 * User: lindal
 * Date: 21.04.17
 * Time: 1:10
 */

namespace app\controllers;

use app\models\forms\LoginForm;
use yii\rest\ActiveController;
use Yii;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->attributes = Yii::$app->getRequest()->post();
        if ($model->validate()) {
            $model->login();
            return Yii::$app->getUser()->getIdentity();
        }
        return $model;
    }
}