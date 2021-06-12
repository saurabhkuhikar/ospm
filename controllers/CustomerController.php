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

class CustomerController extends \yii\web\Controller
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
        Helper :: checkLogin();
        $Pending = 0;
        $Process = 0;
        $Delivered = 0;
        // Helper::checkAccess("Customer"); 
        $query = (new \yii\db\Query())->select(['order_status','customer_id'])->from('cylinder_bookings');
        $command = $query->createCommand();
        $cylinder_booking = $command->queryAll();
        foreach($cylinder_booking as $cylinder_bookings){
            if(in_array("Pending",$cylinder_bookings) && in_array(Helper::getID(),$cylinder_bookings)){
                $Pending++;
            }  
            if(in_array("Process",$cylinder_bookings) && in_array(Helper::getID(),$cylinder_bookings)){
                $Process++;
            } 
            if(in_array("Delivered",$cylinder_bookings) && in_array(Helper::getID(),$cylinder_bookings)){
                $Delivered++;
            }
        }
        return $this->render('/customer/dashboard',['Pending'=>$Pending , 'Process'=>$Process,'Delivered'=>$Delivered]);
                 
    }  


    /* Profile of supplier */
    public function actionProfile()
    {
        $model = $this->findProfile(Helper::getID()); 
        $model->setScenario('updateProfile');
        $indentityPic = (isset($model->identity_proof_type) && !empty($model->identity_proof_type))? $model->identity_proof_type : Null;

        if($model->load(Yii::$app->request->post())){

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
                return $this->redirect(['customer/profile']);
            }
        }
        return $this->render('profile', ['model' => $model]); 
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