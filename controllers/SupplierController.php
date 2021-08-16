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
use app\models\CylinderBooking;
use app\models\Cities;
use app\models\CylinderList;
use app\models\SupplierFile;//save pdf locations
use kartik\mpdf\Pdf;


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
                $cityLists = Cities::find()->where(['state_name'=>$_POST['getStateName']])->joinWith('states')->asArray()->all();
            }
        }
        
        return json_encode(['status'=>200,'cityLists'=>$cityLists]);
    }

/* Cylinder Stock Graph  */

    public function actionShowCylinderStockGraph(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $cylinderListStocks = CylinderList::find()->where(['user_id'=> Helper::getCurrentUserId()])->joinWith('cylinderTypes')->asArray()->all();
            $cylinder_quantity = [];
            $label = [];
            foreach( $cylinderListStocks as $cylinderListStock){
                array_push($label, $cylinderListStock['cylinderTypes']['litre_quantity'].' '.$cylinderListStock['cylinderTypes']['label']);
               array_push($cylinder_quantity,$cylinderListStock['cylinder_quantity']);
            }
        }        
        return json_encode(['status'=>200,'label'=>$label,'cylinder_quantity'=>$cylinder_quantity]);
    }

    
    /* Booked Cylinder Status Graph  */

    public function actionShowStatusGraph(){
        if (Yii::$app->request->isAjax) {
        $bookingRequestsDetails = BookingRequest::find()->select(['SUM( IF(order_status = "Pending", 1, 0) ) AS pending', 
        'SUM( IF(order_status = "Process", 1, 0) ) AS process','SUM( IF(order_status = "Delivered", 1, 0) ) AS delivered'])->where(['supplier_id' => Helper::getCurrentUserId()])->Asarray()->one();
        $bookingStatus = array_values($bookingRequestsDetails);   
        }
        return json_encode(['status'=>200,'bookingStatus'=>$bookingStatus]);
    }

    /* Download PDF Cylinder Status List  */
    public function actionGetCylinderStatusList($status){
        if(isset($status)){
            
            $contents = '';
            $contents .='
            <table bordered="1"> 
            <tr>            
            <th>Name of Customer</th>
            <th>Cylinder Type</th>
            <th>Cylinder Quantity</th>
            <th>Total Amount</th>
            <th>Order Date</th>
            <th>Order Status</th>
            <th>Payment Option</th>
            </tr>';
            
            $cylinderBookingStatus = BookingRequest::find()->where(['order_status'=>$status,'supplier_id'=>Helper::getCurrentUserId()])->joinWith('cylindertypes')->with('userdetails')->all();
            // Helper::dd($cylinderBookingStatus);
            setlocale(LC_MONETARY,"en_US");
            foreach($cylinderBookingStatus as $list){
                $contents .='
                <tr>                
                <td>'.$list->userdetails->first_name.' '.$list->userdetails->last_name.'</td>
                <td>'.$list->cylindertypes->litre_quantity.' '.$list->cylindertypes->label.'</td>
                <td>'.$list->cylinder_quantity.'</td>
                <td>'.'Rs. '.number_format($list->total_amount).'</td>
                <td>'.$list->order_date.'</td>
                <td>'.$list->order_status.'</td>
                <td>'.$list->payment_option.'</td>  
                </tr>';
            }
            $contents .='</table>';
            
            // $destination = Pdf::DEST_BROWSER;//show pdf in browser
            $destination = Pdf::DEST_DOWNLOAD;//download pdf 

            $filename = "cylinderStatusLists.pdf";

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
                'content' => $contents,
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
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    
    /* save PDF of all cylinder booking order list in serve   */
    public function actionBookingOrderPdfList(){ 

        $contents = '';
        $contents .='
        <table style="border:1px solid;border-collapse: collapse;"> 
        <tr style="border:1px solid;border-collapse: collapse;">            
        <th style="border:1px solid;border-collapse: collapse;">Name of Customer</th>
        <th style="border:1px solid;border-collapse: collapse;">Cylinder Type</th>
        <th style="border:1px solid;border-collapse: collapse;">Cylinder Quantity</th>
        <th style="border:1px solid;border-collapse: collapse;">Total Amount</th>
        <th style="border:1px solid;border-collapse: collapse;">Order Date</th>
        <th style="border:1px solid;border-collapse: collapse;">Order Status</th>
        <th style="border:1px solid;border-collapse: collapse;">Payment Option</th>
        </tr>';
        

        $cylinderBookingStatus = BookingRequest::find()->where(['supplier_id'=>Helper::getCurrentUserId()])->joinWith('cylindertypes')->with('userdetails')->all();

        setlocale(LC_MONETARY,"en_US");
        foreach($cylinderBookingStatus as $list){
            if($list->order_status == "Incomplete"){
                continue;
            }
            $contents .='
            <tr style="border:1px solid;border-collapse: collapse;">                
            <td style="border:1px solid;border-collapse: collapse;">'.$list->userdetails->first_name.' '.$list->userdetails->last_name.'</td>
            <td style="border:1px solid;border-collapse: collapse;">'.$list->cylindertypes->litre_quantity.' '.$list->cylindertypes->label.'</td>
            <td style="border:1px solid;border-collapse: collapse;">'.$list->cylinder_quantity.'</td>
            <td style="border:1px solid;border-collapse: collapse;">'.'Rs. '.number_format($list->total_amount).'</td>
            <td style="border:1px solid;border-collapse: collapse;">'.$list->order_date.'</td>
            <td style="border:1px solid;border-collapse: collapse;">'.$list->order_status.'</td>
            <td style="border:1px solid;border-collapse: collapse;">'.$list->payment_option.'</td>  
            </tr>';
        }
        $contents .='</table>';
        
        $destination = Pdf::DEST_BROWSER;//show pdf in browser

        // $destination = Pdf::DEST_DOWNLOAD;//download pdf 
        $filename = 'cylinderStatusLists'.Helper::getCurrentUserId().'.pdf';

        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => $destination,
            'filename' => $filename ,
            // your html content input
            'content' => $contents,         
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
        $mpdf = $pdf->api;
        $mpdf->WriteHTML($contents);

        $getDetails = SupplierFile::find()->where(['supplier_id'=>Helper::getCurrentUserId()])->all();       
        
        if(empty($getDetails)){
            $model = new SupplierFile();        
            $model->supplier_id = Helper::getCurrentUserId();
            $model->file_name = $filename;            
            $model->save(); 
        }else{
            foreach($getDetails as $getDetail){
                $getDetail['file_name'] = $filename;
                $getDetail->save();
            }
        }   
        // return the pdf output as per the destination setting
        return $mpdf->Output(Yii::getAlias('@app').'/web/upload/pdf/'.$filename,'F');
     
    }

    /* dowenload supplier list pdf from link */
    public function actionDownload($fileName){ 
        
        Helper::dd(base64_decode($fileName));
        $path = Yii::$app->getBasePath().'/web/upload/pdf/'.$fileName;       

        $root = Yii::getAlias('@web').$path;        
        if (file_exists($root)) {
            return Yii::$app->response->sendFile($root);
        } else {
            throw new \yii\web\NotFoundHttpException("{$path} is not found!");
        }
    }

    /* Send mail */
    public function actionSendEmail(){
        $mail_id = "kuhikarpalash@gmail.com";
        $details = ['first_name'=>Yii::$app->user->identity->first_name,'user_id'=>'saurabhkuhikar6@gmail.com','password'=>123456];
        Helper::sendMail($details,$mail_id);
    }
}