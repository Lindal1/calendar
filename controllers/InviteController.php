<?php
/**
 * Created by PhpStorm.
 * User: lindal
 * Date: 23.04.17
 * Time: 0:11
 */

namespace app\controllers;


use app\models\Invite;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

class InviteController extends Controller
{
    public function init()
    {
        parent::init();
        Yii::$app->getResponse()->format = Response::FORMAT_JSON;
    }


    /**
     * @inheritdoc
     * @return array
     */
    public function behaviors()
    {
        $behavior = parent::behaviors();
        $behavior['authenticator'] = [
            'class' => HttpBearerAuth::className()
        ];
        $behavior['access'] = [
            'class' => AccessControl::className(),
            'only' => ['new'],
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['new'],
                    'matchCallback' => function ($rule, $action) {
                        return Yii::$app->getUser()->getIdentity()->isAdmin();
                    },
                ]
            ],
        ];
        return $behavior;
    }

    /**
     * Generate new invite link
     * @return Invite|array
     */
    public function actionNew()
    {
        $model = new Invite([
            'created_by' => Yii::$app->getUser()->getId()
        ]);
        if ($model->save()) {
            return ['link' => Url::home(true) . '?register=1&code=' . $model->code];
        }
        return $model;
    }
}