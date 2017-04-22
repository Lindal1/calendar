<?php
/**
 * Created by PhpStorm.
 * User: lindal
 * Date: 22.04.17
 * Time: 0:20
 */

namespace app\assets;


use yii\web\AssetBundle;

class CalendarAsset extends AssetBundle
{
    public $sourcePath = '@bower/fullcalendar';
    public $js = [
        'dist/fullcalendar.js',
        'dist/gcal.js'
    ];
    public $css = [
        'dist/fullcalendar.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'app\assets\MomentAsset'
    ];
}