<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\CylinderBooking;
use app\models\CylinderBookingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Helper;
use app\models\CylinderList;
use app\models\GstTable;

/**
 * CylinderBookingController implements the CRUD actions for CylinderBooking model.
 */
class CylinderBookingController extends Controller
{   
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index','failure-page','successful-page','booking','create','update','bill-amount','payment-option','online-payment','save-cylinder-detail'],
                'rules' => [
                    [
                        'actions' => ['index','failure-page','successful-page','booking','view','create','update','delete','bill-amount','payment-option','online-payment','save-cylinder-detail'],
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
     * Lists all CylinderBooking models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'dashboard';  
        Helper::checkAccess("Customer");         
        $searchModel = new CylinderBookingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        
        return $this->render('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider]);    
       
    }

    /**
     * Displays a single CylinderBooking model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = 'dashboard'; 
        Yii::$app->session->setFlash('order success', "You have successfully Placed the order.The order will be deliver soon...");
        return $this->render('view', [
            'model' => $this->findModel(base64_decode($id)),
        ]);
    }

    /**
     * Creates a new CylinderBooking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($token)   
    {      
        $this->layout = 'dashboard';     
        Helper::checkAccess("Customer");  
        $model = new CylinderBooking();            
        if ($model->load(Yii::$app->request->post())) {
            $model->customer_id = Helper::getCurrentUserId();
            $model->supplier_id = base64_decode($token);
            $totalAmountSession = Helper::getSession('totalAmount');           
            if($model->total_amount != $totalAmountSession  && $model->total_amount != Null){
                $model->total_amount = $totalAmountSession;
            }
            if($model->save()){
                return $this->redirect(['payment-option','id' => $model->id]);
            }
        }
        
        return $this->render('create', ['model' => $model,'token' => $token]);         
    }

    /**
     * Creates a new CylinderBooking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionBooking($token)   
    {      
        $this->layout = 'dashboard';     
        Helper::checkAccess("Customer");  
        $model = new CylinderBooking();  
        $model->setScenario('cylinderDetail');          
        // if ($model->load(Yii::$app->request->post())) {

        //     $model->first_name = Yii::$app->user->identity->first_name;
        //     $model->last_name = Yii::$app->user->identity->last_name;
        //     $model->customer_id = Helper::getCurrentUserId();
        //     $model->supplier_id = base64_decode($token);
        //     $totalAmountSession = Helper::getSession('totalAmount');    
        //     $model->total_amount = $totalAmountSession;       
        //     if($model->total_amount != $totalAmountSession  && $model->total_amount != Null){
        //         $model->total_amount = $totalAmountSession;
        // if($model->save()){
        //     return $this->redirect(['successful-page','id' => base64_encode($model->id)]);
        // }
        //     }
        //     Helper::checkError($model);
        // }
              
        return $this->render('booking', ['model' => $model,'token' => $token]);         
    }

    /**
     * Save Cylinder Details.
     *
     * @return string
     */
    public function actionSaveCylinderDetail()
    {
        if (Yii::$app->request->isAjax) {
            $model = new CylinderBooking();
            $model->setScenario('cylinderDetail');

            $data = Yii::$app->request->post();           
            $data['CylinderBooking']['customer_id'] = Helper::getCurrentUserId();
            $data['CylinderBooking']['supplier_id'] = base64_decode($data['CylinderBooking']['token']);
            $data['CylinderBooking']['cylinder_type_id'] = $data['CylinderBooking']['cylinder_type_id'];
            $data['CylinderBooking']['cylinder_quantity'] = $data['CylinderBooking']['cylinder_quantity'];
            $data['CylinderBooking']['order_date'] = $data['CylinderBooking']['order_date'];

           
            $model->attributes = $data['CylinderBooking'];

            if ($model->save()) {
                Helper::createSession('user_id',$model->id);          
                return json_encode(['status' => 200,'message'=>'Your Cylinder Details Saved Successfully.','id' => base64_encode($model->id)]);
            } else {
                $errors = [];
                foreach ($model->getErrors() as $errorKey => $errorValue) {
                    $errors += [$errorKey => $errorValue[0]];
                }
                return json_encode(['status' => 401, 'errors' => $errors]);
            }
        }
    }

    /**
     * Save Covid Details.
     *
     * @return string
     */
    public function actionSaveCovidDetail()
    {
        
        if (Yii::$app->request->isAjax) {
            $model = $this->findModel(Helper::getSession('user_id')); 
            $model->setScenario('covidDetail');

            $data = Yii::$app->request->post(); 
            $data['CylinderBooking']['covid_test_result'] = $data['CylinderBooking']['covid_test_result'];
            $data['CylinderBooking']['covid_test_date'] = $data['CylinderBooking']['covid_test_date'];
            
            $model->attributes = $data['CylinderBooking'];

            if ($model->save()) {             
                return json_encode(['status' => 200,'message'=>'Your Covid Detail Saved Successfully.','id' => base64_encode($model->id)]);
            } else {
                $errors = [];
                foreach ($model->getErrors() as $errorKey => $errorValue) {
                    $errors += [$errorKey => $errorValue[0]];
                }
                return json_encode(['status' => 401, 'errors' => $errors]);
            }
        }
    }
    /**
     * Save Cart Details.
     *
     * @return string
     */
    public function actionSaveCartDetail()
    {
        if (Yii::$app->request->isAjax) {
            $model = $this->findModel(Helper::getSession('user_id'));

            $data = Yii::$app->request->post();  
            $data['CylinderBooking']['total_amount'] = Helper::getSession('totalAmount');
            $model->attributes = $data['CylinderBooking'];
            if ($model->save()) {
                return json_encode(['status' => 200,'message'=>'Your Cart Detail Saved Successfully.','id' => base64_encode($model->id)]);
            } else {
                $errors = [];
                foreach ($model->getErrors() as $errorKey => $errorValue) {
                    $errors += [$errorKey => $errorValue[0]];
                }
                return json_encode(['status' => 401, 'errors' => $errors]);
            }
        }
    }

    /**
     * Save Payment Information.
     *
     * @return string
     */

    public function actionSavePaymentInformation()
    {
        if (Yii::$app->request->isAjax) {
            $model = $this->findModel(Helper::getSession('user_id'));            
            $model->setScenario('paymentInformation');

            $data = Yii::$app->request->post();   

            $data['CylinderBooking']['payment_option'] = $data['CylinderBooking']['payment_option'];
            $data['CylinderBooking']['order_status'] = "Pending";

            $model->attributes = $data['CylinderBooking'];
            if ($model->save()) {
                if($model->payment_option == "Online"){
                    return $this->redirect(['online-payment','id' => base64_encode($model->id)]);
                }
                return $this->redirect(['successful-page','id' => base64_encode($model->id)]);
                return json_encode(['status' => 200,'message'=>'Your Payment Information Saved Successfully.','id' => base64_encode($model->id)]);
            } else {
                $errors = [];
                foreach ($model->getErrors() as $errorKey => $errorValue) {
                    $errors += [$errorKey => $errorValue[0]];
                }
                return json_encode(['status' => 401, 'errors' => $errors]);
            }
        }
    }


    /**
     * Updates an existing CylinderBooking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = 'dashboard';  
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->customer_id = Helper::getCurrentUserId(); 

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionSuccessfulPage($id){
        $this->layout = 'home'; 
        Helper::checkAccess("Customer");         
        $model = $this->findModel(base64_decode($id));
        if($model->order_status == "Pending"){
            $order_id = ''; 
            $order_id .= str_replace("-","",$model->order_date).'-'.$model->customer_id.'-'.$model->id .'-'.$model->cylinder_quantity;
        }else{
            return $this->render('failure-page');
        }
        
        return $this->render('successful-page',['order_id'=>$order_id]);
    }

    public function actionFailurePage(){
        $this->layout = 'home'; 
        return $this->render('failure-page');
    }

    public function actionOnlinePayment()
    {
        $this->layout = 'dashboard';
        
        return $this->render('online-payment',);
    }
    /**
     * Deletes an existing CylinderBooking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->layout = 'dashboard';  
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the CylinderBooking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CylinderBooking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CylinderBooking::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * send total amount of order.
     * @return mixed
     */
    public function actionBillAmount()
    {      
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();  
            $cylinderLists = CylinderList::find()->where(['user_id'=>base64_decode($data['token']),'cylinder_type_id'=>$data['cylinderType']])->joinWith('cylinderTypes')->one();
            $taxAmount = GstTable::find()->asArray()->one();
            $totalAmount = ($cylinderLists->selling_price * $data['cylinderQuantity']);             
            $gstAmount =  $totalAmount *$taxAmount['gst']/100;
            $sgstAmount =  $totalAmount *$taxAmount['sgst']/100;
            $cgstAmount =  $totalAmount *$taxAmount['cgst']/100;
            $totalAmount += $gstAmount;
            Helper::createSession('totalAmount',$totalAmount);
            $cylinderType = $cylinderLists->cylinderTypes->litre_quantity.' '.$cylinderLists->cylinderTypes->label;
            return json_encode(['status'=>200,'cylinderType'=>$cylinderType,'gstAmount'=>$gstAmount,'cgstAmount'=>$cgstAmount,'sgstAmount'=>$sgstAmount,'totalAmount'=>$totalAmount]);
        }
    }
}
