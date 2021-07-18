<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;
use app\components\Helper;
use app\models\Cities;
use app\models\States;
use yii\data\ActiveDataProvider;

class StateCitySearchController extends SiteController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout',],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $request = Yii::$app->request->post('state_name');
        
        if(!empty($request)){
            $supplierList = User::find()->select(['company_name','id','first_name','state','city','phone_number','profile_picture'])->where(['account_type' => ['Supplier'],'state'=>[$request]])->asArray()->all();
        }else{
            $supplierList = User::find()->select(['company_name','id','first_name','state','city','phone_number','profile_picture'])->where(['account_type' => ['Supplier']])->asArray()->all();
        }

        // return $this->redirect(array('site/index', array(
        //     'supplierList' => $supplierList
        // )));
        return $this->redirect('/site/index',['supplierList' =>$supplierList]);
    }
   
}
