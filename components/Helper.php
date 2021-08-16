<?php

namespace app\components;
use Yii;

use yii\base\Component;
use yii\base\InvalidConfigException;
use app\models\LoginForm;
use yii\web\Session;

class Helper extends Component { 

  public static function dd($arg){
    echo "<pre>";
    print_r($arg);
    echo "</pre>";  
    die(); 
  }
  public static function checkError($arg){
    echo "<pre>";
    print_r($arg->getErrors());
    echo "</pre>";
    die();
  }
  

  public static function checkAccess($type){           
    if(Yii::$app->user->identity->account_type != $type){        
      throw new \yii\web\NotFoundHttpException('You are not authorised to access this page.');
    }    
  }

  public static function getCurrentUserId(){    
    return Yii::$app->user->identity->id;      
  }
  public static function createSession($name,$value){
    $session = Yii::$app->session;    
    $session->open();   
    $session[$name] = $value;
  } 
  
  public static function getSession($name){
    if(isset($_SESSION[$name])){
      $session = Yii::$app->session; 
      $session = $session->get($name);
      return $session;
    }
    throw new \yii\web\NotFoundHttpException('Somthing is going to be wrong.');
  }

  public static function sendMail($userDetails,$user_email_id){ 
    $send = Yii::$app->mailer->compose('templates/contact', ['userDetails'=>$userDetails])
    ->setFrom('saurabhkuhikar55@gmail.com')
    ->setTo($user_email_id)
    ->setSubject('Testing Mails')  
    ->send();
    if($send){  
      echo "<script>alert('email send Successfully')</script>";
    }
  
  }
} 
?>