<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\CustomerSignupForm;
use app\models\SupplierSignupForm;
use app\models\LoginForm;
use app\models\Profile;
use app\components\Helper;

/**
 * OsmpController implements the CRUD actions for Users model.
 */
class AccountController extends Controller
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
                        'actions' => ['login','logout','SupplierSignup','CustomerSignup','ForgotPassword'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(Yii::$app->user->identity->account_type == "Customer"){
                return $this->redirect(['customer/dashboard']);
            }
            return $this->redirect(['supplier/dashboard']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Supplier Signup action.
     *
     * @return Response
     */
   
        /* Supplier Signup form */

        public function actionSupplierSignup()
    {
        $model = new SupplierSignupForm();

        if($model->load(Yii::$app->request->post()) && $model->signup()){
            return $this->redirect(['supplier/dashboard']);            
        }
        return $this->render('supplier-signup', ['model' => $model]);
    }
    
    /**
     * Customer Signup action.
     *
     * @return Response
     */
        /* Customer Signup form */

        public function actionCustomerSignup()
    {
        $model = new CustomerSignupForm();       

        if($model->load(Yii::$app->request->post()) && $model->signup()){
            return $this->redirect(['customer/dashboard']);
                  
        }
        
        return $this->render('customer-signup', ['model' => $model]);
    }

    /*Forgot passwoard */

    public function actionForgotPassword(){

        return $this->render('/account/forgot-password');
    }    
}
