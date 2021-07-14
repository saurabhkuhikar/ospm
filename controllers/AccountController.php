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
use app\models\Cities;
use app\models\States;
use app\components\Helper;
use yii\web\UploadedFile;

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
                'only' => ['logout','change-profile-picture'],
                'rules' => [
                    [
                        'actions' => ['login','logout','change-profile-picture','get-city-list','SupplierSignup','CustomerSignup','ForgotPassword'],
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
        $this->layout = 'login';
        
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
        $this->layout = 'login';
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
        $this->layout = 'login';
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
    
    
    /*profile picture*/

    public function actionChangeProfilePicture()
    {
        $this->layout = 'dashboard';

        $model = $this->findProfile(Helper::getCurrentUserId()); 

        $profilePic = (isset($model->profile_picture) && !empty($model->profile_picture))? $model->profile_picture : Null;

        if ($model->load(Yii::$app->request->post())) {
            $profilePictureObject = UploadedFile::getInstance($model,'profile_picture');
            if(!empty($profilePictureObject)){
                $model->profile_picture = $profilePictureObject;
                $fileName = time().'.'.$model->profile_picture->extension;
                $model->profile_picture->saveAs('upload/profile_pictures/'.$fileName);
                $profilePic = $fileName;
            }
            $model->profile_picture = $profilePic;            
            if($model->save()){                
                Yii::$app->session->setFlash('success', "Your profile picture updated successfully.");
                
                return $this->redirect(['/account/change-profile-picture']);
            }
        }

        
        return $this->render('/account/change-profile-picture',['model' => $model]);
    }    
    
    /**
     * Find Profile Model.
     * @param id
     * @return string
    */
    protected function findProfile($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetCityList(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if(isset($_POST['getStateId'])){
                $stateId = States::find()->select('id')->where(['state_name'=>$_POST['getStateId']])->asArray()->one();
                $cityLists = Cities::find()->select('city_name')->where(['state_id'=>$stateId])->asArray()->all();
            }
        }
        
        return json_encode(['status'=>200,'cityLists'=>$cityLists]);
    }

}