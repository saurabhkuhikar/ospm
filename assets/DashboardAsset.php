<?php

namespace app\assets;

use yii\web\View;
use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DashboardAsset extends AssetBundle
{
    public function init() {
        $this->jsOptions['position'] = View::POS_END;
        parent::init();
    }

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'theme/vendors/font-awesome/css/font-awesome.min.css',   
        'css/site.css',
        'css/custom.css',
    ];
    public $js = [
        'theme/build/js/custom.min.js',
        'js/common.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}