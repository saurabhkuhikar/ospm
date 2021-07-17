<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Profile;
use yii\web\UploadedFile;
use app\components\Helper;
use app\models\BookingRequest;
use app\models\Cities;
use app\models\States;

class SupplierController extends \yii\web\Controller
{    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','dashboard','profile'],
                'rules' => [
                    [
                        'actions' => ['logout','dashboard','get-city-list','profile'],
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
    
    /* dashboard view*/
    public function actionDashboard()
    {        
        $this->layout = 'dashboard';
        Helper::checkAccess("Supplier");
        $bookingRequests = BookingRequest::find()->select(['SUM( IF(order_status = "Pending", 1, 0) ) AS pending', 
        'SUM( IF(order_status = "Process", 1, 0) ) AS process','SUM( IF(order_status = "Delivered", 1, 0) ) AS delivered'])->where(['supplier_id' => Helper::getCurrentUserId()])->Asarray()->one();
        if(in_array("",$bookingRequests)){
            $bookingRequests = ["pending"=>0,"process"=>0,"delivered"=>0];
        }
        return $this->render('/supplier/dashboard',['bookingRequests'=>$bookingRequests]);                   
    }  


    /* Profile of supplier */
    public function actionProfile()
    {
        $this->layout = 'dashboard';
        $model = $this->findProfile(Helper::getCurrentUserId()); 
        $model->setScenario('updateProfile');
        $email = $model->email; 
        $mobileNumber = $model->phone_number; 
        $indentityPic = (isset($model->identity_proof_type) && !empty($model->identity_proof_type))? $model->identity_proof_type : Null;

        if ($model->load(Yii::$app->request->post())){

            if($email != $model->email || $mobileNumber != $model->phone_number){
                $model->email = $email; 
                $model->phone_number = $mobileNumber;
            }

            $indentityPictureObject = UploadedFile::getInstance($model,'identity_proof_type');

            if(!empty($indentityPictureObject)){
                $model->identity_proof_type = $indentityPictureObject;
                $fileName = time().'.'.$model->identity_proof_type->extension;
                $model->identity_proof_type->saveAs('upload/indentity_proof_images/'.$fileName);
                $indentityPic = $fileName;
            }
            $model->identity_proof_type = $indentityPic;
            if($model->save()){
                Yii::$app->session->setFlash('success', "Profile updated successfully.");
                return $this->redirect(['supplier/profile']);
            }
        }
        return $this->render('profile', ['model' => $model]); 
    } 

    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProfile($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        }       

        throw new NotFoundHttpException('The requested page does not exist.');
    } 


    /* Get City list*/
    public function actionGetCityList(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if(isset($_POST['getStateName'])){
                $stateId = States::find()->select('id')->where(['state_name'=>$_POST['getStateName']])->asArray()->one();
                $cityLists = Cities::find()->select('city_name')->where(['state_id'=>$stateId])->asArray()->all();
            }
        }
        
        return json_encode(['status'=>200,'cityLists'=>$cityLists]);
    }

    /* Get State list*/
    public function actionGetStateList(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if(isset($_POST['getCityName'])){
                $stateId = Cities::find()->select('state_id')->where(['city_name'=>$_POST['getCityName']])->asArray()->one();
                $stateLists = States::find()->select('state_name')->where(['id'=>$stateId])->asArray()->all();
            }
        }        
        return json_encode(['status'=>200,'stateLists'=>$stateLists]);
    }

}
