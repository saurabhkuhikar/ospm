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
                'only' => ['logout','index','create','update','bill-amount','payment-option','online-payment'],
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete','bill-amount','payment-option','online-payment'],
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
            'model' => $this->findModel($id),
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

    public function actionPaymentOption($id)   
    {      
        $this->layout = 'dashboard'; 
        Helper::checkAccess("Customer");
        $model = $this->findModel($id);
        
        $model->setScenario('paymentOption');       
        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                if($model->payment_option == "Online"){
                    return $this->redirect(['online-payment','id' => $model->id]);
                }
                return $this->redirect(['view','id' => $model->id]);
            }
        }
        
        return $this->render('payment-option', ['model' => $model,]);         
    }

    public function actionOnlinePayment($id){
        $this->layout = 'dashboard'; 
        Helper::checkAccess("Customer");
        $model = $this->findModel($id);
        
        return $this->render('online-payment',['model' => $model,]);
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
            $cylinderLists = CylinderList::find()->where(['user_id'=>base64_decode($data['token']),'cylinder_type' => $data['cylinderType']])->one();
            $totalAmount = $cylinderLists->cylinder_price * $data['cylinderQuantity'];  
            Helper::createSession('totalAmount',$totalAmount);
            return json_encode(['status'=>200,'totalAmount'=>$totalAmount]);
        }
    }
}
