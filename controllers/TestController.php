<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;
use app\components\Helper;
use app\components\Instamojo;
use kartik\mpdf\Pdf;

class TestController extends Controller
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
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $payload = Array(
            'purpose' => 'FIFA 16',
            'amount' => '2500',
            'phone' => '9999999999',
            'buyer_name' => 'John Doe',
            'redirect_url' => 'http://www.example.com/redirect/',
            'send_email' => true,
            'webhook' => 'http://www.example.com/webhook/',
            'send_sms' => true,
            'email' => 'saurabhkuhikar55@gmail.com',
            'allow_repeated_payments' => false
        );

        //Helper::dd($payload);
        Instamojo::send_request();
    }  

/* mail send */

public function actionSend() {

    \Yii::$app->mailer->htmlLayout = "@app/mail/layouts/html";
    $content = ['saurabh','123456'];
    $send = Yii::$app->mailer->compose('layouts/text.php', ['content' => $content])
    ->setFrom('saurabhkuhikar55@gmail.com')
    ->setTo('saurabhkuhikar6@gmail.com')
    ->setSubject('Testing Mails')
    ->setTextBody('Plain text content. YII2 Application')
    // ->setHtmlBody('<b style="color:red;">HTML content <i>Ram Pukar</i></b>')
    ->send();
    if($send){  
        echo "Send";
    }
}
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionSuccess($token){
        Helper::dd('Success page');
    }

    public function actionFail(){
        Helper::dd('fail page');
    }

    public function actionGetPdf(){
      
        $data = User::find()->one();
        // Helper::dd($data);
        // get your HTML raw content without any layouts or scripts

        // $destination = Pdf::DEST_BROWSER;
        $destination = Pdf::DEST_DOWNLOAD;

        $filename = "mydata.pdf";

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
            'content' => $this->renderPartial('get-pdf',['data'=>$data]),
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => 'p, td,div { font-family: freeserif; }; body, p { font-family: irannastaliq; font-size: 15pt; }; .kv-heading-1{font-size:18px}table{width: 100%;line-height: inherit;text-align: left; border-collapse: collapse;}table, td, th {border: 1px solid black;}',
            'marginFooter' => 5,
            // call mPDF methods on the fly
            'methods' => [
                'SetTitle' => ['SAMPLE PDF'],
                //'SetHeader' => ['SAMPLE'],
                'SetFooter' => ['Page {PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {            
        if ($action->id == 'create-payment-request') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function actionCreatePaymentRequest(){
        //$this->enableCsrfValidation = false;

        $baseUrl = 'http://localhost:8080/';
        $subscription = 10;

        \Stripe\Stripe::setApiKey('sk_test_51J4ToQSBTVzFci2y6FuORB0XREuoNPCQTXEPuDv2x2RzKSBET6aaQkI5m82116negOuK7XT2X0gARYQDCmV99LiS00kV5KXguA');

        header('Content-Type: application/json');

        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'inr',
                    'unit_amount' => $subscription*100,
                    'product_data' => [
                        'name' => 'OSPM',
                        'images' => ['https://d3jmn01ri1fzgl.cloudfront.net/photoadking/webp_thumbnail/5f6dc892e4397_template_image_1601030290.webp'],
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $baseUrl."test/success?token={CHECKOUT_SESSION_ID}",
            'cancel_url' => $baseUrl.'test/fail',
        ]);

        Helper::createSession('checkout_session', json_encode(['id' => $checkout_session->id,'amount' => $subscription]));
        return json_encode(['id' => $checkout_session->id]);
    }

    public function actionExport(){
        $output = '';
        $output .= '

        <table border= "1">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>State</th>
            <th>City</th>
        </tr>    
        ';

        $users = User::find()->all();
        foreach ($users as $user) { 
            $output .= '
            <tr>
                <td>'.$user->first_name.'</td>
                <td>'.$user->last_name.'</td>
                <td>'.$user->email.'</td>
                <td>'.$user->phone_number.'</td>
                <td>'.$user->state.'</td>
                <td>'.$user->city.'</td>
            </tr>';
        }

        $output .= '</table>';
        header("Content-Type: application/xls");
        header("Content-Disposition:attachment; filename=FullReport.xls");
        return $output;
        die(); 
    }
}
