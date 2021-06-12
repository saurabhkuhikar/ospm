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
        Helper::checkLogin();
        // Helper::checkAccess("Supplier");                
        $Pending = 0;
        $Process = 0;
        $Delivered = 0;
        
        $query = (new \yii\db\Query())->select(['order_status','supplier_id'])->from('cylinder_bookings');
        $command = $query->createCommand();
        $supplier_dashboard = $command->queryAll();  
        foreach($supplier_dashboard as $supplier_dashboards){
            if(in_array("Pending",$supplier_dashboards) && in_array(Helper::getID(),$supplier_dashboards)){
                $Pending++;
            }  
            if(in_array("Process",$supplier_dashboards) && in_array(Helper::getID(),$supplier_dashboards)){
                $Process++;
            } 
            if(in_array("Delivered",$supplier_dashboards) && in_array(Helper::getID(),$supplier_dashboards)){
                $Delivered++;
            }
        }
        
        return $this->render('/supplier/dashboard',['Pending'=>$Pending , 'Process'=>$Process,'Delivered'=>$Delivered]);
                   
    }  
    /* Profile of supplier */
    public function actionProfile()
    {
        $model = $this->findProfile(Helper::getID()); 
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
