<?php
/**
 * Created by PhpStorm.
 * User: lindal
 * Date: 23.04.17
 * Time: 0:11
 */

namespace app\controllers;

use app\models\Event;
use app\models\forms\EventForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class EventController extends Controller
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
            'only' => ['update-dates', 'update', 'delete'],
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['update-dates', 'update', 'delete'],
                    'matchCallback' => function ($rule, $action) {
                        $id = Yii::$app->getRequest()->get('id', null) ?: Yii::$app->getRequest()->post('id', null);
                        if (!$id) {
                            return false;
                        }
                        $model = $this->loadModel($id);
                        return $model->user_id == Yii::$app->getUser()->getId() || Yii::$app->getUser()->getIdentity()->isAdmin();
                    },
                ]
            ],
        ];
        return $behavior;
    }

    /**
     * Create new event
     * @param string $date_start
     * @return Event|array
     */
    public function actionCreate($date_start)
    {
        $model = new Event([
            'date_start' => $date_start,
            'user_id' => Yii::$app->getUser()->getId()
        ]);
        if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
            return $model;
        }
        return [
            'content' => $this->renderAjax('create', [
                'model' => $model
            ])
        ];
    }

    /**
     * Update event
     * @param $id
     * @return array|Event
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
            return $model;
        }
        return [
            'content' => $this->renderAjax('update', [
                'model' => $model
            ])
        ];
    }

    /**
     * Delete event
     * @return array
     */
    public function actionDelete()
    {
        $this->loadModel(Yii::$app->getRequest()->post('id', null))->delete();
        return [];
    }

    /**
     * Get event list by month
     * @param $start
     * @param $end
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionIndex($start, $end)
    {
        return Event::find()
            ->where(['between', 'date_start', $start, $end])
            ->orWhere(['between', 'date_end', $start, $end])
            ->all();
    }

    /**
     * @param $id
     * @return array
     */
    public function actionView($id)
    {
        return [
            'content' => $this->renderAjax('view', [
                'model' => $this->loadModel($id)
            ])
        ];
    }

    /**
     * @param $id
     * @return Event
     * @throws NotFoundHttpException
     */
    private function loadModel($id)
    {
        $model = Event::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $model;
    }

    /**
     * @return Event
     */
    public function actionUpdateDates()
    {
        $model = $this->loadModel(Yii::$app->getRequest()->post('id', null));
        $model->date_start = Yii::$app->getRequest()->post('start');
        $model->date_end = Yii::$app->getRequest()->post('end');
        if ($model->validate()) {
            $model->save();
        }
        return $model;
    }

}