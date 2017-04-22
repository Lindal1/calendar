<?php
/**
 * Created by PhpStorm.
 * User: lindal
 * Date: 22.04.17
 * Time: 12:40
 */

namespace app\assets;


use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/login.js'
    ];
    public $depends = [];
}