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
class HomeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'theme/vendors/font-awesome/css/font-awesome.min.css',
        // 'theme/vendors/nprogress/nprogress.css',       
        'css/site.css',
        'css/home.css'
    ];
    public $js = [
        // 'theme/vendors/fastclick/lib/fastclick.js',
        // 'theme/vendors/nprogress/nprogress.js',
        'js/common.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
