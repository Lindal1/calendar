<?php
/**
 * Created by PhpStorm.
 * User: lindal
 * Date: 21.04.17
 * Time: 1:10
 */

namespace app\controllers;

use app\models\forms\LoginForm;
use Yii;
use yii\web\Controller;

class UserController extends Controller
{
    public $modelClass = 'app\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' => HttpBearerAuth::className(),
//            'except' => ['login']
//        ];
        return $behaviors;
    }

    public function actionLogin()
    {
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->login();
            return Yii::$app->getUser()->getIdentity();
        }
        return [
            'content' => $this->renderAjax('login', [
                'model' => $model
            ])
        ];
    }

    public function actionRegister()
    {

    }

    public function actionIam()
    {
        return Yii::$app->getUser()->getIdentity();
    }
}