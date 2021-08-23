<?php

namespace app\modules\admin\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use app\modules\admin\models\UserSearch;
use app\modules\admin\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Profile;
use yii\web\UploadedFile;
use app\components\Helper;
use app\models\AuthItem;
use app\models\AuthAssignment;
use app\models\CylinderBooking;
use app\models\Cities;
use app\models\CylinderList;
use app\models\SupplierFile;//save pdf locations
use kartik\mpdf\Pdf;
use yii\helpers\ArrayHelper;


class AdminController extends \yii\web\Controller
{    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index','dashboard','profile','get-city-list'],
                'rules' => [
                    [
                        'actions' => ['dashboard','show-cylinder-stock-graph','get-city-list','profile'],
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
        $this->layout = '@app/views/layouts/dashboard';

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);                  
    }  

    public function actionPermission($token){
        $this->layout = '@app/views/layouts/dashboard';
        
        $AuthItems = ArrayHelper::map(AuthItem::find()->all(),'name','name');
        
        $authAssignmentItems = AuthAssignment::find()->where(['user_id'=>base64_decode($token)])->all(); 
        
        $authAssignmentItem = ArrayHelper::map($authAssignmentItems,'item_name','item_name');
        
        if (Yii::$app->request->post()) {
            $permissionDetails = Yii::$app->request->post();
            
            if(isset($permissionDetails['checkbox'])){

                foreach($authAssignmentItem as $AuthItems){
                    if(!in_array($AuthItems, $permissionDetails['checkbox'])){                        
                        $authAssignmentItems = AuthAssignment::find()->where(['item_name'=>$AuthItems,'user_id'=>base64_decode($token)])->one();
                        $authAssignmentItems->delete();                        
                    }
                }

                foreach($permissionDetails['checkbox'] as $permissionDetail){
                           
                    if(!in_array($permissionDetail, $authAssignmentItem)){
                        $model = new AuthAssignment();
                        $model->item_name = $permissionDetail;
                        $model->user_id = base64_decode($token); 
                        $model->save();                 
                            
                    }                    
                }
                Yii::$app->session->setFlash('permission', "Permission Succesfully Allowed.");              

            }else{
                $authAssignmentItems = AuthAssignment::deleteAll(['user_id'=>base64_decode($token)]);
                Yii::$app->session->setFlash('permission', "User All Permission Declined."); 
            }
            return $this->redirect(['dashboard']);
        }     

        return $this->render('permission',['token'=>$token,'authAssignmentItem'=>$authAssignmentItem,'AuthItems'=>$AuthItems]);
    }
   
    


    /* Profile of supplier */
    public function actionProfile()
    {
        $this->layout = '@app/views/layouts/dashboard';
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

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = '@app/views/layouts/dashboard';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = '@app/views/layouts/dashboard';

        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = '@app/views/layouts/dashboard';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->layout = '@app/views/layouts/dashboard';
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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


    /* Send mail */
    public function actionSendEmail()
    {
        $this->layout = '@app/views/layouts/dashboard';

        $mail_id = "kuhikarpalash@gmail.com";
        $details = ['first_name'=>Yii::$app->user->identity->first_name,'user_id'=>'saurabhkuhikar6@gmail.com','password'=>123456];
        Helper::sendMail($details,$mail_id);
    }
}