<?php
/**
 * Created by PhpStorm.
 * User: lindal
 * Date: 22.04.17
 * Time: 1:46
 */

namespace app\assets;


use yii\web\AssetBundle;

class MomentAsset extends AssetBundle
{
    public $sourcePath = '@bower/moment';
    public $js = [
        'min/moment.min.js'
    ];
}