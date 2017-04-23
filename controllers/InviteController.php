<?php
/**
 * Created by PhpStorm.
 * User: lindal
 * Date: 23.04.17
 * Time: 0:11
 */

namespace app\controllers;


use yii\rest\ActiveController;

class InviteController extends ActiveController
{
    public $modelClass = 'app\models\Invite';
}