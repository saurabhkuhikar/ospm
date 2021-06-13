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
                        'actions' => ['logout','dashboard','profile'],
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
        Helper::checkAccess("Supplier");
        $statuswiseCounting = ['pending' => 0,'process' => 0,'delivered' => 0];       
        $bookingRequests = BookingRequest::find()->where(['supplier_id' => Helper::getCurrentUserId()])->all();

        foreach($bookingRequests as $bookingRequest){
            $statuswiseCounting[strtolower($bookingRequest->order_status)] = $statuswiseCounting[strtolower($bookingRequest->order_status)] + 1;
        }
        return $this->render('/supplier/dashboard',['statuswiseCounting'=>$statuswiseCounting]);                   
    }  


    /* Profile of supplier */
    public function actionProfile()
    {
        $model = $this->findProfile(Helper::getCurrentUserId()); 
        $model->setScenario('updateProfile');
        
        $indentityPic = (isset($model->identity_proof_type) && !empty($model->identity_proof_type))? $model->identity_proof_type : Null;

        if ($model->load(Yii::$app->request->post())) {

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

}
