<?php

    namespace app\components;

    class Instamojo {

        const version = '1.1';

        private static $endpoint = 'https://test.instamojo.com/api/1.1/';
        private static $api_key = 'bea7ada292de6b167f3389254cffa053';
        private static $auth_token = '1270c5d089646b4bee8494ad0ce70a2e';

        public function __construct() {
        
        }


        public static function send_request() {
            //Make sure cURL is available
            
                //The headers are required for authentication

                // $ch = curl_init();

                // curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
                // curl_setopt($ch, CURLOPT_HEADER, FALSE);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                // curl_setopt($ch, CURLOPT_HTTPHEADER,
                //     array("X-Api-Key:bea7ada292de6b167f3389254cffa053",
                //     "X-Auth-Token:1270c5d089646b4bee8494ad0ce70a2e"));

                //  $payload = Array(
                //     'purpose' => 'FIFA 16',
                //     'amount' => '2500',
                //     'phone' => '9999999999',
                //     'buyer_name' => 'John Doe',
                //     'redirect_url' => 'https://www.akastidesigns.com/redirect/',
                //     'send_email' => true,
                //     'webhook' => 'https://www.akastidesigns.com/webhook/',
                //     'send_sms' => true,
                //     'email' => 'foo@example.com',
                //     'allow_repeated_payments' => false
                // );


                // curl_setopt($ch, CURLOPT_POST, true);
                // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
                // $response = curl_exec($ch);
                // curl_close($ch); 

                // //echo $response;
                // $json_decode = json_decode($response,true);
                // $longurl = $json_decode['payment_request']['longurl'];
                // header('Location: '.$longurl);
                

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                curl_setopt($ch, CURLOPT_HTTPHEADER,
                            array("X-Api-Key:test_7b2e997b23061e1b475e68a2930",
                                  "X-Auth-Token:test_33438eb17ee550f6765d02f68a3"));
                $payload = Array(
                    'purpose' => 'FIFA 16',
                    'amount' => '2500',
                    'phone' => '9999999999',
                    'buyer_name' => 'John Doe',
                    'redirect_url' => 'http://www.example.com/redirect/',
                    'send_email' => true,
                    'webhook' => 'http://www.example.com/webhook/',
                    'send_sms' => true,
                    'email' => 'foo@example.com',
                    'allow_repeated_payments' => false
                );
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
                $response = curl_exec($ch);
                curl_close($ch); 

                echo $response;

                // echo "<pre>";
                // print_r('sadf');
                // echo "</pre>";
                die();
            
        }
    }
?>