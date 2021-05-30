<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
        'theme/plugins/fontawesome-free/css/all.min.css',
        'theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
        'theme/dist/css/adminlte.min.css'
    ];
    public $js = [
        //'theme/plugins/jquery/jquery.min.js',
        'theme/plugins/bootstrap/js/bootstrap.bundle.min.js',
        'theme/dist/js/adminlte.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
