<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use kartik\color\ColorInputAsset;
use kartik\date\DatePickerAsset;
use kartik\time\TimePickerAsset;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/sdk/api.js',
        'js/sdk/user.js',
        'js/sdk/event.js',
        'js/sdk/invite.js',
        'js/main.js',
        'js/register.js',
        'js/calendar.js',
        'js/popup.js',
        'js/router.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\CalendarAsset',
        'app\assets\LoginAsset'
    ];

    public function init()
    {
        parent::init();
        $this->depends[] = ColorInputAsset::className();
        $this->depends[] = DatePickerAsset::className();
        $this->depends[] = TimePickerAsset::className();
    }
}
