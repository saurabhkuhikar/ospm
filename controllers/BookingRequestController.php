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
        Helper::checkAccess("Supplier");        
        $searchModel = new BookingRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // $model = new ExportCylinderStock();
        // if ($model->load(Yii::$app->request->post()) ) {
        
        // }

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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BookingRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'dashboard';  
        $model = new BookingRequest();       

        if ($model->load(Yii::$app->request->post())) {               
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }        
        }
        return $this->render('create', [
            'model' => $model,
        ]);
                
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
        $model = $this->findModel($id);        

        if ($model->load(Yii::$app->request->post())){
            if($model->order_status == "Delivered"){
                $cylinderLists = CylinderList::find()->where(['user_id'=> $model->supplier_id , 'cylinder_type'=>$model->cylinder_type])->one();               
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
     * Export status wise data of booked cylinder 
     */

    public function actionExportBookingList($status){
        $booking_data = '';

        $booking_data .='
        <table bordered="1"> 
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

        $booking_lists = CylinderBooking::find()->where(['order_status'=>$status])->all();
        foreach($booking_lists as $booking_list){
            $booking_data .='
            <tr>
                <td>'.$booking_list->first_name.'</td>
                <td>'.$booking_list->last_name.'</td>
                <td>'.$booking_list->customer_id.'</td>
                <td>'.$booking_list->cylinder_type.'</td>
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
}
