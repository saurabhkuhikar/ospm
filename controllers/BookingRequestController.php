<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\BookingRequest;
use app\models\BookingRequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Helper;
use app\models\CylinderList;
use app\models\CylinderBooking;
use kartik\mpdf\Pdf;

/**
 * BookingRequestController implements the CRUD actions for BookingRequest model.
 */
class BookingRequestController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index','view','create','update','delete'],
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete'],
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
     * Lists all BookingRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'dashboard';  
        
        // Helper::checkAccess("Supplier");        
        $searchModel = new BookingRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider]);    

    }

    /**
     * Displays a single BookingRequest model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {    
        $this->layout = 'dashboard'; 
        if(Yii::$app->user->can('booking-request/view')){ 
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else{
            throw new NotFoundHttpException('You are not authorized to access.');
        }
    }

    /**
     * Creates a new BookingRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'dashboard'; 
        if(Yii::$app->user->can('booking-request/create')){  
            $model = new BookingRequest();       

            if ($model->load(Yii::$app->request->post())) {               
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }        
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }else{
            throw new NotFoundHttpException('You are not authorized to access.');
        }
                
    }

    /**
     * Updates an existing BookingRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {   
        $this->layout = 'dashboard';  

        if(Yii::$app->user->can('booking-request/update')){ 
            $model = $this->findModel($id);        

            if ($model->load(Yii::$app->request->post())){
                if($model->order_status == "Delivered"){
                    $cylinderLists = CylinderList::find()->where(['user_id'=> $model->supplier_id ,'cylinder_type_id'=>$model->cylinder_type_id])->joinWith('cylinderTypes')->one();               
                    $cylinderLists->cylinder_quantity = $cylinderLists->cylinder_quantity - $model->cylinder_quantity;                
                    $cylinderLists->save();
                }            
                if($model->save()){       
                    return $this->redirect(['view', 'id' => $model->id]);       
                }
            }
            if($model->order_status != "Delivered"){
                return $this->render('update', [
                    'model' => $model,
                ]);                    
            }else{
                throw new NotFoundHttpException('Your customer order is Successfully delivered.');
            }
        }else{
            throw new NotFoundHttpException('You are not authorized to access.');
        }
    }

    /**
     * Deletes an existing BookingRequest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->layout = 'dashboard';
        if(Yii::$app->user->can('booking-request/update')){ 
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            throw new NotFoundHttpException('You are not authorized to access.');
        }
    }

    /**
     * Finds the BookingRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BookingRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BookingRequest::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    /**
     * Export Excelsheet status wise data of booked cylinder 
     */

    public function actionExportBookingList($status){

        $booking_data = '';

        $booking_data .='
        <table border="1"> 
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Customer id</th>
            <th>Cylinder Type</th>
            <th>Cylinder Quantity</th>
            <th>Total Amount</th>
            <th>Order Date</th>
            <th>Order Status</th>
            <th>Payment Option</th>
        </tr>';

        $booking_lists = BookingRequest::find()->where(['order_status'=>$status,'supplier_id'=>Helper::getCurrentUserId()])->joinWith('cylindertypes')->innerJoinWith('userdetails')->all();
        foreach($booking_lists as $booking_list){
            $booking_data .='
            <tr>
            <td>'.$booking_list->userdetails->first_name.'</td>
            <td>'.$booking_list->userdetails->last_name.'</td>
            <td>'.$booking_list->customer_id.'</td>
            <td>'.$booking_list->cylindertypes->litre_quantity.' '.$booking_list->cylindertypes->label.'</td>
            <td>'.$booking_list->cylinder_quantity.'</td>
            <td>'.$booking_list->total_amount.'</td>
            <td>'.$booking_list->order_date.'</td>
            <td>'.$booking_list->order_status.'</td>
            <td>'.$booking_list->payment_option.'</td>  
            </tr>';
        }
        $booking_data .='</table>';
        header("Content-Type: application/xls");
        header("Content-Disposition:attachment; filename=CylinderBookingList.xls");
        return $booking_data;
    }     
    
    /* order date wise cylinder booking status   */

    public function actionCylinderBookingStatusPdf()
    {
        $this->layout = 'dashboard'; 
        
        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            $cylinderOrderDate = $data['order_date'];
            if(!empty($cylinderOrderDate)){
                $bookingDetails = BookingRequest::find()->where(['order_date'=>$data['order_date'], 'supplier_id'=>Helper::getCurrentUserId()])->joinWith('cylindertypes')->with('userdetails')->all();
                // if(empty($bookingDetails)){
                //   Yii::$app->session->setFlash('fail', "Conents are not fount please select another date.")
                // }
                $booking_status_data = '';
                $booking_status_data .='
                <table border="1"> 
                <tr>          
                <th>First Name</th>
                <th>Last Name</th>               
                <th>Order Date</th>
                <th>Order Status</th>
                <th>Payment Mode</th>
                <th>Cylinder Type</th>
                <th>Cylinder Quantity</th>
                <th>Total Amount</th>
                </tr>';
                
                foreach($bookingDetails as $bookingDetail){
                    $booking_status_data .='
                    <tr>       
                    <td>'.$bookingDetail->userdetails->first_name.'</td>
                    <td>'.$bookingDetail->userdetails->last_name.'</td>             
                    <td>'.$bookingDetail->order_date.'</td>             
                    <td>'.$bookingDetail->order_status.'</td>             
                    <td>'.$bookingDetail->payment_option.'</td>             
                    <td>'.$bookingDetail->cylindertypes->litre_quantity.' '.$bookingDetail->cylindertypes->label.'</td>
                    <td>'.$bookingDetail->cylinder_quantity.'</td>
                    <td>'.'Rs. '.number_format($bookingDetail->total_amount).'</td>                   
                    </tr>';
                }
                $booking_status_data .='</table>';               
                
                $destination = Pdf::DEST_BROWSER;//show pdf in browser
                // $destination = Pdf::DEST_DOWNLOAD;//download pdf 

                $filename = "CylinderBookingStatus.pdf";

                $pdf = new Pdf([
                    // set to use core fonts only
                    'mode' => Pdf::MODE_UTF8,
                    // A4 paper format
                    'format' => Pdf::FORMAT_A4,
                    // portrait orientation
                    'orientation' => Pdf::ORIENT_PORTRAIT,
                    // stream to browser inline
                    'destination' => $destination,
                    'filename' => $filename,
                    // your html content input
                    'content' => $booking_status_data,
                    // format content from your own css file if needed or use the
                    // enhanced bootstrap css built by Krajee for mPDF formatting 
                    // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                    // any css to be embedded if required
                    'cssInline' => 'p, td,div { font-family: freeserif; }; body, p { font-family: irannastaliq; font-size: 15pt; }; .kv-heading-1{font-size:18px}table{width: 100%;line-height: inherit;text-align: left; border-collapse: collapse;}table, td, th {border: 1px solid black;text-align:center}',
                    'marginFooter' => 5,
                    // call mPDF methods on the fly
                    'methods' => [
                        'SetTitle' => ['Oxygen Cylinder Details'],
                        'SetHeader' => ['Oxygen Supply Plant Management (OSPM)'],
                        'SetFooter' => ['Page {PAGENO}'],
                    ]
                ]);
                
                // return the pdf output as per the destination setting
                return $pdf->render();
            }          
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
