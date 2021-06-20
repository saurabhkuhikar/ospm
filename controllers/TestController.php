<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\components\Helper;
use app\components\Instamojo;

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
}
