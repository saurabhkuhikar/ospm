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

class SupplierController extends \yii\web\Controller
{
    
    
    
    /* dashboard view*/
    public function actionDashboard()
    {
        if (!Yii::$app->user->isGuest){ 
            if(Yii::$app->user->identity->account_type == "Supplier"){
                $query = (new \yii\db\Query())->select(['order_status','supplier_id'])->from('cylinder_bookings');
                $command = $query->createCommand();
                $model = $command->queryAll();
                return $this->render('/supplier/dashboard',['model' => $model]);
            }
       }
       return $this->redirect(['account/login']);
        
           
    }  
    /* Profile of supplier */
    public function actionProfile()
    {
        $model = $this->findProfile(Yii::$app->user->identity->id); 
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
