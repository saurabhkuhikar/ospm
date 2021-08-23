<?php

namespace app\modules\admin;
use Yii;
/**
 * admin module definition class
 */
class Admin extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // Yii::$app->errorHandler->errorAction = '/admin/main/error';


        // Yii::$app->set('user',[
        //     'class'=>'yii\web\user',
        //     'identityClass'=>'app\modules\admin\Admin',
        //     'enableAutoLogin'=>true,
        //     'loginUrl'=>['admin/default/login'],
        // ]);

        // Yii::$app->set('session',[
        //     'class'=>'yii\web\Session',
        //     'name'=>'_adminSessionId',
        // ]);

        // custom initialization code goes here
    }
}