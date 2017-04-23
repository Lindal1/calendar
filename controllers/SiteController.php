<?php

namespace app\controllers;

use app\models\forms\EventForm;
use app\models\forms\RegisterForm;
use Yii;
use yii\web\Controller;
use app\models\forms\LoginForm;
use app\models\ContactForm;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        Yii::$app->getResponse()->format = Response::FORMAT_JSON;
        $model = new LoginForm();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
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
        Yii::$app->getResponse()->format = Response::FORMAT_JSON;
        $model = new RegisterForm();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->register()) {
            return Yii::$app->getUser()->getIdentity();
        }
        return [
            'content' => $this->renderAjax('register', [
                'model' => $model
            ])
        ];
    }

    public function actionCalendar()
    {
        return $this->renderAjax('calendar');
    }

}
